<?php 
use CodeIgniter\Model;

class CategoryModel extends Model{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['*'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

}