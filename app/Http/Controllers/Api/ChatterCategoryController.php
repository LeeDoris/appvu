<?php

namespace App\Http\Controllers\Api;

use App\Transformers\ChatterCategoryTransformer;
use DevDojo\Chatter\Models\Category;
use Illuminate\Support\Facades\Request;

class ChatterCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('authorized:chattercategory');
    }

    public function index()
    {
        return $this->respondWith(
            Category::orderBy('created_at', 'DESC')->paginate(10), new ChatterCategoryTransformer
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chattercategory = new Category;
        $chattercategory->name = hash('adler32', time());
        $chattercategory->save();
        return $this->respondWith($chattercategory, new ChatterCategoryTransformer);
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Category $chattercategory)
    {
        return $this->respondWith($chattercategory, new ChatterCategoryTransformer);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Category $category
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Category $chattercategory)
    {
        $chattercategory->fill($request->all());
        $chattercategory->save();

        return $this->respondWith($chattercategory, new ChatterCategoryTransformer);
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
    public function destroy(Category $chattercategory)
    {
        $chattercategory->delete();

        return $this->respondWithArray([
            'success' => true,
            'message' => 'Successfully deleted category.'
        ]);
    }
}
