<!-- Display current user questions with pagination and can edit, delete, add, search -->
<?php
require_once 'functions/browser_fn.php';
require_once 'functions/question_fn.php';
require_once 'functions/db_conn.php';

$active = null;

if (!isLoggedIn()) {
    redirect('signin.php');
}

if (isset($_POST['submit'])) {
    if (strlen($_POST['description'])>3){
    createQuestion(
        $_POST['title'],
        $_POST['description'],
        currentUserId()
    );
    alertMessage('Created Successfully');
    redirect('index.php');}
    //else alertMessage('Question description cannot be less than 4 characters');
}
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
        // Initialize the TinyMCE editor
        tinymce.init({
            selector: '#editor'
        });

        // Function to confirm the description length before submitting the form
        function confirmdes(event) {
            // Retrieve the description content from TinyMCE
            const description = tinymce.get("editor").getContent({ format: "text" }).trim();
            const title = document.getElementById("title").value.trim();

            // Check if either title or description is less than 4 characters
            if (title.length < 4 || description.length < 4) {
                alert("Question title and description cannot be less than 4 characters.");
                event.preventDefault(); // Prevent form submission
            }
        }
    </script>
</head>

<body >
    <?php require_once 'components/nav_bar.php' ?>
    <hr><hr><hr><hr><hr>
    <div class="container">
        <div class="container mt-4 mb-4">
            <form action="create_question.php" method="post">
                <div class="row justify-content-md-center">
                    <div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="editor"></textarea>
                        </div>
                        
                        <button name="submit" class="btn btn-primary" onclick="confirmdes(event)">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/pg1x28xat94v0az13fouoe7y2oo0lfr93byt94whvwtfg393/tinymce/6/tinymce.min.js" referrerpolicy="origin">
   tinymce.init({
            selector: '#editor'
        });</script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
        });
    </script><?php require_once "components/footer.php" ?>
</body>

</html>