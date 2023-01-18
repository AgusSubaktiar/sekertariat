<?php

namespace App\Models;

use CodeIgniter\Model;

class TableModel extends Model
{
    protected $table = 'formulir';

    public function getAllData()
    {
        return $this->findAll();
    }
}
