<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Login</h2>

    <form id="loginForm">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <div id="message"></div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const form = e.target;
            const email = form.email.value;
            const password = form.password.value;

            const response = await fetch("http://localhost:8000/api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            const data = await response.json();

            if (response.ok) {
                document.getElementById("message").innerText = "Login berhasil! Token: " + data.token;
                // Simpan token di localStorage/sessionStorage jika perlu
            } else {
                document.getElementById("message").innerText = data.message || "Login gagal";
            }
        });
    </script>
</body>
</html>
