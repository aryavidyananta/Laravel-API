<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Register</h2>

    <form id="registerForm">
        <input type="text" name="name" placeholder="Nama" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>

    <div id="message"></div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const form = e.target;
            const name = form.name.value;
            const email = form.email.value;
            const password = form.password.value;

            const response = await fetch("http://localhost:8000/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: JSON.stringify({
                    name,
                    email,
                    password
                })
            });

            const data = await response.json();

            if (response.ok) {
                document.getElementById("message").innerText = `Registrasi berhasil! Token:\n${data.token}`;
            } else {
                let errorMsg = "Gagal Register.\n";
                if (data.errors) {
                    for (let field in data.errors) {
                        errorMsg += `${data.errors[field].join(', ')}\n`;
                    }
                } else {
                    errorMsg += data.message || "Terjadi kesalahan.";
                }
                document.getElementById("message").innerText = errorMsg;
            }
        });
    </script>
</body>
</html>
