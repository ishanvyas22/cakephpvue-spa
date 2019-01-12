<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post, ['novalidate' => true]) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
        ?>
        <button type="submit" class="button radius shadow primary">Submit</button>
        <a class="button shadow radius right mr-6" name="goBack">Back</a>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
