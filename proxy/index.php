<?php
/** 
 * PHP Reverse Proxy
 * v1.0 By shikukuya
 */

$real_url = $_SERVER["QUERY_STRING"];
$server_name = $_SERVER["SERVER_NAME"];
$method = $_SERVER["REQUEST_METHOD"];
$headers = getallheaders();
if (!preg_match("/https?:\/\/.+/", $real_url)) {
    $real_url = "http://" . $real_url;
}
$options["http"] = array(
    "timeout" => 15,
    "method" => $method,
    "header" => $headers,
);
$context = stream_context_create($options);
$response = file_get_contents($real_url, false, $context);
echo $response;