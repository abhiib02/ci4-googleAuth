<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    public function __construct()
    {
        $db = \Config\Database::connect();

    }

    public function insertUser($data)
    {
        $db = \Config\Database::connect();
        return $db->table('users_table')->insert($data);
    }


    public function getAllUsers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getUserID($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("ID");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->ID;
    }
    public function getUser($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("*");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getUserName($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("NAME");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->NAME;
    }
    public function isUserExist($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("*");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function isUserExistByID($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("*");
        $builder->where('ID', $id);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delUser($id)
    {
        if ($this->isUserExistByID($id)) {
            $db = \Config\Database::connect();
            $builder = $db->table('users_table');
            $builder->where('ID', $id);
            $builder->delete();
        } else {
            return 0;
        }
    }
    public function isHashExist($hash)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("*");
        $builder->where('PASSWORD', $hash);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function isAdmin($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("ROLE");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->ROLE;
    }
    public function MakeAdmin($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->set("ROLE", 1);
        $builder->where('ID', $id);
        $builder->update();
    }
    public function RemoveAdmin($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->set("ROLE", 0);
        $builder->where('ID', $id);
        $builder->update();
    }
    public function getUserPassHash($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->select("PASSWORD");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->PASSWORD;
    }
    function can_login($username, $password)
    {

        $passHash = $this->getUserPassHash($username);

        if (password_verify($password, $passHash)) {

            return true;
        } else {
            return false;
        }
    }

    public function changePasswordByAdmin($id, $password)
    {
        $db = \Config\Database::connect();
        $hashedpass = password_hash((string) $password, PASSWORD_DEFAULT);
        $builder = $db->table('users_table');
        $builder->set("PASSWORD", $hashedpass);
        $builder->where("ID", $id);
        $builder->update();
        return true;
    }


    public function resetpassword($newhash, $oldhash)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_table');
        $builder->set("PASSWORD", $newhash);
        $builder->where("PASSWORD", $oldhash);
        $builder->update();
        return true;
    }
}
