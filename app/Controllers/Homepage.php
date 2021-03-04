<?php 
namespace App\Controllers;
use App\Models\ModelCustomer;
use App\Models\ModelAdmin;
use App\Models\ModelLapangan;
use App\Models\ModelPenyewaan;
use App\Models\ModelTarif;

class Homepage extends BaseController
{

    public function index(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }    
        $id = $_SESSION['username'];
        $model = new ModelCustomer();
        $model2 = new ModelLapangan();
        $model3 = new ModelAdmin();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['lapangan'] = $model2->getLapangan();
        $data['penyedia'] = $model3->getPenyedia();
        return view('\templates\homepage', $data);
    }
    public function indexadmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }     
        $id = $_SESSION['idpenyedia'];
        $model = new ModelAdmin();
        $model2 = new ModelPenyewaan();
        $data['penyedia'] = $model->getPenyedia($id)->getRow();
        $data['detail_penyewaan'] = $model2->getPenyewaan();
        return view('\templates\content_penyewaan', $data);
    }
    public function getPenyewaanByUsername(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        $id = $_SESSION['username'];
        $model = new ModelPenyewaan();
        $model2 = new ModelCustomer();
        $data['detail_penyewaan'] = $model->getPenyewaanCust();
        $data['customer'] = $model2->getCustomer($id)->getRow();
        return view('\templates\daftar_penyewaan', $data);

    }
    public function getPenyewaanByIdLapangan($id){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        $data = [
            'lapangan' => $id
        ];
        $model = new ModelPenyewaan();
        $model2 = new ModelCustomer();
        $model3 = new ModelLapangan();
        $data['detail_penyewaan'] = $model->getPenyewaanLap();
        $username = $_SESSION['username'];
        $data['customer'] = $model2->getCustomer($username)->getRow();
        $data['lapangan'] = $model3->getLapangan($id)->getRow();
        return view('\templates\daftar_penyewaan_cust', $data);

    }
    public function daftaradmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }   
        $id = $_SESSION['idpenyedia'];
        $model = new ModelAdmin();
        $model2 = new ModelAdmin();
        $data['penyedia'] = $model->getPenyedia($id)->getRow();
        $data['admin'] = $model2->getPenyedia();
        return view('\templates\content_admin', $data);
    }
    public function indexcustomer(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $id = $_SESSION['idpenyedia'];
        $model = new ModelAdmin();
        $model2 = new ModelCustomer();
        $data['penyedia'] = $model->getPenyedia($id)->getRow();
        $data['customer'] = $model2->getCustomer();
        return view('\templates\content_customer', $data);
    }
    public function daftarlapangan(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $id = $_SESSION['idpenyedia'];
        $model = new ModelAdmin();
        $model2 = new ModelLapangan();
        $data['penyedia'] = $model->getPenyedia($id)->getRow();
        $data['lapangan'] = $model2->getLapangan();
        return view('\templates\content_lapangan', $data);
    }

    public function tambahadmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        return view('\templates\createadmin');
    }
    public function tambahlapangan(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        return view('\templates\createlapangan');
    }
    public function createadmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $data = [];
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'idpenyedia' => 'required|min_length[3]|max_length[100]|numeric|is_unique[penyedia.IdPenyedia]',
                'password' => 'required|min_length[3]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'email' => 'required|valid_email',
                'nomor_telepon' => 'numeric',
                'foto' =>[
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Pilih foto terlebih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ];

            if(!$this->validate($rules)){
                $session = session();
                $session->setFlashdata('failed', 'Gagal Menambahkan Admin');
            }else{
                $fotoprofile = $this->request->getFile('foto');
                $namafoto = $fotoprofile->getName();
                $fotoprofile->move('assets/img_admin',$namafoto);
                $model = new ModelAdmin();
                $newData=[
                    'IdPenyedia' => $this->request->getVar('idpenyedia'),
                    'Nama_Penyedia' => $this->request->getVar('namapenyedia'), 
                    'email' => $this->request->getVar('email'),
                    'foto' => $namafoto, 
                    'password' => $this->request->getVar('password'),
                    'Nomor_Telepon' => $this->request->getVar('nomor_telepon'),
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Berhasil Menambahkan Admin');
                return redirect()->to('/admin/tambahadmin');                
            }
        }
        
        return redirect()->to('/admin/tambahadmin');
    }

    public function createlapangan(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'idlapangan' => 'required|min_length[3]|max_length[100]|is_unique[lapangan.IdLapangan]',
                'namalapangan' => 'required|min_length[3]|max_length[255]',
                'kode_tarif' => 'required',
                'nomorlapangan' => 'required',
                'deskripsi' => 'required',
                'foto' =>[
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Pilih foto terlebih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ];

            if(!$this->validate($rules)){
                $session = session();
                $session->setFlashdata('failed', 'Gagal Menambahkan Lapangan');
            }else{
                $fotolapangan = $this->request->getFile('foto');
                $namafoto = $fotolapangan->getRandomName();
                $fotolapangan->move('assets/img',$namafoto);
                $model = new ModelLapangan();
                $newData=array(
                    'IdLapangan' => $this->request->getVar('idlapangan'),
                    'Nama_Lapangan' => $this->request->getVar('namalapangan'), 
                    'kode_tarif' => $this->request->getVar('kode_tarif'),
                    'Nomor_Lapangan' => $this->request->getVar('nomorlapangan'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'foto' => $namafoto,     
                );
                $model->saveLapangan($newData);
                $session = session();
                $session->setFlashdata('success', 'Berhasil Menambahkan Lapangan');
                return redirect()->to('/daftarlapangan');                
            }
        }
        return redirect()->to('/admin/tambahlapangan');
    }
    public function save(){
       $model = new ModelCustomer();
       $data = array(
           'username_cust' => $this->request->getPost('username'),
           'password' => $this->request->getPost('password'),
           'email' => $this->request->getPost('email'),
           'foto' => $this->request->getPost('foto'),
       );
       $model->saveCustomer($data);
       return redirect()->to('login');
    }

    public function editPenyewaan($id,$id2){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelPenyewaan();
        $model2 = new ModelLapangan();
        $model3 = new ModelTarif();
        $data['detail_penyewaan'] = $model->getPenyewaan($id)->getRow();
        $data['lapangan'] = $model2->getLapangan($id2)->getRow();
        $data['tarif'] = $model3->getTarif($data['lapangan']->kode_tarif)->getRow();
        return view('\templates\editPenyewaan', $data);
    }
    public function editPenyewaanCust($id,$id2){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelPenyewaan();
        $model2 = new ModelLapangan();
        $model3 = new ModelTarif();
        $data['detail_penyewaan'] = $model->getPenyewaan($id)->getRow();
        $data['lapangan'] = $model2->getLapangan($id2)->getRow();
        $data['tarif'] = $model3->getTarif($data['lapangan']->kode_tarif)->getRow();
        return view('\templates\editPenyewaanCust', $data);
    }
    public function editadmin($id){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelAdmin();
        $data['penyedia'] = $model->getPenyedia($id)->getRow();
        return view('\templates\editAdmin', $data);
    }
    public function editLapangan($id){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelLapangan();
        $data['lapangan'] = $model->getLapangan($id)->getRow();
        return view('\templates\editLapangan', $data);
    }
    public function editCustomer($id){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelCustomer();
        $data['customer'] = $model->getCustomer($id)->getRow();
        return view('\templates\editCustomer', $data);
    }

    public function updatePenyewaan(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelPenyewaan();
        $id = $this->request->getPost('nomor_penyewaan');
        $idlapangan = $this->request->getPost('idlapangan');
        $jammulai = $this->request->getVar('jam_main');
        $waktumulai = $jammulai.":00:00";
        $durasi = $this->request->getVar('durasi');
        $harga = $this->request->getVar('harga');
        $totalharga = $harga*$durasi;
        $jamselesai = $jammulai+$durasi;
        if($jamselesai>23){
            $session = session();
            $session->setFlashdata('gagal', 'Jam yang anda masukkan melebihi dari jam operasional kami!');
            return redirect()->to("/admin/editpenyewaan/$id/$idlapangan");
       }
       $waktuselesai = $jamselesai.":00:00";
        $data = array(
            'nomor_penyewaan' => $id,
            'Nama' => $this->request->getPost('nama'),
            'Nomor_Telepon' => $this->request->getPost('nomor_telepon'),
            'Nama_Lapangan' => $this->request->getPost('namalapangan'),
            'tgl_main' => $this->request->getPost('tanggal_main'),
            'jam_mulai' => $waktumulai,
            'jam_selesai' =>  $waktuselesai,
            'durasi' => $durasi,
            'Nama_Lapangan' => $this->request->getPost('namalapangan'),
            'total_harga' => $totalharga,
        );
        $model->updatePenyewaan($data,$id);
        return redirect()->to('/admin/homepage');
    }
    public function updatePenyewaanCust(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelPenyewaan();
        $id = $this->request->getPost('nomor_penyewaan');
        $idlapangan = $this->request->getVar('idlapangan');
        $jammulai = $this->request->getVar('jam_main');
        $waktumulai = $jammulai.":00:00";
        $durasi = $this->request->getVar('durasi');
        $harga = $this->request->getVar('harga');
        $totalharga = $harga*$durasi;
        $jamselesai = $jammulai+$durasi;
        if($jamselesai>23){
            $session = session();
            $session->setFlashdata('gagal', 'Jam yang anda masukkan melebihi dari jam operasional kami!');
            return redirect()->to("/customer/editpenyewaan/$id/$idlapangan");
        }
        $tgl_main = $this->request->getVar('tanggal_main');
        $waktuselesai = $jamselesai.":00:00";
        if($this->request->getMethod() == 'post'){
            $data['detail_penyewaan'] = $model->getPenyewaan();
            foreach($data['detail_penyewaan'] as $row):
                if($waktumulai == $row['jam_mulai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main  || $waktuselesai == $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main || $waktumulai > $row['jam_mulai'] && $waktumulai < $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main || $waktuselesai > $row['jam_mulai'] && $waktuselesai < $row['jam_selesai'] && $row['IdLapangan'] == $idlapangan && $row['tgl_main'] == $tgl_main){
                    $session = session();
                    $session->setFlashdata('gagal', 'Jadwal yang anda pilih sudah dibooking!');
                    return redirect()->to("/customer/editpenyewaan/$id/$idlapangan");
                }
            endforeach;
            $data = array(
                'nomor_penyewaan' => $id,
                'Nama' => $this->request->getPost('nama'),
                'Nomor_Telepon' => $this->request->getPost('nomor_telepon'),
                'Nama_Lapangan' => $this->request->getPost('namalapangan'),
                'tgl_main' => $this->request->getPost('tanggal_main'),
                'jam_mulai' => $waktumulai,
                'jam_selesai' =>  $waktuselesai,
                'durasi' => $durasi,
                'Nama_Lapangan' => $this->request->getPost('namalapangan'),
                'total_harga' => $totalharga,
            );
            $model->updatePenyewaan($data,$id);
            return redirect()->to('/dashboard');
        }
    }
    public function updateCustomer(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelCustomer();
        $id = $this->request->getPost('username_cust');
        $data = array(
            'Email' => $this->request->getPost('email'),
        );
        $model->updateCustomer($data,$id);
        return redirect()->to('/daftarcustomer');
    }
    public function saveProfile(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelCustomer();
        $rules = [
            'email' => 'valid_email',
            'foto' =>[
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];
        
        $id = $this->request->getPost('username_cust');
        if(!$this->validate($rules)){
            return redirect()->to("/editprofile/$id")->withInput();
        }else{
            
            $fotoprofile = $this->request->getFile('foto');
            if($fotoprofile->getError() == 4){
                $namafoto = $this->request->getVar('fotolama');
            }else{
                $namafoto = $fotoprofile->getRandomName();
                $fotoprofile->move('assets/img_cust',$namafoto);
                unlink('assets/img_cust/' . $this->request->getVar('fotolama'));
            }
            
            $model = new ModelCustomer();
            $newData=[
                'email' => $this->request->getVar('email'),
                'foto' => $namafoto,
            ];
            
            $model->updateCustomer($newData,$id);
            return redirect()->to("/editprofile/$id");           
        }
       
    }
    public function editprofile($id){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        $model = new ModelCustomer();
        $data['customer'] = $model->getCustomer($id)->getRow();
        if($_SESSION['username'] != $data['customer']->username_cust){
            return redirect()->to("/dashboard");
        } 
        return view('\templates\editProfile', $data);
    }
    public function changePassword($id){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelCustomer();
        $data['customer'] = $model->getCustomer($id)->getRow();
        if($_SESSION['username'] != $data['customer']->username_cust){
            return redirect()->to("/dashboard");
        } 
        return view('\templates\changePassword', $data);
    }
    public function savePassword(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        } 
        $model = new ModelCustomer();
        $rules = [
            'password' =>'required|min_length[8]|max_length[255]',
            'password_confirm' => 'matches[password]',
        ];
        $id = $this->request->getPost('username_cust');
        if(!$this->validate($rules)){
            $session = session();
            $session->setFlashdata('failed', 'Failed to Change Password!');
            return redirect()->to("/changepassword/$id");
        }else{
            $model = new ModelCustomer();
            $password =  $this->request->getVar('password');
            $passwordHash = password_hash($password,PASSWORD_DEFAULT);
            $newData=[
                'password' => $passwordHash
            ];
            
            $model->updateCustomer($newData,$id);
            return redirect()->to("/editprofile/$id");           
        }
    }
    public function updateAdmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelAdmin();
        $id = $this->request->getPost('idpenyedia');
        $rules = [
            'email' => 'valid_email',
            'nomor_telepon' => 'numeric',
            'foto' =>[
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ] 
        ];
        if(!$this->validate($rules)){
            return redirect()->to('/admin')->withInput();
        }else{
            $fotoadmin = $this->request->getFile('foto');
            if($fotoadmin->getError() == 4){
                $namafoto = $this->request->getVar('fotolama');
            }else{
                $namafoto = $fotoadmin->getRandomName();
                $fotoadmin->move('assets/img_admin',$namafoto);
                unlink('assets/img_admin/' . $this->request->getVar('fotolama'));
            }
            $data = array(
                'Nama_Penyedia' => $this->request->getPost('namapenyedia'),
                'email' => $this->request->getPost('email'),
                'Nomor_Telepon' => $this->request->getPost('nomor_telepon'),
                'foto' => $namafoto,
            );
            $model->updatePenyedia($data,$id);
            return redirect()->to('/admin');
        }
    }

    public function updatelapangan(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        } 
        $model = new ModelLapangan();
        $rules = [
            'foto' =>[
                'rules' => 'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ];
        $id = $this->request->getPost('idlapangan');
        if(!$this->validate($rules)){
            return redirect()->to('/dashboard')->withInput();
        }else{
            $fotolapangan = $this->request->getFile('foto');
            if($fotolapangan->getError() == 4){
                $namafoto = $this->request->getVar('fotolama');
            }else{
                $namafoto = $fotolapangan->getRandomName();
                $fotolapangan->move('assets/img',$namafoto);
                unlink('assets/img/' . $this->request->getVar('fotolama'));
            }
            
            $data = array(
                'Nama_Lapangan' => $this->request->getVar('namalapangan'),
                'kode_tarif' => $this->request->getVar('kode_tarif'),
                'foto' => $namafoto,
                'deskripsi' => $this->request->getVar('deskripsi')
            );
            
            $model->updatelapangan($data,$id);
            return redirect()->to('/daftarlapangan');          
        }     
    }
    
    public function deletePenyewaanAdmin($id){
        $model = new ModelPenyewaan();
        $model->deletePenyewaan($id);
		return redirect()->to('/admin/homepage');
    }
    public function deletePenyewaanCust($id){
        $model = new ModelPenyewaan();
        $model->deletePenyewaan($id);
		return redirect()->to('/daftarpenyewaan');
    }
    public function deletepelanggan($id){
        $model = new ModelCustomer();
        $model->deleteCustomer($id);
		return redirect()->to('/daftarcustomer');
	}
    public function deleteLapangan($id){
        $model = new ModelLapangan();
        $model->deleteLapangan($id);
		return redirect()->to('/daftarlapangan');
	}
    public function deleteadmin($id){
        $model = new ModelAdmin();
        $model->deletePenyedia($id);
		return redirect()->to('/admin');
	}
}