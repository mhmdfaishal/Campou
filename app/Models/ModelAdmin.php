<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelAdmin extends Model{
    protected $table = 'penyedia';
    protected $allowedFields = ['IdPenyedia','Nama_Penyedia','email','foto','password','Nomor_Telepon'];
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
    public function getPenyedia($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['IdPenyedia' => $id]);
        }
    }

    public function savePenyedia($data){
        $query=$this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updatePenyedia($data,$id){
        $query = $this->db->table($this->table)->update($data,array('IdPenyedia' => $id));
        return $query;
    }
    public function deletePenyedia($id){
        $query = $this->db->table($this->table)->delete(array('IdPenyedia' => $id));
        return $query;
    }
}