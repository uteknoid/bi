<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Informasi</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="<?php echo site_url('admin/informasi/add_new'); ?>" class="btn btn-sm btn-neutral">Tambah</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Kelola Galeri Informasi</h3>
            </div>

            <?php if ( count($informasi) > 0) : ?>
            <div class="card-body">
                <div class="row">
                <?php foreach ($informasi as $i) : ?>
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-heading"><?php echo $i->nama; ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img alt="<?php echo $i->nama; ?>" class="img img-fluid rounded" src="<?php echo base_url('assets/uploads/informasi/galery/'. $i->gambar); ?>" style="width: 1000px; max-height: 800px">
                                    <br>
                                </div>
                                
                            </div>
                            <div class="card-footer text-center">
                                <a href="<?php echo site_url('admin/informasi/view/'. $i->id); ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('admin/informasi/edit/'. $i->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="card-footer">
                <?php echo $pagination; ?>
            </div>
            <?php else : ?>
             <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-primary">
                            Belum ada data yang ditambahkan. Silahkan menambahkan baru.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo site_url('admin/informasi/add_new'); ?>"><i class="fa fa-plus"></i> Tambah konten baru</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>