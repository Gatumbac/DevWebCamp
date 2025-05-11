(function() {
    let events = [];
    const summaryContainer = document.querySelector("#userRegistration__summary");
    const conferenceButtons = document.querySelectorAll(".event__add");
    const form = document.querySelector('#registrationForm');

    document.addEventListener('DOMContentLoaded', start)

    function start() {
        if (summaryContainer) {
            showEvents();
            addButtonsListener();
            addFormListener();
        }
    }

    function addButtonsListener() {
        conferenceButtons.forEach(button => {
            button.addEventListener('click', addEvent);
        })
    }

    function addFormListener() {
        form.addEventListener('submit', submitForm);
    }

    function addEvent(e) {
        if (events.length >= 5) {
            showErrorAlert("Límite Alcanzado", "No puedes seleccionar más de 5 eventos")
            return;
        }

        button = e.target;
        const isRepeatedElement = events.some(event => event.id === button.dataset.id);
        if (!isRepeatedElement) {
            events = [...events , {
                id : button.dataset.id,
                title : button.parentElement.querySelector('.event__name').textContent.trim()
            }]
        }
        button.disabled = true;
        showEvents();
    }

    function showEvents() {

        cleanContainer(summaryContainer);

        if(events.length === 0) {

            const message = document.createElement('P');
            message.textContent = 'No tienes eventos seleccionados'
            message.classList.add('registrationEvent__message');
            summaryContainer.appendChild(message);

        } else {

            events.forEach(event => {
                const domEvent = document.createElement('DIV');
                domEvent.classList.add('registrationEvent__event');

                const title = document.createElement('H4');
                title.classList.add('registrationEvent__name');
                title.textContent = event.title;

                const deleteButton = document.createElement('BUTTON');
                deleteButton.classList.add('registrationEvent__button');
                deleteButton.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                deleteButton.onclick = function() {
                    deleteEvent(event.id);
                }

                domEvent.appendChild(title);
                domEvent.appendChild(deleteButton);
                summaryContainer.appendChild(domEvent);
            })
        }
    }

    function cleanContainer(container) {
        while(container.firstChild) {
            container.removeChild(container.firstChild);
        }
    }

    function deleteEvent(id) {
        events = events.filter(event => event.id !== id);
        const eventButton = document.querySelector(`[data-id="${id}"]`);
        eventButton.disabled = false;
        showEvents();
    }

    function submitForm(e) {
        e.preventDefault();
        const giftId = document.querySelector('#gift').value;
        const eventsId = events.map(event => event.id);
        
        if(eventsId.length === 0 || giftId === '') {
            showErrorAlert("Datos Incompletos", "Elige al menos un evento y tu regalo")
            return;
        }
    }

    function showErrorAlert(title, text) {
        Swal.fire({
            icon: "error",
            title: title,
            text: text
        });
    }

})();