<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* ?body { */
        /* background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        } */

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f172a;
            /* dark tech background */
            overflow: hidden;
        }

        .tech-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
            background: radial-gradient(circle at top, #020617, #020617 40%, #000);
        }

        .tech-bg span {
            position: absolute;
            width: 2px;
            height: var(--h);
            left: var(--x);
            top: -150px;
            background: linear-gradient(transparent,
                    rgba(56, 189, 248, 0.9),
                    transparent);
            animation: techMove var(--t) linear infinite;
            filter: drop-shadow(0 0 6px #38bdf8);
            opacity: 0.8;
        }

        @keyframes techMove {
            0% {
                transform: translateY(-150px) translateX(0) rotate(0deg);
                opacity: 0;
            }

            20% {
                opacity: 1;
            }

            100% {
                transform: translateY(120vh) translateX(60px) rotate(8deg);
                opacity: 0;
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .card {
            animation: float 6s ease-in-out infinite;
        }

        .auth-box {
            background: #fff;
            padding: 40px;
            width: 320px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .auth-box h2 {
            margin-bottom: 25px;
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-login {
            background: #0d6efd;
            color: #fff;
        }

        .btn-login:hover {
            background: #0b5ed7;
        }

        .btn-signup {
            background: #198754;
            color: #fff;
        }

        .btn-signup:hover {
            background: #157347;
        }
    </style>
</head>

<body>
         <div class="tech-bg">
        <span style="--x:5%; --h:140px; --t:5s"></span>
        <span style="--x:15%; --h:220px; --t:7s"></span>
        <span style="--x:30%; --h:180px; --t:6s"></span>
        <span style="--x:45%; --h:260px; --t:9s"></span>
        <span style="--x:60%; --h:200px; --t:6.5s"></span>
        <span style="--x:75%; --h:300px; --t:10s"></span>
        <span style="--x:85%; --h:160px; --t:5.5s"></span>
    </div>
    <div class="auth-box">
        <h2>Admin Panel</h2>

        <a href="<?= base_url('admin/Auth/login') ?>" class="btn btn-login">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>

        <a href="<?= base_url('admin/Auth/signup') ?>" class="btn btn-signup">
            <i class="fas fa-user-plus"></i> Signup
        </a>
    </div>

</body>

</html>