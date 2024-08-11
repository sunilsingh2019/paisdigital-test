<?php
$LPname = "Demo Website";

$conn = new mysqli('database', 'lamp', 'lamp', 'lamp');

if ($conn->connect_error) {
    trigger_error('Database connection failed: ' . $conn->connect_error, E_USER_ERROR);
}


function siteURL()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol.$domainName;
}
$siteURL = siteURL();

$all_enquiry = ['Book demo', 'Get in touch'];


?>
