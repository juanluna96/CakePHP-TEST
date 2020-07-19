<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form content">
	<!-- Crear formulario de datos como contraseña y nombre de usuario -->
	<?= $this->Form->create() ?>
	<fieldset>
		<legend><?= __('Please enter your username and password') ?></legend>
		<!-- Input del formulario para el nombre de usuario el campo username es el nombre de la tabla en base de datos -->
		<?= $this->Form->control('username') ?>
		<!-- Input del formulario para la contraseña el campo username es el nombre de la tabla en base de datos -->
		<?= $this->Form->control('password') ?>
	</fieldset>
	<?= $this->Form->button(__('Login')); ?>
	<?= $this->Form->end() ?>
</div>