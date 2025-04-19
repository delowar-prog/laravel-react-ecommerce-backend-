<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class BkashController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct()
    {
        // bKash Merchant API Information
        $bkash_app_key = '5tunt4masn6pv2hnvte1sb5n3j'; // bKash Merchant API APP KEY
        $bkash_app_secret = '1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka'; // bKash Merchant API APP SECRET
        $bkash_username = 'sandboxTestUser'; // bKash Merchant API USERNAME
        $bkash_password = 'hWD@8vtzw0'; // bKash Merchant API PASSWORD
        $bkash_base_url = 'https://checkout.sandbox.bka.sh/v1.2.0-beta'; // For Live Production URL: https://checkout.pay.bka.sh/v1.2.0-beta

        $this->app_key = $bkash_app_key;
        $this->app_secret = $bkash_app_secret;
        $this->username = $bkash_username;
        $this->password = $bkash_password;
        $this->base_url = $bkash_base_url;
    }

    // 🔑 Get Token Method
    public function getToken()
    {
        // If token exists in cache and is not expired, return it
        if (Cache::has('bkash_token')) {
            return response()->json(['success' => true, 'token' => Cache::get('bkash_token')], 200);
        }

        // Generate new token if not found or expired
        $post_token = json_encode([
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret
        ]);

        $url = curl_init("$this->base_url/checkout/token/grant");
        $header = [
            'Content-Type: application/json',
            "password: $this->password",
            "username: $this->username"
        ];

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        // Check for error in response
        if (isset($response['msg'])) {
            return response()->json(['error' => $response['msg']], 400);
        }

        // Store token in Cache for 60 minutes
        Cache::put('bkash_token', $response['id_token'], now()->addMinutes(60));

        return response()->json(['success' => true, 'token' => $response['id_token']], 200);
    }

    // 💳 Create Payment Method
    public function createPayment(Request $request)
    {
        // Get token from cache or refresh it if expired
        $token = Cache::get('bkash_token');
        if (!$token) {
            // Token is expired or not found, refresh it
            $tokenResponse = $this->getToken();
            if ($tokenResponse->getStatusCode() != 200) {
                return response()->json(["error" => "Failed to get token."], 401);
            }
            $token = $tokenResponse->getData()->token;
        }
    
        // Prepare the payment request data
        $requestData = [
            'intent' => 'sale',
            'amount' => number_format((float)$request->amount, 2, '.', ''),
            'currency' => 'BDT',
            'merchantInvoiceNumber' => $request->merchantInvoiceNumber ?? 'INV' . rand(1000, 9999)
        ];
    
        // Call the bKash payment API
        $url = curl_init("$this->base_url/checkout/payment/create");
        $header = [
            'Content-Type: application/json',
            "authorization: $token",
            "x-app-key: $this->app_key"
        ];
    
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    
        $response = curl_exec($url);
        $httpCode = curl_getinfo($url, CURLINFO_HTTP_CODE);
        curl_close($url);
    
        return response()->json([
            'request_payload' => $requestData,
            'http_code' => $httpCode,
            'response' => json_decode($response, true)
        ]);
    }

    // 🏦 Execute Payment Method
    public function executePayment(Request $request)
    {
        // 1. Get the token (refresh if needed)
        $token = Cache::get('bkash_token');
        if (!$token) {
            $tokenResponse = $this->getToken();
            if ($tokenResponse->getStatusCode() != 200) {
                return response()->json(["error" => "Failed to get token."], 401);
            }
            $token = $tokenResponse->getData()->token;
        }
    
        $paymentID = $request->paymentID;
    
        // 2. Query payment status first
        $paymentStatus = $this->queryPayment($paymentID);
    
        if (!isset($paymentStatus['transactionStatus'])) {
            return response()->json([
                "error" => "Unable to retrieve payment status.",
                "bkashResponse" => $paymentStatus
            ], 400);
        }
    
        if ($paymentStatus['transactionStatus'] !== 'Initiated') {
            return response()->json([
                "message" => "Payment already processed or invalid state.",
                "paymentInfo" => $paymentStatus
            ], 200);
        }
    
        // 3. Build execute URL and headers
        sleep(2); // Optional: Sleep for 2 seconds to avoid rate limiting
        $url = rtrim("$this->base_url/checkout/payment/execute/$paymentID", '/');
    
        $headers = [
            'Content-Type: application/json',
            "authorization: $token",
            "x-app-key: $this->app_key"
        ];
    
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "POST"
        ]);
    
        $result = curl_exec($ch);
    
        if (curl_errno($ch)) {
            return response()->json(["error" => "cURL Error: " . curl_error($ch)], 500);
        }
    
        curl_close($ch);
    
        $response = json_decode($result, true);
    
        // 4. Handle bKash API response
        if (isset($response['errorCode'])) {
            if ($response['errorCode'] == '2117') {
                // Already executed, just query again and return final state
                $finalStatus = $this->queryPayment($paymentID);
                return response()->json([
                    "message" => "Payment has already been executed before.",
                    "paymentInfo" => $finalStatus
                ]);
            }
    
            if ($response['errorCode'] == '2056') {
                return response()->json([
                    "error" => "Invalid payment state during execution.",
                    "bkashResponse" => $response
                ], 400);
            }
    
            return response()->json([
                "error" => "Unknown error during payment execution.",
                "bkashResponse" => $response
            ], 500);
        }
    
        // 5. Return successful execution response
        return response()->json([
            "message" => "Payment executed successfully.",
            "bkashResponse" => $response
        ]);
    }
    
    
    


    // 🔍 Query Payment Method
    public function queryPayment($paymentID)
    {
        // Get token from cache or refresh it if expired
        $token = Cache::get('bkash_token');
        if (!$token) {
            // Token is expired or not found, refresh it
            $tokenResponse = $this->getToken();
            if ($tokenResponse->getStatusCode() != 200) {
                return response()->json(["error" => "Failed to get token."], 401);
            }
            $token = $tokenResponse->getData()->token;
        }
    
        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);
        $header = [
            'Content-Type: application/json',
            "authorization: $token",
            "x-app-key: $this->app_key"
        ];
    
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
    
        return json_decode($resultdata, true);
    }
    
    

    // 🏁 Handle Payment Success
    public function bkashSuccess(Request $request)
    {
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE
        if ('Noman' == 'success') {
            // Redirect to your success route
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }
}
