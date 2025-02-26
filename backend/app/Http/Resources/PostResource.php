<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //whenLoaded('user') evita consultas innecesarias cuando la relación user no se ha cargado.
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'user' => $this->user,
            //'author' => new UserResource($this->whenLoaded('user')),
            //'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'comments' => $this->comments,  
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
