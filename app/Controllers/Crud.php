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

    public function detail($id =''){

        // ========= Pakai model langsung query builder =======
        // $komik = $this->komikModel->where(
        //     [
        //         'id'=>$id
        //     ]
        // )->first();

        if ($id !='') {
            # code...
            // ========= ATAU Pakai metod di model ==========
            $komik = $this->komikModel->getKomik($id);
    
            // dd($komik);
            $data = [
                'tittle' => 'CRUD',
                'komik' => $komik
            ];
            return view('crud/detail', $data);
        }else{
            $komik = $this->komikModel->getKomik($id);
    
            // dd($komik);
            $data = [
                'tittle' => 'CRUD',
            ];
            return view('crud/detail');

        }
        
    }

    public function tambah(){
        $data = [
            'tittle' => 'CRUD TAMBAH',
        ];


        return view('crud/detail', $data);
    }
}