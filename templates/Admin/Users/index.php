<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<!-- Imprime el nombre del usuario mediante this->Auth en vez de Session -->
<?php echo $nombre_usuario ?>

<div class="users index content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>

    <!-- Crear buscador usando el metodo get -->
    <?php echo $this->Form->create(null, ['type'=>'get']); ?>
    <?php echo $this->Form->control('key',['label'=>'Busqueda', 'value'=>$this->request->getQuery('key')]); ?>
    <?php echo $this->Form->submit(); ?>
    <?php echo $this->Form->end(); ?>

    <div class="table-responsive"> 
        <!-- Crear formulario valido para los checkbox-->
        <?php echo $this->Form->create(null,['url'=>['action'=>'borrarTodos']]); ?>
        <button>Borrar seleccionados</button>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('correo') ?></th>
                    <!-- <th><?= $this->Paginator->sort('password') ?></th> -->
                    <!-- Mostrar imagen en el html -->
                    <th><?= $this->Paginator->sort('Imagen') ?></th>
                    <th>Telefono</th>
                    <!-- Cambiar estado de activo a inactivo o viseversa -->
                    <th><?= $this->Paginator->sort('Cambiar estado') ?></th>
                    <th><?= $this->Paginator->sort('fecha_creacion') ?></th>
                    <th><?= $this->Paginator->sort('fecha_modificacion') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <!-- Checkbox para seleccionar muchos usuarios -->
                        <td><?php echo $this->Form->checkbox('ids[]',['value'=>$user->id]) ?></td>
                        <td><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->correo) ?></td>
                        <!-- <td><?= h($user->password) ?></td> -->
                        <!-- Mostrar imagen en el html -->
                        <td><?php echo @$this->Html->image($user->imagen,['style'=>'max-width:100px;height:100px;border-radius:50%;']); ?></td>
                        <!-- Anadir de otra tabla de la base de datos perfiles usando llaves foreanas -->
                        <td><?= @h($user->perfile->telefono) ?></td>
                        <!-- Cambiar estado de activo a inactivo o viseversa -->
                        <td>
                            <?php if ($user->estado==1): ?>
                                <?= $this->Form->postLink(__('Inactivar'), ['action' => 'usuarioEstado', $user->id,$user->estado], ['block'=>true,'confirm' => __('Estas seguro de desactivar al usuario # {0}?', $user->id)]) ?>
                                <?php else: ?>
                                    <?= $this->Form->postLink(__('Activar'), ['action' => 'usuarioEstado', $user->id,$user->estado], ['block'=>true,'confirm' => __('Estas seguro de activar al usuario # {0}?', $user->id)]) ?>
                                <?php endif ?>
                            </td>
                            <td><?= h($user->fecha_creacion) ?></td>
                            <td><?= h($user->fecha_modificacion) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['block'=>true,'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->fetch('postLink'); ?>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
