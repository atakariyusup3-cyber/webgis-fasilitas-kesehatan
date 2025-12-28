<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah {{ $judul }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #3fa4b6 0%, #4fc3f7 50%, #21c2b5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px;
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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .container {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            padding: 25px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
        }

        h2 {
            text-align: center;
            color: #0277bd;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #0277bd;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 13px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 12px;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        input[type="text"]::placeholder {
            color: #a0a0a0;
        }

        button[type="submit"] {
            width: 100%;
            padding: 11px;
            background: #0277bd;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(2, 119, 189, 0.3);
            margin-top: 5px;
        }

        button[type="submit"]:hover {
            background: #01579b;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 119, 189, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            .cloud {
                display: none;
            }

            h2 {
                font-size: 20px;
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

    <div class="container">
        <h2>Tambah {{ $judul }}</h2>

        <form method="POST" action="/{{ $route }}">
            @csrf

            <label>Nama</label><br>
            <input type="text" name="nama" required><br><br>

            <label>Alamat</label><br>
            <input type="text" name="alamat" required><br><br>

            <label>Latitude</label><br>
            <input type="text" name="latitude" required><br><br>

            <label>Longitude</label><br>
            <input type="text" name="longitude" required><br><br>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>