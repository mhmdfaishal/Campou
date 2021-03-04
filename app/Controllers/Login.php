<?php
namespace App\Controllers;
use App\Models\ModelCustomer;
use App\Models\ModelAdmin;
class Login extends BaseController{
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }
    public function index(){
        $data = [];
        helper(['form']);
        helper('cookie');
        if(get_cookie('username') && get_cookie('password')) {
            $username = get_cookie('username');
            $pass = get_cookie('password');
            $model = new ModelCustomer();
            $user = $model->where('username_cust', $username)->first();
            if($pass == $user['password']) {
                $this->setUserSession($user);
            }
        }
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        if($this->request->getMethod() == 'post'){
            $rules = [
                'username' => 'required|min_length[5]|max_length[100]',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[username_cust,password]',
            ];
            $errors = [
                'password' =>[
                    'validateUser' => 'Username or Password don\'t match'
                ]
            ];
            
            if(!$this->validate($rules,$errors)){
                $session = session();
                $session->setFlashdata('gagal', 'Username or Password don\'t match');
            }else{
                $model=new ModelCustomer();
                $user = $model->where('username_cust',$this->request->getVar('username'))
                    ->first();
                $this->setUserSession($user);
                if (isset($_POST['remember_me'])) {
                    setcookie('username', $this->request->getVar('username'), time()+3600);
                    setcookie('password', $user['password'], time()+3600);
                    return redirect()->to('dashboard');
                }
                return redirect()->to('dashboard');
            }
        }
        return view('\templates\loginpage');
    }
    public function indexadmin(){
        $data = [];
        helper(['form']);
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        if($this->request->getMethod() == 'post'){
            $rules = [
                'idpenyedia' => 'required|min_length[3]|max_length[100]',
                'password' => 'required|min_length[3]|max_length[255]|validateAdmin[IdPenyedia,password]',
            ];
            $errors = [
                'password' =>[
                    'validateAdmin' => 'ID or Password don\'t match'
                ]
            ];
            
            if(!$this->validate($rules,$errors)){
                $session = session();
                $session->setFlashdata('gagal', 'ID or Password don\'t match!');
                return redirect()->to('/loginadmin');
            }else{
                $model=new ModelAdmin();
                $user = $model->where('IdPenyedia',$this->request->getVar('idpenyedia'))
                    ->first();
                $this->setUserSessionAdmin($user);

                return redirect()->to('/admin/homepage');
            }
        }
        return redirect()->to('loginadmin');
    }
    public function home(){
        helper('cookie');
        if(get_cookie('username') && get_cookie('password')) {
            $username = get_cookie('username');
            $pass = get_cookie('password');
            $model = new ModelCustomer();
            $user = $model->where('username_cust', $username)->first();
            if($pass == $user['password']) {
                $this->setUserSession($user);
            }
        }
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }
        return view('\templates\index');
    }
    public function forgotpage(){
        return view('\templates\forgotpage');
    }
    public function sendEmail(){
        $rules=[
            'username_cust' => 'required|min_length[5]|max_length[100]',            
        ];
        helper('cookie');
        
        if(!$this->validate($rules)){
            $session = session();
            $session->setFlashdata('failed', 'Username Doesn\'t Exist!');
        }else{
            $username = $this->request->getVar('username_cust');
            $model = new ModelCustomer();
            $data['customer'] = $model->getCustomer($username)->getRow();
            $this->email->setFrom('campou.site@gmail.com','campou site');
            $email = $data['customer']->Email;
            $this->email->setTo($email);
            $this->email->setSubject('CAMPOU CONFIRM YOUR EMAIL');
            setcookie('username', $this->request->getVar('username_cust'), time()+3600);
            $message = "<h1>FORGOT YOUR PASSWORD?</h1><br><p>Click this link to verify and Create your new password<br><a href='".'http://localhost:8080/verifyandchange/'.$username."'>CHANGE YOUR PASSWORD</a></p>";
            $this->email->setMessage($message);
            if(!$this->email->send()){
                $data['validation'] = $this->validator;
                return redirect()->to('/login/forgotpage'); 
            }
            $session = session();
            $session->setFlashdata('success', 'Email Has Sent!');
            return redirect()->to('/login/forgotpage'); 
        }
        return redirect()->to('/login/forgotpage'); 
    }
    public function verifyandchange($id){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        helper('cookie');
        if(get_cookie('username')) {
            $model = new ModelCustomer();
            $data['customer'] = $model->getCustomer($id)->getRow();
            return view('\templates\createnewpassword', $data);
        }
    }
    public function createnewpassword(){
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
            $session->setFlashdata('failed', 'Failed to Change Password');
            return redirect()->to("verifyandchange/$id");
        }else{
            $model = new ModelCustomer();
            $password =  $this->request->getVar('password');
            $passwordHash = password_hash($password,PASSWORD_DEFAULT);
            $newData=[
                'password' => $passwordHash
            ];
            
            $model->updateCustomer($newData,$id);
            return redirect()->to('/login');           
        }
    }

    public function loginadmin(){
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        
        return view('\templates\loginadmin');
    }
    

    public function loginidx(){
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/homepage');
        }
        return view('\templates\loginpage');
    }
    private function setUserSessionAdmin($user){
        $data = [
            'idpenyedia' => $user['IdPenyedia'],
            'isLoggedInAdmin' => true,
        ];
        session()->set($data);
        return true;
    }
    private function setUserSession($user){
        $data = [
            'username' => $user['username_cust'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }

    public function register(){
        $data = [];
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'username' => 'required|min_length[5]|max_length[100]is_unique[customer.username_cust]',
                'email' =>'required|min_length[6]|max_length[50]|valid_email',
                'password' =>'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
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
                $session->setFlashdata('gagal', 'Registration Failed!');
            }else{
                $fotoprofile = $this->request->getFile('foto');
                $namafoto = $fotoprofile->getRandomName();
                
                $fotoprofile->move('assets/img_cust',$namafoto);
                $model = new ModelCustomer();
                $newData=[
                    'username_cust' => $this->request->getVar('username'), 
                    'password' => $this->request->getVar('password'),
                    'email' => $this->request->getVar('email'),
                    'foto' => $namafoto,
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Registration Successful');
                return redirect()->to('login');                
            }
        }
        
        return view('\templates\loginpage',$data);
    }
    public function tambahadmin(){
        $data = [];
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'idpenyedia' => 'required|min_length[3]|max_length[100]|numeric|is_unique[penyedia.IdPenyedia]',
                'password' => 'required|min_length[3]|max_length[255]',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $model = new ModelAdmin();
                $newData=[
                    'IdPenyedia' => $this->request->getVar('idpenyedia'), 
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Registration Successful');
                return redirect()->to('loginadmin');                
            }
        }

        
        return view('\templates\loginpage',$data);
    }
    public function logout(){
        helper('cookie');
        session()->destroy();
        setcookie('username', '', time()-3600);
        setcookie('password', '', time()-3600);
        return redirect()->to('/');
    }
    public function logoutadmin(){
        helper('cookie');
        session()->destroy();
        setcookie('idpenyedia', '', time()-3600);
        setcookie('password', '', time()-3600);
        return redirect()->to('loginadmin');
    }

}