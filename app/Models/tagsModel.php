<?php 
use CodeIgniter\Model;

class tagsModel extends Model{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['*'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

}