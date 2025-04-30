<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__button-container">
    <a class="dashboard__button" href="/admin/eventos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__form">
    <?php
    require_once __DIR__ . '/../../templates/alerts.php';
    ?>

    <form action="/admin/eventos/crear" method="POST" class="form">
        
        <?php
        require_once __DIR__ . '/form.php';
        ?>

        <input type="submit" value="Registrar Evento" class="form__submit form__submit--wide">

    </form>

</div>