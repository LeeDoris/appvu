<?php

namespace App\Http\Controllers\Api;

use App\Transformers\ChatterPostTransformer;
use DevDojo\Chatter\Models\Post;

class ChatterPostController extends ApiController
{
    public function __construct()
    {
        $this->middleware('authorized:chatterpost');
    }

    public function index()
    {
        return $this->respondWith(
            Post::orderBy('created_at', 'DESC')->paginate(10), new ChatterPostTransformer
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Discussion $discussion
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     *
     */
    public function destroy(Post $chatterpost)
    {
        $chatterpost->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted post.'
        ]);
    }
}
