<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/loginScreen.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open Sans:wght@400;600&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Telex:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tenor Sans:wght@400&display=swap" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="login-screen">
    <div class="bg">
      <div class="blue-rect"></div>
      <div class="white-rect"></div>
    </div>
    <div class="content">
      <form action="login_code.php" method='post'>
        <div class="texts">
          <div class="welcome-back">Welcome Back</div>
          <div class="ls-enter-your-log-container">
            <p class="ls-enter-your-log">Enter your log in credentials to access your account</p>
          </div>
        </div>
        <div class="email">
          <div class="password1">Email</div>
          <div class="password-child"></div>
          <img class="lock-icon" alt="" src="./public/mail@2x.png" />
          <div class="inputField"><input type="email" name="email" placeholder="username123@emailcom" required></div>
        </div>
        <div class="password">
          <div class="password-child"></div>
          <img class="lock-icon" alt="" src="./public/lock@2x.png" />

          <img class="closed-eye-icon" alt="" src="./public/closed-eye@2x.png" />

          <div class="inputField"><input type="password" name="password" placeholder="********" required></div>
          <div class="password1">Password</div>
          <div class="forgotten-password-reset-container">
            <span class="forgotten-password">Forgotten Password? <a href="" class="reset">Reset</a></span>
          </div>
        </div>
        <div class="sign-in">
          <input type="submit" value='Login' class="sign-in">
        </div>
      </form>
    </div>
    <div class="new-to-brr-container">
      <span>New to BRR Trading? <a href="./user/register.php" class="register-here">Register</a></span>
    </div>
    <div class="lsLogo">
      <div class="lsLogo1">
        <div class="slogan">
          <p id="lsP">Wear better, Look smarter &nbsp;</p>
        </div>
        <img class="lsLogo-icon" alt="" src="./public/logo@2x.png" />
      </div>
    </div>
  </div>
</body>
</html>