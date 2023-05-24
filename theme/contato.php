<?php $v->layout('_theme') ?>

<?php $v->start('css') ?>
<style>
    body {
        background-color: #eee;
    }
</style>
<?php $v->end() ?>

<div>
    <h1>Contato</h1>
</div>

<?php $v->start('js') ?>

<script>
    console.log($('h1'))
</script>

<?php $v->end() ?>