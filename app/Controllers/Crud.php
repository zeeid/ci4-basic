<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Crud extends BaseController
{
    protected $komikModel;
    public function __construct(){
        // Cara konek Pakai Model
        // Cara 1
        // $komikModel = new \App\Models\KomikModel();
        // Cara 2 use App\Models\KomikModel; diatas
        // lalu taruh protected $komikModel;

        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // Cara konek DB tanpa model
        $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * from komik")->getResultArray();
        
        $komik = $this->komikModel->findAll();
        

        $data = [
            'tittle' => 'CRUD',
            'komik' => $komik
        ];


        return view('crud/index', $data);
    }
}