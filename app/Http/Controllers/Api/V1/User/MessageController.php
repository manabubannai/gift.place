<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\V1\User\Message\IndexCollection;
use App\Services\Message\MessageServiceInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MessageServiceInterface $messageService
    ) {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        $messages = $this->messageService->paginateOrderByDesc($request->all());

        return new IndexCollection($messages);
    }
}
