<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Salvage</title>

	<!-- Global stylesheets -->
	<!--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
	<link href="<?php echo BASE; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/custom.css" rel="stylesheet" type="text/css">
	<link href="<?php echo BASE; ?>assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
</head>
<body>

<div class="container">

	<div class="col-sm-12">
		<h1>Welcome to Salvage Place Bid!</h1>
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p><br>

		<ul class="row" style="list-style: none; padding: 0">
			<?php foreach ($products as $product){ ?>
				<li class="col-sm-12">
					<h2><?php echo $product->title; ?></h2>
					<p><?php echo $product->description; ?></p>
					<a href="<?php echo BASE; ?>bidding/place_bid/<?php echo $product->product_id; ?>" class="btn btn-success"><i class="icon-thumbs-up2"></i> <b>Place Bid</b></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>

</body>
</html>