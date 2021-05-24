<?php

include __DIR__.'/vendor/autoload.php';

use Discord\Discord;

//Configurando o Discord;
$discord = new Discord([
    'token' => 'token',
]);

//-Toda a config da api daqui
$api_url = 'apiurl';

$json = file_get_contents($api_url);
$data = json_decode($json);

$exchange = $data -> rates;
//-Até aqui


function usdBrl(){
    global $currency, $exchange;
    $currency = ($exchange->BRL)/($exchange->USD);
    $currency = round($currency, 2);
    return $currency;
}

$discord->on('ready', function ($discord){
    echo "Bot is running!";

    $discord->on('message', function ($message, $discord){
        if ($message->content == "!moedas"){
            $message->channel->sendMessage("  __**Moedas Suportadas:**__".PHP_EOL."-Dolar:".PHP_EOL."```-dolar```");
        }
    });

    $discord->on('message', function ($message, $discord){
        //dolar
        if($message->content === "!dolar"){
            echo PHP_EOL.PHP_EOL."-Requisição de dolar.".PHP_EOL.PHP_EOL;
            $message->channel->sendMessage("**1** Dolar americano igual a".PHP_EOL."**".usdBrl()."** Real Brasileiro");
        }
    });
});

$discord->run();