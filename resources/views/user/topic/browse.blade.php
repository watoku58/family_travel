@extends('layouts.admin')

@section('title', '投稿の閲覧')

@section('content')
    <div>
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                <div class="col-md-4">
                    @if ($topic->user_id == Auth::id())
                        <a href="{{ action('User\TopicController@edit', ['id' => $topic->id]) }}" role="button" class="btn btn-primary" id="edit-button">編集</a>
                    @endif
                    
                    @if (isset($favorite))
                        <form action="{{ action('User\FavoriteController@toggle') }}" method="POST" class="mb-4" >
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                            <button type="submit">
                                お気に入り解除
                            </button>
                        </form>
                    @else
                        <form action="{{ action('User\FavoriteController@toggle') }}" method="POST" class="mb-4" >
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                            <button type="submit">
                                お気に入り登録
                            </button>
                        </form>
                    @endif
                    
                </div>
                <div class="row">
                    <div class="text col-md-6">
                        <div class="date">
                            {{ $topic->updated_at->format('Y年m月d日') }}
                        </div>
                        <div class="title">
                            {{ str_limit($topic->title, 150) }}
                        </div>
                        <div class="tavel_destination">
                            旅行先：{{ $topic->travel_destination }}
                        </div>
                        <div class="body mt-3">
                            {{ $topic->body, 1500 }}
                        </div>
                        
                    </div>
                    <div class="image col-md-6 text-right mt-4">
                        @if ($topic->image_path)
                            <img src="{{ $topic->image_path }}">
                        @endif
                    </div>
                    <div class="nickname">
                        @if (isset($topic->user->profile->nickname))
                            <a href="{{ action('User\ProfileController@index', ['id' => $topic->user->profile->id]) }}">
                                by{{ $topic->user->profile->nickname}}さん
                            </a>
                        @else
                                by{{ $topic->user->name}}さん
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection