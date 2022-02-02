		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Kami Melayani Jasa Desain Interior Mobil</h2>
				<p class="col-12 text-center">Total 3 HTML pages are included in this template. Header image has a parallax effect. You can feel free to download, edit and use this TemplateMo layout for your commercial or non-commercial websites.</p>
			</header>
			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="#galery" class="tm-paging-link active">Galery</a></li>
						<li class="tm-paging-item"><a href="#galery" class="tm-paging-link">Bahan</a></li>
					</ul>
				</nav>
			</div>

			<!-- Gallery -->
			<div class="row tm-gallery" id="galery">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-galery" class="tm-gallery-page">

					<?php 
					$galery = $this->db->query("SELECT * FROM informasi WHERE kategori = 'Galery'")->result();
					foreach ($galery as $g) {
						?>

						<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
							<figure>
								<img src="<?php echo base_url('assets/uploads/informasi/galery/'. $g->gambar); ?>" alt="Image" class="img-fluid tm-gallery-img" />
								<figcaption>
									<h4 class="tm-gallery-title"><?php echo $g->nama; ?></h4>
									<p class="tm-gallery-description"><?php echo $g->deskripsi; ?></p>
								</figcaption>
							</figure>
						</article>

					<?php } ?>

				</div> <!-- gallery page 1 -->

				<!-- gallery page 2 -->
				<div id="tm-gallery-page-bahan" class="tm-gallery-page hidden">

					<?php 
					$bahan = $this->db->query("SELECT * FROM informasi WHERE kategori = 'Bahan'")->result();
					foreach ($bahan as $b) {
						?>

						<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
							<figure>
								<img src="<?php echo base_url('assets/uploads/informasi/galery/'. $b->gambar); ?>" alt="Image" class="img-fluid tm-gallery-img" />
								<figcaption>
									<h4 class="tm-gallery-title"><?php echo $b->nama; ?></h4>
									<p class="tm-gallery-description"><?php echo $b->deskripsi; ?></p>
								</figcaption>
							</figure>
						</article>

					<?php } ?>

				</div> <!-- gallery page 2 -->
			</div>

		</main>