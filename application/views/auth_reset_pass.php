<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .box {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .box h2 {
            margin-bottom: 10px;
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 15px;
        }

        input:focus {
            border-color: #c200ff;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff3cac, #784ba0, #2b86c5);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body> -->
    <div class="reset-pass-container">
        <div class="box">
            <h2>Reset Password</h2>

            <form method="POST" action="update_password">
                <input type="password" placeholder="New Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="cpassword" required>
                <button type="submit">Update Password</button>
            </form>
        </div>
    </div>
<!-- </body>

</html> -->