<?php
namespace App\Validation;
use App\Models\ModelCustomer;
use App\Models\ModelAdmin;

class UserRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new ModelCustomer();
        $user = $model->where('username_cust', $data['username'])->first();
        if (!$user) {
            return false;
        }   
        return password_verify($data['password'], $user['password']);
    }
    public function validateUserEmail(string $str, string $fields, array $data)
    {
        $model = new ModelCustomer();
        $user = $model->where('username_cust', $data['username'])->first();
        if (!$user) {
            return false;
        }   
        // return password_verify($data['Email'], $user['Email']);
    }
    
    public function validateAdmin(string $str, string $fields, array $data)
    {
        $model = new ModelAdmin();
        $user = $model->where('IdPenyedia', $data['idpenyedia'])->first();
        if (!$user) {
            return false;
        }   
        
        return password_verify($data['password'], $user['password']);
    }
}
