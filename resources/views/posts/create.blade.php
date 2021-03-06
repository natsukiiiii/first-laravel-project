@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any()) //追加
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                {{-- enctype="multipart/form-data":画像のアップロード処理に必須 --}}
            {{csrf_field()}}
            {{-- クロス・サイト・リクエスト・フォージェリは悪意のあるエクスプロイトの一種であり、信頼できるユーザーになり代わり、認められていないコマンドを実行します。 --}}
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" placeholder="タイトルを入力して下さい" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" placeholder="内容" rows="5" name="body"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" class="form-control-file" id="image" name="image">

                </div>
                <button type="submit" class="btn btn-primary">作成する</button>
            </form>
        </div>
    </div>
</div>
@endsection