<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
      
        
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
 display: flex;
 justify-content: space-around;
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
    </style>
</head>
<body><?php require_once 'components/styles.php' ?>
    <?php
    require_once 'functions/db_conn.php';
    require_once 'functions/browser_fn.php';
    require_once 'functions/question_fn.php';

    if (!isLoggedIn()) {
        redirect('index.php');
    }

    if (isset($_POST['delete'])) {
        deleteQuestion($_POST['question_id']);
    }

    $active = 'my_questions';

    // Pagination
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $questions_per_page = 10;
    $total_questions = getCurrentUserQuestions1();
    $total_pages = ceil($total_questions / $questions_per_page);
    $offset = ($page - 1) * $questions_per_page;

    $questions = getCurrentUserQuestions($page, $questions_per_page);
    ?><?php require_once 'components/nav_bar.php' ?><hr><hr><hr><hr><hr><br>
   
    <div class="container-md" style="width: 1500px;  margin-left: 200px; margin-top:25px;">
    
    <div class="containerHeader">
       
    <div><h2 >My Questions:</h2></div>
     <div><a href="create_question.php" class="btn btn-primary" style="font-size:25px">Ask Question</a></div>
    </div>
    <div class="answers-grid" style="width: 1500px;">
    
        
       
        <?php
        //$flag = false;
       // if (empty($questions)) {
          //  echo "<h1>No more questions.</h1>";
          //  $flag = true;
        //}
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
        }
        ?></div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="page-item"><a class="page-link" href="my_questions.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php else : ?>
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>"><a class="page-link" href="my_questions.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages) : ?>
                    <li class="page-item"><a class="page-link" href="my_questions.php?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php else : ?>
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                <?php endif; ?>
            </ul>
        </nav>
        </div>
        <?php require_once "components/footer.php" ?>
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
    </script>
</body>
</html>
