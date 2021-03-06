@extends('layouts.admin')
@section('title', '投稿の新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>投稿新規作成</h2>
                <form action="{{ action('User\TopicController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">旅行先</label>
                        <div class="col-md-10">
                            <select type="text" class="form-control" name="travel_destination">                          
                                @foreach(config('pref') as $pref_id => $pref_name)
                                    <option value="{{ $pref_name }}">{{ $pref_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">投稿文</label>
                        <div class="col-md-10">
                            <textarea maxlength="500" class="form-control" onkeyup="ShowLength(value);" name="body" rows="20">{{ old('body') }}</textarea>
                            <p id="inputlength" style="margin-bottom:0px;">入力文字数0</p><p>（500字以内）</p>
                        </div>
                    </div>
                    {{--<div class="form-group row">
                        <label class="col-md-2">タグ</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control {{ $errors->has('tag_name') ? 'is-invalid' : '' }}" name="tag_name" value="{{ old('tag_name') }}" id="tag_name" >
                        </div>
                    </div>--}}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="投稿">
                </form>
            </div>
        </div>
    </div>
@endsection