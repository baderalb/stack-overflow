<!-- Search all questions -->
<?php
require_once 'functions/db_conn.php';
require_once 'functions/question_fn.php';
require_once 'functions/browser_fn.php';

$active = null;

if (!isset($_GET['search'])) {
    redirect('index.php');
}

$questions = searchQuestions($_GET['search']);
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
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
            height: 120px; /* Increased height */
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%; /* Full height of the card */
        }

        .card-link {
            color: #007bff;
            font-weight: bold;
            max-width: 70%; /* Limit the width of the title */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis for overflow text */
        }

        .card-link:hover {
            text-decoration: none;
            color: #0056b3;
        }

        .card-subtitle {
            color: #6c757d;
            font-size: 14px;
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
        <a href="index.php"  class="btn btn-outline-primary border border-secondary " style="text-align: center;" >Reset</a>
     </div>
        <?php
        foreach ($questions as $question) {
            echo '
                <div class="card">
                    <div class="card-body">
                        <a class="card-link" href="index.php?question_id=' . $question['id'] . '">' . substr($question['title'], 0, 45) . (strlen($question['title']) > 45 ? '...' : '') . '</a>
                        <div class="card-subtitle text-muted">
                            <h6>Answers: ' . $question['answers_count'] . '</h6>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
    <?php require_once "components/footer.php" ?>
</body>

</html>