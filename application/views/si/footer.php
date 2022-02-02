

		<footer class="tm-footer text-center">
			<p>Copyright &copy; <?php echo date('Y'); ?> Bandung Interior</p>
			</footer>
		</div>
		<script src="<?= base_url('assets/si/'); ?>js/jquery.min.js"></script>
		<script src="<?= base_url('assets/si/'); ?>js/parallax.min.js"></script>
		<script>
			$(document).ready(function(){
			// Handle click on paging links
			$('.tm-paging-link').click(function(e){
				e.preventDefault();
				
				var page = $(this).text().toLowerCase();
				$('.tm-gallery-page').addClass('hidden');
				$('#tm-gallery-page-' + page).removeClass('hidden');
				$('.tm-paging-link').removeClass('active');
				$(this).addClass("active");
			});
		});
	</script>
</body>
</html>