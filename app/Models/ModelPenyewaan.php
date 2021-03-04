<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelPenyewaan extends Model{
    protected $table = 'detail_penyewaan';
    protected $allowedFields = ['nomor_penyewaan','username_cust','Nama','Nomor_Telepon','Nama_Lapangan','IdLapangan','tgl_main','jam_mulai','jam_selesai','total_harga','durasi'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate']; 
    public function getPenyewaan($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['nomor_penyewaan' => $id]);
        }
    }
    public function getPenyewaanCust($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['username_cust' => $id]);
        }        
    }
    public function getPenyewaanLap($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['IdLapangan' => $id]);
        }        
    }
    public function savePenyewaan($data){
        $query=$this->db->table($this->table)->insert($data);
        return $query;
    }
    public function updatePenyewaan($data,$id){
        $query = $this->db->table($this->table)->update($data,array('nomor_penyewaan' => $id));
        return $query;
    }
    public function deletePenyewaan($id){
        $query = $this->db->table($this->table)->delete(array('nomor_penyewaan' => $id));
        return $query;
    }
}