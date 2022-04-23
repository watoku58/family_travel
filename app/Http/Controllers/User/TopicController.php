<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Topic;

class TopicController extends Controller
{
    public function add()
    {
        return view('user.topic.create');
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Topic::$rules);
        $topic = new Topic;
        $form = $request->all();
        
        // フォームから画像が送信されてきたら、保存して、$topic->image_path に画像のパスを保存する
        if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $topic->image_path = basename($path);
        } else {
            $topic->image_path = null;
        }
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        
        // データベースに保存する
        $topic->fill($form);
        $topic->save();
        
        // user/topic/createにリダイレクトする
        return redirect('user/topic/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Topic::where('title', $cond_title)->get();
        } else {
            // それ以外はすべての投稿を取得する
            $posts = Topic::all();
        }
        return view('user.topic.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
}
