<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
    public function get_pengguna($email = null)
    {
        if ($email == null) {
            $query = "select * from pengguna";
            return $this->db->query($query)->result_array();
        } else {
            $query = "select * from pengguna where email = '" . $email . "'";
            return $this->db->query($query)->result_array();
        }
    }

    public function login_pengguna($param)
    {
        return $this->db->where($param)->get('pengguna')->result();
    }

    public function daftar_pengguna($data)
    {
        $this->db->insert('pengguna', $data);
        return $this->db->affected_rows();
    }

    public function edit_profil_cust($data)
    {
        $this->db->set('username', $data['username']);
        $this->db->set('alamat', $data['alamat']);
        $this->db->set('no_telp', $data['no_telp']);
        $this->db->set('id_kota', $data['id_kota']);
        $this->db->set('nama_kota', $data['nama_kota']);
        $this->db->set('password', $data['password']);
        $this->db->set('email', $data['email']);
        $this->db->where('id_pengguna', $data['id_pengguna']);
        return $this->db->update('pengguna');
    }
}
