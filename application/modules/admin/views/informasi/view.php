<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0"><?php echo $informasi->nama; ?></h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/informasi'); ?>">Galeri Informasi</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $informasi->nama; ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-md-12">
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
          <div class="card-body p-0 d-flex">
            <div>
              <img style="width: 20rem;" alt="<?php echo $informasi->nama; ?>" class="img img-fluid rounded" src="<?php echo base_url('assets/uploads/informasi/galery/'. $informasi->gambar); ?>">
            </div>

            <table class="table table-hover table-striped">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><b><?php echo $informasi->nama; ?></b></td>
              </tr>
              <tr>
                <td>Kategori</td>
                <td>:</td>
                <td><b><?php echo $informasi->kategori; ?></b></td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td><b><?php echo $informasi->deskripsi; ?></b></td>
              </tr>
            </table>
          </div>
          <div class="card-footer text-right">
            <a href="<?php echo site_url('admin/informasi/edit/'. $informasi->id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
          </div>

        </div>

      </div>

    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-default">Hapus Galeri Informasi</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="#" id="deleteinformasiForm" method="POST">

          <input type="hidden" name="id" value="<?php echo $informasi->id; ?>">

          <div class="modal-body">
            <p class="deleteText">Yakin ingin menghapus Galeri Informasi ini? Semua data yang terkait seperti data order juga akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $('#deleteinformasiForm').submit(function(e) {
      e.preventDefault();

      var btn = $('.btn-delete');
      var data = $(this).serialize();

      btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);

      $.ajax({
        method: 'POST',
        url: '<?php echo site_url('admin/informasi/informasi_api?action=delete_informasi'); ?>',
        data: data,
        success: function (res) {
          if (res.code == 204) {
            setTimeout(function() {
              btn.html('<i class="fa fa-check"></i> Terhapus!');
              $('.deleteText').fadeOut(function() {
                $(this).text('Galeri Informasi berhasil dihapus')
              }).fadeIn();
            }, 2000);

            setTimeout(function() {
              $('.deleteText').fadeOut(function() {
                $(this).text('Mengalihkan...')
              }).fadeIn();
            }, 4000);

            setTimeout(function() {
              window.location = '<?php echo site_url('admin/informasi'); ?>';
            }, 6000);
          }
          else {
            console.log('Terjadi kesalahan sata menghapus Galeri Informasi');
          }
        }
      })
    })
  </script>