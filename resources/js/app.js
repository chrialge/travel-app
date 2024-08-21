import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


if (document.readyState === "loading" || document.readyState === "interactive") {
    console.log('caricamento')

    document.getElementById('app').style.display = 'block';


    window.addEventListener('load', function () {
        console.log('fine caricamento')

        console.log(document.getElementById('app'));
        document.getElementById('app').style.display = 'block';

        document.getElementById('loading').style.display = 'none';
    });

} else {
    console.log('fine caricamento')

    document.getElementById('app').style.display = 'block';
    document.getElementById('loading').style.display = 'none';
}

