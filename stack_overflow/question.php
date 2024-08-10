<!-- Display question with answers and can add answer,  rate an answer -->
<?php
session_start();
require_once 'functions/browser_fn.php';
require_once 'functions/db_conn.php';
require_once 'functions/question_fn.php';
require_once 'functions/answer_fn.php';

$active = null;

if (!isset($_SESSION['question_id'])) {
    redirect('index.php');
}
$question_id = $_SESSION['question_id'];
if (isLoggedIn())
    $current_user_id = currentUserId();

if (isset($_POST['answer'])) {
    if (!isLoggedIn()) {
        redirect('signin.php');
    }
    createAnswer($_POST['answer_answer'], $question_id, $current_user_id);
} else if (isset($_POST['answer_id1'])) {
    if (isset($_POST['rate'.$_POST['answer_id1'].''])) {
        if (!isLoggedIn()) {
            redirect('signin.php');
        }
    
        rateAnswer($_POST['answer_id1'], $_POST['rate'.$_POST['answer_id1'].''], $current_user_id);
        }
        //redirect('question.php');//}
       
    } else if (isset($_POST['answer_id'])) {
        if (isset($_POST['rate'])) {
            if (!isLoggedIn()) {
                redirect('signin.php');
            }
            
            rateAnswer($_POST['answer_id'], $_POST['rate'], $current_user_id);
            //redirect('question.php');//}
           
        }} 
 else if (isset($_POST['add_comment'])) {
    if (!isLoggedIn()) {
        redirect('signin.php');
    }
    createComment($_POST['question_id'] ?? null, $_POST['answer_id2'] ?? null, $current_user_id, $_POST['comment']);
}

$question = getQuestion($question_id);
$answers = getQuestionAnswers($question_id);
$question_comments = getQuestionComments($question_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
    <?php require_once 'components/styles.php' ?>
    <script>
       
        
        </script>
    <style>
body {
    font-family: 'Open Sans', Arial, sans-serif;
    background-image: url("css/back5.png");
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 20px;
}

.card {
    margin-top: 40px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    border-radius: 8px;
}

.question-card {
  border-left: 5px solid black;
  width: 1500px;
  margin-left: 80px;
  margin-bottom: 60px;
}

.answer-card, .comment-card {
    background-color: #f8f9fa;
    border-left: 3px solid #6c757d;
    width: 1300px;
    margin-left: 200px;
    margin-bottom:30px ;
}

.card-title, .card-text, .text-muted {
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
}

.rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover{
            color: #deb217;
            animation: mymove 0.5s;
            animation-fill-mode: forwards;
            text-shadow: -1px 0 lightblue, 0 1px lightblue, 1px 0 lightblue, 0 -1px lightblue;
            position: relative;
           
            
        }
        @keyframes mymove {
            from {
                font-size:30px;
                bottom:0px;
               
                }

             to {
                font-size:40px;;
                bottom:7px;
                

    }
        }.rate:(:checked)>label{/**/
            color: #00000000;
            animation: mymove 0.5s;
            animation-fill-mode: forwards;
            text-shadow: -1px 0 lightblue, 0 1px lightblue, 1px 0 lightblue, 0 -1px lightblue;
            position: relative;
           
            
        }
        
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
            text-shadow: -1px 0 lightblue, 0 1px lightblue, 1px 0 lightblue, 0 -1px lightblue;     
           }

     .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {          /*       onChange="autoSubmit();}*/
            color: #c59b08;
        }
.containerQustionContent{
        display: flex;
        justify-content: space-between;

    }

.comment{
    
 width: 1300px;
 margin-left: 200px;
}
.containerQustionContent{
        display: flex;
        justify-content: space-between;

    }
</style>

    </style>
</head>

