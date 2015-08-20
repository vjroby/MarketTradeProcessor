<?php
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 20.08.2015
 * Time: 21:20
 */
class MessageSeeder extends DatabaseSeeder
{

    public function run()
    {
        DB::truncate("messages");

        DB::table("messages")->insert(
            [
                "userId"=> "54543",
                "currencyFrom" => "EUR",
                "currencyTo" => "GBP",
                "amountSell" => 667,
                "amountBuy" => 54.1,
                "rate" =>  0.102,
                "timePlaced" =>  \Carbon\Carbon::now(),
                "originatingCountry"=> "EN"
            ],
            [
                "userId"=> "123",
                "currencyFrom" => "RON",
                "currencyTo" => "GBP",
                "amountSell" => 123,
                "amountBuy" => 4.1,
                "rate" =>  0.102,
                "timePlaced" =>  \Carbon\Carbon::now(),
                "originatingCountry"=> "EN"
            ],
            [
                "userId"=> "321",
                "currencyFrom" => "AUD",
                "currencyTo" => "GBP",
                "amountSell" => 23,
                "amountBuy" => 54.1,
                "rate" =>  0.102,
                "timePlaced" =>  \Carbon\Carbon::now(),
                "originatingCountry"=> "EN"
            ]
        );
    }
}