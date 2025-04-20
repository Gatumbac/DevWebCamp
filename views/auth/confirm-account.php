<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Confirma tu cuenta en DevWebCamp</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php';
    ?>
    <?php if (isset($alerts['success'])): ?>
    <div class="actions--center">
        <a class="actions__link" href="/login"><span>Iniciar Sesión</span></a>
    </div>
    <?php endif; ?>
</main>