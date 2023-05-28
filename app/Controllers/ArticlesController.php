<?php

namespace App\Controllers;
use App\Models\ArticlesModel;

class ArticlesController extends BaseController
{
    public $Articles;

    public $Users;

    
    public function __construct(){
        $this->Articles = model('ArticlesModel');
        $this->Users = model('UsersModel');
    }
	
	public function index()
	{
		
		
		return view('Dashboard');
	}


    public function create_Article()
    {
        return view('Articles/create_Article');
    }

    public function show_Articles()
    {
        $articleModel = model('ArticlesModel');
        $articles = $articleModel->findAll();
        $data = [
            'articles' => $articles
        ];

        return view('Articles/show_Articles', $data);
    }

    public function show_Article($id){
        $articleModel = model('ArticlesModel');
        $article = $articleModel->find($id);

        if($article == null)
            return view('Articles/Not_Found_Error');

        $data = [
            'article' => $article,
            'writer' => $this->Users->find($article['writer'])
        ];
        return view('Articles/show_Article', $data);
    }

    public function add_Article(){
        helper(['form', 'url']);
        $title = $this->request->getVar('title');
        $subtitle = $this->request->getVar('subtitle');
        $content = $this->request->getVar('editor');
        $writer = session()->get('user_id');
        //Validaate image upload
        $thumnail = $this->request->getFile('thumnail');
       // $newName = "Default_Image.jpg";
        if($thumnail->isValid() && !$thumnail->hasMoved()){
            $newName = $thumnail->getRandomName();
            $lastId = model('ArticlesModel')->getLastId();
            $thumnail->move('uploads/Images/'.$lastId, $newName);
            echo "File uploaded successfully";
        }else{
            $newName = "Default_Image.jpg";
            echo "File upload failed";
        }

        $articleModel = model('ArticlesModel');
        $articleModel = new \ArticlesModel();

        print_r($writer);
        if($content == '')
            $content = "No Content";

        $articleModel->insert([
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'writer' => $writer,
            'thumnail' => $newName
        ]);
        
        //print_r($content);
        return redirect()->to('/show_Articles');
        
    }

    public function gototest(){
        return view('Articles/test');
    }
    public function delete_Article($id){
        $this->Articles->delete($id);

        //delete the article folder
        $path = 'uploads/Images/'.$id;
        if(is_dir($path)){
            $files = glob($path.'/*');
            foreach($files as $file){
                unlink($file);
            }
            rmdir($path);
        }

        

        return redirect()->to('/show_Articles');
    }

    public function modify_Article($id){
        $article = $this->Articles->find($id);
        $data = 
        [
            'article' => $article
        ];

        return view('Articles/modify_Article', $data);

    }

    public function update_Article($id){
        helper(['form', 'url']);
        $title = $this->request->getVar('title');
        $subtitle = $this->request->getVar('subtitle');
        $content = $this->request->getVar('editor');
        $writer = session()->get('user_id');
        //Validaate image upload
        $thumnail = $this->request->getFile('thumnail');
        $newName = $this->Articles->find($id)['thumnail'];
        if($thumnail->isValid() && !$thumnail->hasMoved()){
            /*$newName = $thumnail->getRandomName();
            $lastId = model('ArticlesModel')->getLastId() + 1;
            $thumnail->move('uploads/Images/'.$lastId, $newName);
            echo "File uploaded successfully";*/

            $newName = $thumnail->getRandomName();
            $thumnail->move('uploads/Images/'.$id, $newName);
            //delete old image
            $oldImage = $this->Articles->find($id)['thumnail'];
            if($oldImage != "Default_Image.jpg")
                unlink('uploads/Images/'.$id.'/'.$oldImage);
            echo "File uploaded successfully";
        }else{
            //$newName = "Default_Image.jpg";
            //echo "File upload failed";
        }

        $articleModel = model('ArticlesModel');
        $articleModel = new \ArticlesModel();

        print_r($writer);
        if($content == '')
            $content = "No Content";

        $articleModel->update($id, [
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'writer' => $writer,
            'thumnail' => $newName
        ]);
        
        //print_r($content);
        return redirect()->to('/show_Articles');
    }


    public function show_Writers_Articles(){
        $writer = session()->get('user_id');
        $articles = $this->Articles->where('writer', $writer)->findAll();
        $data = [
            'articles' => $articles
        ];

        return view('Articles/show_Articles', $data);
    }
}
