<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form button:hover {
            background: #0056b3;
        }
        .login-form .forgot-password {
            display: block;
            text-align: right;
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 0.9em;
        }
        .login-form .forgot-password a {
            color: #007BFF;
            text-decoration: none;
        }
        .login-form .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="logindb.php" method="post" class="login-form">
        <h2>Login</h2>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
