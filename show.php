<?php
require_once 'SqliteNoteRepository.php';
require_once 'Note.php';

$NoteReposit = new \gkushwah\p3\SqliteNoteRepository();

//Shortend Get variable names if set
$NoteId = isset($_GET['id']) ? $_GET['id'] : '';

$Note = $NoteReposit->getNoteById($NoteId);

?>

<?php if ($Note): ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Note <?php print $Note->getSubjectline(); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<p class="lead"><strong>Subject Line: </strong><?php print $Note->getSubjectline();?></p>
<p class="lead"><strong>Note Body: </strong><?php print $Note->getNotebody();?></p>
<p class="lead"><strong>Author Name: </strong><?php print $Note->getAuthor();?></p>
<p class="lead"><strong>Date/Time Created: </strong><?php print $Note->getCdatetime();?></p>
<p class="lead"><strong>Last Edited: </strong><?php print $Note->getLastedited();?></p>
<p class="lead"><strong>Number of Characters: </strong><?php print $Note->getNumofchar();?></p>
<p class="lead">
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php print $Note->getId();?>">
        <input class="btn btn-info" type="submit" value="Edit Note">
    </form>
</p>
<p>
    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?php print $Note->getId();?>">
        <input class="btn btn-danger" type="submit" value="Delete Note">
    </form>
</p>
</body>
</html>
<?php else: ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>No Note To Show</title>
</head>
<body>
<h1>No Note Found</h1>
  <a href="index.php">Back to Note List</a>
</body>
</html>
<?php endif; ?>
