function statusbarClose() {
    const bar = document.querySelector(".statusbar > .bar");

    bar.classList.remove("error");
    bar.classList.remove("success");
    bar.classList.add("none");
}

function showError(text) {
    const bar = document.querySelector(".statusbar > .bar");
    bar.classList.add("error");
    if (bar.classList.contains("none")) {
        bar.classList.remove("none");
    }
    if (bar.classList.contains("success")) {
        bar.classList.remove("success");
    }
    bar.querySelector("p").innerHTML = text;
}

function showSuccess(text) {
    const bar = document.querySelector(".statusbar > .bar");
    bar.classList.add("success");
    if (bar.classList.contains("none")) {
        bar.classList.remove("none");
    }
    if (bar.classList.contains("error")) {
        bar.classList.remove("error");
    }
    bar.querySelector("p").innerHTML = text;
}