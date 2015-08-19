<?php
namespace App\Http\Controllers;

use App\Repositories\MessageRepositoryInterface;
use Response;
use Input;

/**
 * Created for MarketTradeProcessor.
 * User: Robert Gabriel Dinu
 * Date: 8/13/15
 * Time: 13:30
 */
class MessageController extends Controller
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * @param MessageRepositoryInterface $messageRepository
     */
    function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }


    public function store()
    {
        $messages = Input::json();

        $this->messageRepository->manageMessages($messages);

        return Response::make("", \Illuminate\Http\Response::HTTP_CREATED);
    }

    public function index()
    {
        return Response::json($this->messageRepository->getAllMessages());
    }

} // end of class