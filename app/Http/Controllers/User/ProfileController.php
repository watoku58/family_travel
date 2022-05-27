<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Topic;
use App\Profile;
use App\Favorite;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function add ()
    {
        $profile = Auth::user()->profile;
        if (!empty($profile)){
            return redirect('user/profile');
        }
        
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
        $profile->user_id = Auth::id();
        $profile->save();

        return redirect('user/profile/create');
    }
    
    public function edit (Request $request)
    {
        $profile = Auth::user()->profile;
        if (empty($profile)) {
            return redirect('user/profile/create');
        }
        return view('user.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update (Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
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
    
    public function view (Request $request)
    {
            $profile = Auth::user()->profile;
            $favorites = Favorite::where('user_id', Auth::id())->get();
        
        //ユーザーのプロフィール情報がなければ新規登録画面に移行する。
        if ($profile == null) {
            return redirect('user/profile/create');
        } 
        
        return view('user.profile.index', ['profile' => $profile, 'favorites' => $favorites]);
    }
    
    
    public function index (Request $request)
    {
        //1.idを指定する
        $profile = Profile::find($request->id);
        //dd($request->id);
        //dd(Profile::find($request->id));
        
        //2.自分のidであればお気に入り情報を取得する。
        //  自分のidでなければお気に入り情報を取得せず対象の情報を取得する
        if ($profile->user_id == Auth::id()) {
            //$profile = Auth::user()->profile;
            $favorites = Favorite::where('user_id', Auth::id())->get();
        } else {
            $favorites = null;
        }
        
        return view('user.profile.index', ['profile' => $profile, 'favorites' => $favorites]);
    }
    
    public function delete(Request $request)
    {
        $profile = Auth::user()->profile;
        if (!empty($profile)) {
            $profile->delete();
        }
        
        return redirect('user/profile/create');
    }  
}
