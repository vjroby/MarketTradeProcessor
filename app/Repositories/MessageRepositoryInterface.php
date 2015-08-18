<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:32
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    /**
     * Method for proce
     * @param array $messages
     * @return mixed
     */
    public function manageMessages(array $messages);

    /**
     * @return Collection
     */
    public function getAllMessages();
} // end of class