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
        // $db = \Config\Database::connect();
        $komik = $this->db->query("SELECT * from komik")->getResultArray();
        
        // $komik = $this->komikModel->findAll();
        

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

            // ==== Jika hasil kosong =======

            if (empty($data['komik'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('data tidak ditemukan');
                
            }

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
            'validasi' => \Config\Services::validation(),
        ];

        // $validasi = \Config\Services::validation();

        return view('crud/detail', $data);
    }

    public function insert(){
        // dd($this->request->getVar());

        // ========= VALIDASI ==========
        if (!$this->validate([
            'nama' => 'required',
            'creator' => 'required',
            'sampul' => [
                'rules'     => 'max_size[sampul, 1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors'    => [
                    'max_size'  => 'Gambar kebesaran',
                    'is_image'  => 'Bukan Gambar Broo',
                    'mime_in'   => 'Bukan Gambar Broo'
                ]
            ],
        ])) {
            return redirect()->to('/crud/tambah')->withInput();
        }

        // ============ SIMPAN FILE ===============
            $filenya    = $this->request->getFile('sampul');
            // ==== CEK JIKA UPLOAD KOSONG ====
                if ($filenya->getError() == 4) {
                    $namafile_random = 'default.jpg';
                }else{

                    // ==== generate Nama file random  ===
                    $namafile_random = $filenya->getRandomName();
                    // ==== PINDAH FILE KE FOLDER ===
                    $filenya->move('img',$namafile_random);
        
                    // $filenya->move('img');
                    // ==== AMBIL NAMA FILE Kalau nama file seperti yg diupload ====
                    // $namafile   = $filenya->getName();
        
                    // dd($namafile);
                }
        // ============ SIMPAN FILE ===============
        
        // ==== INSERT PAKE BUILDer TANPA MODEL=====
        // $data = [
        //     'nama' => $this->request->getVar('nama'),
        //     'creator' => $this->request->getVar('creator')
        // ];
        // $builder = $this->db->table('komik');
        // $simpan = $builder->insert($data);
        // === RETURN 1 jika berhasil simpan

        // ===== SIMPAN PAKAI MODEL====
            $simpan = $this->komikModel->save([
                            'nama'      => $this->request->getVar('nama'),
                            'creator'   => $this->request->getVar('creator'),
                            'sampul'    => $namafile_random
                        ]);

        // echo $simpan;

        // ==== BUAT FLASH DATA ====
        session()->setFlashdata('pesan', 'Berhasil disimpan');

        return redirect()->to('/crud');
    }

    public function delete($id){

        // ======== DELEte PAKAI MODELS ========
        // $hapus = $this->komikModel->delete($id);

        // delete pake Builder =======
        $builder    = $this->db->table('komik');
        $hapus      = $builder->delete(['id' => $id]);
        // return 1 jika true

        // ==== BUAT FLASH DATA ====
        session()->setFlashdata('pesan', 'Berhasil dihapus');

        return redirect()->to('/crud');
    }

    public function update(){
        $id = $this->request->getVar('idnya');
        $data = [
            'nama' => $this->request->getVar('nama'),
            'creator' => $this->request->getVar('creator')
        ];

        // dd($id);
        $builder    = $this->db->table('komik');
        $builder->where('id', $id);
        $update = $builder->update($data);
        // === return 1 if true

         // ==== BUAT FLASH DATA ====
        session()->setFlashdata('pesan', 'Berhasil diupdate');

        return redirect()->to('/crud');
    }
}