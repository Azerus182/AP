function statusbarClose() {
    const bar = document.querySelector(".statusbar > .bar");

    bar.classList.remove("error");
    bar.classList.remove("success");
    bar.classList.add("none");
}

function showError(text) {
    const bar = document.querySelector(".statusbar > .bar");
    bar.classList.add("error");
    bar.classList.remove("none");
    bar.querySelector("p").innerHTML = text;
}