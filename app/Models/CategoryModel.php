<?php 
use CodeIgniter\Model;

class tagsModel extends Model{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['*'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

}