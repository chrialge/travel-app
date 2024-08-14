let index = localStorage.getItem('date')


console.log('index')
if (index) {
    let dateId = 'date-' + index;
    let dateActive = document.getElementById(dateId);
    localStorage.setItem('date', index)

    // gli do la classe active
    dateActive.classList.add('active')
} else {
    let dateActive = document.getElementById('date-0');
    localStorage.setItem('date', 0)
    // gli do la classe active
    dateActive.classList.add('active')
}


// prendo tutte i contenitori delle date
const dateEl = document.querySelectorAll(".date_container");

// ciclo per tutti i contenitori
for (let index = 0; index < dateEl.length; index++) {

    // prendo il singolo contenitore
    const element = dateEl[index];
    // al click del singolo contenitore
    element.addEventListener('click', function (e) {

        // prendo il contenittore che e stato cliccato
        localStorage.setItem('date', index);
        let date = e.target;
        // se il contenitore cliccato e uguale a contenitore salvato in date active
        if (dateActive == date) {
            // previene l'evento
            e.preventDefault();
        } else {
            // rimuove la classe active al vecchio contenitore
            dateActive.classList.remove('active')


            // date active adesso diventa il contenitore cliccato
            dateActive = date
            // aggiungo la classe active al contenitore cliccato
            date.classList.add('active')
            localStorage.setItem('date', index);
        }

    })
}