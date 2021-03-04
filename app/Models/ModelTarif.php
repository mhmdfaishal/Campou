<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelTarif extends Model{
    protected $table = 'Tarif';
    protected $allowedFields = ['kode_tarif','harga'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate']; 
    public function getTarif($id = false){
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['kode_tarif' => $id]);
        }
    }

}