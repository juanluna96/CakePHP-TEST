<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/7507f7d910.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.7/jquery.timeago.min.js" integrity="sha512-RlGrSmkje9EE/FXpJKWf0fvOlg4UULy/blvNsviBX9LFwMj/uewXVoanRbxTIRDXy/0A3fBQppTmJ/qOboJzmA==" crossorigin="anonymous"></script>
	<title>Cakephp</title>
</head>
<body>
	<?php echo $this->element('nav'); ?> 
	<?php echo $this->fetch('content'); ?> 
	<!-- Se coloca esta linea para que continue con el template -->
</body>
</html>