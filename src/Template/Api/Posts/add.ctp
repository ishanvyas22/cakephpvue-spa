<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post, ['novalidate' => true]) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
        ?>
        <button type="submit">Submit</button>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
