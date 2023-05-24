<?php $v->layout("_theme");

var_dump($_SESSION)
?>
<?php $v->start('css') ?>
<style>
</style>
<?php $v->end() ?>
<h1>
    Testando as rotas
</h1>

<?php $v->start('js') ?>
<script>
    $(function() {
        $("h1").text('Carregou o js');
    });
</script>
<?php $v->end() ?>