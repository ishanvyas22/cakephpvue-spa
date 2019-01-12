<?php
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

    <?php
    echo $this->Html->css('base.css');
    echo $this->Html->css('foundation-icons/foundation-icons.css');
    echo $this->Html->css('style.css');
    ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <span id="app">
        <top-header></top-header>

        <app></app>

        <?php
        // echo $this->fetch('content');
        ?>

        <footer>
        </footer>
    </span>
</body>

<script type="text/javascript" src="/js/dist/app.js"></script>

</html>
