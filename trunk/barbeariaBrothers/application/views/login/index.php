<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barbearia Brothers - <?php echo $title; ?></title>

    <!-- Snackbar CSS -->
    <link href="<?= base_url() ?>assets/css/snackbar.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?= base_url() ?>assets/css/login.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
		      <form class="form-signin">
		        <h2 class="form-signin-heading">Login</h2>
		        <input type="text" id="username" class="form-control" placeholder="Usuário" required autofocus>
		        <input type="password" id="passwd" class="form-control" placeholder="Senha" required>
		        
		        <button id="btnLogin" class="btn btn-lg btn-primary btn-block" type="button">Entrar</button>
		      </form>
		    </div>
		</div>
		    
	    <div id="snackbar" class="alert"></div>
	</div>
    <!-- /container -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    
    <!-- snackbar -->
    <script src="<?= base_url() ?>assets/js/snackbar.js"></script>
    
    <!-- Javascript Pagina -->
    <script src="<?= base_url() ?>assets/js/login.js"></script>
    
</body>

</html>