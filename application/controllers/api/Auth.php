<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('pengguna_model', 'pengguna');
    }

    public function login_get()
    {
        $param = $this->get();

        $where = array(
            'email' => $param['email'],
            'password' => $param['password']
        );

        $data = $this->pengguna->login_pengguna($where);

        if ($data != null) {
            $this->response(['status' => true, 'message' => 'Berhasil login.', 'data' => $data], 200);
        } else {
            $this->response(['status' => false, 'message' => 'Email tidak ditemukan atau password salah. Silakan coba lagi.'], 200);
        }
    }

    public function daftar_post()
    {
        $param = $this->post();

        $now = new DateTime();
        $email = $param['email'];
        $peran = $param['peran'];
        $password = $param['password'];
        $alamat = $param['alamat'];
        $username = $param['username'];
        $no_telp = $param['no_telp'];
        $lat = $param['latitude'];
        $longi = $param['longitude'];

        $data = [
            'peran' => $peran,
            'email' => $email,
            'password' => $password,
            'tgl_daftar' => $now->format('Y-m-d H:i:s'),
            'status' => 1,
            'foto' => 'default.jpg',
            'alamat' => $alamat,
            'username' => $username,
            'no_telp' => $no_telp,
            'latitude' => $lat,
            'longitude' => $longi,
        ];

        $res = $this->pengguna->daftar_pengguna($data);

        if ($res > 0) {
            $this->response([
                'status' => true,
                'message' => 'pengguna terdaftar'
            ],  200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal mendaftarkan pengguna'
            ],  200);
        }
    }
}
