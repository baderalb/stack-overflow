<!-- This is home page should get 10 recent questions and 10 questions with most answers as cards -->
<?php
session_start();
require_once 'functions/browser_fn.php';
require_once 'functions/db_conn.php';
require_once 'functions/question_fn.php';
$active = 'home';
if (isset($_GET['question_id'])) {
    $_SESSION['question_id'] = $_GET['question_id'];
    redirect('question.php');
}
if (isset($_POST['delete'])) {
    deleteQuestion($_POST['question_id']);
}

 $answerd_questions = getTop10AnsweredQuestions();
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
    body {
    overflow-x: hidden; /* Hide horizontal overflow on the body */
}
::-webkit-scrollbar{
        height: 10px;
        width: 4px;
        background: white;
    }
    ::-webkit-scrollbar-thumb:horizontal{
        background: #eee6d3;
        border-radius: 10px;
        border: 0.5px solid  rgba(0, 0, 0, 0.2);;
    }
.containerCards {
    display: grid;
    grid-template-columns: repeat(5, 500px); /* 5 columns, each 500px wide */
    grid-template-rows: repeat(2, 200px); /* 2 rows, each 200px high */
    gap: 20px;
    overflow-x: auto; /* Enable horizontal scrolling for this container only */
    overflow-y: hidden; /* Disable vertical scrolling */
    max-width: 2600px; /* Maximum width, remove fixed width */
    margin-left: 30px;
    margin-right: 30px; /* Adjusted right margin for symmetry */
    padding-bottom: 50px;
    margin-top: 80px;
}

.elementCard {
    width: 500px; /* Maintain card width */
    height: 200px; /* Maintain card height */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
}

.elementCard:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}



/* Additional existing styles */



    .elementCard{
        width:500px;

        height: 200px;

    }
    .elementCard {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-left: 5px solid black;

}

.elementCard:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.containerQustionContent{
        display: flex;
        justify-content: space-between;

    }


    .containerHeader{
 display: flex;
 justify-content: center;
 width: 2000px;
 gap: 250px;
 border-style: double;
 border-width:0px 0px 4px 0px;
 padding-bottom: 10px;
}



   /*This is only foor footer to display it!! */
   html {
    position: relative;
    min-height: 100%; /* make sure the html element is at least as tall as the viewport */
}

body {
    margin: 0; /* Remove default margin */
    padding-bottom: 120px; /* Give body a padding-bottom equal to the footer's total height to prevent overlap */
}

.footer {
    position: absolute; /* Position the footer at the bottom of the page */
    bottom: 0; /* Align it to the bottom */
    width: 100%; /* Ensure it spans across the whole width */
    height: 120px; /* Adjust the height as necessary */
    background-color: #eee6d3; /* Your existing background color */
}

.container-fluid {
    width: 100%; /* Full width */
    padding-right: 0;
    padding-left: 0;
}
.container-type {
    background-color: #f8f9fa; /* Light gray background color */
    border-radius: 10px; /* Rounded corners */
    padding: 20px; /* Add some padding */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    margin-top: 20px;
    margin-bottom: 40px;
    border-radius: 10px;
    opacity: 0; /* Start with 0 opacity */
    animation: fadeIn 0.5s forwards; /* Apply fadeIn animation */
}

.container-type h2 {
    margin-left: 20px; /* Add some left margin */
    font-size: 24px; /* Larger font size for headers */
    color: #333; /* Dark text color */
    border-left: 5px solid  #eee6d3; /* Blue left border for emphasis */
    padding-left: 10px; /* Add padding to the left of the header */
}

@keyframes fadeIn {
    from {
        opacity: 0; /* Start with 0 opacity */
    }
    to {
        opacity: 1; /* End with full opacity */
    }
}
.card-link {
    background-color: #17a2b8; /* Blue color for the button */
    color: white; /* White text color */
    border-color: #17a2b8; /* Matching border color */
}

.card-link:hover {
    background-color: #138496; /* Darker blue on hover */
    border-color: #138496; /* Matching border color on hover */
}
.btn-ask-question {
    background-color: #007bff; /* Blue color for the button */
    color: white; /* White text color */
    border-color: #007bff; /* Matching border color */
}

.btn-ask-question:hover {
    background-color: #0056b3; 
    border-color: #0056b3; 
}

    </style>
</head>

