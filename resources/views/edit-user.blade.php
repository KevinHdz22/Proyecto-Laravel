<!-- resources/views/edit-user.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuario</title>
        <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
    </head>
    <body>
        <h1>Editar Usuario</h1>
        
        <form id="edit-user-form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="button" id="actualizar-btn">Actualizar</button>
        </form>
        
        <script>
            const authToken = localStorage.getItem("authToken");
            const userId = {{ $user->id }}; // Recibir el ID del usuario desde el controlador
            const actualizarBtn = document.getElementById("actualizar-btn");
            const nombreInput = document.getElementById("nombre");
            const apellidoInput = document.getElementById("apellido");
            const emailInput = document.getElementById("email");

            actualizarBtn.addEventListener("click", function() {
                const nombre = nombreInput.value;
                const apellido = apellidoInput.value;
                const email = emailInput.value;

                if (nombre === "" || apellido === "" || email === "") {
                    alert("Por favor completa todos los campos.");
                    return;
                }

                const userData = {
                    id: userId,
                    nombre: nombre,
                    apellido: apellido,
                    email: email
                };

                fetch("{{ url('/update') }}", {
                    method: "PUT",
                    headers: {
                        "Authorization": "Bearer " + authToken,
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json" 
                    },
                    body: JSON.stringify(userData) // Convertir el objeto a JSON
                })
                .then(response => response.json())
                .then(data => {
                    alert("Usuario actualizado exitosamente.");
                    window.location.href = "{{ route('user-list') }}";
                })
                .catch(error => {
                    alert("Error al actualizar el usuario: " + error.message);
                });
             });

        </script>
    </body>
</html>
