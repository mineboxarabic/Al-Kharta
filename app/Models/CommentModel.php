<?php 
use CodeIgniter\Model;

class Commentmodel extends Model{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['*'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

}