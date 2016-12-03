<?php

namespace App\Transformers;

use App\Discussion;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = ['owner','reply'];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform(Discussion $discussion)
    {
        return [
            'id' => $discussion->id,
            'user_id' => $discussion->user_id,
            'body' => $discussion->body,
            'chatter_category_id' => $discussion->chatter_category_id,
        ];
    }
    public function includeOwner(Discussion $discussion){
        return $this->item($discussion->owner, new UserTransformer);
    }
    public function includeReply(Discussion $discussion){
        return $this->item($discussion->reply, new ReplyTransformer);
    }

}
