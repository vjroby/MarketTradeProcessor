<?php
use App\Exceptions\ValidationException;
use Mockery as m;
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 12.08.2015
 * Time: 21:13
 */
class MessageControllerTest extends TestCase
{
    /**
     * @var Mockery\MockInterface
     */
    protected $messageRepositoryMock;

    public function testGettMessage()
    {
        $this->createMockObjects();
        $this->withoutMiddleware();

        $this->messageRepositoryMock->shouldReceive("getAllMessages")->once()
        ->andReturn($this->getMessageDummy());

        $response =  $this->call("GET", "/message");
        $this->assertEquals(\Illuminate\Http\Response::HTTP_OK, $response->getStatusCode());
        $data = json_decode($response->content(), true);

        $this->assertEquals($this->getMessageDummy(), $data);
    }

    public function testPostMessage()
    {
        $this->createMockObjects();
        $this->withoutMiddleware();

        $this->messageRepositoryMock->shouldReceive("manageMessages")->once();

        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($this->getPostMessageDummy()));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testInvalidUserId()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['userId']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testInvalidCurrencyFrom()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['currencyFrom']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testInvalidCurrencyTo()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['currencyTo']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testInvalidAmountSell()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['amountSell']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testInvalidAmountBuy()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['amountBuy']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testInvalidRate()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['rate']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testInvalidTimePlaced()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['timePlaced']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testInvalidOriginatingCountry()
    {
        $this->withoutMiddleware();

        $dummy = $this->getPostMessageDummy();
        unset($dummy['originatingCountry']);
        $response =  $this->call("POST", "/message",[],[],[],[], json_encode($dummy));
        $this->assertEquals(\Illuminate\Http\Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }



    protected function getPostMessageDummy()
    {
        return [
            "userId"=> "54543",
            "currencyFrom" => "EUR",
            "currencyTo" => "GBP",
            "amountSell" => 1000,
            "amountBuy" => 747.1,
            "rate" =>  0.7471,
            "timePlaced" =>  "12-JUL-15 02:13:23",
            "originatingCountry"=> "RO"
        ];
    }

    protected function getMessageDummy()
    {
        return [
            [
                "id" => 321,
                "userId"=> "565",
                "currencyFrom" => "USD",
                "currencyTo" => "RON",
                "amountSell" => 1000,
                "amountBuy" => 747.1,
                "rate" =>  0.7471,
                "timePlaced" =>  "12-JUL-12 02:13:23",
                "originatingCountry"=> "RO"
            ],
            [
                "id" => 322,
                "userId"=> "565",
                "currencyFrom" => "USD",
                "currencyTo" => "RON",
                "amountSell" => 1000,
                "amountBuy" => 747.1,
                "rate" =>  0.7471,
                "timePlaced" =>  "12-JUL-12 02:13:23",
                "originatingCountry"=> "RO"
            ],
        ];
    }

    public function createMockObjects()
    {
        $this->messageRepositoryMock = m::mock("App\Repositories\EloquentMessageRepository");
        $this->app->instance("App\Repositories\EloquentMessageRepository", $this->messageRepositoryMock);

    }

    public function run(PHPUnit_Framework_TestResult $result = null)
    {

        return parent::run($result);

    }
}