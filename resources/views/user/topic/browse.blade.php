@extends('layouts.admin')

@section('title', '投稿の閲覧')

@section('content')
    <div>
        
        <div class="col-md-4">
            <form action="{{ action('User\FavoriteController@store') }}" method="POST" class="mb-4" >
                @csrf
                <input type="hidden" name="topic_id" value="{{$topic->id}}">
                <button type="submit">
                    お気に入り登録
                </button>
            </form>
        </div>
        
        {{-- お気に入り登録されていればお気に入り解除を、されていなければお気に入り登録を出す。
        @if (!empty($favorite))
            <form action="{{ action('User\FavoriteController@delete', ['id' => $topic->id]) }}" method="POST" class="mb-4" >
            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                <button type="submit">
                    お気に入り解除
                </button>
            </form>
        @else
            <form action="{{ action('User\FavoriteController@store', ['id' => $topic->id]) }}" method="POST" class="mb-4" >
            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                <button type="submit">
                    お気に入り登録
                </button>
            </form>
        @endif --}}
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                <div class="row">
                    <div class="text col-md-6">
                        <div class="date">
                            {{ $topic->updated_at->format('Y年m月d日') }}
                        </div>
                        <div class="title">
                            {{ $topic->title, 150 }}
                        </div>
                        <div class="body mt-3">
                            {{ $topic->body, 1500 }}
                        </div>
                        <div class="nickname">
                            <a href="{{ action('User\ProfileController@index', ['id' => $topic->id]) }}">
                                by{{ $topic->user->profile->nickname}}さん
                            </a>
                        </div>
                    </div>
                    <div class="image col-md-6 text-right mt-4">
                        @if ($topic->image_path)
                            <img src="{{ asset('storage/image/' . $topic->image_path) }}">
                        @endif
                    </div>
                    
                </div>
                <hr color="#c0c0c0">
            </div>
        </div>
    </div>
@endsection