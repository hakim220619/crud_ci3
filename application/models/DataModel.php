<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model
{

    // Get DataTable data
    function getUsers($postData = null)
    {

        $response = array();

        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        // Custom search filter 
        $searchProvinsi = $postData['searchProvinsi'];
        $searchKabupaten = $postData['searchKabupaten'];
        $searchKecamatan = $postData['searchKecamatan'];
        $searchDesa = $postData['searchDesa'];
        $searchNama = $postData['searchNama'];

        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = " (users.nama like '%" . $searchValue . "%' or 
         users.provinsi like '%" . $searchValue . "%' or 
         users.kabupaten like'%" . $searchValue . "%' ) or 
         users.kecamatan like'%" . $searchValue . "%' ) or 
         users.desa like'%" . $searchValue . "%' ) ";
        }
        if ($searchProvinsi != '') {
            $search_arr[] = " users.provinsi='" . $searchProvinsi . "' ";
        }
        if ($searchKabupaten != '') {
            $search_arr[] = " users.kabupaten='" . $searchKabupaten . "' ";
        }
        if ($searchKecamatan != '') {
            $search_arr[] = " users.kecamatan='" . $searchKecamatan . "' ";
        }
        if ($searchDesa != '') {
            $search_arr[] = " users.Desa='" . $searchDesa . "' ";
        }
        if ($searchNama != '') {
            $search_arr[] = " users.nama like '%" . $searchNama . "%' ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        // $this->db->select('count(*) as allcount');
        $this->db->select('count(*) as allcount, users.*, propinsi.nama as namaProvinsi, kabupaten.nama as namaKabupaten, kecamatan.nama as namaKecamatan, desa.nama as namaDesa');
        $this->db->from('users');
        $this->db->join('propinsi', 'propinsi.id = users.provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.id = users.kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan', 'left');
        $this->db->join('desa', 'desa.id = users.desa', 'left');
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount, users.*, propinsi.nama as namaProvinsi, kabupaten.nama as namaKabupaten, kecamatan.nama as namaKecamatan, desa.nama as namaDesa');
        $this->db->from('users');
        $this->db->join('propinsi', 'propinsi.id = users.provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.id = users.kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan', 'left');
        $this->db->join('desa', 'desa.id = users.desa', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('users.*, propinsi.nama as namaProvinsi, kabupaten.nama as namaKabupaten, kecamatan.nama as namaKecamatan, desa.nama as namaDesa');
        $this->db->from('users');
        $this->db->join('propinsi', 'propinsi.id = users.provinsi', 'left');
        $this->db->join('kabupaten', 'kabupaten.id = users.kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id = users.kecamatan', 'left');
        $this->db->join('desa', 'desa.id = users.desa', 'left');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record) {

            $data[] = array(
                "id" => $record->id,
                "nama" => $record->nama,
                "alamat" => $record->alamat,
                "namaProvinsi" => $record->namaProvinsi,
                "namaKabupaten" => $record->namaKabupaten,
                "namaKecamatan" => $record->namaKecamatan,
                "namaDesa" => $record->namaDesa,
                "image" => $record->image,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    // Get cities array
    public function getProvinsi()
    {

        ## Fetch records
        $this->db->distinct();
        $this->db->select('provinsi');
        $this->db->order_by('provinsi', 'asc');
        $records = $this->db->get('users')->result();

        $data = array();

        foreach ($records as $record) {
            $data[] = $record->provinsi;
        }

        return $data;
    }
}
