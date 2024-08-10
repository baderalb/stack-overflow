<!-- Search all questions -->
<?php
require_once 'functions/db_conn.php';
require_once 'functions/question_fn.php';
require_once 'functions/browser_fn.php';

$active = 'my_questions';

if (!isset($_GET['search'])) {
    redirect('index.php');
}if (isset($_POST['delete'])) {
    deleteQuestion($_POST['question_id']);
}

$questions = searchmQuestions($_GET['search']);
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
 
        
        .answers-grid {
            top: 50px;
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Creates two columns */
            grid-gap: 20px; /* Space between grid items */
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }


      .container{
        width: 2500px;
        display: grid;
       
        gap: 10px;
        margin-left: 70px;

       }


       .containerAnswerontent{
        display: flex;
        justify-content: space-between;

    }
    .containerHeader{

 border-style: double;
 border-width:0px 0px 4px 0px;
 padding-bottom: 10px;
 margin-bottom: 25px;
}
      
        
        .pagination {
            justify-content: center;
        }
        .pagination .page-link {
            color: #007bff;
            border: 1px solid #007bff;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
        .pagination .page-link:hover {
            background-color: #e9ecef;
        }
        .containerQustionContent{
        display: flex;
        justify-content: space-around;
        margin-bottom: 35px;

    }
    </style>
</head>

<body >
    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr>

    <div class="container mt-4">
    <div class="containerQustionContent"> <h1>Results:</h1>
        <a href="my_questions.php"  class="btn btn-outline-primary rounded border border-secondary" style="font-size:25px" >Reset</a>
     </div>
        <?php
        if(!isset($questions)){echo'<h2>no such answers</h2>';}
        else{
        foreach ($questions as $question) {
            echo '
            
                <form method="post" action="#" class="answer-form">
                    <div class="card mb-4 answerElemnt">
                        <div class="card-body">
                        <a class="card-link" href="index.php?question_id=' . $question['id'] . '">' . $question['title'] . '</a>
                            <hr>
                            <div class="card-text containerAnswerontent ">
                            
                                <div>
                                <h6 class="mt-1"> ' . substr(htmlspecialchars_decode($question['description']) , 0,50) .'</h6><br>
                                </div>

                                <div class="border-left" style="padding-left: 4px">
                                <h6 class="mt-1 text-muted" style="margin-bottom:10px;">Answers: ' . $question['answers_count'] . '</h6>
                                <h6 class="mt-1 text-muted">' . substr($question['created_at'],0,-9) . '</h6>
                               <p class="text-muted"></p>
                                </div>
                              

                            </div>
                            <a href="question_editor.php?question_id=' . $question['id'] . '" class="btn btn-primary">Edit</a>
                            <input type="hidden" name="question_id" value="' . $question['id'] . '"/>
                            <button name="delete" class="btn btn-danger" onclick="confirmSelection(event)">Delete</button>
                        </div>
                    </div>
                </form>';
        }}
        ?>
    </div>

    <script>
        // Function to confirm selection and restore previous value if canceled
        function confirmSelection(event) {
            // Confirmation message
            const message = "Are you sure you want to delete your question?";
            // Confirm the choice
            if (!confirm(message)) {
                // Prevent the default form submission if the user cancels
                event.preventDefault();
            }
        }
    </script><?php require_once "components/footer.php" ?>
</body>

</html>