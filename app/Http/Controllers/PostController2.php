<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use App\Like;
use App\Dislike;
use App\Comment;
use App\Search;
use App\Profile;
use Auth;
use DB;

class PostController extends Controller
{
    public function post(){
    	$categories = Category::all();
    	
    	return view('posts.post', ['categories' => $categories]);
    }

    public function addPost(Request $request){
    	$this->validate($request, [
    		'post_title' => 'required',
    		'post_body' => 'required',
    		'category_id' => 'required',
    		'post_image' => 'required',
    	]);
    	$posts = new Post;
    	$posts->post_title = $request->input('post_title');
    	$posts->user_id = Auth::user()->id;
    	$posts->post_body = $request->input('post_body');
    	$posts->category_id = $request->input('category_id');

    	if(Input::hasFile('post_image')){
			$file = Input::file('post_image');
$file->move(public_path(). '/posts/', $file->getClientOriginalName());
$url = URL::to("/") . '/posts/' .
			$file->getClientOriginalName();
			
    	}
    	$posts->post_image = $url;
    	$posts->save();
    	return redirect('/home')->
    	with('response','Post Added Successfully');
    }

    public function view($post_id){
        $posts = Post::where('id', '=', $post_id)->get();
        $likePost = Post::find($post_id);
        $dislikePost = Post::find($post_id);
        $likeCtr = Like::where(['post_id' => $likePost->id])->count();
        $dislikeCtr = Dislike::where(['post_id' => $dislikePost->id])->count();
        $categories = Category::all();
        $comments = DB::table('users')
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('users.name', 'comments.*')
            ->where(['posts.id' => $post_id])
            ->get();
        return view('posts.view', ['posts' => $posts, 'categories' => $categories, 'likeCtr' => $likeCtr, 'dislikeCtr' => $dislikeCtr, 'comments' => $comments]);
    }

    public function edit($post_id){
        $categories = Category::all();
        $posts = Post::find($post_id);
        $category = Category::find($posts->category_id);
        return view('posts.edit', ['categories' => $categories, 'posts' => $posts, 'category' => $category]);
    }

    public function editPost(Request $request, $post_id){
        $this->validate($request, [
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
        ]);
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->post_body = $request->input('post_body');
        $posts->category_id = $request->input('category_id');

        if(Input::hasFile('post_image')){
            $file = Input::file('post_image');
$file->move(public_path(). '/posts/', $file->getClientOriginalName());
$url = URL::to("/") . '/posts/' .
            $file->getClientOriginalName();

        }
        $posts->post_image = $url;
        $data = array(
            'post_title' => $posts->post_title,
            'user_id' => $posts->user_id,
            'post_body' => $posts->post_body,
            'category_id' => $posts->category_id,
            'post_image' => $posts->post_image
        );
        Post::where('id', $post_id)
        ->update($data);
        $posts->update();
        return redirect('/home')->
        with('response','Post Edited Successfully!');
        return $post_id;
    }

    public function deletePost($post_id){
        Post::where('id', $post_id)
        ->delete();
        return redirect('/home')->
        with('response','Post Deleted Successfully!');
    }

    public function category($cat_id){
        $categories = Category::all();
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.*')
            ->where(['categories.id' => $cat_id])
            ->get();
        return view('categories.categoriesposts', ['categories' => $categories, 'posts' => $posts]);
    }

 
    public function like($id){
        $loggedin_user = Auth::user()->id;
        $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        $delete_like = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->delete();
        return redirect('/view')->with('response','You unliked this post!');
     /*   $throw_error = DB::table('dislikes')
            ->join('post_id', 'dislikes.user_id', '=', 'dislikes.id' )
            ->select('user_id')
            ->where(!empty('user_id'));
        return redirect("/view/{$id}")->with('response','You can only react once in a post!'); */


        if (empty($like_user->user_id)) {
            
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect("/view/{$id}");
            
        } elseif (!empty($like_user->user_id)){
            $delete_like;
            return redirect("/view/{$id}");
        }

        else{
            return redirect("/view/{$id}");
        } 
    
           
}

    public function dislike($id){
        $loggedin_user = Auth::user()->id;
        $dislike_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        $delete_dislike = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->delete();
        return redirect('/view')->with('response','You undisliked this post!');
     /*  $throw_error = DB::table('dislikes')
            ->join('post_id', 'dislikes.user_id', '=', 'dislikes.id' )
            ->select('user_id')
            ->where(!empty('user_id'));
        return redirect("/view/{$id}")->with('response','You can only react once in a post!'); */


        if (empty($dislike_user->user_id)) {
            
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
           // $unlike = new Unlike;
            $dislike = new Dislike;
            $dislike->user_id = $user_id;
            $dislike->email = $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect("/view/{$id}");
            
        } elseif (!empty($dislike_user->user_id)){
            $delete_dislike;
            return redirect("/view/{$id}");
        }

        else{
            return redirect("/view/{$id}");
        } 
    
           
}

   /* public function dislike($id){
        $loggedin_user = Auth::user()->id;
        $dislike_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if (empty($dislike_user->user_id)) {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $dislike = new Dislike;
            $dislike->user_id = $user_id;
            $dislike->email = $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect("/view/{$id}");
        }
        else{
            return redirect("/view/{$id}");
        }
    }*/

    public function comment(Request $request, $post_id){
        $this->validate($request, [
            'comment' => 'required',
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->comment = $request->input('comment');
        $comment->save();
        return redirect("/view/{$post_id}")->with('response','Comment Added Successfully');
    }

    public function search(Request $request){
        $user_id = Auth::user()->id;
        $profile = Profile::find($user_id);
        $keyword = $request->input('search');
        $posts = Post::where('post_title', 'LIKE', '%'.$keyword.'%')->get();
        return view('posts.searchposts', ['profile' => $profile, 'posts' => $posts]);
        
    }

}
