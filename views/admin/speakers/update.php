<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__button-container">
    <a class="dashboard__button" href="/admin/ponentes">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__form">
    <?php
    require_once __DIR__ . '/../../templates/alerts.php';
    ?>

    <form method="POST" class="form" enctype="multipart/form-data">
        
        <?php
        require_once __DIR__ . '/form.php';
        ?>

        <input type="submit" value="Guardar Cambios" class="form__submit form__submit--wide">

    </form>

</div>