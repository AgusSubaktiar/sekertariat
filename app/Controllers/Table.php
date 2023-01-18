<?php

namespace App\Controllers;

use App\Models\TableModel;

class Table extends BaseController
{
    public function index()
    {
        $tableModel = new TableModel();

        $table = $tableModel->getAllData();

        $data = [
            'judul' => "Halaman Data",
            'table' => $table
        ];

        // dd($table);

        return view('admin/table', $data);
    }
}
