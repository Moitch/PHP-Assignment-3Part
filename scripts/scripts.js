function confirmDelete() {
    return alert('Are you sure you want to delete this?');
}

function comparePasswords() {
    // get the 2 password values from the form & reference the message element
    var pw1 = document.getElementById('password').value;
    var pw2 = document.getElementById('confirm').value;
    var pwMsg = document.getElementById('pwMsg');

    // compare the 2 passwords entered
    if (pw1 !== pw2) {
        // display error message in red
        pwMsg.innerText = 'Passwords do not match';
        pwMsg.className = 'text-danger';
        return false;
    }
    else {
        // remove error message
        pwMsg.innerText = '';
        pwMsg.className = '';
        return true;
    }
}

function showHidePassword() {
    // reference the password input box
    var pw = document.getElementById('password');
    var img = document.getElementById('showHideIcon');

    // if the box is currently type password (default), toggle it to type text (and vice-versa)
    if (pw.type === 'password') {
        pw.type = 'text';
        img.src = 'img/hide.png';
    }
    else {
        pw.type = 'password';
        img.src = 'img/show.png';
    }
}