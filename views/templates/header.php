<header class="header">
    <div class="header__container">
        <nav class="header__nav">
            <?php if (verifyAuth()){ ?>
                <a class="header__link" href="<?php echo verifyAdmin() ? '/admin/dashboard' : 'finalizar-registro'?>">Administrar</a>
                <a class="header__link" href="/logout">Cerrar Sesión</a>
            <?php } else { ?>
                <a class="header__link" href="/crear-cuenta">Registro</a>
                <a class="header__link" href="/login">Iniciar Sesión</a>
            <?php } ?>
        </nav>

        <div class="header__content">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp/></h1>
            </a>
            <p class="header__text">Agosto 5-6 | 2025</p>
            <p class="header__text header__text--mode">En Línea - Presencial</p>
            <a class="header__button" href="/crear-cuenta">Comprar Pase</a>
        </div>
    </div>
</header>

<div class="bar">
    <div class="bar__content">
            <a href="/">
                <h2 class="bar__logo">&#60;DevWebCamp/></h2>
            </a>
            <nav class="nav">
                <a href="/devwebcamp" class="nav__link <?php echo verifyActualPage('/devwebcamp') ? 'nav__link--current' : '' ?>">Evento</a>
                <a href="/paquetes" class="nav__link <?php echo verifyActualPage('/paquetes') ? 'nav__link--current' : '' ?>">Paquetes</a>
                <a href="/conferencias-workshops" class="nav__link <?php echo verifyActualPage('/conferencias-workshops') ? 'nav__link--current' : '' ?>">Workshops / Conferencias</a>
                <a href="/crear-cuenta" class="nav__link <?php echo verifyActualPage('/crear-cuenta') ? 'nav__link--current' : '' ?>">Comprar Pase</a>
            </nav>
    </div>
</div>