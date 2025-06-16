<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Register</h2>
    <form id="registerForm">
        <input type="text" name="name" placeholder="Nama" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <hr>

    <h2>Login</h2>
    <form id="loginForm">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <div id="message"></div>

    <script>
        const baseUrl = "http://localhost:8000";

        // Handle Register
        document.getElementById("registerForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const form = e.target;
            const name = form.name.value;
            const email = form.email.value;
            const password = form.password.value;

            const res = await fetch(`${baseUrl}/api/register`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ name, email, password })
            });

            const data = await res.json();
            document.getElementById("message").innerText = res.ok
                ? "Register berhasil! Silakan login."
                : (data.message || "Gagal register.");
        });

        // Handle Login
        document.getElementById("loginForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const form = e.target;
            const email = form.email.value;
            const password = form.password.value;

            const res = await fetch(`${baseUrl}/api/login`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ email, password })
            });

            const data = await res.json();

            if (res.ok) {
                localStorage.setItem("auth_token", data.token);
                window.location.href = "/books";
            } else {
                document.getElementById("message").innerText = data.message || "Login gagal.";
            }
        });
    </script>
</body>
</html>
