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
        $catergoryModel = model('CategoryModel');
        $categories = $catergoryModel->findAll();
        $data = [
            'categories' => $categories
        ];
        return view('Articles/create_Article', $data);
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
        $comments = model('CommentModel')->where('article', $id)->where('deleted_at', null)->findAll();


        if($article == null)
            return view('Articles/Not_Found_Error');

        $data = [
            'article' => $article,
            'writer' => $this->Users->find($article['writer']),
            'comments' => $comments
        ];
        return view('Articles/show_Article', $data);
    }

    public function add_Article(){
        helper(['form', 'url']);
        //_ Retrieve the request
            $title = $this->request->getVar('title');
            $subtitle = $this->request->getVar('subtitle');
            $content = $this->request->getVar('editor');
            $writer = session()->get('user_id');

            $thumnail = $this->request->getFile('thumnail');
            $category = $this->request->getVar('category');
            $Tags = $this->request->getVar('Tags');
            $Tags = explode(',', $Tags);
        //_

        //_ Check The Image
            //TODO: add Ajax to make give error messeges if the image is not valid

            if($thumnail->isValid() && !$thumnail->hasMoved()){
                $newName = $thumnail->getRandomName();
                $lastId = model('ArticlesModel')->getLastId();
                $thumnail->move('uploads/Images/'.$lastId, $newName);
                echo "File uploaded successfully";
            }else{
                $newName = "Default_Image.jpg";
                echo "File upload failed";
            }
        //_

        $articleModel = model('ArticlesModel');
        $articleModel = new \ArticlesModel();
        $TagsModel = model('tagsModel');

        print_r($writer);
        if($content == '')
            $content = "No Content";


        //insert the tags
        foreach($Tags as $tag){
            $TagsModel->insert([
                'name' => $tag,
                'article' => $articleModel->getLastId()
            ]);
        }
        //turn category to int
        $category = (int)$category;
        echo "Category: ";
        print_r($category);

        $builder = $articleModel->builder();
        $builder->insert([
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'writer' => $writer,
            'thumnail' => $newName,
            'category' => $category
        ]);

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
        $catergoryModel = model('CategoryModel');
        $Tags = model('tagsModel');
        $tags = $Tags->where('article', $id)->findAll();
        $data = 
        [
            'article' => $article,
            'categories' => $catergoryModel->findAll(),
            'tags' => $tags
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
        $category = $this->request->getVar('category');
        $Tags = $this->request->getVar('Tags');
        if($thumnail->isValid() && !$thumnail->hasMoved()){

            $newName = $thumnail->getRandomName();
            $thumnail->move('uploads/Images/'.$id, $newName);
            $oldImage = $this->Articles->find($id)['thumnail'];
            if($oldImage != "Default_Image.jpg")
                unlink('uploads/Images/'.$id.'/'.$oldImage);
            echo "File uploaded successfully";
        }else{
           
        }

        $articleModel = model('ArticlesModel');
        $articleModel = new \ArticlesModel();
        $TagsModel = model('tagsModel');

        $TagsModel->where('article', $id)->delete();
        $Tags = explode(',', $Tags);
        //insert the tags
        foreach($Tags as $tag){
            $TagsModel->insert([
                'name' => $tag,
                'article' => $id
            ]);
        }


        print_r($writer);
        if($content == '')
            $content = "No Content";

        //turn category to int
        $category = (int)$category;


        $articleModel->update($id, [
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
            'writer' => $writer,
            'thumnail' => $newName,
            'category' => $category
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


    public function show_Filtered_Articles(){
        //Filter The Articles By the passed parameters in the url (GET)
        //We will filter by:
        // 1- Category
        // 2- Tags
        // 3- Writer
        // 4- Date
        // 5- Title
        // 6- Content
        // 7- Subtitle


        $category = isset($_GET['category']) ? $_GET['category'] : null;
        $tags = isset($_GET['tags']) ? $_GET['tags'] : null;
        $writer = isset($_GET['writer']) ? $_GET['writer'] : null;
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $title = isset($_GET['title']) ? $_GET['title'] : null;
        $content = isset($_GET['content']) ? $_GET['content'] : null;
        $subtitle = isset($_GET['subtitle']) ? $_GET['subtitle'] : null;

        $articles = $this->Articles->findAll();
        $filteredArticles = [];
        foreach($articles as $article){
            $articleTags = model('tagsModel')->where('article', $article['id'])->findAll();
            $articleTagsNames = [];
            foreach($articleTags as $tag){
                array_push($articleTagsNames, $tag['name']);
            }
            $article['tags'] = $articleTagsNames;
            array_push($filteredArticles, $article);
        }

        if($category != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($category){
                return $article['category'] == $category;
            });
        }
        if($tags != null){
            $tags = explode(',', $tags);
            $filteredArticles = array_filter($filteredArticles, function($article) use ($tags){
                foreach($tags as $tag){
                    if(!in_array($tag, $article['tags']))
                        return false;
                }
                return true;
            });
        }

        if($writer != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($writer){
                return $article['writer'] == $writer;
            });
        }

        if($date != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($date){
                return $article['created_at'] == $date;
            });
        }

        if($title != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($title){
                return $article['title'] == $title;
            });
        }

        if($content != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($content){
                return $article['content'] == $content;
            });
        }

        if($subtitle != null){
            $filteredArticles = array_filter($filteredArticles, function($article) use ($subtitle){
                return $article['subtitle'] == $subtitle;
            });
        }

        $data = [
            'articles' => $filteredArticles
        ];

        return view('Articles/show_Articles', $data);
    }
}
