<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:32
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;

interface MessageRepositoryInterface
{
    const ID = 'id';
    const USER_ID = 'userId';
    const CURRENCY_FROM = 'currencyFrom';
    const CURRENCY_TO = 'currencyTo';
    const AMOUNT_SELL = 'amountSell';
    const AMOUNT_BUY = 'amountBuy';
    const RATE = 'rate';
    const TIME_PLACED = 'timePlaced';
    const ORIGINATING_COUNTRY = 'originatingCountry';
    /**
     * Method for proce
     * @param array $message
     * @return mixed
     */
    public function manageMessages(ParameterBag $message);

    /**
     * @return Collection
     */
    public function getAllMessages();
} // end of class