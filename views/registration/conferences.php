<div class="conferences">
    <h2 class="conferences__heading"><?php echo $title; ?></h2>
    <p class="conferences__description">Elige hasta 5 eventos para asistir de forma presencial</p>

    <div class="conferencesRegistration">
        <main class="conferencesRegistration__list">
            <h3 class="conferencesRegistration__heading">&lt;Conferencias /></h3>

            <p class="conferencesRegistration__date">Viernes 5 de Agosto</p>
            <div class="conferencesRegistration__grid">
                <?php foreach ($events['conferences_1'] as $event): ?>
                    <?php include __DIR__ . '/event.php' ?>
                <?php endforeach; ?>
            </div>

            <p class="conferencesRegistration__date">Sábado 6 de Agosto</p>
            <div class="conferencesRegistration__grid">
                <?php foreach ($events['conferences_2'] as $event): ?>
                    <?php include __DIR__ . '/event.php' ?>
                <?php endforeach; ?>
            </div>

            <h3 class="conferencesRegistration__heading--workshops">&lt;Workshops /></h3>

            <p class="conferencesRegistration__date">Viernes 5 de Agosto</p>
            <div class="conferencesRegistration__grid events--workshops">
                <?php foreach ($events['workshops_1'] as $event): ?>
                    <?php include __DIR__ . '/event.php' ?>
                <?php endforeach; ?>
            </div>

            <p class="conferencesRegistration__date">Sábado 6 de Agosto</p>
            <div class="conferencesRegistration__grid events--workshops">
                <?php foreach ($events['workshops_2'] as $event): ?>
                    <?php include __DIR__ . '/event.php' ?>
                <?php endforeach; ?>
            </div>
        </main>
        <aside class="userRegistration">
            <h3 class="userRegistration__heading">Tu Registro</h3>
            <div id="userRegistration__summary" class="userRegistration__summary"></div>
            <div class="userRegistration__gift">
                <label for="gift" class="userRegistration__label">Selecciona un regalo</label>
                <select class="userRegistration__select" id="gift">
                    <option selected disabled value="">-- Selecciona tu regalo --</option>
                    <?php foreach ($gifts as $gift): ?>
                        <option value="<?php echo $gift->getId(); ?>"><?php echo $gift->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <form id="registrationForm" class="form">
                <input type="submit" class="form__submit form__submit--wide" value="Registrarme">
            </form>
        </aside>
    </div>

</div>

<?php 
    $view_scripts = $view_scripts ?? [];
    $view_scripts[] = '/build/js/registration.js';
    $view_scripts[] = "https://cdn.jsdelivr.net/npm/sweetalert2@11";
?>


