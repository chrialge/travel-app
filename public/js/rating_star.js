
/**
 * funzione che colora le stelle 
 * @param {Number} n il numero di stelle da colorare
 * @param {Number} id l'id dell'itinerario
 */
function rating(n, id) {

    // prendo la specifica stella
    const stars = document.getElementsByClassName(`star-rating-${id}`);

    // invoca la funzione
    remove(stars);

    // ciclo per tutte le stelle selezionate
    for (let i = 0; i < n; i++) {

        // colore le stelle
        stars[i].style.color = 'orange';

        //salvo l'emento 
        let input = document.getElementById(`vote-${id}`)

        // inserisce il valore del input
        input.value = n;
    }

}

/**
 * funzione che toglie lo stile dalle stelle 
 * @param {Element} stars 
 */
function remove(stars) {
    let i = 0;
    while (i < 5) {
        stars[i].style.color = 'black';
        i++;
    }
}

