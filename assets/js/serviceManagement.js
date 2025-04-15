function saveNew(button) {
    var data = new FormData();

    data.append("newService", button.parentElement.querySelector("input").value);
    fetch('/api/service/', {
        method: 'POST',
        body: data
    })
    // .then(
    //     location.reload()
    // )
    ;
}

function update(button) {
    var data = new FormData();

    data.append("action", button.value);
    button.parentElement.querySelectorAll("input").forEach(input => {
        data.append(input.name, input.value);
    });
    console.log(data);
    fetch('/api/service/', {
        method: 'POST',
        body: data
    });
}