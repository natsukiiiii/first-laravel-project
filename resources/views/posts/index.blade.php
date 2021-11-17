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
            <div class="card-body">
                <h5 class="card-title">1回目の投稿</h5>
                <p class="card-text">油そばは春日亭も好きですが、kirinjiが一番好きです</p>
                <a href="#" class="btn btn-primary">詳細</a>
            </div>
            <div class="card-footer text-muted">
                2日前
            </div>
        </div>
        </div>
        <div class="col-md-2">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
        </div>
    </div>
</div>
@endsection