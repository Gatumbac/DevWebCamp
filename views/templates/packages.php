<?php $isUserRegistration = $isUserRegistration ?? false; ?>
<div class="packages__grid">
    <div class="package">
        <h3 class="package__name">Pase Gratis</h3>
        <ul class="package__list">
            <li class="package__element">Acceso virtual a DevWebCamp</li>
        </ul>
        <p class="package__price">$0</p>
        <?php if ($isUserRegistration): ?>
        <form class="form" action="/finalizar-registro/gratis" method="POST">
            <input type="submit" class="package__submit" value="Inscripción Gratis">
        </form>
        <?php endif; ?>
    </div>

    <div class="package">
        <h3 class="package__name">Pase Presencial</h3>
        <ul class="package__list">
            <li class="package__element">Acceso Presencial a DevWebCamp</li>
            <li class="package__element">Pase por 2 días</li>
            <li class="package__element">Acceso a Talleres y Conferencias</li>
            <li class="package__element">Acceso a Grabaciones</li>
            <li class="package__element">Camisa del Evento</li>
            <li class="package__element">Comida y Bebida</li>
        </ul>
        <p class="package__price">$199</p>

        <?php if ($isUserRegistration) : ?>
            <div id="paypal-button-container"></div>
                
                <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                        purchase_units: [{
                            custom_id: "1",
                            description: "Pago Presencial DevWebCamp",
                            amount: {
                            currency_code: "USD",
                            value: '199.00'  
                            }
                        }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(orderData) {

                            const data = new FormData();
                            data.append('package_id', orderData.purchase_units[0].custom_id);
                            data.append('pay_id', orderData.purchase_units[0].payments.captures[0].id);
                            fetch('/finalizar-registro/pagar', {
                                method: 'POST',
                                body: data
                            })
                            .then(response => response.json())
                            .then(result => {
                                if(result.result) {
                                    window.location.href = '/finalizar-registro/conferencias';
                                }
                            })
                                

                            const element = document.getElementById('paypal-button-container');
                            element.innerHTML = '';
                            element.innerHTML = `<h3 style="text-align: center;">Ocurrió un error al procesar tu pago en DevWebCamp</h3>`;
                        });
                    },

                    onError: function (err) {
                        console.log(err);
                    }
                }).render('#paypal-button-container');
                </script>

        <?php endif; ?>
    </div>

    <div class="package">
        <h3 class="package__name">Pase Virtual</h3>
        <ul class="package__list">
            <li class="package__element">Acceso Virtual a DevWebCamp</li>
            <li class="package__element">Pase por 2 días</li>
            <li class="package__element">Acceso a Talleres y Conferencias</li>
            <li class="package__element">Acceso a Grabaciones</li>
        </ul>
        <p class="package__price">$49</p>
    </div>
</div>