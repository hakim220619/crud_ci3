<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->model('DataModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['provinces'] = $this->db->get('propinsi')->result();
        $this->db->select('users.*, propinsi.nama as namaProvinsi, kabupaten.nama as namaKabupaten, kecamatan.nama as namaKecamatan, desa.nama as namaDesa');
        $this->db->from('users');
        $this->db->join('propinsi', 'propinsi.id = users.provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.id = users.kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan', 'left');
        $this->db->join('desa', 'desa.id = users.desa', 'left');
        $data['users'] = $this->db->get()->result_array();
    
        $this->load->view('data', $data);
    }
    function add_ajax_kab($id_prov)
    {
        $query = $this->db->get_where('kabupaten', ['id_propinsi' => $id_prov]);
        $data = "<option value=''>- Select Kabupaten -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    function add_ajax_kec($id_kab)
    {
        $query = $this->db->get_where('kecamatan', array('id_kabupaten' => $id_kab));
        $data = "<option value=''> - Pilih Kecamatan - </option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    function add_ajax_des($id_kec)
    {
        $query = $this->db->get_where('desa', array('id_kecamatan' => $id_kec));
        $data = "<option value=''> - Pilih Desa - </option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }
    public function insert()
    {
        $nama = $this->input->post('nama');
        $config['upload_path']   = './assets/foto/users/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);
        if ($this->upload->do_upload('imagefile')) {
            $gambar = $this->upload->data();
            $save  = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten'  => $this->input->post('kabupaten'),
                'kecamatan'  => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'image' => $gambar['file_name']
            );

            $this->db->insert("users", $save);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function edit($id)
    {
        $data['provinces'] = $this->db->get('propinsi')->result();
        $this->db->select('users.*, propinsi.nama as namaProvinsi, kabupaten.nama as namaKabupaten, kecamatan.nama as namaKecamatan, desa.nama as namaDesa');
        $this->db->from('users');
        $this->db->join('propinsi', 'propinsi.id = users.provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.id = users.kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan', 'left');
        $this->db->join('desa', 'desa.id = users.desa', 'left');
        $this->db->where('users.id', $id);
        $data['users'] = $this->db->get()->row_array();

        $this->load->view('edit', $data);
    }
    public function update()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $config['upload_path']   = './assets/foto/users/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile') == true) {
            $gambar = $this->upload->data();
            $save  = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten'  => $this->input->post('kabupaten'),
                'kecamatan'  => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'image' => $gambar['file_name']
            );

            $g = $this->db->get_where('users', array('id =' => $id))->row_array();

            if ($g != null) {
                //hapus gambar yg ada diserver
                unlink('assets/foto/users/' . $g['image']);
            }
            $this->db->where('id', $id);
            $this->db->update('users', $save);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $save  = array(
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'provinsi' => $this->input->post('provinsi'),
                'kabupaten'  => $this->input->post('kabupaten'),
                'kecamatan'  => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
            );
            $this->db->where('id', $id);
            $this->db->update('users', $save);
            redirect('data');
        }
    }

    public function delete($id)
    {
        $g = $this->db->get_where('users', array('id =' => $id))->row_array();

        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/users/' . $g['image']);
        }
        $this->db->where('id', $id);
        $this->db->delete('users');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function userList()
    {
        $postData = $this->input->post();
        $data = $this->DataModel->getUsers($postData);
        echo json_encode($data);
    }
}