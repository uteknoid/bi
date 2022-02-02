<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'informasi_model' => 'informasi'
        ));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Kelola Informasi '. get_store_name();

        $config['base_url'] = site_url('admin/informasi/index');
        $config['total_rows'] = $this->informasi->count_all_informasi();
        $config['per_page'] = 16;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $informasi['informasi'] = $this->informasi->get_all_informasi($config['per_page'], $page);
        $informasi['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('informasi/informasi', $informasi);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->informasi->is_informasi_exist($id))
        {
            $data = $this->informasi->informasi_data($id);

            $params['title'] = $data->nama;

            $informasi['informasi'] = $data;
            $informasi['flash'] = $this->session->flashdata('informasi_flash');

            $this->load->view('header', $params);
            $this->load->view('informasi/view', $informasi);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function add_new()
    {
        $params['title'] = 'Tambah Galeri Informasi Baru';

        $informasi['flash'] = $this->session->flashdata('add_new_informasi_flash');

        $this->load->view('header', $params);
        $this->load->view('informasi/add_new_informasi', $informasi);
        $this->load->view('footer');
    }

    public function add()
    {
        $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('nama', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->add_new_informasi();
        }
        else
        {
            $name = $this->input->post('nama');
            $category = $this->input->post('category');
            $desc = $this->input->post('description');

            $config['upload_path'] = './assets/uploads/informasi/galery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ( isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0')
            {
                if ( ! $this->upload->do_upload('picture'))
                {
                    $error = array('error' => $this->upload->display_errors());

                    show_error($error);
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                }
            }


            $informasi['kategori'] = $category;
            $informasi['nama'] = $name;
            $informasi['deskripsi'] = $desc;
            $informasi['gambar'] = $file_name;

            $this->informasi->add_new_informasi($informasi);
            $this->session->set_flashdata('add_new_informasi_flash', 'Galery informasi baru berhasil ditambahkan!');

            redirect('admin/informasi/add_new');
        }
    }

    public function edit($id = 0)
    {
        if ( $this->informasi->is_informasi_exist($id))
        {
            $data = $this->informasi->informasi_data($id);

            $params['title'] = 'Edit '. $data->nama;

            $informasi['flash'] = $this->session->flashdata('edit_informasi_flash');
            $informasi['informasi'] = $data;

            $this->load->view('header', $params);
            $this->load->view('informasi/edit_informasi', $informasi);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function edit_informasi()
    {
        $this->form_validation->set_error_delimiters('<div class="form-error text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('nama', 'Nama produk', 'trim|required|min_length[4]|max_length[255]');
        $this->form_validation->set_rules('description', 'Deskripsi produk', 'max_length[512]');
        
        if ($this->form_validation->run() == FALSE)
        {
            $id = $this->input->post('id');
            $this->edit($id);
        }
        else
        {
            $id = $this->input->post('id');
            $data = $this->informasi->informasi_data($id);
            $current_picture = $data->gambar;

            $name = $this->input->post('nama');
            $category = $this->input->post('category');
            $desc = $this->input->post('description');

            $config['upload_path'] = './assets/uploads/informasi/galery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ( isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0')
            {
                if ( $this->upload->do_upload('picture'))
                {
                    $upload_data = $this->upload->data();
                    $new_file_name = $upload_data['file_name'];

                    if ( $this->informasi->is_informasi_have_image($id))
                    {
                        $file = './assets/uploads/informasi/galery/'. $current_picture;

                        $file_name = $new_file_name;
                        unlink($file);
                    }
                    else
                    {
                        $file_name = $new_file_name;
                    }
                }
                else
                {
                    show_error($this->upload->display_errors());
                }
            }
            else
            {
                $file_name = ($this->informasi->is_informasi_have_image($id)) ? $current_picture : NULL;
            }

            $informasi['kategori'] = $category;
            $informasi['nama'] = $name;
            $informasi['deskripsi'] = $desc;
            $informasi['gambar'] = $file_name;

            $this->informasi->edit_informasi($id, $informasi);
            $this->session->set_flashdata('edit_informasi_flash', 'Produk berhasil diperbarui!');

            redirect('admin/informasi/view/'. $id);
        }
    }

    public function informasi_api()
    {
        $action = $this->input->get('action');

        switch ($action)
        {
            case 'delete_image' :
                $id = $this->input->post('id');
                $data = $this->informasi->informasi_data($id);
                $picture_name = $data->gambar;
                $file = './assets/uploads/informasi/galery/'. $picture_name;

                if ( file_exists($file) && is_readable($file) && unlink($file))
                {
                    $this->informasi->delete_informasi_image($id);
                    $response = array('code' => 204, 'message' => 'Gambar berhasil dihapus');
                }
                else
                {
                    $response = array('code' => 200, 'message' => 'Terjadi kesalahan sata menghapus gambar');
                }
            break;
            case 'delete_informasi' :
                $id = $this->input->post('id');
                $data = $this->informasi->informasi_data($id);
                $picture = $data->gambar;
                $file = './assets/uploads/informasi/galery/'. $picture;

                $this->informasi->delete_informasi($id);

                if ( file_exists($file) && is_readable($file))
                {
                    unlink($file);
                }

                $response = array('code' => 204);
            break;
        }

        $response = json_encode($response);
        $this->output->set_content_type('application/json')
            ->set_output($response);
    }
}