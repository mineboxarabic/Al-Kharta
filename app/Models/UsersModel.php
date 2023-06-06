<?php 
use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    //id	firstname	lastname	date_of_birth	role	email	username
    protected $allowedFields = ['id','firstname','lastname','date_of_birth','role','email','username','avatar'];
    protected $returnType = 'array';
    protected $useTimestamps = false;


    public function getUserName($id){
        $query = $this->db->query('SELECT username FROM users WHERE id = '.$id);
        $row = $query->getRow();
        if($row == null)
            return 'Anonymous';
        else
            return $row->username;
        //return $row->username;
    }

    public function getPhoto($id){
        $query = $this->db->query('SELECT avatar FROM users WHERE id = '.$id);
        $row = $query->getRow();


        $img = '';
        if($row == null || $row->avatar == null){
            $img = '/Profiles/default.png';
        }else{
            if(strpos($row->avatar, 'http') !== false){
                //if a valid url
                if(!filter_var($row->avatar, FILTER_VALIDATE_URL) === false)
                    $img = $row->avatar;
                else
                    $img = '/Profiles/default.png';
                
                
            }else{
                $img = '/Profiles/Images/'.$row->avatar;
            }
        }

        return $img;
    }
}