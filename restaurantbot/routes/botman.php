<?php


use App\Middleware\RasaNLU;

$botman = resolve('botman');

$rasaNLU = RasaNLU::create()->listenForAction();
$botman->middleware->received($rasaNLU);

$botman->group(['middleware' => $rasaNLU], function (\BotMan\BotMan\BotMan $botman) {

    $botman->hears('greet', function (\BotMan\BotMan\BotMan $bot) {
        $bot->reply("Welcome to the chatbot.");
    });

    $botman->hears('goodbye', function (\BotMan\BotMan\BotMan $bot) {
        $bot->reply("See you soon.");
    });

    $botman->hears('restaurant_search', function (\BotMan\BotMan\BotMan $bot) {

        $extra = var_export($bot->getMessage()->getExtras(), true);
        $entities = var_export($bot->getMessage()->getExtras('apiEntities'), true);

        $bot->reply($extra .$entities);

    });

}
);