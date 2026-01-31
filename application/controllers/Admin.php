<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('auth/login');
        }

        $this->load->model('Artikel_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }
    public function index() {
        $data['user'] = $this->session->userdata();
        $data['artikel'] = $this->Artikel_model->get_semua();
        $data['total_artikel'] = count($data['artikel']);
        $data['total_views'] = array_sum(array_column($data['artikel'], 'views'));
        $this->load->view('admin/dashboard', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[draft,published]');

        if ($this->form_validation->run() === FALSE) {
            $data['kategori'] = $this->Kategori_model->get_all();
            $data['user'] = $this->session->userdata();
            $this->load->view('admin/tambah_artikel', $data);
            return;
        }

        $insert = [
            'judul' => $this->input->post('judul'),
            'slug'  => url_title($this->input->post('judul'), 'dash', TRUE),
            'konten'=> $this->input->post('konten'),
            'penulis' => $this->session->userdata('nama_lengkap'),
            'status' => $this->input->post('status')
        ];

        $artikel_id = $this->Artikel_model->simpan($insert);

        $kategori_ids = $this->input->post('kategori');
        if ($kategori_ids) {
            $this->Artikel_model->simpan_kategori($artikel_id, $kategori_ids);
        }

        $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan!');
        redirect('admin');
    }

    public function edit($id = null) {
        if (!$id) show_404();
        $artikel = $this->Artikel_model->get_by_id($id);
        if (!$artikel) show_404();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[draft,published]');

        $data['user'] = $this->session->userdata();
        $data['artikel'] = $artikel;
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['artikel_kategori'] = $this->Artikel_model->get_kategori($id);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/edit_artikel', $data);
            return;
        }

        $update_data = [
            'judul' => $this->input->post('judul'),
            'konten'=> $this->input->post('konten'),
            'status'=> $this->input->post('status')
        ];

        $this->Artikel_model->update($id, $update_data);

        // update kategori relasi
        $kategori_ids = $this->input->post('kategori');
        $this->Artikel_model->hapus_kategori($id);
        if ($kategori_ids) {
            $this->Artikel_model->simpan_kategori($id, $kategori_ids);
        }

        $this->session->set_flashdata('success', 'Artikel berhasil diperbarui!');
        redirect('admin');
    }

    public function kategori() {
        $data['user'] = $this->session->userdata();
        $data['kategori'] = $this->Kategori_model->get_all();
        $this->load->view('admin/kategori', $data);
    }

    public function hapus($id) {
        if (!$id) show_404();
        $this->Artikel_model->hapus($id);
        $this->session->set_flashdata('success', 'Artikel berhasil dihapus!');
        redirect('admin');
    }
}