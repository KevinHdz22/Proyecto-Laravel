<!-- resources/views/create-user.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Usuario</title>
        <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
    </head>
    <body>
        <h1>Crear Usuario</h1>

        <form id="create-user-form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"><br>

            <button type="submit" id="actualizar-btn">Crear</button>
        </form>

        <script>
        document.getElementById("create-user-form").addEventListener("submit", function(event) {
            event.preventDefault();

            const nombre = document.getElementById("nombre").value;
            const apellido = document.getElementById("apellido").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if (nombre.trim() === "" || apellido.trim() === "" || email.trim() === "" || password.trim() === "") {
                alert("Por favor completa todos los campos.");
                return;
            }

            const authToken = localStorage.getItem("authToken");

            fetch("{{url('/create') }}",{
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Authorization": "Bearer " + authToken
                },
                body: JSON.stringify({
                    nombre: nombre,
                    apellido: apellido,
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.user.nombre + " fue creado exitosamente.");
                window.location.href = "{{ url('/user-list') }}";
            })
            .catch(error => {
                alert("Error al crear el usuario: " + error.message);
            });
        });
        </script>
    </body>
</html>
