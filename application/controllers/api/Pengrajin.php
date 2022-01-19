<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Pengrajin extends RestController
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        //$this->load->model('pengrajin_model', 'pengrajin');
        $this->load->model('pengrajin_model', 'pengajin');
    }

    public function index_get()
    {
        $id = $this->get('id_pengguna');

        if ($id === NULL) {
            $pengrajin = $this->pengrajin->get_pengrajin();
        } else {
            $pengrajin = $this->pengrajin->get_pengrajin($id);
        }

        if ($pengrajin) {
            $this->response(['status' => true, 'message' => 'Pengrajin ditemukan', 'data' => $pengrajin],  200);
        } else {
            $this->response([
                'status' => false, 'message' => 'Perngajin tidak ditemukan'
            ],  200);
        }
    }
}
