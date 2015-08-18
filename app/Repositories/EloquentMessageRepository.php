<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:52
 */

namespace App\Repositories;


use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

class EloquentMessageRepository implements MessageRepositoryInterface
{
    /**
     * @var Message
     */
    private $messages;

    /**
     * @param Message $messages
     */
    public function __construct(Message $messages)
    {
        $this->messages = $messages;
    }


    /**
     * @return Collection
     */
    public function getAllMessages()
    {
        return $this->messages->orderBy('messages.created_at','DESC')->get([
            'id',
            'userId',
            'currencyFrom',
            'currencyTo',
            'amountSell',
            'amountBuy',
            'rate',
            'timePlaced',
            'originatingCountry',
        ]);
    }

    /**
     * Method for proce
     * @param array $messages
     * @return mixed
     */
    public function manageMessages(array $messages)
    {
        // TODO: Implement manageMessages() method.
    }

    protected function saveMessageToDatabase(array $message)
    {

    }

    protected function sendMessageToRedis(array $message)
    {
        $redis = LRedis::connection();
        $redis->publish('message', json_encode($message));
    }
} // end of class