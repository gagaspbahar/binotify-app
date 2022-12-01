const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

const validateUsername = (username) => {
  return String(username)
    .toLowerCase()
    .match(/^[a-zA-Z0-9_]*$/);
}

const checkUsername = () => {
  let username = document.getElementById("username").value
  
  if (username.length < 3) {
    document.getElementById("username").style.borderColor = "red";
    document.getElementById('username-error').innerHTML = "Username needs to be at least 3 characters long";
  }
  else if (!validateUsername(username)) {
    document.getElementById("username").style.borderColor = "red";
    document.getElementById('username-error').innerHTML = "Username can only contain alphanumeric characters and underscore";
  }
  else {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/auth/register.php', true);
    xhr.onload = function() {
      if (this.status == 200) {
        let response = JSON.parse(this.responseText);
        if (response.status == "success") {
          document.getElementById("username").style.borderColor = "green";
          document.getElementById('username-error').innerHTML = "";
        }
        else{
          document.getElementById("username").style.borderColor = "red";
          document.getElementById('username-error').innerHTML = response.message;
        }
      }
      checkAll();
    }

    xhr.send(JSON.stringify({username: username}));
  }
  checkAll();
}

const checkEmail = () => {
  let email = document.getElementById("email").value
  if (email.length < 3) {
    document.getElementById("email").style.borderColor = "red";
  }
  else if (!validateEmail(email)) {
    document.getElementById("email").style.borderColor = "red";
    document.getElementById('email-error').innerHTML = "Invalid email";
  }
  else {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/auth/register.php', true);
    xhr.onload = function() {
      if (this.status == 200) {
        let response = JSON.parse(this.responseText);
        if (response.status == "success") {
          document.getElementById("email").style.borderColor = "green";
          document.getElementById('email-error').innerHTML = "";
        }
        else{
          document.getElementById("email").style.borderColor = "red";
          document.getElementById('email-error').innerHTML = response.message;
        }
      }
      checkAll();
    }

    xhr.send(JSON.stringify({email: email}));
  }
  checkAll();
}

const checkPassword = () => {
  let password = document.getElementById("password").value
  if (password.length < 8) {
    document.getElementById("password").style.borderColor = "red";
    document.getElementById('password-error').innerHTML = "Password needs to be at least 8 characters long";
  }
  else {
    document.getElementById("password").style.borderColor = "green";
    document.getElementById('password-error').innerHTML = "";
    let confirmPassword = document.getElementById("confirm-password").value
    if (password != confirmPassword) {
      document.getElementById("confirm-password").style.borderColor = "red";
      document.getElementById('confirm-password-error').innerHTML = "Password mismatch";
    }
    else{
      document.getElementById("confirm-password").style.borderColor = "green";
      document.getElementById('confirm-password-error').innerHTML = "";
    }
  }
  checkAll();
}

const checkAll = () => {
  if (document.getElementById("username").style.borderColor == "green" && document.getElementById("email").style.borderColor == "green" && document.getElementById("password").style.borderColor == "green" && document.getElementById("confirm-password").style.borderColor == "green") {
    document.getElementById('register-button').disabled = false
  }
  else {
    document.getElementById('register-button').disabled = true
  }
}