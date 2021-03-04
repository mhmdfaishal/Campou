<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelLapangan extends Model{
    protected $table = 'lapangan';
    protected $allowedFields = ['IdLapangan','Nama_Lapangan','kode_tarif','Nomor_Lapangan','deskripsi','foto'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate']; 
    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    public function getLapangan($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['IdLapangan' => $id]);
        }
    }

    public function saveLapangan($data){
        $query=$this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updateLapangan($data,$id){
        $query = $this->db->table($this->table)->update($data,array('IdLapangan' => $id));
        return $query;
    }
    public function deleteLapangan($id){
        $query = $this->db->table($this->table)->delete(array('IdLapangan' => $id));
        return $query;
    }
}