@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h5>タイトル：{{ $post->title }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">内容：{{ $post->body }}</p>
                <p>投稿者：{{$post->user->name}}</p>
                @isset($post->image_path)
                  <img src="{{ $post->image_path }}" alt="画像">
                @endisset
                {{-- !? altに値入れると全ページに文字と画像マーク表示されてしまう, --}}
                 {{-- →if分で画像がある時のみ表示する --}}
                <p>投稿日時：{{ $post->created_at }}</p>
                <div class="col-md-3">
                    {{-- <form action="{{route('favorites', $post)}}" method="post">
                    @csrf
                    <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                    </form>
                    <div class="col-md-3">
                        <form action="{{route('unfavorites', $post)}}" method="post">
                        @csrf
                        <input type="submit" value="&#xf164;いいね" class="fas btn btn-danger">
                        </form> --}}

                    </div>

                </div>

                <div class="btn-group">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集する</a>
                <form action='{{ route('posts.destroy', $post->id) }}' method='post'>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type='submit' value='削除' class="btn btn-danger mx-2" onclick='return confirm("削除しますか？？");'>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('comments.store')}}" method="POST">
            {{csrf_field()}}
            {{-- webの気弱性を利用した攻撃方法。掲示板や問い合わせフォームなどに本来拒否すべき他サイトからのリクエストを受信し処理してしまう。 --}}
            <input type="hidden" name="post_id" value="{{ $post->id}}">
              <div class="form-group">
                  <label for="">コメント</label>
                  <textarea name="body" id="" rows="5" class="form-control" placeholder="内容"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">コメントする</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($post->comments as $comment)
            {{-- post.phpのcomments,postとcommentsがリレーションしているから --}}
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $comment->user->name}}</h5>
                <div calss="card-body">
                  <h5 class="card-title mx-3 my-3">投稿日時：{{ $comment->created_at}}</h5>
                  <p class="card-text mx-3 my-3">内容：{{  $comment->body}}</p>
                  <form action='{{ route('comments.destroy', $comment->id) }}' method='post'>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    {{-- htmlはDELETEアクションをサポートしてないため --}}
                    <input type='submit' value='削除' class="btn btn-danger mx-2" onclick='return confirm("削除しますか？？");'>
                </form>

                </div>

            </div>
                
            @endforeach

        </div>

    </div>


</div>
@endsection