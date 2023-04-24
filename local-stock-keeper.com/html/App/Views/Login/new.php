<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="/new.css">
</head>
<body>
<form action="/Login/create" method="POST">
    <h2>Login</h2>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required ><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>
</body>
</html>
