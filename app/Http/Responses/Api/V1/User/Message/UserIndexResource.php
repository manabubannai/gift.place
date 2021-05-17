<?php
namespace App\Http\Responses\Api\V1\User\Message;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIndexResource extends JsonResource
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
            'name'      => $this->name,
            'slug'      => $this->slug,
            'cover_url' => $this->cover_url,
        ];
    }
}
