<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #020617, #0f172a);

            /* dark tech background */
            overflow: hidden;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translate3d(-30px, 0, 0);
                /* ← start from left */
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
                /* center */
            }
        }



        .auth-box {
            background: #fff;
            padding: 40px;
            width: 320px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            animation: fadeSlide 0.6s ease-out;
            will-change: transform, opacity;
            transform: translateZ(0);
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