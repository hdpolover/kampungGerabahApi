<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    public function get_produk($id = null)
    {
        if ($id == null) {
            $query = "select * from produk";
            return $this->db->query($query)->result_array();
        } else {
            $query = "select produk.* from produk, pengguna where produk.id_pengguna = pengguna.id_pengguna and produk.id_pengguna = " . $id;
            return $this->db->query($query)->result_array();
        }
    }

    public function get_detail_produk($id)
    {
        $query = "select * from produk where id_produk = " . $id;
        return $this->db->query($query)->result_array();
    }

    public function tambah_p($data)
    {
        $this->db->insert('produk', $data);
        return $this->db->affected_rows();
    }

    public function get_kategori_produk($kategori)
    {
        $query = "select * from produk where kategori = '" . $kategori . "'";
        return $this->db->query($query)->result_array();
    }
}
