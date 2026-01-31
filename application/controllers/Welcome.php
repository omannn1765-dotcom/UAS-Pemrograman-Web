<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Artikel_model');
		$this->load->model('Kategori_model');
	}

	public function index()
	{
		// Tampilkan artikel terbaru khusus kategori 'Berita' (jika ada)
		$kategori_berita = $this->Kategori_model->get_by_slug('berita');
		if ($kategori_berita) {
			$this->db->select('artikel.*');
			$this->db->from('artikel');
			$this->db->join('artikel_kategori', 'artikel.id = artikel_kategori.artikel_id');
			$this->db->where('artikel_kategori.kategori_id', $kategori_berita['id']);
			// Filter judul atau konten yang mengandung kata 'Indonesia' (case-insensitive)
			$this->db->group_start();
			$this->db->like('artikel.judul', 'Indonesia');
			$this->db->or_like('artikel.konten', 'Indonesia');
			$this->db->group_end();
			$this->db->where('artikel.status', 'published');
			$this->db->order_by('artikel.tanggal_dibuat', 'DESC');
			$this->db->limit(10);
			$data['artikel'] = $this->db->get()->result_array();
		} else {
			// Fallback: tampilkan semua artikel terbaru yang dipublikasikan
			$data['artikel'] = $this->Artikel_model->get_published(10);
		}
		$data['kategori'] = $this->Kategori_model->get_all();
		$this->load->view('home', $data);
	}
	
	public function artikel($slug)
	{
		$data['artikel'] = $this->Artikel_model->get_by_slug($slug);
		if (!$data['artikel']) {
			show_404();
		}
		$data['kategori'] = $this->Kategori_model->get_all();
		$this->load->view('artikel_detail', $data);
	}
	
	public function kategori($slug)
	{
		$kategori = $this->Kategori_model->get_by_slug($slug);
		if (!$kategori) {
			show_404();
		}
		
		// Get artikel by kategori
		$this->db->select('artikel.*');
		$this->db->from('artikel');
		$this->db->join('artikel_kategori', 'artikel.id = artikel_kategori.artikel_id');
		$this->db->where('artikel_kategori.kategori_id', $kategori['id']);
		$this->db->where('artikel.status', 'published');
		$this->db->order_by('artikel.tanggal_dibuat', 'DESC');
		
		$data['kategori_info'] = $kategori;
		$data['artikel'] = $this->db->get()->result_array();
		$data['kategori'] = $this->Kategori_model->get_all();
		$this->load->view('kategori_view', $data);
	}
	
	public function search()
	{
		$keyword = $this->input->get('q');
		$data['keyword'] = $keyword;
		$data['artikel'] = $this->Artikel_model->search($keyword);
		$data['kategori'] = $this->Kategori_model->get_all();
		$this->load->view('search_results', $data);
	}
}
