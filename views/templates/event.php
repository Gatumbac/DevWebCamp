<div class="event swiper-slide">
    <p class="event__hour"><?php echo $event->getHour(); ?></p>
    <div class="event__content">
        <h4 class="event__name"><?php echo $event->getName(); ?></h4>
        <p class="event__information"><?php echo $event->getDescription(); ?></p>

        <div class="event__speaker">
            <picture>
                <source srcset="/build/img/speakers/<?php echo $event->getSpeakerImg(); ?>.webp" type="image/webp">
                <source srcset="/build/img/speakers/<?php echo $event->getSpeakerImg(); ?>.png" type="image/png">
                <img class="event__speaker-img" src="/build/img/speakers/<?php echo $event->getSpeakerImg(); ?>.png" width="200" height="300" alt="Imagen Ponente">
            </picture>

            <p class="event__speaker-name"><?php echo $event->getSpeaker(); ?></p>
        </div>
    </div>
</div>