<?php

namespace App\Transformers;

use DevDojo\Chatter\Models\Discussion;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ChatterDiscussionTransformer extends TransformerAbstract
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
    public function transform(Discussion $discussion)
    {
        return [
            'id' => $discussion->id,
            'user_id' => $discussion->user_id,
            'title' => $discussion->title,
            'chatter_category_id' => $discussion->chatter_category_id,
        ];
    }

}
