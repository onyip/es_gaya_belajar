<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $level = session()->get('level');
        if (!in_array($level, ['Admin', 'Petugas'])) {
            // Optionally handle unauthorized access, but for now redirect to login or show error
            return redirect()->to('/login');
        }

        return view('dashboard');
    }
}
