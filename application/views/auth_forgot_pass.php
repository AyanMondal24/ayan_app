<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<style>
    body{
        background:#f7f7f7;
        font-family:Arial, sans-serif;
        display:flex;
        align-items:center;
        justify-content:center;
        height:100vh;
    }
    .box{
        width:400px;
        background:#fff;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
        text-align:center;
    }
    .box h2{
        margin-bottom:10px;
        font-size:22px;
        font-weight:600;
        color:#333;
    }
    .box p{
        color:#666;
        margin-bottom:25px;
        font-size:14px;
    }
    input{
        width:100%;
        padding:12px;
        margin:8px 0;
        border-radius:8px;
        border:1px solid #ddd;
        outline:none;
        font-size:15px;
    }
    input:focus{
        border-color:#c200ff;
    }
    button{
        width:100%;
        padding:12px;
        background:linear-gradient(90deg,#ff3cac,#784ba0,#2b86c5);
        border:none;
        color:white;
        font-size:16px;
        border-radius:8px;
        cursor:pointer;
        transition:0.3s ease;
    }
    button:hover{
        opacity:0.9;
    }
    .back-login{
        display:block;
        margin-top:15px;
        color:#ff0095;
        text-decoration:none;
    }
</style>
</head>
<body> -->
<div class="forgot-pass-container">
    <div class="box">
        <h2>Forgot Password</h2>
        <p>Enter your email to receive password reset link</p>

        <form method="POST" action="" id="forgot_password" novalidate>
            <input type="email" class="form-control mb-4" id="email" placeholder="Enter Email Address" name="email" required>
            <button type="submit">Send Reset Link</button>
        </form>

        <a class="back-login" href="<?= base_url('Auth/login') ?>">← Back to Login</a>

        <div id="response" class="mt-2"></div>
    </div>
</div>
<!-- </body>
</html> -->

<script>
document.addEventListener('DOMContentLoaded',function(){
   $("#forgot_password").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:"<?= base_url('Auth/forgot_password') ?>",
            type:"POST",
            dataType:"JSON",
            data: {
                email:$("#email").val()
            },
            success: function(response){
                if(response.status==='error'){
                    $("#response").addClass("error-msg").removeClass("success-msg").html(response.message).fadeIn(200).delay(2000).fadeOut(200);
                }
            }
        })
   });
});
</script>