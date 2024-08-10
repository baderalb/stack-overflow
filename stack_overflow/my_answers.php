
<?php
require_once 'functions/db_conn.php';
require_once 'functions/browser_fn.php';
require_once 'functions/answer_fn.php';
if (!isLoggedIn()) {
    redirect('index.php');
}
if (isset($_POST['delete'])) {
    deleteAnswer($_POST['answer_id']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
  
    <?php require_once 'components/styles.php';$active = 'my_answers'; ?>
    <style>
        /* Grid Layout CSS */

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
}.pagination {
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
<body >

<?php

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $questions_per_page = 10;
    $total_questions = getnumberCurrentUserAnswers();
    $total_pages = ceil($total_questions / $questions_per_page);
    $offset = ($page - 1) * $questions_per_page;

    $answers = getCurrentUserAnswers1($page);
?>
    <?php require_once 'components/nav_bar.php' ?>
    <hr>
    <hr>
    <hr> 
    <hr>
    <hr>

    <div  class="container-md"  style="width: 1500px;  margin-left: 200px; margin-top:40px;">
        <div style="text-align:center;  " class="containerHeader" ><h2 >Answers</h2></div>


        <div class="answers-grid" style="width: 1500px;">
            <?php

            foreach ($answers as $answer) {
                $qtitle= getAnswerTitle($answer['id']);
                $rate=getAnswerRate($answer['id']);
                echo '
                <form method="post" action="#" class="answer-form">
                    <div class="card mb-4 answerElemnt">
                        <div class="card-body">
                            <a class="card-link" href="index.php?question_id=' . $answer['question_id'] . '"> For Question  : '.$qtitle["title"] .'</a>
                            <hr>
                            <div class="card-text containerAnswerontent ">
                            
                                <div>
                                <h6 class="mt-1"> ' . substr(htmlspecialchars_decode($answer["answer"]) , 0,30) .'</h6>
                                </div>

                                <div class="border-left" style="padding-left: 4px">
                               <h6 class="mt-1">Rate: ' . $rate. ' <image style="width :30px; height :30px;" src="css/star.png ">    </h6>
                               <p class="text-muted">'     . substr($answer["created_at"], 0, -9) . '</p>
                                </div>
                              

                            </div>
                            <a href="answer_editor.php?answer_id=' . $answer['id'] . '" class="btn btn-primary">Edit</a>
                            <input type="hidden" name="answer_id" value="' . $answer['id'] . '"/>
                            <button name="delete" class="btn btn-danger" onclick="confirmSelection(event)">Delete</button>
                        </div>
                    </div>
                </form>';
            }
            


            ?>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="page-item"><a class="page-link" href="my_answers.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php else : ?>
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>"><a class="page-link" href="my_answers.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages) : ?>
                    <li class="page-item"><a class="page-link" href="my_answers.php?page=<?php echo $page + 1; ?>">Next</a></li>
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