var preadmissionPage = 1;

function preadmissionGoToPage(page) {
    const pages = document.querySelectorAll(".preadmission > .pages > *");

    document.querySelector(".preadmission > .pages > .focused").classList.remove("focused");
    pages[page - 1].classList.add("focused");
}

function showError(text) {
    const bar = document.querySelector(".statusbar > .bar");
    bar.classList.add("error");
    bar.classList.remove("none");
    bar.querySelector("p").innerHTML = text;
}

function preadmissionCheckCurrentPage() {
    if (null != document.querySelector(".preadmission > .pages > .focused *:invalid")) {
        showError("Veillez inserer toutes les informations requises.")
        return (true);
    }
    return (false);
}

function preadmissionPageNext() {
    if (preadmissionCheckCurrentPage()) {
        return;
    }
    preadmissionPage = preadmissionPage < 5 ? preadmissionPage + 1 : preadmissionPage;
    preadmissionGoToPage(preadmissionPage);
}

function preadmissionPagePrevious() {
    preadmissionPage = preadmissionPage > 1 ? preadmissionPage - 1 : preadmissionPage;
    preadmissionGoToPage(preadmissionPage);
}

function setChildMod(age) {
    const birthday = new Date(age);
    const now = new Date();

    // Calculate the adult birthday exactly 18 years in the future based on the current date
    const adultBirthday = new Date(now.getFullYear() + 18, now.getMonth(), now.getDate());

    const pagesElements = document.querySelectorAll(".preadmission .minor, .preadmission .minor-pass");
    if (adultBirthday > birthday) {
        pagesElements.forEach(element => {
            element.classList.add("minor");
            // Check if class exists before removing to avoid errors
            if (!element.classList.contains('minor-pass')) {
                element.classList.remove('minor-pass');
            }
        });
    } else {
        pagesElements.forEach(element => {
            // Check if class exists before adding to avoid errors
            if (element.classList.contains('minor-pass')) {
                element.classList.remove("minor");
            } else {
                element.classList.add("minor");
            }
        });
    }
}

function getDataFromElement(elem) {
    const data = [];

    elem.querySelectorAll('input:not([type="file"]), select').forEach(input => {
        data[input.name] = input.value;
    });
    elem.querySelectorAll('input[type="file"]').forEach(input => {
        data[input.name] = input.files[0];
    });
    return (data);
}

function sendForm() {
    var data = new FormData();
    var inputs = getDataFromElement(document.querySelector(".preadmission"));

    for (var key in inputs) {
         data.append(key, inputs[key]);
    };
    fetch('/api/preadmission/', {
        method: 'POST',
        body: data
    });
}