<?php

namespace App\Transformers;

use DevDojo\Chatter\Models\Category;
use League\Fractal\TransformerAbstract;

class ChatterCategoryTransformer extends TransformerAbstract
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
    public function transform(Category $chattercategory)
    {
        return [
            'id' => $chattercategory->id,
            'order' => $chattercategory->order,
            'name' => $chattercategory->name,
            'color' => $chattercategory->color,
            'slug' => $chattercategory->slug,
        ];
    }

}
