<?php 
use CodeIgniter\Model;

class tagsModel extends Model{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'logo', 'article'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

}