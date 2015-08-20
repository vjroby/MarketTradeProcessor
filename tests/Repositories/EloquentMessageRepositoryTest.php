<?php
use App\Repositories\EloquentMessageRepository;
use Mockery as m;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 19.08.2015
 * Time: 21:29
 */
class EloquentMessageRepositoryTest extends TestCase
{
    /**
     * @var Mockery\MockInterface
     */
    protected $message;
    /**
     * @var EloquentMessageRepository
     */
    protected $messageRepository;

    public function createMocks()
    {
        $this->message = m::mock("App\Models\Message");
        $this->messageRepository = new EloquentMessageRepository($this->message);
    }

    public function prepareDatebase()
    {
        Artisan::call("migrate");
    }

    public function testManageMessage()
    {
        $this->createMocks();


        $redisConnection = m::mock("Predis\Client");

        $this->message->shouldReceive("newInstance")->once()->andReturnSelf();
        $this->message->shouldReceive("save")->once();
        $this->message->shouldReceive("offsetGet")->once()->with(EloquentMessageRepository::TIME_PLACED)->andReturnSelf();
        $this->message->shouldReceive("offsetSet")->once()->with(EloquentMessageRepository::TIME_PLACED,"dummy date");
        $this->message->shouldReceive("offsetGet")->once()->with(EloquentMessageRepository::AMOUNT_BUY)->andReturn("100.1");
        $this->message->shouldReceive("offsetSet")->once()->with(EloquentMessageRepository::AMOUNT_BUY, "100.10");
        $this->message->shouldReceive("offsetGet")->once()->with(EloquentMessageRepository::AMOUNT_SELL)->andReturn("45");
        $this->message->shouldReceive("offsetSet")->once()->with(EloquentMessageRepository::AMOUNT_SELL,"45.00");
        $this->message->shouldReceive("offsetGet")->once()->with(EloquentMessageRepository::RATE)->andReturn("4.23");
        $this->message->shouldReceive("offsetSet")->once()->with(EloquentMessageRepository::RATE, "4.2300");
        $this->message->shouldReceive("toDateTimeString")->once()->andReturn("dummy date");
        $this->message->shouldReceive("toJson")->once()->andReturn("dummy json");


        \LRedis::shouldReceive("connection")->once()->andReturn($redisConnection);

        $redisConnection->shouldReceive("publish")->once()->with("message", "dummy json");

        $this->messageRepository->manageMessages(new ParameterBag($this->getMessageDummy()));
    }

    public function testGetAllMessages()
    {
        $this->createMocks();
        
        $this->message->shouldReceive("orderBy")->once()->with('messages.created_at','DESC')->andReturnSelf();
        $this->message->shouldReceive("get")->once()->with([
            EloquentMessageRepository::ID,
            EloquentMessageRepository::USER_ID,
            EloquentMessageRepository::CURRENCY_FROM,
            EloquentMessageRepository::CURRENCY_TO,
            EloquentMessageRepository::AMOUNT_SELL,
            EloquentMessageRepository::AMOUNT_BUY,
            EloquentMessageRepository::RATE,
            EloquentMessageRepository::TIME_PLACED,
            EloquentMessageRepository::ORIGINATING_COUNTRY,
        ])->andReturn($this->getMessageDummy());

        $data =  $this->messageRepository->getAllMessages();

        $this->assertEquals($this->getMessageDummy(), $data);
    }


    public function run(PHPUnit_Framework_TestResult $result = null)
    {
        return parent::run($result);

    }

    protected function getMessageDummy()
    {
        return [
            "userId"=> "54543",
            "currencyFrom" => "EUR",
            "currencyTo" => "GBP",
            "amountSell" => 667,
            "amountBuy" => 54.1,
            "rate" =>  0.102,
            "timePlaced" =>  "12-JUL-15 02:13:23",
            "originatingCountry"=> "EN"
        ];
    }
}











