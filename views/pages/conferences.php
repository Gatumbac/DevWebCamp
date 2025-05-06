<main class="schedule">
    <h2 class="schedule__heading">Conferencias & Workshops</h2>
    <p class="schedule__description">Talleres y Conferencias dictados por expertos en desarrollo web</p>

    <div class="events">
        <h3 class="events__heading">&lt;Conferencias /></h3>
        <p class="events__date">Viernes 5 de Agosto</p>
        <div class="events__list swiper slider">
            <div class="swiper-wrapper">
                <?php foreach ($events['conferences_1'] as $event): ?>
                    <?php include __DIR__ . '/../templates/event.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <p class="events__date">Sábado 6 de Agosto</p>
        <div class="events__list swiper slider">
            <div class="swiper-wrapper">
                <?php foreach ($events['conferences_2'] as $event): ?>
                    <?php include __DIR__ . '/../templates/event.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div class="events events--workshops">
        <h3 class="events__heading">&lt;Workshops /></h3>
        <p class="events__date">Viernes 5 de Agosto</p>
        <div class="events__list swiper slider">
            <div class="swiper-wrapper">
                <?php foreach ($events['workshops_1'] as $event): ?>
                    <?php include __DIR__ . '/../templates/event.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <p class="events__date">Sábado 6 de Agosto</p>
        <div class="events__list swiper slider">
            <div class="swiper-wrapper">
                <?php foreach ($events['workshops_2'] as $event): ?>
                    <?php include __DIR__ . '/../templates/event.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</main>

<?php
    $view_scripts = $view_scripts ?? [];
    $view_scripts[] = '/build/js/slider.js';
?>