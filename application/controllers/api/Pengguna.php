<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use phpDocumentor\Reflection\Types\Self_;

class Pengguna extends RestController
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('pengguna_model', 'pengguna');
    }

    public function index_get()
    {
        $param = $this->get();

        $email = $param['email'];

        if ($email === NULL) {
            $pengguna = $this->pengguna->get_pengguna();
        } else {
            $pengguna = $this->pengguna->get_pengguna($email);
        }

        if ($pengguna) {
            $this->response(['status' => true, 'message' => 'Pengguna ditemukan', 'data' => $pengguna],  200);
        } else {
            $this->response([
                'status' => false, 'message' => 'Pengguna tidak ditemukan'
            ],  200);
        }
    }

    public function edit_cust_get()
    {
        $param = $this->get();

        $data = [
            'id_pengguna' => $param['id_pengguna'],
            'username' => $param['username'],
            'alamat' => $param['alamat'],
            'no_telp' => $param['no_telp'],
            'id_kota' => $param['id_kota'],
            'nama_kota' => $param['nama_kota'],
            'email' => $param['email'],
            'password' => $param['password'],
        ];

        $i = $this->pengguna->edit_profil_cust($data);

        if ($i == 1) {
            $this->response(['status' => true, 'message' => 'Berhasil'], 200);
        } else {
            $this->response(['status' => false, 'message' => 'gagal.'], 200);
        }
    }
}
