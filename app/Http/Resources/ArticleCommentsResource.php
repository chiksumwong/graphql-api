<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Comment;

class ArticleCommentsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($comment){
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'state' => $comment->status
                ];
            }),
        ];
    }


}
