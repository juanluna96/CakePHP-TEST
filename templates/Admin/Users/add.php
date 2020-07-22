<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <!-- Adicionamos el archivo como variable a pasar junto con el user -->
            <?= $this->Form->create($user,['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                echo $this->Form->control('username');
                echo $this->Form->control('correo');
                echo $this->Form->control('password');
                // Crear campo para la tabla perfiles de la base de datos
                echo $this->Form->control('perfile.telefono');
                //Adicionamos el control para las imagenes de usuario
                echo $this->Form->control('archivo_imagen',['type'=>'file']);
                // echo $this->Form->control('fecha_creacion');
                // echo $this->Form->control('fecha_modificacion', ['empty' => true]);
                // Crear campo para la tabla skills de la base de datos
                echo $this->Form->control('skills.0.nombre');
                echo $this->Form->control('skills.1.nombre');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
