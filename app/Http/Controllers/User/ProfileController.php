<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    public function add ()
    {
        return view('user.profile.create');
    }
    
    public function create (Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        if (isset($form['my_image'])) {
            $path = $request->file('my_image')->store('public/my_image');
            $profile->my_image_path = basename($path);
        } else {
            $profile->my_image_path = null;
        }
      
        unset($form['_token']);
      
        unset($form['my_image']);
      
        $profile->fill($form);
        $profile->save();

        return view('user.profile.create');
    }
    
    public function edit (Request $request)
    {
       // Topic Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);    
        }
        return view('user.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update (Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // Topic Modelからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        if ($request->remove == 'true') {
            $profile_form['my_image_path'] = null;
        } elseif ($request->file('my_image')) {
            $path = $request->file('my_image')->store('public/my_image');
            $profile_form['my_image_path'] = basename($path);
        } else {
            $profile_form['my_image_path'] = $profile->my_image_path;
        }
        
        unset($profile_form['my_image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        return redirect('user/profile');
    }
    
    public function index (Request $request)
    {
        //1.profile_idを指定する
        $profile = Profile::find($request->id);
        if (empty($profile)){
            abort(404);
        } 
        
        //2.自分のprofile_idであれば編集ボタンを表示する
        //var_dump($profile);
        
        //3.自分のprofile_idがなければ新規登録画面にとばす
        
        //$posts = Profile::all();
            
        return view('user.profile.index', ['posts' => [$profile]]);
        //return view('user.profile.index', ['profile' => $profile]);
    }
    
}