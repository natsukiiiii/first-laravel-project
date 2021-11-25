@extends('layouts.app')　
{{-- ここでviews layoutsの app.blade.phpを読み込みます --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card text-center">
            <div class="card-header">
                投稿一覧
            </div>
            @foreach ($posts as $post)
            <div class="card-body border border-light-1  rounded mb-3">
                <h5 class="card-title">タイトル：{{ $post->title }}</h5>
                <p class="card-text">内容：{{ $post->body }}</p>
                <p class="card-text">投稿者：{{ $post->user->name }}</p>
                <p class="text-muted text-right">投稿日時：{{ $post->created_at }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細へ</a>
                {{-- $post->id : どのpostの詳細にいくのかを指定 --}}

                {{-- いいね機能 --}}
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <form action="">
                            <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                        </form>
                    </div>
                    <div col-md-3>
                        <form action="">
                            <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
                        </form>

                    </div>
                </div>
                {{-- いいね機能 --}}

            </div>
            @endforeach
        </div>
        </div>
        <div class="col-md-2">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
        </div>
    </div>
</div>
@endsection