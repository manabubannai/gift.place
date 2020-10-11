<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\MessageLike;
use Illuminate\Http\Request;

class MessaegLikeController extends Controller
{
    public function __construct()
    {
    }

    public function store(Request $request)
    {
        // FIXME
        try {
            $like = MessageLike::create([
                'user_id'     => $request->input('user_id'),
                'message_id'  => $request->input('message_id'),
            ]);
        } catch (\Exception $e) {
            \Log::error($e);

            return response(['success' => false]);
        }

        $likesCount = MessageLike::where('message_id', $request->input('message_id'))->count();

        return response([
            'success'    => true,
            'isLiked'    => true,
            'likesCount' => $likesCount,
            'like'       => $like,
        ]);
    }

    public function destroy(int $id, Request $request)
    {
        // FIXME
        try {
            $messageLike = MessageLike::where('id', $id)->first();

            $messageLike->delete();
        } catch (\Exception $e) {
            \Log::error($e);

            return response(['success' => false]);
        }

        $likesCount = MessageLike::where('message_id', $request->input('message_id'))->count();

        return response([
            'success'    => true,
            'isLiked'    => false,
            'likesCount' => $likesCount,
        ]);
    }
}
