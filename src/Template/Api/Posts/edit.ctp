<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post, ['novalidate' => true]) ?>
    <fieldset>
        <legend><?= __('Edit Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
        ?>
        <?= $this->Form->button(__('Submit'), ['class' => 'button radius shadow primary']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
