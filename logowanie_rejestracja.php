<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityPlanner Pro - Logowanie i Rejestracja</title>
    <link rel="stylesheet" href="css/logowanie.css">
    <link rel="shortcut icon" href="./IMG/icon.png">
</head>
<body>
    <div class="container">
        <div class="banner">CityPlanner Pro</div>
        <div class="content">
            <div class="image-container"></div>
            <div class="forms-container">
                <div class="form-container" id="login">
                    <h2>Logowanie</h2>
                    <form action="aplikacja.php" method="POST">
                        <label for="username">Nazwa użytkownika:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="password">Hasło:</label>
                        <input type="password" id="password" name="password" required>
                        <button type="submit" name="loginbtn">Zaloguj się</button>
                    </form>
                    <button id="show-register">Zarejestruj się</button>
                </div>

                <div class="form-container" id="register">
                    <h2>Rejestracja</h2>
                    <form action="aplikacja.php" method="POST">
                        <label for="username">Nazwa użytkownika:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <label for="password">Hasło:</label>
                        <input type="password" id="password" name="password" required>
                        <button type="submit" name="registerbtn">Zarejestruj się</button>
                    </form>
                    <button id="show-login">Zaloguj się</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('show-register').addEventListener('click', function() {
            document.getElementById('login').style.display = 'none';
            document.getElementById('register').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function() {
            document.getElementById('register').style.display = 'none';
            document.getElementById('login').style.display = 'block';
        });
    </script>
</body>
</html>

