(function() {
    const speakerList = document.querySelector('#speakerList');
    const speakerInput = document.querySelector('#speaker');
    const speakerInputHidden = document.querySelector('[name="speaker_id"]');
    let speakers = [];
    let filteredSpeakers = [];

    document.addEventListener('DOMContentLoaded', function() {
        start();
    })
    
    function start() {
        findSpeakers();
        addInputListener();
    }

    function addInputListener() {
        speakerInput.addEventListener('input', function(e) {
            const input = e.target.value.trim();
            if(input.length > 3) {
                filteredSpeakers = speakers.filter(speaker => {
                    const name = speaker.name.toLowerCase();
                    return name.includes(input.toLowerCase());
                })
            } else {
                filteredSpeakers = [];
            }
            showSpeakers();
        });
    }

    async function findSpeakers() {
        url = `/api/ponentes`;
        try {
            const response = await fetch(url);
            const result = await response.json();
            formatSpeakers(result);
        } catch (error) {
            console.log(error);
        }
    }

    function formatSpeakers(speakerArray = []) {
        speakers = speakerArray.map(speaker => {
            return {
                id: `${speaker.id}`,
                name: `${speaker.name.trim()} ${speaker.lastname.trim()}`
            }
        });
    }

    function showSpeakers() {
        cleanContainer(speakerList);
        speakerInputHidden.value = '';

        if (filteredSpeakers.length > 0) {
            filteredSpeakers.forEach(speaker => {
                const speakerHTML = document.createElement('LI');
                speakerHTML.classList.add('speakerList__speaker');
                speakerHTML.textContent = speaker.name;
                speakerHTML.dataset.speakerId = speaker.id;
                speakerHTML.addEventListener('click', selectSpeaker);

                speakerList.appendChild(speakerHTML);
            })
        } else {
            const message = document.createElement('LI');
            message.classList.add('speakerList__message');
            message.textContent = 'No existen resultados para la búsqueda'
            speakerList.appendChild(message);
        }
    }

    function cleanContainer(container) {
        while(container.firstChild) {
            container.removeChild(container.firstChild);
        }
    }

    function selectSpeaker(e) {
        speakerInputHidden.value = '';
        const previousSelection = document.querySelector('.speakerList__speaker--selected');
        if (previousSelection) {
            previousSelection.classList.remove('speakerList__speaker--selected');
        }

        const speaker = e.target;
        speaker.classList.add('speakerList__speaker--selected');
        speakerInputHidden.value = speaker.dataset.speakerId;
    }

})();
