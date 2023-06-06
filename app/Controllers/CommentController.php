<?php

namespace App\Controllers;


class CommentController extends BaseController
{
    private $Commnets;
    private $Articles;
    private $Users;
    public function __construct(){
        $this->Commnets = model('CommentModel');
        $this->Articles = model('ArticlesModel');
        $this->Users = model('UsersModel');
    }

    public function add_Comment($id){
        $Article_id = $id;
        $Comment = $this->request->getVar('comment');


        $is_logged = session()->get('is_logged_in') == true ? true : false;

        if($is_logged)
            $User = session()->get('user_id');
        else
            $User = $this->request->getVar('username');
        





        $data = [
            'article' => $Article_id,
            'user' => $User,
            'comment' => $Comment,
            'is_logged' => $is_logged,
            'deleted_at' => null
        ];
        $builder = $this->Commnets->builder();
        $builder->insert($data);
        
        $CommentFromDB = $this->Commnets->where('article', $Article_id)->where('user', $User)->where('comment', $Comment)->first();
        $Comment = new \App\Classes\Comment($CommentFromDB);

        

        echo $Comment->getComment();;
    }


    public function edit_Comment($id){
        $Comment_id = $id;

        $CommentText = $this->request->getVar('comment');
        $builder = $this->Commnets->builder();
        $builder->where('id', $Comment_id);
        $builder->update(['comment' => $CommentText, 'updated_at' => date('Y-m-d H:i:s')]);


        $Comment = $this->Commnets->where('id', $Comment_id)->first();
        $Comment = new \App\Classes\Comment($Comment);
        echo $Comment->getComment();

        
    }

    public function delete_Comment($id){
        $Comment_id = $id;
        $builder = $this->Commnets->builder();
        $builder->where('id', $Comment_id);
        $builder->update(['deleted_at' => date('Y-m-d H:i:s')]);

        echo 'Comment Deleted';
    }
}
