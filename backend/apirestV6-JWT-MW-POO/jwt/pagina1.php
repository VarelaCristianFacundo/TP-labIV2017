<?php
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
$headers = apache_request_headers();
$key = "example_key";

$tk = explode(' ', $headers['Authorization']);
try {
  $decoded = JWT::decode($tk[1], $key, array('HS256'));

} catch (\Firebase\JWT\ExpiredException $e) {

}
if ($decoded){
  $rta['rta'] = $decoded;
  // return true;
}
else {
  $rta['rta'] = false;

}
print_r(json_encode($rta));

return;
/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($token, $key);
$tok['token'] = $jwt;
print_r(json_encode($tok));
return;


?>
