<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'HOME'
        ];

        echo view('layout/header',$data);
        echo view('pages/home');
        echo view('layout/footer');
    }
    public function about()
    {
        $data = [
            'tittle' => 'About'
        ];

        echo view('layout/header',$data);
        echo view('pages/about');
        echo view('layout/footer');
    }

    // ==== VIEW PAKAI TEMPLATE ENGINE ====
    public function kontak(){
        $data = [
            'tittle' => 'Kontak Me'
        ];

        return view('pages/kontak',$data);
    }
}
