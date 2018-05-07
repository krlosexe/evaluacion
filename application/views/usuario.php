<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
</head>
<body>
	<table>
		<tr>
			<td>Nombre de Usuario</td>
			<td>Ip</td>
			<td>Cerrar sesion</td>
		</tr>
		<tr>
			<td><?= $usuario->nombre?></td>
			<td><?= $ip?></td>
			<td><a href="<?= base_url()?>home/logout">Logout</a></td>
		</tr>
	</table>

	

	<form action="<?= base_url() ?>home/modify" method="post">
		<h3>Cambiar mi contraseña</h3>
		<?php if ($this->session->flashdata('error')): ?>
			<div>
	            <?php echo $this->session->flashdata('error');?>
	            <?= form_error("username", "<span class='help-block'>","</span>"); ?>
	        </div>
		<?php endif ?>

		<?php if ($this->session->flashdata('valid')): ?>
			<div>
	            <?php echo $this->session->flashdata('valid');?>
	            <?= form_error("username", "<span class='help-block'>","</span>"); ?>
	        </div>
		<?php endif ?>
		<input type="password" name="pass" placeholder="Contraseña actual" required>
		<input type="password" name="pass1" placeholder="Nueva contraseña" required>
		<input type="password" name="pass2" placeholder="Repita contraseña" required>
		<br>
		<br>
		<input type="submit" value="cambiar">
	</form>
	

	<h1>Cuentas</h1>
	<a href="<?= base_url()?>home/register">Crear nueva cuenta</a>
	<table>
		<tr>
			<td>Nombre</td>
			<td>Username</td>
			<td>Accion</td>
		</tr>
		<?php if (!empty($usuarios)): ?>
			<?php foreach ($usuarios as $usuario): ?>
				<tr>
					<td><?= $usuario->nombre?></td>
					<td><?= $usuario->username?></td>
					<td>
						<a href="<?= base_url()?>home/delete/<?= $usuario->id?>">Eliminar</a>
					</td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</body>
</html>