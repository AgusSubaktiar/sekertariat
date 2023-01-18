<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EmailMasuk_Model;
use App\Models\EmailModel;


class EmailMasuk extends BaseController
{



    public function index()
    {

        return view('admin/emailmasuk');
    }

    function emailAjax()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $katakunci = isset($_REQUEST['searching']['value']) ? $_REQUEST['searching']['value'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $lenght = isset($_REQUEST['lenght']) ? $_REQUEST['lenght'] : '';

        $this->model = new EmailMasuk_Model();
        $data = $this->model->tampilData($katakunci, $start, $lenght);
        $jumlahData = $this->model->tampilData($katakunci);

        $output = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($jumlahData),
            'recordsFiltered' => count($jumlahData),
            'data' => $data
        );

        //dd($output);

        echo json_encode($output);
    }

    public function addemailmasuk()
    {
        if (isset($_POST['addemailmasuk'])) {
            $val = $this->validate([
                'tgl_emailmasuk' => 'required',
                'no_emailmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'tembusan' => 'required',
                'ordner' => [
                    'rules' => 'uploaded[ordner]|mime_in[ordner,application/pdf]|max_size[ordner,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('EmailKeluar')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Email Masuk',
                    'emailmasuk' => $this->model->getAllData()
                ];

                $data['emailmasuk'] = $this->model->getdata('emailmasuk')->result();

                echo view('admin/emailmasuk', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploademailmasuk');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_emailmasuk' => $this->request->getPost('tgl_emailmasuk'),
                    'no_emailmasuk' => $this->request->getPost('no_emailmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addemailmasuk($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('EmailMasuk'));
                }
            }
        } else {
            return redirect()->to('EmailMasuk');
            dd('berhasil');
        }
    }

    public function ubahemailmasuk()
    {
        if (isset($_POST['ubahemailmasuk'])) {
            $val = $this->validate([
                'tgl_emailmasuk' => 'required',
                'no_emailmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'tembusan' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('EmailMasuk')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Email Masuk',
                    'emailmasuk' => $this->model->getAllData()
                ];

                echo view('admin/emailmasuk', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_emailmasuk' => $this->request->getPost('tgl_emailmasuk'),
                    'no_emailmasuk' => $this->request->getPost('no_emailmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahemailmasuk($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('EmailMasuk'));
                }
            }
        } else {
            return redirect()->to('EmailMasuk');
        }
    }


    public function hapusemailmasuk($id)
    {
        $success = $this->model->hapusemailmasuk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('EmailMasuk'));
        }
    }
}
