<?php

function createAnswer($answer, $question_id, $user_id)
{
    $db = connectDB();
    $sql = "INSERT INTO answers (answer, question_id,  user_id) VALUES('" . htmlspecialchars($answer) . "', $question_id, $user_id)";
    mysqli_query($db, $sql);
}

function updateAnswer($answer, $answer_id)
{
    $db = connectDB();
    $sql = "UPDATE answers SET answer = '" . htmlspecialchars($answer) . "' WHERE id = $answer_id";
    mysqli_query($db, $sql);
}

function deleteAnswer($answer_id)
{
    $db = connectDB();
    $sql = "DELETE FROM answers WHERE id = $answer_id";
    mysqli_query($db, $sql);
}

function getAnswer($answer_id)
{
    $db = connectDB();
    $sql = "SELECT * FROM answers WHERE id = $answer_id";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getCurrentUserAnswers()
{
    $db = connectDB();
    $user_id = currentUserId();
    $sql = "SELECT a.*, AVG(r.rate) rate FROM answers a JOIN users u ON(u.id = a.user_id) LEFT JOIN ratings r ON(r.answer_id = a.id) WHERE a.user_id = $user_id GROUP BY a.id";
    $result = mysqli_query($db, $sql);
    $answers = array();
    while ($row = mysqli_fetch_array($result)) {
        $answers[] = $row;
    }
    return $answers;
}
function getCurrentUserAnswers1($page)
{
    $db = connectDB();
    $user_id = currentUserId();
    $last_item = ($page-1) * 10;
    $sql = "SELECT a.*, AVG(r.rate) rate FROM answers a JOIN users u ON(u.id = a.user_id) LEFT JOIN ratings r ON(r.answer_id = a.id) WHERE a.user_id = $user_id GROUP BY a.id LIMIT $last_item, 10";
    $result = mysqli_query($db, $sql);
    $answers = array();
    while ($row = mysqli_fetch_array($result)) {
        $answers[] = $row;
    }
    return $answers;
}
function getnumberCurrentUserAnswers()
{
    $db = connectDB();
    $user_id = currentUserId();
    $sql = "SELECT a.*, AVG(r.rate) rate FROM answers a JOIN users u ON(u.id = a.user_id) LEFT JOIN ratings r ON(r.answer_id = a.id) WHERE a.user_id = $user_id GROUP BY a.id";
    $result = mysqli_query($db, $sql);
    $answers = array();
    $c=0;
    while ($row = mysqli_fetch_array($result)) {
        $answers[] = $row;
        $c++;
    }
    return $c;
}

function SearchMAnswer($search)
{
    $db = connectDB();
    $user_id = currentUserId();
    $sql = "SELECT a.*, AVG(r.rate) rate FROM answers a JOIN users u ON(u.id = a.user_id) LEFT JOIN ratings r ON(r.answer_id = a.id) WHERE a.user_id = $user_id AND (a.answer LIKE '%" . $search . "%') GROUP BY a.id";
    $result = mysqli_query($db, $sql);
    $answers = array();



    while ($row = mysqli_fetch_array($result)) {
        $answers[] = $row;
    }
    return $answers;
}

function getQuestionAnswers($question_id)
{
    $db = connectDB();
    $sql = "SELECT a.*, u.name username, AVG(r.rate) rate FROM answers a JOIN users u ON(u.id = a.user_id) LEFT JOIN ratings r ON(r.answer_id = a.id) WHERE a.question_id = $question_id GROUP BY a.id";
    $result = mysqli_query($db, $sql);
    $answers = array();
    while ($row = mysqli_fetch_array($result)) {
        $answers[] = $row;
    }
    return $answers;
}

function checkIfUserDidAlreadyRatedAnswer($answer_id, $user_id)
{
    $db = connectDB();
    if  ($user_id!=0){
    $sql = "SELECT id FROM ratings WHERE user_id = $user_id AND answer_id = $answer_id";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return isset($row['id']);}
}
function currentRating($answer_id, $user_id)
{
    $db = connectDB();
    if  ($user_id!=0){
    $sql = "SELECT rate FROM ratings WHERE user_id = $user_id AND answer_id = $answer_id";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    if(isset($row['rate'])){
        return $row['rate'];
    }}
}

function rateAnswer($answer_id,  $rate, $user_id)
{
    $db = connectDB();
    if (!checkIfUserDidAlreadyRatedAnswer($answer_id, $user_id)) {
    $sql = "INSERT INTO ratings (rate, answer_id, user_id) VALUES ($rate, $answer_id, $user_id)";
    mysqli_query($db, $sql);}
    else {
        $sql = "UPDATE ratings SET rate=$rate WHERE user_id = $user_id AND answer_id = $answer_id";
        mysqli_query($db, $sql);
        }
    
}

function getAnswerComments($answer_id)
{
    $db = connectDB();
    $sql = "SELECT c.*, u.name username FROM comments c JOIN users u ON(u.id = c.user_id) WHERE c.answer_id = $answer_id GROUP BY c.id";
    $result = mysqli_query($db, $sql);
    $comments = array();
    while ($row = mysqli_fetch_array($result)) {
        $comments[] = $row;
    }
    return $comments;
}





function getAnswerTitle($answer){
  $db=connectDB();
  $user_id= currentUserId();

  $sql=" SELECT q.*
         FROM questions q  
        JOIN answers a ON q.id = a.question_id 
        WHERE a.user_id = $user_id AND a.id = $answer";
   $result =mysqli_query($db,$sql);
   $row=mysqli_fetch_assoc($result);
   $title=$row;
   return $title;

}
function getAnswerRate($answer){
    $db=connectDB();
    $user_id= currentUserId();
    $sql=" SELECT rate 
           FROM ratings as r 
          WHERE r.answer_id ='$answer'";
    $result = mysqli_query($db, $sql);
    $rating=0;
    $count=0;
    while($row=  mysqli_fetch_assoc($result)){
        $rating+= $row["rate"];
        $count ++;
    }
    if($count >0)
    return round($rating/$count,1);
    else
    return 0;

}







