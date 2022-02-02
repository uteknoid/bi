<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Tambah Galeri Informasi</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/products'); ?>">Galeri Informasi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <?php echo form_open_multipart('admin/informasi/add'); ?>

  <div class="row">
    <div class="col-md-8">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Data Galeri Informasi</h3>
            <?php if ($flash) : ?>
              <span class="float-right text-success font-weight-bold" style="margin-top: -30px">
                <?php echo $flash; ?>
              </span>
            <?php endif; ?>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="category">Kategori:</label>
                  <select name="category" class="form-control" id="category" required>
                    <option value="" selected disabled>Pilih kategori</option>
                    <option value="Galery">Galery</option>
                    <option value="Bahan">Bahan</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="name">Nama:</label>
              <input type="text" name="nama" value="<?php echo set_value('nama'); ?>" class="form-control" id="nama" required>
              <?php echo form_error('nama'); ?>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="desc">Deskripsi:</label>
              <textarea name="description" class="form-control" id="desc" required><?php echo set_value('description'); ?></textarea>
              <?php echo form_error('description'); ?>
            </div>

          </div>

        </div>

      </div>

    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Foto</h3>
        </div>
        <div class="card-body">
         <div class="form-group">
           <label class="form-control-label" for="pic">Foto:</label>
           <input type="file" name="picture" class="form-control" id="pic" required>
           <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
         </div>
       </div>
       <div class="card-footer text-right">
        <input type="submit" value="Tambah Galeri Informasi Baru" class="btn btn-primary">
      </div>
    </div>
  </div>
</div>

</form>