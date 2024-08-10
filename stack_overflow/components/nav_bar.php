<link href="path_to_your_stylesheet.css?v=1.1" rel="stylesheet" type="text/css">
<?php require_once 'functions/browser_fn.php';
;
require_once 'functions/user_fn.php';
; ?>

<style>
    .search-input:hover {
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
        background-color: #D3D3D3;
    }
    .search-button:hover {
        background-color: #D3D3D3;
    }
    .sign-button:hover {
        background-color: white;
        color: #343a40;
    }
    .logout-button {
        border: none;
        transition: background-color 0.3s;
    }
    .logout-button:hover {
        background-color: #dc3545;
    }


.search-input {
    width: 300px !important; /* Increased width with !important */
    transition: background-color 0.3s, width 0.3s;
    height: 40px; /* Ensured the height is uniform */
}

.search-button {
    padding: 0 12px;
    height: 40px; /* Align height with input */
}

/* Ensure other styles are not interfering */
/* Other styles remain the same */

.user{
 margin-right: 20px;
 padding: 10px 10px;
 border-radius: 50px;
}

</style>


<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="position: fixed; width: 100%; z-index: 1; background-color: #eee6d3; color: black;">
    <a class="navbar-brand" href="index.php"><img src="css/logo.png" alt="logo" width="140px"></a>
    <div class="collapse navbar-collapse justify-content-between" style="display: flex;" id="navbarNav">
        <?php echo'<ul class="navbar-nav">';
        $all = $active === 'all' ? 'active' : '';
         $home = $active === 'home' ? 'active' : ''; 
         echo'<li class="nav-item ' . $home . '">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>';
        if (isLoggedIn()) {
                         
            $my_questions = $active === 'my_questions' ? 'active' : '';
            $my_answers = $active === 'my_answers' ? 'active' : '';
            echo '
                
                    
                    <li class="nav-item ' . $my_questions . '">
                        <a class="nav-link" href="my_questions.php">My Questions</a>
                    </li>
                    <li class="nav-item ' . $my_answers . '">
                        <a class="nav-link" href="my_answers.php">My Answers</a>
                    </li>
                ';
        }echo '<li class="nav-item ' . $all . '">
                <a class="nav-link" href="all_questions.php">All Questions</a>
            </li>
                </ul>';
        ?>

        <form> <input type="hidden"></form>
        <?php 
       if($active!="signin") {if($active!="my_questions"){if($active!="my_answers"){
        echo '<form class="form-inline d-flex align-items-center" action="search.php">
    <input name="search" class="form-control mx-sm-2 search-input" type="search" placeholder="Search" aria-label="Search" >
    <button class="btn search-button" type="submit">
        <img src="css/image1.png" class="icon_small" style="width: 20px;">
    </button>
    </form>' ; 
    }}}
    if($active==="my_questions" ) {
        echo '<form class="form-inline d-flex align-items-center" action="searchmq.php">
    <input name="search" class="form-control mx-sm-2 search-input" type="search" placeholder="Search" aria-label="Search" >
    <button class="btn search-button" type="submit">
        <img src="css/image1.png" class="icon_small" style="width: 20px;">
    </button>
    </form>' ; 
    }if($active==="my_answers") {
        echo '<form class="form-inline d-flex align-items-center" action="searchma.php">
    <input name="search" class="form-control mx-sm-2 search-input" type="search" placeholder="Search" aria-label="Search" >
    <button class="btn search-button" type="submit">
        <img src="css/image1.png" class="icon_small" style="width: 20px;">
    </button>
    </form>' ; 
    }

    ?>
        <?php
        if (!isLoggedIn()) {
            echo '
                <div class="d-flex align-items-center">
                    <a href="signin.php" class="btn btn-secondary mx-1 sign-button">Sign In</a>
                    <a href="signup.php" class="btn btn-secondary mx-1 sign-button">Sign Up</a>
                </div>
            ';
        } else {
            echo '
            
            <form action="signout.php" method="post" class="form-inline">
           <span class=" border-top border-bottom user border border-secondary " >' . currentUserName(currentUserId()).'</span> 
                <button name="logout" type="submit" class="btn btn-danger logout-button">Logout</button>
            </form>
            ';
        }
        ?>
    </div>
</nav>