<body>
    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr>
    <div class="card mb-2 question-card" >
      <div class="card-body" >
        
        <h3 class="card-title"><?php echo $question['title'] ?></h3>
        <hr>
        <div class="containerQustionContent">
         <div>
           <p class="card-text"><?php echo htmlspecialchars_decode($question['description']) ?></p>
         </div>
         <div class="border-left" style="padding-left: 4px">
        <h6 class="mt-4">Asked By: <span class="text-success"><?php echo $question['username'] ?></span></h6>
        <p class="text-muted"><?php echo 'Asked ' .substr($question['created_at'],0,-9 ) .' at ' .substr($question['created_at'],11,-3 ) ?></p>
        </div>
      </div>

     </div>

        </div>
       <hr>
        <?php
      foreach ($question_comments as $comment) {
        echo '
        <div class="card comment-card">
            <div class="card-body containerQustionContent">
               <div>
                <p class="card-text">' .  $comment['content']  . '</p>
               </div>
               <div class="border-left" style="padding-left: 10px"> <p class="card-subtitle">By: <span class="text-success"> ' .  $comment['name']  . ' </span></p>
                <p class="text-muted">Commented ' .substr($comment['created_at'],0,-9 ) .' at ' .substr($comment['created_at'],11,-3 ).'</p>
               </div>
            </div>
        </div>
        ';
    }
    
    
        ?>
        
        <form action="question.php" method="post" class="form" style="margin-left: 200px; width:1300px  ;   margin-bottom: 0px;">
            <div class="form-group">
                <input name="comment" placeholder="Enter Your Comment" type="text" class="form-control">
            </div>
            <input type="hidden" name="question_id" value="<?php echo $question['id'] ?>" required>
            <button name="add_comment" type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
  <hr>
        <div id='div_session_write'> </div>
        <div class="mt-4">
            <?php
            if (count($answers) === 0) {
                echo '<h4 class="text-muted mt-4">No answers yet be the first one</h4>';
            } else {
                echo '<h4 class="mt-4"> ' . count($answers) . ' Answers</h4>';
                foreach ($answers as $answer) {
                    $answer_comments = getAnswerComments($answer['id']);
                   
                    //echo"<h1>.$answer['id'].</h1>";
                    $rateElement = '';
                    if  (isset($current_user_id)){
                       // alertmessage(checkIfUserDidAlreadyRatedAnswer($answer['id'], $current_user_id));
                        //alertmessage(true);
                    if (!checkIfUserDidAlreadyRatedAnswer($answer['id'], $current_user_id)) {
                        $rateElement = '
                        <form id="theForm" method="post" action="question.php">
                            <input type="hidden" name="answer_id" value="' . $answer['id'] . '"/>
                                <div class="rate">
                                    <input type="radio" id="star5'.$answer['id'].'" name="rate"'.$answer['id'].' value="5" onchange="this.form.submit(); " />
                                    <label for="star5'.$answer['id'].'" title="text">5 stars</label>
                                    <input type="radio" id="star4'.$answer['id'].'" name="rate"'.$answer['id'].' value="4" onchange="this.form.submit(); "/>
                                    <label for="star4'.$answer['id'].'" title="text">4 stars</label>
                                    <input type="radio" id="star3'.$answer['id'].'" name="rate"'.$answer['id'].' value="3" onchange="this.form.submit(); "/>
                                    <label for="star3'.$answer['id'].'" title="text">3 stars</label>
                                    <input type="radio" id="star2'.$answer['id'].'" name="rate"'.$answer['id'].' value="2" onchange="this.form.submit(); "/>
                                    <label for="star2'.$answer['id'].'" title="text">2 stars</label>
                                    <input type="radio" id="star1'.$answer['id'].'" name="rate"'.$answer['id'].' value="1" onchange="this.form.submit(); "/>
                                    <label for="star1'.$answer['id'].'" title="text">1 star</label>
                                    
                                </div>
                        </form>';
                    }
                    else{$rateElement = '
                        <form id="theForm1" method="post" action="question.php">
                            <input type="hidden" name="answer_id1" value="' .$answer['id'] . '"/>
                                <div class="rate">
                                    <input  class =".a5" type="radio" id="star5'.$answer['id'].'" name="rate'.$answer['id'].'" value="5" '. (currentRating($answer["id"], $current_user_id) ==5 ? 'checked': '' ).' onchange="confirmSelectionAndRestore(this, this.form, ' .$answer["id"].')"/>
                                    <label for="star5'.$answer['id'].'" title="text">5 stars</label>
                                    <input class =".a4" type="radio" id="star4'.$answer['id'].'" name="rate'.$answer['id'].'" value="4" '. (currentRating($answer["id"], $current_user_id) ==4 ? 'checked': '' ).' onchange="confirmSelectionAndRestore(this, this.form, ' .$answer["id"].')"/>
                                    <label for="star4'.$answer['id'].'" title="text">4 stars</label>
                                    <input class =".a3" type="radio" id="star3'.$answer['id'].'" name="rate'.$answer['id'].'" value="3" '. (currentRating($answer["id"], $current_user_id) ==3 ? 'checked': '' ).'  onchange="confirmSelectionAndRestore(this, this.form, ' .$answer["id"].')"/>
                                    <label for="star3'.$answer['id'].'" title="text">3 stars</label>
                                    <input class =".a2" type="radio" id="star2'.$answer['id'].'" name="rate'.$answer['id'].'" value="2" '. (currentRating($answer["id"], $current_user_id) ==2 ? 'checked': '' ).' onchange="confirmSelectionAndRestore(this, this.form, ' .$answer["id"].')"/>
                                    <label for="star2'.$answer['id'].'" title="text">2 stars</label>
                                    <input class =".a1" type="radio" id="star1'.$answer['id'].'" name="rate'.$answer['id'].'" value="1" '. (currentRating($answer["id"], $current_user_id) ==1 ? 'checked': '' ).' onchange="confirmSelectionAndRestore(this, this.form, ' .$answer["id"].')"/>
                                    <label for="star1'.$answer['id'].'" title="text">1 star</label>
                                    
                                </div>
                        </form>';}
                    $selectedOption = currentRating($answer["id"], $current_user_id);}
                    echo '
                    <div class="card question-card">
                        <div class="card-body">
                        Rate:
                        <label for="rating-5" class="fa fa-star"> ' . ($answer['rate'] ? round($answer['rate'], 1) : 0) . '</label>
                        <hr>
                           <div class="containerQustionContent">
                            <div>
                           <p class="card-text">' .  htmlspecialchars_decode($answer['answer'])  . '</p>
                           </div>
                           <div class="border-left" style="padding-left: 10px ; width: 400px;">
                           <h6 class="mt-4">By: <span class="text-success">' . $answer['username'] . '</span></h6>
                            <p class="text-muted"> Answered ' .substr($answer['created_at'],0,-9 ) .' at ' .substr($answer['created_at'],11,-3 ).'</p>
                            <div class="star-rating" id="star-rating">
                            
                                <div class="star-input">
                                    ' . $rateElement . ' 
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div><hr>'
                   ;
                    echo count($answer_comments) > 0 ? ' Comments. ' : 'No Comments';
                    foreach ($answer_comments as $comment) {
                        echo '
                        <div class="card comment-card">
            <div class="card-body containerQustionContent">
               <div>
                <p class="card-text">' .  $comment['content']  . '</p>
               </div>
               <div class="border-left" style="padding-left: 10px"> <p class="card-subtitle">By: <span class="text-success"> ' .  $comment['username']  . ' </span></p>
                <p class="text-muted">Commented ' .substr($comment['created_at'],0,-9 ) .' at ' .substr($comment['created_at'],11,-3 ).'</p>
               </div>
            </div>
        </div>';
                    }
                    echo '
                    <form action="question.php" method="post" class="mt-2 form" style="margin-left: 200px; width:1300px  ;   margin-bottom: 0px;">
                        <div class="form-group">
                            <input name="comment" placeholder="Enter Your Comment" type="text" class="form-control">
                        </div>
                        <input type="hidden" name="answer_id2" value="' . $answer['id'] . '" required>
                        <button name="add_comment" type="submit" class="btn btn-primary">Submit comment</button>
                    </form>
                    <hr>' ;
                    //$answer['id']=$answer['id'];
                   // echo"<h1>.$answer['id'].</h1>";
                }
            }
            ?>
        </div>
        <h2 class="mt-4" style="margin-left: 20px;">Your Answer</h2>
        <form action="question.php" method="post">
            <div class="row " style="margin-left: 20px;">
                <div >
                    <div class="form-group">
                        <textarea name="answer_answer" id="editor"></textarea>
                    </div>
                    <button name="answer" class="btn btn-primary"onclick="confirmdes(event)">Submit</button>
                </div>
            </div>
        </form>
    </div>


    <script src="https://cdn.tiny.cloud/1/pg1x28xat94v0az13fouoe7y2oo0lfr93byt94whvwtfg393/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
            height: 300,
        });
        function initializeEditor() {
            tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
            height: 300,
        });
    }

    // Check if the editor element exists before initializing
    if (document.getElementById('editor')) {
        initializeEditor();
    }
    $(document).ready(function(){
        initializeEditor();
    })
        //let initiallyChecked = '<?php //echo $selectedOption; ?>';

        // Function to confirm selection and restore previous value if canceled
        function confirmSelectionAndRestore(radioButton, form, Aid) {
           
            let message = "Are you sure you want to change your previous rating with " + radioButton.value + " stars ?";
            
            // Confirm the choice
            if (confirm(message)) {
                // Update the initially checked value if confirmed
              //  initiallyChecked = radioButton.value;
                form.submit();
            }
        }
        
        // Initialize the TinyMCE editor
      


        // Function to confirm the description length before submitting the form
        function confirmdes(event) {
            // Retrieve the description content from TinyMCE
            const description = tinymce.get("editor").getContent({ format: "text" }).trim();
            //const title = document.getElementById("title").value.trim();

            // Check if either title or description is less than 4 characters
            if (description.length < 4) {
                alert("Answer cannot be less than 4 characters.");
                event.preventDefault(); // Prevent form submission
            }
        }
    
        
    </script><?php require_once "components/footer.php" ?>
</body>

</html>