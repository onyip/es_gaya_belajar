<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GayaBelajarModel;

class GayaBelajar extends BaseController
{
    protected $gayaBelajarModel;

    public function __construct()
    {
        $this->gayaBelajarModel = new GayaBelajarModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        return view('gaya_belajar/index');
    }

    public function listData()
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (kode_gaya like '%" . $searchValue . "%' or nama_gaya like '%" . $searchValue . "%' or definisi like '%" . $searchValue . "%') ";
        }

        ## Total number of records without filtering
        $totalRecords = $this->gayaBelajarModel->countAll();

        ## Total number of records with filtering
        $totalRecordwithFilter = $this->gayaBelajarModel;
        if ($searchValue != '') {
            $totalRecordwithFilter->where($searchQuery);
        }
        $totalRecordwithFilter = $totalRecordwithFilter->countAllResults(false); // false to not reset query

        ## Fetch records
        $records = $this->gayaBelajarModel->orderBy($columnName, $columnSortOrder)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id_gaya" => $record['id_gaya'],
                "kode_gaya" => $record['kode_gaya'],
                "nama_gaya" => $record['nama_gaya'],
                "definisi" => $record['definisi'],
                "solusi" => $record['solusi'],
                "action" => '
                    <div class="btn-list flex-nowrap">
                        <button onclick="editData(' . $record['id_gaya'] . ')" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-3.39 3.42l2.97 2.97l3.39 -3.42z" /><path d="M16 14a2 2 0 0 1 2 2a2 2 0 0 1 -2 2a2 2 0 0 1 -2 -2a2 2 0 0 1 2 -2" /></svg>
                            Edit
                        </button>
                        <button onclick="deleteData(' . $record['id_gaya'] . ')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                            <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 0 0 1 1 1v3" /></svg>
                            Hapus
                        </button>
                    </div>
                '
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $data = [
            'kode_gaya' => $this->request->getPost('kode_gaya'),
            'nama_gaya' => $this->request->getPost('nama_gaya'),
            'definisi' => $this->request->getPost('definisi'),
            'solusi' => $this->request->getPost('solusi'),
        ];
        $this->gayaBelajarModel->insert($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $data = $this->gayaBelajarModel->find($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = [
            'kode_gaya' => $this->request->getPost('kode_gaya'),
            'nama_gaya' => $this->request->getPost('nama_gaya'),
            'definisi' => $this->request->getPost('definisi'),
            'solusi' => $this->request->getPost('solusi'),
        ];
        $this->gayaBelajarModel->update($id, $data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    }

    public function delete($id)
    {
        $this->gayaBelajarModel->delete($id);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
