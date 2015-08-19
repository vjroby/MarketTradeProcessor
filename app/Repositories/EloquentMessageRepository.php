<?php
/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:52
 */

namespace App\Repositories;


use App\Exceptions\ValidationException;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;
use Validator;

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
            self::ID,
            self::USER_ID,
            self::CURRENCY_FROM,
            self::CURRENCY_TO,
            self::AMOUNT_SELL,
            self::AMOUNT_BUY,
            self::RATE,
            self::TIME_PLACED,
            self::ORIGINATING_COUNTRY,
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
        $this->validateMessage($message);
        $message[self::TIME_PLACED] = new Carbon($message[self::TIME_PLACED]);

        $dataBseMessage = $this->messages->newInstance($message);
        $dataBseMessage->save();

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

    protected function validateMessage($message)
    {
        $validator =  Validator::make(
            $message,
            [
                self::USER_ID => ['required', 'numeric'],
                self::CURRENCY_FROM => ['required', 'alpha_num','max:3'],
                self::CURRENCY_TO => ['required', 'alpha_num','max:3'],
                self::AMOUNT_SELL => ['required', 'numeric'],
                self::AMOUNT_BUY => ['required', 'numeric'],
                self::RATE => ['required', 'numeric'],
                self::TIME_PLACED => ['required', 'date'],
                self::ORIGINATING_COUNTRY => ['required', 'alpha_num'],
            ]
        );

        if ($validator->fails()){
            throw new ValidationException($validator->messages());
        }
    }
} // end of class