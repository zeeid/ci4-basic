<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo "coba kontroler $this->nama";
    }

    public function datasegmen($nama ='', $data2 =''){
        echo "KOntroler Ambil Data Segmen: ". $nama. $data2;
    }

    public function dataplaceholder($data1 ='', $data2 =''){
        echo "KOntroler Ambil Data placeholder router: ". $data1. $data2;
    }
}
