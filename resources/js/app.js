import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
// document.getElementById('poiBoxInfo').style.display = 'none';
if (document.readyState === "loading" || document.readyState === "interactive") {
    // console.log('caricamento')

    document.getElementById('app').style.display = 'block';


    window.addEventListener('load', function () {

        // console.log('fine caricamento')
        if (this.innerWidth >= "500px") {
            console.log('bel34576')
            const sidebarPcEl = document.getElementById('sidebar_pc');
            sidebarPcEl.classList.add('sidebar-narrow-unfoldable')
        }

        // console.log(document.getElementById('app'));
        document.getElementById('app').style.display = 'block';

        document.getElementById('loading').style.display = 'none';
    });

} else {
    // console.log('fine caricamento')

    document.getElementById('app').style.display = 'block';
    document.getElementById('loading').style.display = 'none';
}

console.log(innerWidth);



document.getElementById('siderbar_phone_container').addEventListener('click', (e) => {

    e.preventDefault();

    const sidebarPcEl = document.getElementById('sidebar_pc');
    sidebarPcEl.classList.remove('sidebar-narrow-unfoldable')
    if (sidebarPcEl.style.display === 'flex') {

        sidebarPcEl.style.display = 'none';
    } else {
        sidebarPcEl.style.display = 'flex'
    }

})
