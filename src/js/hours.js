(function() {
    const days = document.querySelectorAll('[name="day"]');
    const dayInputHidden = document.querySelector('[name="day_id"]');
    const hourInputHidden = document.querySelector('[name="hour_id"]');
    const categoryInput = document.querySelector('[name="category_id"]'); 

    let search = {
        category_id: '',
        day: ''
    }

    document.addEventListener('DOMContentLoaded', function() {
        start();
    })
    
    function start() {
        addListeners();
    }

    function addListeners() {
        days.forEach((day) => {
            day.addEventListener('input', fillSearch);
        });
        categoryInput.addEventListener('change', fillSearch);
    }

    function fillSearch(e) {
        search[e.target.name] = e.target.value;
        
        if (!Object.values(search).includes('')) {
            hourInputHidden.value = '';
            dayInputHidden.value = '';
            findEvents();
        }
    }
    
    async function findEvents() {
        const {day, category_id} = search;
        url = `/api/horario-eventos?day_id=${day}&category_id=${category_id}`;
        try {
            const request = await fetch(url);
            const events = await request.json();
            showAvalaibleHours(events);
        } catch (error) {
            console.log(error);
        }
    }

    function showAvalaibleHours(events) {
        const takenHours = events.map(event => event.hour_id);
        const hourList = document.querySelectorAll('#hours li');

        hourList.forEach(hour => {
            hour.classList.add('hours__hour--disabled');
            hour.classList.remove('hours__hour--selected');
            hour.removeEventListener('click', selectHour); // Remove old listener if any
        });

        const hourArray = Array.from(hourList);
        const freeHours = hourArray.filter(hour => !takenHours.includes(hour.dataset.hourId));

        freeHours.forEach(hour => {
            hour.classList.remove('hours__hour--disabled');
            hour.addEventListener('click', selectHour)
        });
    }

    function selectHour(e) {
        const previousHour = document.querySelector('.hours__hour--selected');
        if(previousHour) {
            previousHour.classList.remove('hours__hour--selected');
        }
        e.target.classList.add('hours__hour--selected')
        hourInputHidden.value = e.target.dataset.hourId;
        dayInputHidden.value = document.querySelector('[name="day"]:checked').value;
    }
    
})();
