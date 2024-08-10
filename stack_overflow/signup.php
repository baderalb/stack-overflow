<?php
require_once 'functions/db_conn.php';
require_once 'functions/user_fn.php';
require_once 'functions/browser_fn.php';

$active = "signin";

if (isLoggedIn()) {
    redirect('index.php');
}

if (isset($_POST['password'])) {
    if($_POST['password']==$_POST['confirm_password']&&$_POST['email']!=''){
if (isset($_POST['submit'])) {
    try {
        register($_POST['name'], $_POST['email'], $_POST['password']);
        redirect('index.php');
    } catch (\Exception $th) {
        alertMessage('This email is already taken!');
    }
    
}}
else if($_POST['email']!='')alertMessage('the password and Confirm password are not the same!');else alertMessage('Email Field cannot be empty!');}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
    <?php require_once 'components/styles.php' ?>
    <hr><hr><hr><hr><hr>
    <style>
        .stylish-form {
            padding: 10px;
        }

        .stylish-form h2 {
            color: #f96332;
            margin-top: 50px;

        }

        .font_white {
            color: #fff !important;
        }

        .mar20 {
            margin: 20px;
        }

        .inner-section {
            background-color: #f96332;
            width: 350px;
            display: block;
            margin: 0 auto;
        }

        .inside-form {
            border-radius: 8px;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .inside-form h2 {
            font-weight: 700;
        }

        .inside-form ul {
            list-style-type: none;
            text-align: center;
            margin-top: 30px;
        }

        .inside-form ul>li {
            display: inline-block;
        }

        .inside-form ul>li>i {
            margin-top: 18px;
        }

        .icon-holder {
            background: #fff;
            border-radius: 50%;
            vertical-align: middle;
            height: 50px;
            width: 50px;
            text-align: center;
            margin-right: 20px;
        }

        .dsp-flex {
            display: -webkit-box;
            /* OLD - iOS 6-, Safari 3.1-6 */
            display: -moz-box;
            /* OLD - Firefox 19- (buggy but mostly works) */
            display: -ms-flexbox;
            /* TWEENER - IE 10 */
            display: -webkit-flex;
            /* NEW - Chrome */
            display: flex;
            /* NEW, Spec - Opera 12.1, Firefox 20+ */
            align-items: center;
            -webkit-align-items: center;
            justify-content: center
        }

        .input-group,
        .form-group {
            margin-bottom: 10px;
        }
        body{background-image: url("css/back.png");}
        .input-group-addon {
            border: none;
            color: #FFFFFF;
            border-radius: 25px;
            padding: 10px;
        }

        .input-group .form-control,
        .input-group .form-control:focus,
        .input-group .form-control:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            border-radius: 25px;
            border: none;
            font-size: 14px;
        }

        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #fff !important;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #fff !important;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #fff !important;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            color: #fff !important;
        }

        .footer {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        input::placeholder {
            color: #fff !important;
        }

        .btn-lg {
            font-size: 1em;
            border-radius: 0.25rem;
            padding: 15px 48px;
        }

        .btn-round {
            border-width: 1px;
            border-radius: 30px !important;
            padding: 11px 23px;
        }

        .btn-neutral,
        .btn-neutral:focus,
        .btn-neutral:hover {
            background-color: #FFFFFF;
            color: #f96332;
        }
    </style>
</head>

<body style="background-image: url('css/back5.png')">
    <?php require_once 'components/nav_bar.php' ?>
    
    <section class="background-radial-gradient overflow-hidden">
  <style>
    .background-radial-gradient {
      background-color: 'eee6d3';
      background-image: radial-gradient( #5d1d1333,#eee6d3),
        radial-gradient( #5d1d1333,#eee6d3);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#eee6d3, #00000033);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#00000033, #eee6d3);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>

  <div class="container px-4 py-5 px-md-5 text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 text-center mb-lg-0" style="z-index: 10">
      <h1 class="my-5 display-5 fw-bold ls-tight" style="color: #505050; font-weight:bolder">
         <br />
          <span style="color: #505050">Enabling the development of technology worldwide through shared knowledge.
</span>
        </h1>
        <p class="mb-4 opacity-80" style="color:#505050; font-size:20px">
        Ask, share, and learn at work or at home with our products and tools. 
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form method="POST" action="signup.php">

              <!-- Name input -->
              <div data-mdb-input-init class="form-outline mb-4"><label class="form-label" for="form3Example4">Name</label>
                <input type="name" id="form3Example3" class="form-control" name="name" placeholder="Name"/>
                
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4"><label class="form-label" for="form3Example4">Email address</label>
                <input type="email" id="form3Example3" class="form-control" name="email" placeholder="Email address"/>
                
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Password</label>
                <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Password" />
                
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Confirm Password</label>
                <input type="password" id="form3Example4" class="form-control" name="confirm_password" placeholder="Confirm Password" />
                
              </div>


              <!-- Submit button -->
              <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Sign Up
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                

                <p class="mb-0">Already have an account? <a href="signin.php" class="text-white-50 fw-bold">Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><?php require_once "components/footer.php" ?>
</body>

</html>