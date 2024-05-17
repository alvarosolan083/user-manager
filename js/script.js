document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('index.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          console.log(data);
          location.reload();
      });
});

document.getElementById('importButton').addEventListener('click', function() {
    const formData = new FormData();
    formData.append('action', 'import');

    fetch('index.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          console.log(data);
          location.reload();
      });
});

function deleteUser(id) {
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('id', id);

    fetch('index.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(data => {
          console.log(data);
          location.reload();
      });
}

function editUser(user) {
    document.getElementById('action').value = 'update';
    document.getElementById('id').value = user.id;
    document.getElementById('first_name').value = user.first_name;
    document.getElementById('last_name').value = user.last_name;
    document.getElementById('age').value = user.age;
    document.getElementById('gender').value = user.gender;
    document.getElementById('email').value = user.email;
    document.getElementById('country').value = user.country;
    document.getElementById('city').value = user.city;
    document.getElementById('picture_large').value = user.picture_large;
    document.getElementById('submitButton').textContent = 'Actualizar';
}
