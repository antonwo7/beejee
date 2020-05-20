<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />

		<title></title>

		<link rel="stylesheet" type="text/css" href="view/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="view/assets/css/main.css" />
		
		<script src="view/assets/js/jquery.min.js"></script>
	</head>

	<body>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php if(!empty($head)){ ?>
						<div class="head"><?=$head; ?></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<?php if(!empty($tasks)){ ?>
						<div><?=$tasks; ?></div>
						<?php } ?>
					</div>
				</div>
		</section>
	</body>
</html>