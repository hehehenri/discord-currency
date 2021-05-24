<?php

include __DIR__.'/vendor/autoload.php';

use Discord\Discord;

//Configurando o Discord;
$discord = new Discord([
    'token' => 'ODQ1NzgwNDM1OTg0NDQ5NTk3.YKl8aQ.ZSB8_n0SUmg3sBeLvrn9IyUi_nY',
]);

//-Toda a config da api daqui
$api_url = 'http://data.fixer.io/api/latest?access_key=9685b2f46fb15830a6db760e4ec51651&format=1';

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