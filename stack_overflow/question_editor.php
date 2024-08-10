<?php
require_once 'functions/browser_fn.php';
require_once 'functions/question_fn.php';
require_once 'functions/db_conn.php';

$active = null;

if (!isLoggedIn()) {
    redirect('signin.php');
}

if (!isset($_GET['question_id']) && !isset($_POST['question_id'])) {
    redirect('my_questions.php');
}

if (isset($_POST['submit'])) {
    updateQuestion(
        $_POST['title'],
        $_POST['description'],
        $_POST['question_id']
    );
    alertMessage('Updated Successfully');
    redirect('my_questions.php');
}

$question = getQuestion($_GET['question_id'] ?? $_POST['question_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Overflow</title>
    <?php require_once 'components/styles.php' ?>
</head>

<body >
    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr>
    <div class="container">
        <div class="container my-5">
            <form action="question_editor.php" method="post">
                <div class="row justify-content-md-center">
                    <div>
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input name="title" id="title" value="<?php echo $question['title'] ?>" type="text" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <textarea name="description" id="editor" required><?php echo htmlspecialchars_decode($question['description']) ?></textarea>
                        </div>
                        <input type="hidden" name="question_id" value="<?php echo $_GET['question_id'] ?? $_POST['question_id'] ?>">
                        <button name="submit" class="btn btn-primary" onclick="confirmdes(event)">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/pg1x28xat94v0az13fouoe7y2oo0lfr93byt94whvwtfg393/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script> function confirmdes(event) {
            // Retrieve the description content from TinyMCE
            const description = tinymce.get("editor").getContent({ format: "text" }).trim();
            const title = document.getElementById("title").value.trim();

            // Check if either title or description is less than 4 characters
            if (title.length < 4 || description.length < 4) {
                alert("Question title and description cannot be less than 4 characters.");
                event.preventDefault(); // Prevent form submission
            }
        }
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