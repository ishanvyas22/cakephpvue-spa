<?php
/**
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakeVue Application';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->AssetMix->css('main') ?>

    <?= $this->AssetMix->script('app') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <span id="app">
        <top-header></top-header>

        <app></app>

        <footer></footer>
    </span>
</body>

</html>
