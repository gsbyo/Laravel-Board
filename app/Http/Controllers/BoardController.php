<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Session;


class BoardController extends Controller
{
    public function board(){
        $posts = Post::limit(5)->skip(0)->get();
        $count = Post::count();

        return view('board', compact('posts', 'count'));
    }

    public function pagingBoard($page){
        if($page == 1){
            return redirect('board');
        }

        $posts = Post::limit(5)->skip(($page-1) * 5)->get();
        $count = Post::count();

        if(!count($posts)){
            return redirect('board');
        }

        return view('board', compact('posts','count'));
    }



    public function write(){
       return view('write');
    }

    public function writePost(Request $request){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;
        $post->user = session()->get('loginUsername');

        $res = $post->save();

        if($res){
            return redirect('board');
        }else{
            return back()->with('fail', 'something wrong');
        }
    }

    //서버에 이미지를 저장함.
    public function uploadImg(Request $request){
        request()->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

        $name = $request->file('img')->getClientOriginalName();
        $path = "/img/";

        $request->file('img')->move( public_path('img'), $name);

        $url = $path . $name;

        return response()->json($url);
    }

    public function showPost(Request $request, $id){
      if(Session::has('postId')){
        $postIdArr = $request->session()->get('postId');
        if(!in_array($id, $postIdArr)){
            array_push($postIdArr, $id);
            $request->session()->put('postId',$postIdArr);

            Post::where('id','=', $id)->increment('view');
        }
      }else{
        $postIdArr = array();
        array_push($postIdArr, $id);
        $request->session()->put('postId', $postIdArr);

        Post::where('id','=', $id)->increment('view');
      }

        $post = Post::where('id', '=', $id)->first();
        $comments = Comment::where('post_id', $id)->limit(5)->get();
        $count = Comment::where('post_id', $id)->count();
        return view('post', compact('post', 'comments', 'count'));
    }

    public function writeComment(Request $request){
        $request->validate([
            'post_id'=>'required',
            'content'=>'required'
        ]);

        $comment = new Comment();

        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->user = $request->session()->get('loginUsername');

        $res = $comment->save();

        if($res){
            return response()->json('ok');
        }

        return $this->responseWithError("Store failed.");
    }

    public function getComment($id, $page){
       $comments = Comment::where('post_id', $id)->skip(($page - 1) * 5)->limit(5)->get();

       return response()->json($comments);
    }

    public function searchPost(Request $request){
        switch($request->input('smt')){
            case 0:
                $posts = Post::where('title', 'like', '%'.$request->stx.'%')->skip(($request->page - 1) * 5)->limit(5)->get();
                $count =  Post::where('title', 'like','%'.$request->stx.'%')->count();
                break;
            case 1:
                $posts = Post::where('content', 'like', '%'.$request->stx.'%')->skip(($request->page - 1) * 5)->limit(5)->get();
                $count =  Post::where('content', 'like','%'.$request->stx.'%')->count();
                break;
            case 2:
                $posts = Post::where('title', 'like', '%'.$request->stx.'%')
                                   ->orWhere('content', 'like', '%'.$request->stx.'%')
                                   ->skip(($request->page  - 1) * 5)
                                   ->limit(5)
                                   ->get();

                $count = Post::where('title', 'like', '%' . '%'.$request->stx.'%')
                                   ->orWhere('content', 'like', '%' . '%'.$request->stx.'%')
                                   ->skip(($request->page  - 1) * 5)
                                   ->limit(5)
                                   ->count();
        }

        return view('search', compact('posts','count'));
    }
}
