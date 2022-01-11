<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('pengrajin_model', 'pengrajin');
        $this->load->model('produk_model', 'produk');
    }

    public function index_get()
    {
        $id = $this->get('id_pengguna');

        if ($id === NULL) {
            $produk = $this->produk->get_produk();
        } else {
            $produk = $this->produk->get_produk($id);
        }

        if ($produk) {
            $this->response([
                'status' => true, 'message' => 'Produk ditemukan', 'data' => $produk
            ],  200);
        } else {
            $this->response([
                'status' => false, 'message' => 'Produk tidak ditemukan'
            ],  200);
        }
    }

    public function get_kategori_get()
    {
        $id = $this->get('kategori');

        $produk = $this->produk->get_kategori_produk($id);

        if ($produk) {
            $this->response([
                'status' => true, 'message' => 'Produk ditemukan', 'data' => $produk
            ],  200);
        } else {
            $this->response([
                'status' => false, 'message' => 'Produk tidak ditemukan'
            ],  200);
        }
    }

    public function get_detail_produk_get()
    {
        $id = $this->get('id_produk');

        $produk = $this->produk->get_detail_produk($id);

        if ($produk) {
            $this->response([
                'status' => true, 'message' => 'Produk ditemukan', 'data' => $produk
            ],  200);
        } else {
            $this->response([
                'status' => false, 'message' => 'Produk tidak ditemukan'
            ],  200);
        }
    }

    public function tambah_post()
    {
        $param = $this->post();

        $this->load->helper('inflector');
        $file_name = underscore($_FILES['image']['name']);
        $config['file_name'] = $file_name;
        //$upload_image = $_FILES['image']['name'];

        if ($file_name) {
            $newPath = './assets/produk/';

            if (!is_dir($newPath)) {
                mkdir($newPath, 0777, TRUE);
            }

            $config['upload_path'] = $newPath;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = '3000';

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data = array(
                    'id_pengguna' => $param['id_pengguna'],
                    'kategori' => $param['kategori'],
                    'nama' => $param['nama'],
                    'deskripsi' => $param['deskripsi'],
                    'harga_satuan' => $param['harga_satuan'],
                    'stok' => $param['stok'],
                    'gambar' => $file_name,
                    'berat' => $param['berat']
                );

                $insert = $this->produk->tambah_p($data);

                if ($insert == 1) {
                    $this->response(['status' => true, 'message' => 'Berhasil'], 200);
                } else {
                    $this->response(['status' => false, 'message' => 'Gagal'], 200);
                }
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $this->response(['status' => false, 'message' => 'failed to register'],  200);
        }
    }
}
