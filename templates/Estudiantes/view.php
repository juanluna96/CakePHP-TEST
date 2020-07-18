<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $estudiante
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Estudiante'), ['action' => 'edit', $estudiante->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Estudiante'), ['action' => 'delete', $estudiante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudiante->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Estudiantes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Estudiante'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudiantes view content">
            <h3><?= h($estudiante->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($estudiante->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pais') ?></th>
                    <td><?= h($estudiante->pais) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($estudiante->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Edad') ?></th>
                    <td><?= $this->Number->format($estudiante->edad) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
