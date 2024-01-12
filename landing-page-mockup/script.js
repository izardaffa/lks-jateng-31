function dropdown() {
    document.getElementById("dropdown").classList.toggle("show");
}

window.onclick = function(event) {
    let dropdown = document.getElementById("dropdown");

    if (!event.target.matches('.dropdown-btn') && !dropdown) {
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    }
}