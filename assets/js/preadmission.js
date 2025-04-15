var preadmissionPage = 1;

function preadmissionGoToPage(page) {
    let index = 0;
    const pages = document.querySelectorAll(".preadmission > .pages > *");

    document.querySelector(".preadmission > .pages > .focused").classList.remove("focused");
    pages[page - 1].classList.add("focused");
    for (let head of document.querySelectorAll(".preadmission > .header > p")) {
        if (index >= page) {
            head.classList.remove("valid");
        } else {
            head.classList.add("valid");
        }
        index++;
    }
}

function preadmissionCheckCurrentPage() {
    if (null != document.querySelector(".preadmission > .pages > .focused *:invalid")) {
        showError("Veillez inserer toutes les informations requises.")
        // return (true);
    }
    return (false);
}

function preadmissionPageNext() {
    var lenght = document.querySelectorAll(".pages > .page").length;

    if (preadmissionCheckCurrentPage()) {
        return;
    }
    if (preadmissionPage < lenght) {
        preadmissionPage++;
    } else {
        return;
    }
    preadmissionGoToPage(preadmissionPage);
}

function preadmissionPagePrevious() {
    preadmissionPage = preadmissionPage > 1 ? preadmissionPage - 1 : preadmissionPage;
    preadmissionGoToPage(preadmissionPage);
}

function setChildMod(age) {
    const birthday = new Date(age);
    const now = new Date();


    const adultBirthday = new Date(now.getFullYear() - 18, now.getMonth(), now.getDate());

    const pagesElements = document.querySelectorAll(".preadmission .minor, .preadmission .minor-pass");
    if (adultBirthday > birthday) {
        console.log("adult mod");
        pagesElements.forEach(element => {
            element.classList.add("minor");
            if (!element.classList.contains('minor-pass')) {
                element.classList.remove('minor-pass');
            }
        });
    } else {
        console.log("child mod");
        pagesElements.forEach(element => {
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