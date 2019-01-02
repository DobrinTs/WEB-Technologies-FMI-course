var form = document.getElementById('registerForm');
form.addEventListener('submit', validate);

function validate(event) {
  var usernameField = form.elements[0];
  var pass1Field = form.elements[1];
  var pass2Field = form.elements[2];

  var usernameLabel = document.getElementById('username');
  var pass1Label = document.getElementById('pass1');
  var pass2Label = document.getElementById('pass2');

  var nameRegex = /^\w{3,10}$/;
  if (usernameField.value.match(nameRegex) === null) {
    usernameLabel.textContent = 'Username must containt only letters, numbers and _ and \
      be between 3 and 10 symbols long';
    usernameLabel.setAttribute('class', 'errorMessage');
    event.preventDefault();
  } else {
    usernameLabel.textContent = '';
    usernameLabel.setAttribute('class', 'hide');
  }

  if (pass1Field.value.match(/.{6,}/) && pass1Field.value.match(/[A-Z]+/) &&
    pass1Field.value.match(/[a-z]+/) && pass1Field.value.match(/\d+/)) {
    pass1Label.textContent = '';
    pass1Label.setAttribute('class', 'hide');
  } else {
    pass1Label.textContent = 'Password must contain a small letter, a capital letter \
    a digit and be atleast 6 symbols long';
    pass1Label.setAttribute('class', 'errorMessage');
    event.preventDefault();
  }

  if (pass2Field.value != pass1Field.value) {
    pass2Label.textContent = 'Passwords must match';
    pass2Label.setAttribute('class', 'errorMessage');
    event.preventDefault();
  } else {
    pass2Label.textContent = '';
    pass2Label.setAttribute('class', 'hide');
  }
}
