// importo bootstrap
import './bootstrap';
// importo lo stile
import '~resources/scss/app.scss';
// importo la globale per le immagini
import.meta.glob([
    '../img/**'
])


// se e in stato di "loading" o di "interazione"
if (document.readyState === "loading" || document.readyState === "interactive") {

    // cambio lo stile del elemento con l'id "app"
    document.getElementById('app').style.display = 'block';

    // quando la pagina e in stato di caricamento
    window.addEventListener('load', function () {

        // se lo schermo di visualizzazione e oltre le 500px
        if (this.innerWidth >= "500px") {

            // salvo l'elemento con l'id "siderbar_pc"
            const sidebarPcEl = document.getElementById('sidebar_pc');

            // aggiungo la classe all'elemento "siderbar_pc"
            sidebarPcEl.classList.add('sidebar-narrow-unfoldable')
        }

        // cambio lo stile dell'elemento con l'id "app"
        document.getElementById('app').style.display = 'block';

        // cambio lo stile dell'elemento con l'id "loading"
        document.getElementById('loading').style.display = 'none';
    });

} else { //altrimenti

    // cambio lo stile dell'elemento con l'id "app"
    document.getElementById('app').style.display = 'block';

    // cambio lo stile dell'elemento con l'id "loading"
    document.getElementById('loading').style.display = 'none';
}


// se esiste l'elemento con l'id "siderbar_phone_container"
if (document.getElementById('siderbar_phone_container')) {

    // quando l'elemento viene 'cliccato' con l'id "siderbar_container_phone"
    document.getElementById('siderbar_phone_container').addEventListener('click', (e) => {

        // 
        e.preventDefault();

        // salvo l'elemento con l'id "siderbar_pc"
        const sidebarPcEl = document.getElementById('sidebar_pc');
        // rimuovo la classe dall'elemento con l'id "sidebar_pc"
        sidebarPcEl.classList.remove('sidebar-narrow-unfoldable')

        // se la rule display e flex
        if (sidebarPcEl.style.display === 'flex') {

            // cambio lo stile dell'elemento con l'id "siderbar_pc"
            sidebarPcEl.style.display = 'none';
        } else { //altrimenti

            // cambio lo stile dell'elemento con l'id "siderbar_pc"
            sidebarPcEl.style.display = 'flex'
        }

    })
}


