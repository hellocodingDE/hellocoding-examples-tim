<?php

class DiscordWebhook {
  function __construct() { }

  public function postWebhook($discord_webhook_url = "", $message = '') {
    $discord_message = array();
    // $discord_message["content"] = "Hallo Welt <@300306717802102784>";
    $discord_message["content"] = $message;
    $discord_message = json_encode($discord_message);
    $curl = curl_init($discord_webhook_url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $discord_message);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Length: ".strlen($discord_message),
        "Content-Type: application/json"
    ]);

    curl_exec($curl);
  }
}

$discord = new DiscordWebhook();
$discord->postWebhook('https://discord/webhookurl', "This is a Message!");
