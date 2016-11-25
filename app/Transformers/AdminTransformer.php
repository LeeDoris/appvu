<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\User;
use Hashids;

class AdminTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'hashid'   => Hashids::encode($user->id),
            'name'     => $user->name,
            'username' => $user->username,
            'avatar'   => $user->avatar,
            'email'    => $user->email,
            'bio'      => $user->bio
        ];
    }

}
