<?php
/** 
 * PHP Reverse Proxy
 * v1.0 By shikukuya
 */

$url_pattern = "/https?:\/\/[-A-Za-z0-9+&@#\/%?=~_|!:,.;]+[-A-Za-z0-9+&@#\/%=~_|]/";
$real_url = $_SERVER["QUERY_STRING"];
$server_name = $_SERVER["SERVER_NAME"];
$method = $_SERVER["REQUEST_METHOD"];
$headers = getallheaders();
$headers_string = "";
foreach ($headers as $k => $v) {
    $headers_string = "$headers_string$k: $v\n";
}
if (!preg_match($url_pattern, $real_url)) {
    $real_url = "http://$real_url";
}
$options["http"] = array(
    "timeout" => 15,
    "method" => $method,
    "header" => $headers_string,
);
$context = stream_context_create($options);
$response = file_get_contents($real_url, false, $context);
$response = preg_replace_callback($url_pattern, function ($m) {
    global $server_name;
    return "http://$server_name/proxy/?" . $m[0];
}, $response);
echo $response;