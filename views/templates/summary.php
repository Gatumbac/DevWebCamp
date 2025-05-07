<section class="summary">
    <div class="summary__grid">
        <div data-aos="<?php echo aos_animation(); ?>" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $totalSpeakers ?? 20; ?></p>
            <p class="summary__text">Speakers</p>
        </div>
        <div data-aos="<?php echo aos_animation(); ?>" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $totalConferences ?? 15; ?></p>
            <p class="summary__text">Conferencias</p>
        </div>
        <div data-aos="<?php echo aos_animation(); ?>" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $totalWorkshops ?? 25; ?></p>
            <p class="summary__text">Workshops</p>
        </div>
        <div data-aos="<?php echo aos_animation(); ?>" class="summary__block">
            <p class="summary__text summary__text--number">500</p>
            <p class="summary__text">Asistentes</p>
        </div>
    </div>
</section>