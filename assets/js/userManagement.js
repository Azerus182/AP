function saveNew(button) {
    var data = new FormData();

    data.append("action", "newUser");
    fetch('/api/user/', {
        method: 'POST',
        body: data
    }).then(() => {
        window.location.reload();
    });
}

function update(button, action) {
    var data = new FormData();
    var user = button.parentElement.parentElement;

    data.append("action", action);
    user.querySelectorAll("input, select").forEach(input => {
        data.append(input.name, input.value);
    });
    console.log(data);
    fetch('/api/user/', {
        method: 'POST',
        body: data
    }).then(() => {
        window.location.reload();
    });
}