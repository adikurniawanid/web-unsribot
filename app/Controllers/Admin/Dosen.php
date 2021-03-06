<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Dosen;

class Dosen extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Dosen();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url('Auth/Login'));
        }

        $data = [
            'judul' => 'Dosen',
            'dosen_list' => $this->model->get_dosen_list()
        ];

        return view('admin/dosen', $data);
    }

    public function addDosen()
    {
        if (isset($_POST['buttonAddDosen'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'nip_param' => [
                    'label' => 'NIP',
                    'rules' => 'required|is_unique[dosen.NIP]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'is_unique' => '{field} tersebut telah digunakan, silahkan gunakan {field} lain yang belum terdaftar'
                    ]
                ]
            ]);
            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to($_SERVER['HTTP_REFERER']);
            } else {
                $data = [
                    'nama_param' => $this->request->getPost('nama_param'),
                    'nip_param' => $this->request->getPost('nip_param')
                ];

                $success = $this->model->add_dosen($data['nip_param'], $data['nama_param']);
                if ($success) {
                    $message = 'Dosen <b>' . $data['nama_param'] . '</b> berhasil ditambahkan';
                    session()->setFlashData('message', $message);
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteDosen($nip_param)
    {
        $success = $this->model->delete_dosen($nip_param);

        if ($success) {
            $message = 'Dosen <b>' . $nip_param . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }

    public function editDosen($nip_param)
    {
        $data = [
            'judul' => 'Edit Dosen',
            'dosen' => $this->model->get_detail_edit_dosen($nip_param)
        ];

        echo view('admin/dosenEdit', $data);

        if (isset($_POST['buttonEditDosen'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]

                ],
                'nip_param' => [
                    'label' => 'NIP Dosen',
                    'rules' => 'required|max_length[18]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 18 karakter.',
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to($_SERVER['HTTP_REFERER'])->withInput();
            } else {
                $data = [
                    'nip_param' => $this->request->getPost('nip_param'),
                    'nama_param' => $this->request->getPost('nama_param'),
                ];
                $success = $this->model->edit_dosen($data['nip_param'], $data['nama_param']);

                if ($success) {
                    $message = 'Dosen <b>' . $data['nama_param'] . '</b> berhasil diedit';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/Dosen'));
                } else {
                    return redirect()->to(base_url('Admin/Dosen'));
                }
            }
        }
    }
}
