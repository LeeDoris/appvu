<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Discussion;
use Validator;

class DiscussionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->remove('_token');
        $request->request->add(['user_id' => Auth::user()->id]);
        $cate_id = (int)$request->get('chatter_category_id');
        $request->request->add(['chatter_category_id' => $cate_id]);
        $validator = Validator::make($request->all(), [
            'body' => 'required|min:10',
            'chatter_category_id' => 'required',
        ]);
        if ($validator->passes()) {
            Discussion::create($request->all());
            return back();
        }else{
            return back()->withErrors($validator);
        }
    }
}
