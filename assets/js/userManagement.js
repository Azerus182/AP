function saveNew(button) {
    var data = new FormData();

    data.append("action", "newUser");
    fetch('/api/user/', {
        method: 'POST',
        body: data
    })
}

function update(button) {
    var data = new FormData();

    data.append("action", "updateUser");
    button.parentElement.querySelectorAll("input").forEach(input => {
        data.append(input.name, input.value);
    });
    console.log(data);
    fetch('/api/user/', {
        method: 'POST',
        body: data
    });
}