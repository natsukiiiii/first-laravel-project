<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $posts->load('user');
        return view('posts.index', compact('posts'));
        // return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request);
        $input = $request->all();
        // ユーザーが入力した $request の配列を $input に代入します。
        $input['user_id'] = Auth::id();

        // dd(Auth::user());
        // ログイン中のuserのIdが取れる
        // user_id は Auth::id() で取得し $input の配列に追加します。
        Post::create($input);
        // create() を使用して新規投稿を保存しましょう。
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $post->load('user', 'comments');
        // テーブルが2つあったとしたら
        // Eagerロード：2つのデーブルのデータを１度に取得します
        // →　クエリの発行回数を減らせるので、N＋1問題の回避策として用いられる
        // lazyロード：テーブル１からデータ取得し、テーブル２からデータ取得

        return view('posts.show', compact('post'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(Auth::id() !== $post->user_id){
            return abort(404);
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if(Auth::id() !== $post->user_id){
            return abort(404);
        }
        $post->update($request->all());
        return view('posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(Auth::id() !== $post->user_id){
            return abort(404);
        }
        $post -> delete();
        return redirect()->route('posts.index');
    }
}
