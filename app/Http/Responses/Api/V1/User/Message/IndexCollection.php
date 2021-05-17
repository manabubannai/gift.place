<?php
namespace App\Http\Responses\Api\V1\User\Message;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexCollection extends ResourceCollection
{
    /**
     * リソースコレクションを配列に変換.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return MessageIndexResource::collection($this->collection);
    }
}
