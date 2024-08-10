<?php
require_once 'functions/db_conn.php';
require_once 'functions/user_fn.php';
require_once 'functions/browser_fn.php';

$active = "signin";

if (isLoggedIn()) {
    redirect('index.php');
}

if (isset($_POST['submit'])) {
  if($_POST['email']!=""){

    login($_POST['email'], $_POST['password']);
    //if (isLoggedIn()) {
     //   redirect('index.php');
    //}
    //redirect('index.php');
}}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
    <?php require_once 'components/styles.php' ?>
    <style>
      
        .gradient-custom {
/* fallback for old browsers */
background: #6a11cb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}


    </style>
</head>

<body>

    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr>
   <!-- <div class="container-fluid stylish-form">
        <div class="row mar20">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="inner-section">
                    <form method="POST" action="#">
                        <div class="mar20 inside-form">
                            <h2 class="font_white text-center">SIGN IN</h2>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope "></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" name="submit" class="btn btn-neutral btn-round btn-lg">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
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

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
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
            <form method="POST" action="signin.php">
              

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control" name="email" placeholder="Email address"/>
                
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" name="password" placeholder="Password" />
                
              </div>


              <!-- Submit button -->
              <button type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Sign in
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                

                <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>
<?php require_once 'components/footer.php';?>