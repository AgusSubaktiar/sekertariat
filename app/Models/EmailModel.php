<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailMasuk_Model extends Model
{
    function tampilData($katakunci = null, $start = 0, $lenght = 0)
    {
        $builder = $this->table('emailmasuk');
        if ($katakunci) {
            $arr = explode("", $katakunci);
            for ($i = 0; $i < count($arr); $i++) {
                $builder =  $builder->orlike('tgl_emailmasuk', $arr[$i]);
                $builder =  $builder->orlike('kepada', $arr[$i]);
                $builder =  $builder->orlike('ordner', $arr[$i]);
            }
        }

        if ($start != 0 or $lenght != 0) {
            $builder = $builder->limit($lenght, $start);
        }

        return $builder->orderBy('tgl_emailmasuk', 'asc')->get()->getResult();
    }
}
