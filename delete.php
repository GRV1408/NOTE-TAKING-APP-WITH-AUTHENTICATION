<?php
require_once 'Note.php';
require_once 'SqliteNoteRepository.php';
//require_once ''

$NoteReposit = new \gkushwah\p3\SqliteNoteRepository();

?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])): ?>
    <?php if (!empty($_POST['delete'])): ?>
    <?php
    $NoteReposit->deleteNote($_POST['id']);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
      <h1 style="color: #DD4700;"><u>Note Deleted</u></h1>
      <a href="index.php"><p>Back To Note List</p></a>
  </body>
  </html>
    
    <?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Note</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
    <p class="lead" style="color: #1884BB;">Do you want to delete note?</p>
    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?php print $_POST['id'];?>">
        <input type="hidden" name="delete" value="delete">
        <input class="btn btn-danger" type="submit" value="Delete Note">
    </form></body><br>
    <p><a href="index.php"><mark>cancel</mark></a></p>
        
        
    </body>
    </html>
    <?php endif; ?>

<?php endif; ?>

