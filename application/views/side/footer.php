<script src="<?= base_url()?>asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?= base_url()?>asset/plugins/bootstrap/js/tether.min.js"></script>
<script src="<?= base_url()?>asset/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?= base_url()?>asset/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= base_url()?>asset/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= base_url()?>asset/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="<?= base_url()?>asset/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url()?>asset/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- chartist chart -->
<script src="<?= base_url()?>asset/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="<?= base_url()?>asset/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!--c3 JavaScript -->
<script src="<?= base_url()?>asset/plugins/d3/d3.min.js"></script>
<script src="<?= base_url()?>asset/plugins/c3-master/c3.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php if (!empty($add_js)) { ?>
<script src="<?php echo base_url() ?>asset/js/<?= $add_js ?>.js"></script>
<?php } ?>

<script type="text/javascript">
	$('body').click(function() {
	   $('.modal').fadeOut();
	});

	if ($('.modal').attr('is-alert') === "1") {
		$('.modal').fadeIn(2000);
	}

	$('.select2').select2();

	function to_rupiah(number) {
	  var   number_string = number.toString(),
	  split = number_string.split(','),
	  sisa  = split[0].length % 3,
	  rupiah  = split[0].substr(0, sisa),
	  ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
	    
	  if (ribuan) {
	    separator = sisa ? '.' : '';
	    rupiah += separator + ribuan.join('.');
	  }
	  
	  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	  return  'Rp ' + rupiah;
	}

</script>