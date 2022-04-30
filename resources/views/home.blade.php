@extends('layouts.admin')

@section('title', 'Family Travel')

@section('content')
<div class="container">
    <div class="navigation">
        <ul class="navigation">
            <li><a href="{{ url('/') }}">トップ</a></li>
            <li><a href="{{ url('/user/topic/create') }}">新規投稿</a></li>
            <li><a href="{{ url('/user/topic') }}">投稿履歴</a></li>
            <li><a href="{{ url('/user/profile/create') }}">利用者情報登録</a></li>
        </ul>
    </div>
    <div class="card-contents">
        <h3 class="text-title">最新の投稿</h2>
    </div>
    <div>
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <a href="{{ url('/user/topic/browse') }}">
                            <div class="row">
                                <div class="text col-md-6">
                                    <div class="date">
                                        {{ $post->updated_at->format('Y年m月d日') }}
                                    </div>
                                    <div class="title">
                                        {{ str_limit($post->title, 150) }}
                                    </div>
                                    <div class="body mt-3">
                                        {{ str_limit($post->body, 1500) }}
                                    </div>
                                    <div class="nickname">
                                        {{ str_limit($post->nickname, 150) }}
                                    </div>
                                </div>
                                <div class="image col-md-6 text-right mt-4">
                                    @if ($post->image_path)
                                        <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
