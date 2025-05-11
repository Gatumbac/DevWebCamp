<main class="ticketPage">
    <h2 class="ticketPage__heading"><?php echo $title; ?></h2>
    <p class="ticketPage__description">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales</p>

    <div class="virtualTicket">
        <div class="ticket ticket--<?php echo $package['class']; ?> ticket--access">
            <h4 class="ticket__logo">&#60;DevWebCamp/></h4>
            <p class="ticket__plan"><?php echo $package['name']; ?></p>
            <p class="ticket__name"><?php echo $userName; ?></p>
            <p class="ticket__id"><?php echo "#" . $registration->getToken(); ?></p>
        </div>
    </div>
</main>