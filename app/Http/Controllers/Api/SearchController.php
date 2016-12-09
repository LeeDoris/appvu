<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Transformers\PostTransformer;

use Illuminate\Support\Facades\Input;

class SearchController extends ApiController
{
    public function index()
    {
        $query = e(Input::get('q',''));
        if(!$query && $query == ''){
            return $this->respondWith('', new PostTransformer);
        }
        $products = Post::where('title','like','%'.$query.'%')->get();
        return $this->respondWith($products, new PostTransformer);
    }
}