<body>
    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr><hr>
        
    
        <div class="containerHeader border-buttom" >
         <div>
            <h1> Top Questions</h1>
         </div>
         <div>
            <a href="create_question.php" class="btn btn-outline-primary btn-ask-question " style="font-size:25px">Ask Question</a>
         </div>
        </div>
    
      
       <?php
                    
        ?>
        
        <?php 
     
        ?>
        


         <div class="container-type" style="margin-bottom: 100px;">
        <?php echo('<div class="substitle"><h2 style="margin-left:80px; margin-top:15px;"> Recent Questions</h2></div>');?>
        <div class="containerCards ">

        <?php
        $questions = getLast10Questions();
        foreach ($questions as $question) {
            $s1= '<form method="post" action="#">
                <div class="card elementCard border-left-0 ">
                    <div class="card-body">
                    <div class="containerQustionContent">
                    <h5> '.substr($question['title'], 0, 33) . (strlen($question['title']) > 33 ? '...' : '').' </h5> <a class="card-link btn" style="font-size: 18px; text-decoration:none;" href="index.php?question_id=' . $question['id'] . '"> View More</a>
                      </div> 
                       <hr>
                    <div class="card-subtitle text-muted  containerQustionContent">
                        <div>
                            <h6 class="mt-1" style="display: inline;"> ' . substr(htmlspecialchars_decode($question['description']) , 0,40) . (strlen($question['description']) > 40 ? '...' : '')   . '</h6>
                            <br>';
                            if (isLoggedIn()) {
                                if (currentUserId()==$question['user_id']){
                             $s1 .= ' <div style="margin-bottom:20px"><a  href="question_editor.php?question_id=' . $question['id'] . '" class="btn btn-primary rounded border-bottom">Edit</a>
                            <input type="hidden" name="question_id" value="' . $question['id'] . '"/>
                            <button name="delete" class="btn btn-danger rounded border-bottom" onclick="confirmSelection(event)">Delete</button></div>';}}
                       $s1 .=' </div>
                       <div class="border-left" style="padding-left: 4px">
                       <h6 class="mt-1">answers: ' . $question['answers_count'] . ' <i class="bi bi-chat-dots-fill"></i> </h6>
                       <h6 class="mt-4" style=display:inline; >Asked By: <span class="text-primary">' . substr(strtoupper( $question['username'] ),0,13). ' </span></h6>
                    <p class="text-muted">'     . substr($question["created_at"], 0, -9) . '</p>
                    </div>
                        </div>
                    </div>
                </div></form>';
                echo $s1;
        }
        ?>

       </div><br>
       <br>
</div>
  <div class="container-type" style="margin-bottom:200px;">
       <?php echo('<h2 style="margin-left:80px ;margin-top:15px;" > Most Answered Questions</h2>');?>
        <div class="containerCards " style="margin-bottom: '100px'">

        <?php $questions = getTop10AnsweredQuestions();
        
        foreach ($questions as $question) {
            $s1= '<form method="post" action="#">
                <div class="card elementCard border-left-0  "style="border-left:30px">
                    <div class="card-body">

                    <div class="containerQustionContent">
                    <h5> '.substr($question['title'], 0, 33) . (strlen($question['title']) > 33 ? '...' : '').'</h5> <a class="card-link btn " style="font-size: 18px; text-decoration:none;" href="index.php?question_id=' . $question['id'] . '"> View More</a>
                      </div>                     <hr>
                    <div class="card-subtitle text-muted  containerQustionContent">
                        <div>
                            <h6 class="mt-1" style="display: inline;">  ' . substr(htmlspecialchars_decode($question['description']) , 0,40) . (strlen($question['description']) > 40 ? '...' : '')   .  ' <i class="bi bi-chat-dots-fill"></i> </h6>
                            ';
                            if (isLoggedIn()) {
                                if (currentUserId()==$question['user_id']){
                             $s1 .= ' <br><div style="margin-bottom:20px"><a href="question_editor.php?question_id=' . $question['id'] . '" class="btn btn-primary rounded border-bottom">Edit</a>
                            <input type="hidden" name="question_id" value="' . $question['id'] . '"/>
                            <button name="delete" class="btn btn-danger rounded border-bottom" onclick="confirmSelection(event)">Delete</button></div>';}}
                            $s1 .='</div>
                        <div class="border-left" style="padding-left: 4px">
                            <h6 class="mt-1">answers: ' . $question['answers_count'] . ' <i class="bi bi-chat-dots-fill"></i> </h6>
                            <h6 class="mt-4" style=display:inline; >Asked By: <span class="text-primary">' . substr(strtoupper( $question['username'] ),0,13). ' </span></h6>
                         <p class="text-muted">'     . substr($question["created_at"], 0, -9) . '</p>
                         </div>
                        </div>
                    </div>
                </div></form>';echo $s1;
        }
        ?>

       </div>

       <br>
       <br>
    </div>
      
       <?php require_once "components/footer.php" ?>
<script>
        // Function to confirm selection and restore previous value if canceled
        function confirmSelection(event) {
    // Confirmation message
    const message = "Are you sure you want to delete your Answer?";

    // Confirm the choice
    if (!confirm(message)) {
        // Prevent the default form submission if the user cancels
        event.preventDefault();
    }
}
    </script>
</body>

</html>