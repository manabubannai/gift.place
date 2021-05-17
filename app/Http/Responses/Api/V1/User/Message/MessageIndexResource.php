<?php
namespace App\Http\Responses\Api\V1\User\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'uuid'           => $this->uuid,
            'user_id'        => $this->user_id,
            'description'    => $this->description,
            'created_at_jst' => $this->created_at_jst,
            'user'           => new UserIndexResource($this->user),
        ];
    }
}
