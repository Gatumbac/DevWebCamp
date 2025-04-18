<main class="auth">
    <h2 class="auth__heading"><?php echo $title; ?></h2>
    <p class="auth__text">Crea tu cuenta en DevWebCamp</p>

    <form class="form" action="/crear-cuenta">
        <div class="form__field">
            <label class="form__label" for="name">Nombre</label>
            <input 
                id="name"
                name="name"
                type="text"
                placeholder="Tu nombre"
                class="form__input"
                required
            >
        </div>

        <div class="form__field">
            <label class="form__label" for="lastname">Apellido</label>
            <input 
                id="lastname"
                name="lastname"
                type="text"
                placeholder="Tu apellido"
                class="form__input"
                required
            >
        </div>

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

        <input type="submit" class="form__submit" value="Crear Cuenta">
    </form>

    <div class="actions">
        <a class="actions__link" href="/login">¿Ya tienes una cuenta? <span>Iniciar Sesión</span></a>
        <a class="actions__link" href="/olvide-password">¿Olvidaste tu password?</a>
    </div>
</main>