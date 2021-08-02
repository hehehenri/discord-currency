<?php

include __DIR__.'/vendor/autoload.php';

use Discord\Discord;

//Configurando o Discord;
$discord = new Discord([
    'token' => 'ODQ1NzgwNDM1OTg0NDQ5NTk3.YKl8aQ.B4qQmh6BLjOSKsyvnQxKIAdsD7g',
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
    echo PHP_EOL.PHP_EOL."-Requisição de dolar.".PHP_EOL.PHP_EOL;
    return $currency;
}

function eurBrl(){
    global $currency, $exchange;
    $currency = ($exchange->BRL)/($exchange->EUR);
    $currency = round($currency, 2);
    echo PHP_EOL.PHP_EOL."-Requisição de euro.".PHP_EOL.PHP_EOL;
    return $currency;
}

function gbpBrl(){
    global $currency, $exchange;
    $currency = ($exchange->BRL)/($exchange->GBP);
    $currency = round($currency, 2);
    echo PHP_EOL.PHP_EOL."-Requisição de libra.".PHP_EOL.PHP_EOL;
    return $currency;
}

function btcBrl(){
    global $currency, $exchange;
    $currency = ($exchange->BRL)/($exchange->BTC);
    $currency = round($currency, 2);
    echo PHP_EOL.PHP_EOL."-Requisição de BTC.".PHP_EOL.PHP_EOL;
    return $currency;
}
$discord->on('ready', function ($discord){
    echo "Bot is running!";
    $discord->on('message', function ($message, $discord){
        if ($message->content == "!moedas"){
            echo PHP_EOL.PHP_EOL."-Consulta.".PHP_EOL.PHP_EOL;
            $message->channel->sendMessage("  **Moedas Suportadas:**"
                .PHP_EOL."-Dolar: "."`!dolar`"
                .PHP_EOL."-Euro: "."`!euro`"
                .PHP_EOL."-Libra: "."`!libra`"
                .PHP_EOL."-Bitcoin: ". "`!btc`");
        }

        //dolar
        if($message->content === "!dolar"){
            $message->channel->sendMessage("**1** Dolar americano igual a".PHP_EOL."**".usdBrl()."** Real Brasileiro");
        }

        //euro
        if($message->content === "!euro"){
            $message->channel->sendMessage("**1** Euro igual a".PHP_EOL."**".eurBrl()."** Real Brasileiro");
        }

        //libra
        if($message->content === "!libra"){
            $message->channel->sendMessage("**1** Libra esterlina igual a".PHP_EOL."**".gbpBrl()."** Real Brasileiro");
        }

        //bitcoin
        if($message->content === "!btc"){
            $message->channel->sendMessage("**1** Bitcoin igual a".PHP_EOL."**".btcBrl()."** Real Brasileiro");
        }

    });
});

$discord->run();