<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:52
 */

namespace App\Repositories;


use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;

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
     * @param array $message
     * @return mixed
     */
    public function manageMessages(ParameterBag $message)
    {

        $this->sendMessageToRedis($this->saveMessageToDatabase($message->all()));
    }

    protected function saveMessageToDatabase( $message)
    {
        $message[self::TIME_PLACED] = new Carbon($message[self::TIME_PLACED]);

        $dataBseMessage = $this->messages->create($message);

        return  $dataBseMessage;
    }

    protected function sendMessageToRedis(Message $message)
    {
        $message[self::TIME_PLACED] = $message[self::TIME_PLACED]->toDateTimeString();
        $message[self::AMOUNT_BUY] = number_format($message[self::AMOUNT_BUY],2,'.','');
        $message[self::AMOUNT_SELL] = number_format($message[self::AMOUNT_SELL],2,'.','');
        $message[self::RATE] = number_format($message[self::RATE],4,'.','');
        $redis = \LRedis::connection();
        $redis->publish('message', $message->toJson());
    }
} // end of class