<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h1>Registro</h1>
	<?php if ($this->session->flashdata('error')): ?>
		<div>
            <?php echo $this->session->flashdata('error');?>
            <?= form_error("username", "<span class='help-block'>","</span>"); ?>
        </div>
	<?php endif ?>
	<form action="<?= base_url() ?>home/store" method="post">
		<input type="text" name="nombre" id="nombre" placeholder="nombre" required value="<?= set_value("nombre")?>">
		<input type="text" name="username" id="username" placeholder="usuario" required value="<?= set_value("username")?>"><br><br>
		<input type="password" name="password" id="password" placeholder="contraseña" required>
		<input type="submit">
		<br>	
		<br>	
		<a href="<?= base_url()?>">Volver</a>
	</form>
</body>
</html>