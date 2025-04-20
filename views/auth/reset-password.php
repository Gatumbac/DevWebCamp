<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Coloca tu nuevo password</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    if ($show):
    ?>

    <form class="form" method="POST">

        <div class="form__field">
            <label class="form__label" for="password">Password</label>
            <input 
                id="password"   
                name="password"
                type="password"
                placeholder="Tu password"
                class="form__input"
                required
            >
        </div>

        <div class="form__field">
            <label class="form__label" for="repeatedPassword">Repetir Password</label>
            <input 
                id="repeatedPassword"   
                name="repeatedPassword"
                type="password"
                placeholder="Repite tu password"
                class="form__input"
                required
            >
        </div>

        <input type="submit" class="form__submit" value="Guardar Cambios">
    </form>

    <?php endif; ?>

</main>