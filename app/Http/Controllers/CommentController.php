<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Post;
use Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $post = Post::find($request->post_id);
        // 該当の投稿を探す
            $comment = new Comment;
            //commentのインスタンスを作成
            $comment -> body = $request->body;
            $comment -> user_id = Auth::id();
            $comment -> post_id = $request->post_id;
            $comment->save();

        // if($post->id === 'POST'){
        // }
        $request->session()->regenerateToken();
    //  !? リロードするたびにコメントが増えたのを防ぐため、上記を入れたが、419が毎度表示されるので、まだ改善の予知あり。。

        return view('posts.show', compact('post'));
        //リターン先は該当の投稿詳細ページ
        // compact:変数を受け渡す時に使う。複数可。withでも良いがcompactの方が可読性高いらしい。
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(Auth::id() !== $comment->user_id){
            return abort(404);
        }
        $comment -> delete();
        return redirect()->route('posts.index');
    }
}
