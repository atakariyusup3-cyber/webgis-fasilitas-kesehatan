<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin WebGIS Puskesmas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2ebcba 0%, #4fc3f7 50%, #3596b1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative clouds */
        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 100px;
        }

        .cloud1 {
            width: 200px;
            height: 60px;
            top: 10%;
            left: 10%;
            animation: float 20s infinite ease-in-out;
        }

        .cloud2 {
            width: 250px;
            height: 80px;
            top: 60%;
            left: -50px;
            animation: float 25s infinite ease-in-out 5s;
        }

        .cloud3 {
            width: 180px;
            height: 55px;
            top: 20%;
            right: 5%;
            animation: float 22s infinite ease-in-out 3s;
        }

        .cloud4 {
            width: 220px;
            height: 70px;
            bottom: 15%;
            right: 10%;
            animation: float 28s infinite ease-in-out 7s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 400px;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .user-icon {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .user-icon svg {
            width: 40px;
            height: 40px;
            fill: #0277bd;
        }

        h2 {
            color: #0277bd;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border-left: 4px solid #c62828;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 15px 20px;
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        input::placeholder {
            color: #a0a0a0;
        }

        .forgot-password {
            text-align: center;
            margin: 5px 0 15px;
        }

        .forgot-password a {
            color: #0277bd;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #01579b;
            text-decoration: underline;
        }

        button[type="submit"] {
            padding: 15px;
            background: #0277bd;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(2, 119, 189, 0.3);
            text-transform: capitalize;
            letter-spacing: 0.5px;
        }

        button[type="submit"]:hover {
            background: #01579b;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 119, 189, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 40px 30px;
            }

            .cloud {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative clouds -->
    <div class="cloud cloud1"></div>
    <div class="cloud cloud2"></div>
    <div class="cloud cloud3"></div>
    <div class="cloud cloud4"></div>

    <div class="login-container">
        <div class="user-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
        <h2>User Login</h2>

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <input type="email" name="email" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <div class="forgot-password">
                <a href="/forgot-password"></a>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>