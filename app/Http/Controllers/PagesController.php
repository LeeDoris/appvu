<?php

namespace App\Http\Controllers;

use Acme\PostsRepo;
use App\Category;
use App\Post;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home(Post $post) {
        $posts = PostsRepo::getPosts(10, 'owner');
        return view(config('theme.default.pages').'.index')->withPosts($posts,$post);
    }

    /**
     * Display the specified post.
     *
     * @param \App\Post $post
     */
    public function post(Post $post){
        $pagination_results = config('chatter.paginate.num_of_results');
        $discussions = Discussion::with('user')->with('reply')->with('replysCount')->where('chatter_category_id', '=', $post->id)->orderBy('created_at', 'DESC')->paginate($pagination_results);
        $replys = Reply::with('user')->get();
        return view(config('theme.default.pages').'.post',compact('discussions','replys'))->withPost($post);
    }

    /**
     * Display the posts of specified category.
     *
     * @param \App\Category $category
     */
    public function category(Category $category){
        $posts = PostsRepo::getCategoryPosts($category, 10, 'owner');
        return view(config('theme.default.pages').'.category')->withPosts($posts);
    }
}
