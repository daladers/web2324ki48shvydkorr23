document.getElementById('contactForm').addEventListener('submit', event => {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    sendRequest('GET', `submit.php?name=${name}&email=${email}&message=${message}`);
});

const sendRequest = (method, url, data) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    xhr.onload = function() {
        if (this.status == 200) {
            document.getElementById('response').innerHTML = this.responseText;
        }
    };

    xhr.send(data);
}