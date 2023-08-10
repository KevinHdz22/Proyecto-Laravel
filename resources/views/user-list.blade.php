<!-- resources/views/user-list.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Usuarios</title>
        <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
    </head>
    <body>
        <h1>Listado de Usuarios</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button onclick="editarUsuario({{ $user->id }})">Editar</button>
                        <button onclick="eliminarUsuario({{ $user->id }})">Eliminar</button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="button-container">
            <button onclick="crearUsuario()">Crear Usuario</button>
        </div>

        <script>
            const authToken = localStorage.getItem("authToken");
            const id = element.getAttribute("data-id");

            function editarUsuario(id) {
                // Redireccionar a la página de edición
                window.location.href = "{{ route('editar-usuario', ['id' => '_id_']) }}".replace('_id_', id);
            }

            function eliminarUsuario(id) {
                if (confirm('¿Estás seguro de eliminar este usuario?')) {
                    // Realizar la eliminación
                    fetch("{{ url('/delete') }}", {
                        method: "DELETE",
                        headers: {
                            "Authorization": "Bearer " + authToken,
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        window.location.reload();
                    })
                    .catch(error => {
                        alert("Error al eliminar el usuario: " + error.message);
                    });
                }
            }

            function crearUsuario() {
                // Redireccionar a la página de creación
                window.location.href = "{{ route('crear-usuario') }}";
            }
        </script>
    </body>
</html>
