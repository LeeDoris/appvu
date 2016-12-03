<?php

namespace App\Http\Controllers\Api;

use App\Reply;
use App\Transformers\ReplyTransformer;

class ReplyController extends ApiController
{
    public function __construct()
    {
        $this->middleware('authorized:reply');
    }

    public function index()
    {
        return $this->respondWith(
            Reply::orderBy('created_at', 'DESC')->paginate(10), new ReplyTransformer
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
    public function destroy(Reply $reply)
    {
        $reply->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted discussion.'
        ]);
    }
}
