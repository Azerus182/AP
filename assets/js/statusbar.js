function statusbarClose() {
    const bar = document.querySelector(".statusbar > .bar");

    bar.classList.remove("error");
    bar.classList.remove("success");
    bar.classList.add("none");
}