<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelCustomer extends Model{
    protected $table = 'customer';
    protected $allowedFields = ['username_cust','password','email','foto'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate']; 
    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        }
        return $data;
    }
    public function getCustomer($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['username_cust' => $id]);
        }
    }

    public function saveCustomer($data){
        $query=$this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateCustomer($data,$id){
        $query = $this->db->table($this->table)->update($data,array('username_cust' => $id));
        return $query;
    }
    public function deleteCustomer($id){
        $query = $this->db->table($this->table)->delete(array('username_cust' => $id));
        return $query;
    }
}