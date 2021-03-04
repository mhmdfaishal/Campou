<?php 
namespace App\Controllers;
use App\Models\ModelCustomer;
use App\Models\ModelLapangan;
use App\Models\ModelPenyewaan;
use App\Models\ModelTarif;
use CodeIgniter\Exceptions\AlertError;
use CodeIgniter\I18n\Time;

class Penyewaan extends BaseController
{

    public function index($id,$lapangan){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        if (!session()->get('isLoggedIn') && !session()->get('isLoggedInAdmin')) {
            return redirect()->to('/');
        } 
        $model = new ModelCustomer();
        $modelLapangan = new ModelLapangan();
        $modeltarif = new ModelTarif();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['lapangan'] = $modelLapangan->getLapangan($lapangan)->getRow();
        $data['tarif'] = $modeltarif->getTarif($data['lapangan']->kode_tarif)->getRow();
        if($_SESSION['username'] != $data['customer']->username_cust){
            return redirect()->to("/dashboard");
        } 
        return view('\templates\form', $data); 
    }

    public function save(){
        helper('text');
        $username = $this->request->getVar('usernamePemesan');
        $idlapangan = $this->request->getVar('IdLapangan');

        $model = new ModelPenyewaan();
        $jammulai = $this->request->getVar('jam_main');
        $waktumulai = $jammulai.":00:00";
        $durasi = $this->request->getVar('durasi');
        $jamselesai = $jammulai+$durasi;
        if($jamselesai>23){
            $session = session();
            $session->setFlashdata('gagal', 'Jam yang anda masukkan melebihi dari jam operasional kami!');
            return redirect()->to("/penyewaan/$username/$idlapangan");
        }
        $tgl_main = $this->request->getVar('tanggal_main');
        $waktuselesai = $jamselesai.":00:00";
        $harga = $this->request->getVar('harga');
        $totalharga = $harga*$durasi;
        $nomor_penyewaan = random_string('numeric',4);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'namaPemesan' => 'required|min_length[5]|max_length[30]',
                'noHP' => 'required',
            ];
            
            $data['detail_penyewaan'] = $model->getPenyewaan();
            foreach($data['detail_penyewaan'] as $row):
                if($waktumulai == $row['jam_mulai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main  || $waktuselesai == $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main || $waktumulai > $row['jam_mulai'] && $waktumulai < $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main || $waktuselesai > $row['jam_mulai'] && $waktuselesai < $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main){
                    $session = session();
                    $session->setFlashdata('gagal', 'Jadwal yang anda pesan tidak tersedia! Harap cek jadwal yang tersedia dan isi kembali');
                    return redirect()->to("/penyewaan/$username/$idlapangan");
                }
            endforeach;
            $newData = array(
                'nomor_penyewaan' => $nomor_penyewaan,
                'username_cust' => $this->request->getVar('usernamePemesan'),
                'Nama' => $this->request->getVar('namaPemesan'),
                'Nomor_Telepon' => $this->request->getVar('noHP'),
                'Nama_Lapangan' => $this->request->getVar('namaLapangan'),
                'IdLapangan' => $this->request->getVar('IdLapangan'),    
                'tgl_main' => $tgl_main,
                'jam_mulai' => $waktumulai,
                'jam_selesai' => $waktuselesai,
                'total_harga' => $totalharga,
                'durasi' => $durasi,
            );
            $model->savePenyewaan($newData);
            return redirect()->to('/dashboard');
        }
    }

    public function edit($id){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelPenyewaan();
        $data['detail_penyewaan'] = $model->getPenyewaan($id)->getRow();
        return view('\templates\edit', $data);
    }

    public function update(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelPenyewaan();
        $id = $this->request->getPost('username');
        $data = array(
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'foto' => $this->request->getPost('foto'),
        );
        $model->updateCustomer($data,$id);
        return redirect()->to('/edit');
    }
    
    public function delete($id){
        $model = new ModelPenyewaan();
        $model->deleteCustomer($id);
		return redirect()->to('/pelanggan');
	}
}