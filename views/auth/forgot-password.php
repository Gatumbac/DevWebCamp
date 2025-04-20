<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Recupera tu acceso a DevWebCamp</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form class="form" method="POST" action="/olvide-password">

        <div class="form__field">
            <label class="form__label" for="email">Email</label>
            <input 
                id="email"
                name="email"
                type="email"
                placeholder="Tu email"
                class="form__input"
                value="<?php echo s($user->getEmail()); ?>"
                required
            >
        </div>

        <input type="submit" class="form__submit" value="Enviar Instrucciones">
    </form>

    <div class="actions">
        <a class="actions__link" href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Obtener una</span></a>
        <a class="actions__link" href="/login">¿Ya tienes una cuenta? <span>Iniciar Sesión</span></a>
    </div>
</main>