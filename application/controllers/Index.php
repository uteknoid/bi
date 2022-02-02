<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model(array(
            'product_model' => 'product',
            'review_model' => 'review'
        ));
    }

    public function index() {
        $data['title'] = 'Selamat Datang';

        $this->load->view('si/header', $data);
        $this->load->view('si/informasi');
        $this->load->view('si/footer');
    }

    public function contact() {
        $data['title'] = 'Selamat Datang';

        $this->load->view('si/header', $data);
        $this->load->view('si/contact');
        $this->load->view('si/footer');
    }

    public function about() {
        $data['title'] = 'Selamat Datang';

        $this->load->view('si/header', $data);
        $this->load->view('si/about');
        $this->load->view('si/footer');
    }
}