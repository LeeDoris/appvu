<?php

namespace App\Transformers;

use App\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = ['owner','discussion'];

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
    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id,
            'user_id' => $reply->user_id,
            'body' => $reply->body,
            'chatter_discussion_id' => $reply->chatter_discussion_id,
        ];
    }

    public function includeOwner(Reply $reply){
        return $this->item($reply->owner, new UserTransformer);
    }
    public function includeDiscussion(Reply $reply){
        return $this->item($reply->discussion, new CommentTransfrom);
    }

}
