<?php

function createQuestion($title, $description, $user_id)
{
    $db = connectDB();
    $sql = "INSERT INTO questions (title, description,  user_id) VALUES('" . $title . "', '" . htmlspecialchars($description) . "', $user_id)";
    mysqli_query($db, $sql);
}

function updateQuestion($title, $description, $question_id)
{
    $db = connectDB();
    $sql = "UPDATE questions SET title = '" . $title . "', description = '" . htmlspecialchars($description) . "' WHERE id = $question_id";
    mysqli_query($db, $sql);
}

function deleteQuestion($question_id)
{
    $db = connectDB();
    $sql = "DELETE FROM questions WHERE id = $question_id";
    mysqli_query($db, $sql);
}

function getLast10Questions()
{
    $db = connectDB();
    $sql = "SELECT q.*,u.name username, COUNT(a.id) answers_count FROM questions q JOIN users u ON(u.id = q.user_id) LEFT JOIN answers a ON(q.id = a.question_id) GROUP BY q.id ORDER BY id DESC LIMIT 10;";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}

function getTop10AnsweredQuestions()
{
    $db = connectDB();
    $sql = "SELECT q.*,u.name username, COUNT(a.id) answers_count FROM questions q JOIN users u ON(u.id = q.user_id) LEFT JOIN answers a ON(q.id = a.question_id) GROUP BY q.id ORDER BY answers_count DESC LIMIT 10;";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}function getTopAnsweredQuestions()
{
    $db = connectDB();
    $sql = "SELECT q.*,u.name username, COUNT(a.id) answers_count FROM questions q JOIN users u ON(u.id = q.user_id) LEFT JOIN answers a ON(q.id = a.question_id) GROUP BY q.id ORDER BY answers_count DESC ;";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}

function searchQuestions($search)
{
    $db = connectDB();
    $sql = "SELECT q.*, COUNT(a.id) answers_count FROM questions q LEFT JOIN answers a ON(q.id = a.question_id) WHERE q.title LIKE '%" . $search . "%' OR q.description LIKE '%" . $search . "%' GROUP BY q.id DESC ";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}
function searchaQuestions($search)
{
    $db = connectDB();
    $sql = "SELECT q.*,u.name username, COUNT(a.id) answers_count FROM questions q JOIN users u ON(u.id = q.user_id) LEFT JOIN answers a ON(q.id = a.question_id) WHERE q.title LIKE '%" . $search . "%' OR q.description LIKE '%" . $search . "%' GROUP BY q.id DESC ";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}

function searchmQuestions($search)
{
    $db = connectDB();
    $user_id = currentUserId();
    $sql = "SELECT q.*, COUNT(a.id) answers_count FROM questions q LEFT JOIN answers a ON(q.id = a.question_id) WHERE q.user_id =$user_id AND ( q.title LIKE '%" . $search . "%' OR q.description LIKE '%" . $search . "%') GROUP BY q.id DESC ";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}

function getCurrentUserQuestions($page)
{
    $db = connectDB();
    $user_id = currentUserId();
    $last_item = ($page-1) * 10;
    $sql = "SELECT q.*, COUNT(a.id) answers_count FROM questions q LEFT JOIN answers a ON(q.id = a.question_id) WHERE q.user_id = $user_id GROUP BY q.id LIMIT $last_item, 10";
    $result = mysqli_query($db, $sql);
    $questions = array();
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
    }
    return $questions;
}function getCurrentUserQuestions1()
{
    $db = connectDB();
    $user_id = currentUserId();
    
    $sql = "SELECT q.* FROM questions q LEFT JOIN answers a ON(q.id = a.question_id) WHERE q.user_id = $user_id GROUP BY q.id ";
    $result = mysqli_query($db, $sql);
    $questions = array();
    $c=0;
    while ($row = mysqli_fetch_array($result)) {
        $questions[] = $row;
        $c++;
    }
    return $c;
}

function getCurrentUserPaginationCount()
{
    $db = connectDB();
    $user_id = currentUserId();
    $sql = "SELECT (COUNT(id) / 10) pagination FROM questions WHERE user_id = $user_id";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return ceil($row['pagination']);
}

function getQuestion($question_id)
{
    $db = connectDB();
    $sql = "SELECT q.*, u.name username FROM questions q JOIN users u ON(u.id = q.user_id) WHERE q.id = $question_id";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getQuestionComments($question_id)
{
    $db = connectDB();
    $sql = "SELECT c.*, u.name FROM comments c JOIN users u ON(c.user_id = u.id) WHERE question_id = $question_id";
    $result = mysqli_query($db, $sql);
    $comments = array();
    while ($row = mysqli_fetch_array($result)) {
        $comments[] = $row;
    }
    return $comments;
}

function createComment($question_id = null, $answer_id = null, $user_id, $content)
{
    $db = connectDB();
    if ($question_id) {
        $sql = "INSERT INTO comments (content, question_id,  user_id) VALUES('" . $content . "',  $question_id, $user_id)";
    } else {
        $sql = "INSERT INTO comments (content, answer_id,  user_id) VALUES('" . $content . "', $answer_id,  $user_id)";
    }
    mysqli_query($db, $sql);
}
