var register_username = document.getElementById('register-username');
var register_email = document.getElementById('register-email');
var registration = document.getElementById('registration');

function debounce(func, timeout = 1000) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    }
}

if (register_username != null) {
    register_username.addEventListener('keyup', debounce(() => {
        if (register_username.value != "") {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    register_username.className = xhr.responseText.split(' ')[0];
                    if (register_username.className == "red-border") {
                        document.getElementById('error-username').style.display = "block";
                        if (xhr.responseText.split(' ')[1] == "error-username-regex") {
                            document.getElementById('error-username').innerHTML = "Username harus berupa gabungan alphabet, angka, dan underscore";
                        } else {
                            document.getElementById('error-username').innerHTML = "Username sudah digunakan";
                        }
                    } else {
                        document.getElementById('error-username').style.display = "none";
                    }
                }
            };
            xhr.open('GET', "../user/check_unique_username?username=" + register_username.value, true);
            xhr.send();
        } else {
            register_username.className = "";
            document.getElementById('error-username').style.display = "none";
        }
    }));
}

if (register_email != null) {
    register_email.addEventListener('keyup', debounce(() => {
        if (register_email.value != "") {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    register_email.className = xhr.responseText.split(' ')[0];
                    if (xhr.responseText.split(' ')[0] == "red-border") {
                        document.getElementById('error-email').style.display = "block";
                        if (xhr.responseText.split(' ')[1] == "error-email-regex") {
                            document.getElementById('error-email').innerHTML = "Email tidak valid";
                        } else {
                            document.getElementById('error-email').innerHTML = "Email sudah digunakan";
                        }
                    } else {
                        document.getElementById('error-email').style.display = "none";
                    }
                }
            };
            xhr.open('GET', "../user/check_unique_email?email=" + register_email.value, true);
            xhr.send();
        } else {
            register_email.className = "";
            document.getElementById('error-email').style.display = "none";
        }
    }));
}

if (registration != null) {
    registration.addEventListener('submit', event => {
        if (register_username.className == "red-border" || register_email.className == "red-border") {
            event.preventDefault();
            return false;
        }
    });
}