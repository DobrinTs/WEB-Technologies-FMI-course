function ajax(url, settings) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (xhr.status == 200) {
      settings.success(xhr.responseText);
    } else {
      console.error(xhr.responseText);
    }
  };
  xhr.open(settings.method || 'GET', url, /* async */ true);
  xhr.setRequestHeader('Content-Type', 'application/json')
  xhr.send(settings.data || null);
}

var form = document.getElementById('registerForm');
form.addEventListener('submit', submitHandler);

function submitHandler(event) {
  event.preventDefault();
  
  var usernameField = form.elements[0];
  var pass1Field = form.elements[1];
  var pass2Field = form.elements[2];

  var formData = {
    username: usernameField.value,
    password: pass1Field.value,
    confirmPassword: pass2Field.value
  }

  var json = JSON.stringify(formData);

  ajax('./81265.php', {
    success: (result) => console.log(result),
    method: 'POST',
    data: json
  })
}
