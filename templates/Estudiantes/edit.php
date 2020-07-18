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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $estudiante->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $estudiante->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Estudiantes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudiantes form content">
            <?= $this->Form->create($estudiante) ?>
            <fieldset>
                <legend><?= __('Edit Estudiante') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('edad');
                    echo $this->Form->control('pais');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
