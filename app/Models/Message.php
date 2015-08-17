<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:55
 */
class Message extends Model
{
    protected $fillable = [
        'userId',
        'currencyFrom',
        'currencyTo',
        'amountSell',
        'amountBuy',
        'rate',
        'timePlaced',
        'timePlaced',
        'originatingCountry',
    ];


} // end of class