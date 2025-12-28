<!DOCTYPE html>
<html>
<head>
    <title>Tambah Puskesmas</title>
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

        /* Notifikasi Success */
        .notification-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .notification-overlay.show {
            display: flex;
        }

        .notification-box {
            background: linear-gradient(135deg, #87CEEB 0%, #5DADE2 100%);
            border-radius: 25px;
            padding: 50px 60px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
            text-align: center;
            animation: slideDown 0.5s ease;
            position: relative;
            border: 3px solid rgba(255, 255, 255, 0.5);
        }

        .moon-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #B8E0F6 0%, #87CEEB 100%);
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            box-shadow: 
                0 0 30px rgba(135, 206, 235, 0.6),
                inset 0 -10px 30px rgba(0, 0, 0, 0.1);
            animation: moonGlow 2s ease-in-out infinite;
        }

        .moon-icon::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            top: 15px;
            right: 20px;
            box-shadow: 
                10px 10px 0 rgba(255, 255, 255, 0.2),
                -5px 15px 0 rgba(255, 255, 255, 0.15);
        }

        .checkmark {
            font-size: 60px;
            color: white;
            font-weight: bold;
            z-index: 1;
            animation: checkPop 0.6s ease 0.3s both;
        }

        .notification-text {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .notification-subtext {
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            font-weight: 500;
        }

        .close-notification {
            margin-top: 25px;
            background: white;
            color: #5DADE2;
            border: none;
            padding: 12px 35px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .close-notification:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: #f0f8ff;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes moonGlow {
            0%, 100% {
                box-shadow: 
                    0 0 30px rgba(135, 206, 235, 0.6),
                    inset 0 -10px 30px rgba(0, 0, 0, 0.1);
            }
            50% {
                box-shadow: 
                    0 0 50px rgba(135, 206, 235, 0.9),
                    inset 0 -10px 30px rgba(0, 0, 0, 0.1);
            }
        }

        @keyframes checkPop {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
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

            .notification-box {
                padding: 40px 30px;
                margin: 20px;
            }

            .moon-icon {
                width: 100px;
                height: 100px;
            }

            .checkmark {
                font-size: 50px;
            }

            .notification-text {
                font-size: 20px;
            }

            .notification-subtext {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Puskesmas</h2>

    <form method="POST" action="{{ url('/puskesmas') }}" id="puskesmasForm">
        @csrf

        <div class="form-group">
            <label>Nama <span class="required">*</span></label>
            <input type="text" name="nama" placeholder="Nama" required>
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
            <a href="/puskesmas" class="back-link">⬅ Kembali</a>
        </div>
    </form>
</div>

<!-- Notifikasi Success -->
<div class="notification-overlay" id="notificationOverlay">
    <div class="notification-box">
        <div class="moon-icon">
            <div class="checkmark">✓</div>
        </div>
        <div class="notification-text">Data Berhasil Disimpan!</div>
        <div class="notification-subtext">Puskesmas telah ditambahkan ke sistem</div>
        <button class="close-notification" onclick="closeNotification()">OK</button>
    </div>
</div>

<script>
    // Handle form submit
    document.getElementById('puskesmasForm').addEventListener('submit', function(e) {
        // Untuk demo, kita tampilkan notifikasi
        // Dalam implementasi real, ini akan dipanggil setelah AJAX success atau redirect dengan session
        
        // Uncomment baris berikut untuk demo (comment jika sudah integrate dengan backend)
        // e.preventDefault();
        // showNotification();
    });

    function showNotification() {
        document.getElementById('notificationOverlay').classList.add('show');
        
        // Auto close setelah 3 detik
        setTimeout(function() {
            closeNotification();
        }, 3000);
    }

    function closeNotification() {
        document.getElementById('notificationOverlay').classList.remove('show');
        // Optional: redirect ke halaman list setelah close
        // window.location.href = '/puskesmas';
    }

    // Cek jika ada session success dari Laravel
    @if(session('success'))
        window.addEventListener('load', function() {
            showNotification();
        });
    @endif
</script>

</body>
</html>