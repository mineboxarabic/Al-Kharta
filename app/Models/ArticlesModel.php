<?php 
use CodeIgniter\Model;

class ArticlesModel extends Model{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    //allow insert and update

    protected $allowedFields = ['title', 'subtitle', 'content', 'writer', 'thumnail'];
   // protected $allowedFields = ['*'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    public function getLastId(){
        $query = $this->db->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = \'al_kharta_db\' AND TABLE_NAME = \'articles\'');
        $row = $query->getRow();
        return $row->AUTO_INCREMENT;
        

    }

}