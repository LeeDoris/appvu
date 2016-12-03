<?php

namespace App\Http\Controllers\Api;

use App\Discussion;
use App\Transformers\CommentTransformer;

class CommentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('authorized:comment');
    }

    public function index()
    {
        return $this->respondWith(
            Discussion::orderBy('created_at', 'DESC')->paginate(10), new CommentTransformer
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
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted discussion.'
        ]);
    }
}
