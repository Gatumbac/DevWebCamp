<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="blocks">
    <div class="blocks__grid">
        <div class="block">
            <h3 class="block__heading">Últimos Registros</h3>
            <?php foreach ($registrations as $registration): ?>
                <div class="block__content">
                    <p class="block__text"><?php echo $registration->getUserName(); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="block">
            <h3 class="block__heading">Ingresos Netos</h3>
            <p class="block__text--income">$<?php echo $income; ?></p>
        </div>

        <div class="block">
            <h3 class="block__heading">Eventos con menos lugares disponibles</h3>
            <?php foreach ($lowSeatsEvents as $event): ?>
                <div class="block__content">
                    <p class="block__text--event"><?php echo $event->getName() . ' - ' . $event->getSeatQuantity() . ' Disponibles'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="block">
            <h3 class="block__heading">Eventos con más lugares disponibles</h3>
            <?php foreach ($highSeatsEvents as $event): ?>
                <div class="block__content">
                    <p class="block__text--event"><?php echo $event->getName() . ' - ' . $event->getSeatQuantity() . ' Disponibles'; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>