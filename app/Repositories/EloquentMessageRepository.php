<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:52
 */

namespace App\Repositories;


use App\Models\Message;

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