(function () {
    const chart = document.getElementById('gift-chart');
    getGiftData();
    async function getGiftData() {
        try {
            const url = '/api/regalos';
            const response = await fetch(url);
            const data = await response.json();
            new Chart(chart, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: '',
                        data: Object.values(data),
                        backgroundColor: [
                            '#ea580c',
                            '#84cc16',
                            '#22d3ee',
                            '#a855f7',
                            '#ef4444',
                            '#14b8a6',
                            '#db2777',
                            '#e11d48',
                            '#7e22ce'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        } catch (error) {
            console.log(error);
            return [];
        }
    }

})();