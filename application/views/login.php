<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h1>LOGIN</h1>
	<?php if ($this->session->flashdata('valid')): ?>
		<div>
            <?php echo $this->session->flashdata('valid');?>
        </div>
	<?php endif ?>
	<?php if ($this->session->flashdata('error')): ?>
		<div>
            <?php echo $this->session->flashdata('error');?>
        </div>
	<?php endif ?>
	<form action="<?= base_url() ?>home/login" method="post">
		<input type="text" name="username" id="username" placeholder="Username">
		<input type="password" name="password" id="password" placeholder="password">
		<input type="submit">
		<br>	
		<br>	
		<a href="<?= base_url()?>home/sreg">Crear Usuario</a>
	</form>
</body>
</html>