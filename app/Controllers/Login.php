<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public $googleClient;
    public function __construct(){
        $this->googleClient = new \Google_Client();
        $this->googleClient->setClientID('551537692822-m4pkiu4arc3pi765egvbhgh8170nfnlf.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/login_redir');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');


    } 
	public function index()
	{
        $googleButton = $this->googleClient->createAuthUrl();
        $button = "<a href='$googleButton'>Login with Google</a>";
        $imgPath = base_url('assets/images/login_with_google.png');
        $button = "<a href='$googleButton'><img width=\"30%\" src='$imgPath' alt='Login with Google'></a>";
        
        $data = [
            'button' => $button
        ];
        return view('Login', $data);
	}

    public function loginRedirect(){
        $code = $this->request->getVar('code');
        echo $code;
        if(isset($code)){
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);
            $this->googleClient->setAccessToken($token['access_token']);
            $google_oauth = new \Google_Service_Oauth2($this->googleClient);
            $google_account_info = $google_oauth->userinfo->get();
            print_r($google_account_info);
            $email =  $google_account_info->email;
            $firstname =  $google_account_info->givenName;
            $lastname =  $google_account_info->familyName;
            $username =  $google_account_info->name;
            $picture =  $google_account_info->picture;
            session()->set('google_user_image',$picture);
           //// $name =  $google_account_info->name;
            //$session = session();
           // $session->set('email',$email);
           // $session->set('name',$name);

            $usersModel = model('UsersModel');
            $user = $usersModel->where('email', $email)->first();
            if(!$user)
                $usersModel->insert(['email' => $email, 'firstname' => $firstname,'lastname'=>$lastname,'username'=>$username, 'role' => 0,'avatar'=>$picture]);
            
            $user = $usersModel->where('email', $email)->first();
            $session = session();

            $roles = [
                0 => 'user',
                1 => 'admin',
                2 => 'writer',
                4 => 'mod'
            ];
            $role = $roles[$user['role']];

            $session->set('role', $role);
            $session->set('user_id', $user['id']);
            $session->set('is_logged_in', true);

            return redirect()->to('/');
        }
        else{
            return redirect()->to('/login');
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
