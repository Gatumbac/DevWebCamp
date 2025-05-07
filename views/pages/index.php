<?php include_once __DIR__ . '/conferences.php'; ?>
<?php include_once __DIR__ . '/../templates/summary.php'; ?>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Conoce a nuestros expertos de DevWebCamp</p>
    <div class="speakers__grid">
    <?php foreach($speakers as $speaker): ?>
        <div data-aos="<?php echo aos_animation(); ?>" class="speaker">
            <picture>
                <source srcset="/build/img/speakers/<?php echo $speaker->getImage(); ?>.webp" type="image/webp">
                <source srcset="/build/img/speakers/<?php echo $speaker->getImage(); ?>.png" type="image/png">
                <img class="speaker__img" src="/build/img/speakers/<?php echo $speaker->getImage(); ?>.png" width="200" height="300" alt="Imagen Ponente">
            </picture>
            <div class="speaker__info">
                <h4 class="speaker__name"><?php echo $speaker->getFullName(); ?></h4>
                <p class="speaker__location"><?php echo $speaker->getLocation(); ?></p>
                <nav class="speaker-social">

                    <?php $networks = json_decode($speaker->getNetworks()) ;?>
                    <?php if (!empty($networks->facebook)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://facebook.com">
                        <span class="speaker-social__hide">Facebook</span>
                        </a> 
                    <?php endif; ?>

                    <?php if (!empty($networks->twitter)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://twitter.com">
                            <span class="speaker-social__hide">Twitter</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if (!empty($networks->youtube)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://youtube.com">
                            <span class="speaker-social__hide">YouTube</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if (!empty($networks->instagram)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://instagram.com">
                            <span class="speaker-social__hide">Instagram</span>
                        </a> 
                    <?php endif; ?>
                    
                    <?php if (!empty($networks->tiktok)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://tiktok.com">
                            <span class="speaker-social__hide">Tiktok</span>
                        </a> 
                    <?php endif; ?>

                    <?php if (!empty($networks->github)): ?>
                        <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="https://github.com">
                            <span class="speaker-social__hide">GitHub</span>
                        </a>
                    <?php endif; ?>
                </nav>
                <ul class="speaker__skills">
                    <?php $tags = explode(',', $speaker->getTags()); ?>
                    <?php foreach($tags as $tag): ?>
                        <li class="speaker__skill"><?php echo $tag; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</section>

<div id="map" class="map">
</div>

<section class="tickets">
    <h2 class="tickets__heading">Boletos & Precios</h2>
    <p class="tickets__description">Precios para DevWebCamp</p>

    <div class="tickets__grid">
        <div data-aos="zoom-in" class="ticket ticket--onsite">
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Presencial</p>
            <p class="ticket__price">$199</p>
        </div>

        <div data-aos="zoom-in" class="ticket ticket--online">
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Virtual</p>
            <p class="ticket__price">$49</p>
        </div>

        <div data-aos="zoom-in" class="ticket ticket--free">
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan">Presencial</p>
            <p class="ticket__price">Gratis - $0</p>
        </div>
    </div>

    <div class="ticket__linkContainer">
        <a href="/paquetes" class="ticket__link">Ver Paquetes</a>
    </div>
</section>

<?php
    $view_scripts = $view_scripts ?? [];
    $view_scripts[] = '/build/js/map.js';
?>