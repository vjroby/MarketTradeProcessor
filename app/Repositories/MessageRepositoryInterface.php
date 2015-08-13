<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:32
 */

namespace App\Repositories;


interface MessageRepositoryInterface
{
    /**
     * Method for proce
     * @param array $messages
     * @return mixed
     */
    public function manageMessages(array $messages);
} // end of class