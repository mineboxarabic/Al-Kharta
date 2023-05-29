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


		return view('Profile/Profile', $data);
	}

    public function edit_Profile(){
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
		return view('Profile/edit_Profile', $data);
    }

    public function save_Profile(){
       $userName = $this->request->getVar('user_name');
        $Bio = $this->request->getVar('bio');
        $userPic = $this->request->getFile('profile_pic');
        $user = model('UsersModel');

        $user = $user->where('id', session()->get('user_id'))->first();
        $profileJson = json_decode($user['profile'], true);


                

        if($Bio != null){
            $profileJson['Bio'] = $Bio;
        }
        $imgName = $user['avatar'];
        if($userPic != null && $userPic->isValid()){
            echo session()->get('user_id');
            $imgExt = $userPic->getClientExtension();
            $location = 'Profiles/Images/'.session()->get('user_id').'.'.$imgExt;
            if(file_exists($location))
                unlink($location);
            $userPic->move('Profiles/Images/', session()->get('user_id').'.'.$imgExt);
            $imgName = session()->get('user_id').'.'.$imgExt;
        }
    

     
       $user = model('UsersModel');
      $builder = $user->builder();
        $builder->set('profile', json_encode($profileJson));
        $builder->set('username', $userName);
        $builder->set('avatar', $imgName);
        session()->set('avatar', $imgName);
        $builder->where('id', session()->get('user_id'))->update();


    }

}

/*
{
    "Tags":[
      "No Tags"
   ],
   "Bio":"No Bio",
   "links":[]
}


 */
