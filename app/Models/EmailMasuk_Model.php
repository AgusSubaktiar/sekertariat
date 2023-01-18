<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailMasuk_Model extends Model
{

    protected $table = 'emailmasuk';
    protected $allowedFields = ['tgl_emailmasuk', 'no_emailmasuk', 'kepada', 'perihal', 'kode_proyek', 'nama_proyek', 'tembusan', 'ordner'];

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

    public function search($keyword)
    {
        return $this->table('emailmasuk')->like('tgl_emailmasuk', $keyword)->orLike('no_emailmasuk', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('emailmasuk')->get()->getResultArray();
        } else {
            return $this->db->table('emailmasuk')->where('id', $id);
            return $this->db->table('emailmasuk')->get()->getRowArray();
        }
    }

    public function addemailmasuk($data)
    {
        return $this->table('emailmasuk')->insert($data);
    }

    public function hapusemailmasuk($id)
    {
        return $this->db->table('emailmasuk')->delete(['id' => $id]);
    }

    public function ubahemailmasuk($data, $id)
    {
        return $this->db->table('emailmasuk')->update($data, ['id' => $id]);
    }
}
