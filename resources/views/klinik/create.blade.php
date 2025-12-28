<!DOCTYPE html>
<html>
<head>
    <title>Tambah Klinik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #27a9ae 0%, #35a5b1 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 35px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        label .required {
            color: #ff6b6b;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            font-size: 15px;
            color: #333;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        input::placeholder,
        textarea::placeholder {
            color: #aaa;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button[type="submit"] {
            flex: 1;
            background: #3498db;
            color: white;
            border: none;
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        button[type="submit"]:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .back-link {
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #b77f57;
            color: white;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .back-link:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px 20px;
            }

            h2 {
                font-size: 24px;
                margin-bottom: 30px;
            }

            label {
                font-size: 16px;
            }

            input[type="text"],
            input[type="number"],
            textarea {
                padding: 15px;
                font-size: 14px;
            }

            .button-group {
                flex-direction: column;
            }

            button[type="submit"],
            .back-link {
                width: 100%;
                padding: 15px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Klinik</h2>

    <form method="POST" action="{{ url('/klinik') }}">
        @csrf

        <div class="form-group">
            <label>Nama Klinik <span class="required">*</span></label>
            <input type="text" name="nama" placeholder="Nama Klinik" required>
        </div>

        <div class="form-group">
            <label>Alamat <span class="required">*</span></label>
            <textarea name="alamat" placeholder="Alamat" required></textarea>
        </div>

        <div class="form-group">
            <label>Latitude <span class="required">*</span></label>
            <input type="text" name="latitude" placeholder="Latitude" required>
        </div>

        <div class="form-group">
            <label>Longitude <span class="required">*</span></label>
            <input type="text" name="longitude" placeholder="Longitude" required>
        </div>

        <div class="button-group">
            <button type="submit">Simpan</button>
            <a href="/klinik" class="back-link">⬅ Kembali</a>
        </div>
    </form>
</div>

</body>
</html>