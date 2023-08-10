document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const loginButton = document.getElementById('login-button');
    const createForm = document.getElementById('create-form');
    const createButton = document.getElementById('create-button');
    const logoutButton = document.getElementById('logout-button');

    let token = null;

    loginButton.addEventListener('click', async function () {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const response = await fetch('http://localhost:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });

        if (response.ok) {
            const data = await response.json();
            token = data.newToken;

            // Navigate to dashboard page
            window.location.href = 'dashboard.html';
        } else {
            alert('Login failed');
        }
    });

    createButton.addEventListener('click', async function () {
        const name = document.getElementById('name').value;
        const createEmail = document.getElementById('create-email').value;
        // Other input fields

        const response = await fetch('http://localhost:8000/api/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                name: name,
                email: createEmail
                // Other fields
            })
        });

        if (response.ok) {
            alert('User created successfully');
        } else {
            alert('Failed to create user');
        }
    });

    logoutButton.addEventListener('click', function () {
        // Clear token and navigate back to login page
        token = null;
        window.location.href = 'index.html';
    });
});
