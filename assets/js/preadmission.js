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
        return (true);
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

function setChildMod(birth) {
    const minorBlock = document.querySelector(".preadmission #pageFiles > .minor");
    const birthday = new Date(birth);
    const adultBirthday = new Date(
        new Date().getFullYear() - 18,
        new Date().getMonth(),
        new Date().getDate()
    );

    if (birthday > adultBirthday) {
        console.log("Child");
        if (minorBlock.classList.contains("hidden") == true) {
            minorBlock.classList.remove("hidden");
        }
    } else {
        console.log("Adult");
        if (minorBlock.classList.contains("hidden") == false) {
            minorBlock.classList.add("hidden");
        }
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

function displayReturn(response) {
    console.log(response);
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
    }).then(response => {
        if (!response.ok) {
            throw new Error("Problème de connexion");
        }
        return (response.json());
    }).then(data => {
        if (data["status"] != 0) {
            throw new Error(data["error"]);
        }
        showSuccess("Préadmission effectuée");
    }).catch(error => {
        showError(error.message || "Problème de connexion")
    });
}