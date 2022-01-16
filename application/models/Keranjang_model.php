<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{

    public function get_keranjang($id)
    {
        $query = "select * from keranjang where id_pengguna = " . $id;
        return $this->db->query($query)->result_array();
    }

    public function simpan_baru($data)
    {
        $this->db->insert('keranjang', $data);
        return $this->db->affected_rows();
    }

    public function update_status($data)
    {
        $this->db->set('status_pengiriman', $data['status_pengiriman']);
        $this->db->where('id_transaksi', $data['id_transaksi']);
        return $this->db->update('transaksi');
    }

    public function hapus_ker($id)
    {
        $this->db->where('id_keranjang', $id);
        return $this->db->delete('keranjang');
    }
}
