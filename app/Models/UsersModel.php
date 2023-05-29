<?php 
use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    //id	firstname	lastname	date_of_birth	role	email	username
    protected $allowedFields = ['id','firstname','lastname','date_of_birth','role','email','username','avatar'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

}