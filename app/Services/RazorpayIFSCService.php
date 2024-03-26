<?php

namespace App\Services;

use GuzzleHttp\Client;

class RazorpayIFSCService
{
    protected $httpClient;
    protected $apiKey;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->apiKey = 'rzp_test_Pr8rSFGW98gREc';
    }

    public function searchIFSCByBankAndBranch($bankName, $branchName)
    {
        $url = "https://ifsc.razorpay.com/{$bankName}/{$branchName}";
        
        // https://razorpay.com/ifsc-code/axis-bank/karnataka/bengaluru/razorpay/UTIB000RAZP/

        try {
            $response = $this->httpClient->get($url, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':')
                ]
            ]);

            return json_decode($response->getBody(), true);
             $ifscCode = isset($responseData['IFSC']) ? $responseData['IFSC'] : null;

        return ['ifsc_code' => $ifscCode];
        } catch (\Exception $e) {
            // Handle exception
             return ['ifsc_code' => null];
        }
    }
}