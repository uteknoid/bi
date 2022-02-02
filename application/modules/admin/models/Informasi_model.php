<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function count_all_informasi()
    {
        return $this->db->get('informasi')->num_rows();
    }

    public function get_all_informasi($limit, $start)
    {
        $informasi = $this->db->get('informasi', $limit, $start)->result();

        return $informasi;
    }

    public function search_informasi($query, $limit, $start)
    {
        $informasi = $this->db->like('name', $query)->or_like('description', $query)->get('informasi', $limit, $start)->result();

        return $informasi;
    }

    public function count_search($query)
    {
        $count = $this->db->like('name', $query)->or_like('description', $query)->get('informasi')->num_rows();

        return $count;
    }

    public function add_new_informasi(Array $informasi)
    {
        $this->db->insert('informasi', $informasi);

        return $this->db->insert_id();
    }

    public function is_informasi_exist($id)
    {
        return ($this->db->where('id', $id)->get('informasi')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function informasi_data($id)
    {
        $data = $this->db->query("
            SELECT *
            FROM informasi
            WHERE id = '$id'
        ")->row();

        return $data;
    }

    public function delete_informasi_image($id)
    {
        return $this->db->where('id', $id)->update('informasi', array('gambar' => NULL));
    }

    public function is_informasi_have_image($id)
    {
        $data = $this->informasi_data($id);
        $file = $data->gambar;

        return file_exists('./assets/uploads/informasi/galery/'. $file) ? TRUE : FALSE;
    }

    public function edit_informasi($id, $informasi)
    {
        return $this->db->where('id', $id)->update('informasi', $informasi);
    }

    public function delete_informasi($id)
    {
        return $this->db->where('id', $id)->delete('informasi');
    }
}