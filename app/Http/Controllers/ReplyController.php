<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;


use App\Reply;
use Validator;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->remove('_token');

        $request->request->add(['user_id' => Auth::user()->id]);
        $disc_id = (int)$request->get('chatter_discussion_id');
        $request->request->add(['chatter_discussion_id' => $disc_id]);

        $validator = Validator::make($request->all(), [
            'body' => 'required|min:10',
            'chatter_discussion_id' => 'required',
        ]);
        if ($validator->passes()) {
            Reply::create($request->all());
            return back();
        } else {
            return back()->withErrors($validator);
        }
    }
}