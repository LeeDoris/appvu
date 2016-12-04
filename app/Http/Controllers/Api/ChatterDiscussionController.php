<?php

namespace App\Http\Controllers\Api;

use App\Transformers\ChatterDiscussionTransformer;
use DevDojo\Chatter\Models\Discussion;

class ChatterDiscussionController extends ApiController
{
    public function __construct()
    {
        $this->middleware('authorized:chatterdiscussion');
    }

    public function index()
    {
        return $this->respondWith(
            Discussion::orderBy('created_at', 'DESC')->paginate(10), new ChatterDiscussionTransformer
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
    public function destroy(Discussion $chatterdiscussion)
    {
        $chatterdiscussion->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted discussion.'
        ]);
    }
}
