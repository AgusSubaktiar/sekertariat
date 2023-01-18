<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Formulir_Model;

class FormulirUser extends BaseController
{

    public function __construct()
    {
        $this->model = new Formulir_Model();
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $surat = $this->model->search($keyword);
        } else {
            $surat = $this->model;
        }

        $data = [
            'judul' => 'Data Softcopy Formulir',
            'formulir' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('user/formulir', $data);
    }

    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploadformulir/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }
}
