<?php

namespace App\Controllers;
use App\Models\UsersModel;


class UserController extends BaseController
{
	
	public function show_Profile()
	{
        $user = model('UsersModel');
        $articles = model('ArticlesModel');
        
        $user = $user->where('id', session()->get('user_id'))->first();
        $profileJson = json_decode($user['profile'], true);
        
        
        $articles = $articles->where('writer', session()->get('user_id'))->findAll();

        $data = [
            'user' => $user,
            'profile' => $profileJson,
            'articles' => $articles
        ];

		return view('Profile', $data);
	}
}
