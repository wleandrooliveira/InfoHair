    	<div id="snackbar" class="alert"></div>
	</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    
    <!-- snackbar -->
    <script src="<?= base_url() ?>assets/js/snackbar.js"></script>
    
    <!-- Date Range Picker-->
    <script src="<?= base_url() ?>assets/js/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    
    <!-- Mask Input -->
    <script src="<?= base_url() ?>assets/js/plugins/jquery.maskedinput.min.js"></script>

    <?php if(isset($hasCharts) && $hasCharts) {?>
	    <!-- Morris Charts JavaScript -->
	    <script src="<?= base_url() ?>assets/js/plugins/morris/raphael.min.js"></script>
	    <script src="<?= base_url() ?>assets/js/plugins/morris/morris.min.js"></script>
	    <script src="<?= base_url() ?>assets/js/plugins/morris/morris-data.js"></script>
    <?php } ?>
    
    <?php if(isset($controller)) { ?>
    	<!-- Javascript Pagina -->
    	<script src="<?= base_url() ?>assets/js/<?= $controller ?>.js"></script>
    <?php }?>
    
    <?php if(isset($autocomplete)) { ?>
    	<!-- AutoComplete Pagina -->
    	<script src="<?= base_url() ?>assets/js/plugins/autocomplete/jquery.easy-autocomplete.min.js"></script>
    <?php }?>
    
</body>

</html>