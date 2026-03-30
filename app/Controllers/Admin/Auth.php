<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        if (session()->get('is_admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        $data = [
            'title' => 'Admin Login - Vibrant Academy',
        ];

        return view('admin/auth/login', $data);
    }

    public function attemptLogin()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all fields correctly');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->where('username', $username)
                                  ->where('is_active', 1)
                                  ->first();

        if (!$admin || !password_verify($password, $admin['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }

        // Update last login
        $this->adminModel->update($admin['id'], ['last_login' => date('Y-m-d H:i:s')]);

        // Set session
        $sessionData = [
            'admin_id'           => $admin['id'],
            'admin_username'     => $admin['username'],
            'admin_name'         => $admin['name'],
            'is_admin_logged_in' => true,
        ];

        session()->set($sessionData);

        return redirect()->to('admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login')->with('success', 'You have been logged out successfully');
    }
}