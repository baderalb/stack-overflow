<?php
require_once 'functions/browser_fn.php';
require_once 'functions/answer_fn.php';
require_once 'functions/db_conn.php';

$active = "signin";

if (!isLoggedIn()) {
    redirect('signin.php');
}

if (!isset($_GET['answer_id']) && !isset($_POST['answer_id'])) {
    redirect('my_answers.php');
}

if (isset($_POST['submit'])) {
    updateAnswer(
        $_POST['answer'],
        $_POST['answer_id']
    );
    alertMessage('Updated Successfully');
    redirect("my_answers.php");
}

$answer = getAnswer($_GET['answer_id'] ?? $_POST['answer_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Answer - Stack Overflow</title>
    <?php require_once 'components/styles.php'; ?>

</head>
<body >
<hr>
    <hr>
    <hr>
    <hr>
    <?php require_once 'components/nav_bar.php'; ?>
 
    <div class="container my-5">
        <h3>Edit Answer</h3>
        <hr>
        <form action="answer_editor.php" method="post">
            <div class="form-group mb-3">
                <textarea name="answer" id="editor" class="form-control" required><?php echo htmlspecialchars_decode($answer['answer']); ?></textarea>
            </div>
            <input type="hidden" name="answer_id" value="<?php echo $_GET['answer_id'] ?? $_POST['answer_id']; ?>">
            <button name="submit" type="submit" class="btn btn-primary" >Update Answer</button>
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
    </script><?php require_once "components/footer.php" ?>
</body>
</html>