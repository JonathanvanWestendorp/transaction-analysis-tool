<?php

require __DIR__ . '/vendor/autoload.php';
use Ethereum\Ethereum;

print_r($_POST);

$rpcRequest = 
[
    "jsonrpc"   => "2.0",
    "method"    => "eth_sendTransaction",
    "id"        => 1,
    "params"    =>
    [
        "to"    => $_POST("contractAddress"),
        "data"  => "$call"
    ]
];

$rpcRequestJson = json_encode($rpcRequest);                  

$ch = curl_init("localhost:5000");

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $rpcRequestJson);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($rpcRequestJson))                                                                       
);

echo(curl_exec($ch));
curl_close($ch);

?>