<?php
/**
 * Script Sederhana Telegram BOT
 * Menggunakan Bahasa Program PHP
 * @narablog
 */
 
 // Pengaturan Waktu Indonesia
date_default_timezone_set("ASIA/Jakarta");

// Token & API Telegram
$akses_token = '713568630:AAHjLw4IotfDLMnDBiKCeOX8u6J4nJrlVIk';
$api = 'https://api.telegram.org/bot' . $akses_token;

/**
 * Silahkan edit mulai dari sini
 * Sesuaikan dengan kebutuhan
 */

// Jika user bergabung
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
// Jika user datang
if ($output['message']['new_chat_member']){
$obj = $output['message']['new_chat_member'];
$MemberBaru ="Halo.. ". $obj['first_name'] ." - @".$obj['username'] . " Selamat Bergabung di Grup!";; 
sendMessage($chat_id, $MemberBaru);
}

// Jika user pergi
// Tidak berlaku ketika user pada grup sudah lebih dari 50
if ($output['message']['left_chat_member']){
$MemberPergi = "User @". $output['message']['left_chat_member']['username'] . " Meninggalkan Grup.";
sendMessage($chat_id, $MemberPergi);
}

// Respon Start
switch($message) {
case '/start':
sendMessage($chat_id, "Halo.. saya adalah BOT");
break;
}

// Cek Status BOT
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
switch($message) {
case '/status':
sendMessage($chat_id, "BOT Sedang ONLINE.");
break;
}

function sendMessage($chat_id, $message) {
file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&parse_mode=html');
}
?>
