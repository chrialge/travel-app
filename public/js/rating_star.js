

function rating(n, id) {
    const stars = document.getElementsByClassName(`star-rating-${id}`);

    remove(stars);
    for (let i = 0; i < n; i++) {
        stars[i].style.color = 'orange';
        let input = document.getElementById(`vote-${id}`)
        input.value = n;
    }

}

// To remove the pre-applied styling
function remove(stars) {
    let i = 0;
    while (i < 5) {
        stars[i].style.color = 'black';
        i++;
    }
}

