<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengrajin_model extends CI_Model
{
    public function get_pengrajin($id = null)
    {
        if ($id == null) {
            $query = "select * from pengguna where peran = 'pengrajin'";
            return $this->db->query($query)->result_array();
        } else {
            $query = "select * from pengguna where peran = 'pengrajin' AND id_pengguna = " . $id;
            return $this->db->query($query)->result_array();
        }
    }
}
