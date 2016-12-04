<?php

namespace App\Transformers;

use DevDojo\Chatter\Models\Post;
use League\Fractal\TransformerAbstract;

class ChatterPostTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

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
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'body' => $post->body,
            'chatter_discussion_id' => $post->chatter_discussion_id,
        ];
    }

}
