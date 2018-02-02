<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount('comments')->paginate(10);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    public function create()
    {

        return view('post/create');
    }

    public function store(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title'   => 'required|min:3|max:20',
            'content' => 'required|min:3',
        ]);
        $user_id=\Auth::id();
        //逻辑
        $params=array_merge(request(['title', 'content']),['user_id'=>$user_id]);
        Post::create($params);
        //渲染
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title'   => 'required|min:3|max:20',
            'content' => 'required|min:3',
        ]);
        //逻辑
        $this->authorize('update',$post);
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        //渲染
        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return redirect('/posts');
    }

    public function imgUpload(Request $request)
    {
        $path = $request->file('postsimg')->storePublicly(md5(time()));
        $data['data'][] = asset('storage/' . $path);
        $data['errno'] = 0;
        return json_encode($data);
    }
    public function comment(Post $post){

        $this->validate(request(),[
           'content'=>'required|min:3',
        ]);

        $comment=new Comment();
        $comment->post_id=$post->id;
        $comment->user_id=\Auth::id();
        $comment->content=request('content');

        $post->comments()->save($comment);

        return back();
    }
}
