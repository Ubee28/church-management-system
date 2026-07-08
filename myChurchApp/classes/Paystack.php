<?php 


require_once "Config.php";
error_reporting(E_ALL);


        class Paystack
        {
            private $secret_key;
            public function __construct(){
                $this->secret_key= PAYSTACK_SECRET_KEY;
            }

            public function generateReference(){
                return 'DON_' . time() . '_' . uniqid();
            }

            public function verifyPayment($reference){
                    // Paystack API call
                     $curl = curl_init();

                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => [
                            "Authorization: Bearer " . $this->secret_key,
                            "Cache-Control: no-cache",
                        ]
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);

                    return json_decode($response, true);
            }

           

        
        }



?>