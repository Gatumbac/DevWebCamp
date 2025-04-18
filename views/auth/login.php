<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Inicia sesión en DevWebCamp</p>

    <form class="form" action="/">
        <div class="form__field">
            <label class="form__label" for="email">Email</label>
            <input 
                id="email"
                name="email"
                type="email"
                placeholder="Tu email"
                class="form__input"
                required
            >
        </div>

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

        <input type="submit" class="form__submit" value="Iniciar Sesión">
    </form>

    <div class="actions">
        <a class="actions__link" href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Obtener una</span></a>
        <a class="actions__link" href="/olvide-password">¿Olvidaste tu password?</a>
    </div>
</main>