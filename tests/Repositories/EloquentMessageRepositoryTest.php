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

    public function testManageMessage()
    {
        $this->createMocks();

        $redisConnection = m::mock("Predis\Client");

        $this->message->shouldReceive("newInstance")->once()->andReturnSelf();
        $this->message->shouldReceive("save")->once();


        \LRedis::shouldReceive("connection")->once()->andReturn($redisConnection);

        $redisConnection->shouldReceive("publish")->once();

        $this->messageRepository->manageMessages(new ParameterBag($this->getMessageDummy()));
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