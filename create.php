<?php
require_once 'Note.php';
require_once 'SqliteNoteRepository.php';

//Shortend Post variable names if set
$NoteSubject = isset($_POST['subjectline']) ? htmlspecialchars(trim($_POST['subjectline'])) : '';
$NoteBody = isset($_POST['notebody']) ? htmlspecialchars(trim($_POST['notebody'])) : '';
$NoteAuthor = isset($_POST['author']) ? htmlspecialchars(trim($_POST['author'] )): '';
date_default_timezone_set('America/Chicago');
$NoteCdatetime = date("l F d, Y - H:i:s a"); 
$NoteLastedited = date("l F d, Y - H:i:s a");
$NoteNumofchar = 0;

//Validate form fields
$formIsValid = true;
$subjectError = '';
$AuthorError = '';
if (empty($NoteSubject)){
    $formIsValid = false;
    $subjectError = '<span style="color: #f00;">* Subject Line is required!</span>';
}
if (empty($NoteAuthor)){
    $formIsValid = false;
    $AuthorError = '<span style="color: #f00;">* Author Name is required!</span>';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Note</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <?php if ($formIsValid): ?>
        <?php
        $NoteReposit = new \gkushwah\p3\SqliteNoteRepository();
        $Note = new \gkushwah\p3\Note();
        $Note->setSubjectline($NoteSubject);
        $Note->setAuthor($NoteAuthor);
		$Note->setNotebody($NoteBody);
		$Note->setCdatetime($NoteCdatetime);
		$Note->setLastedited($NoteLastedited);
		$NoteNumofchar = Strlen($NoteBody);
		$Note->setNumofchar($NoteNumofchar);
        $NoteReposit->saveNote($Note);
        ?>
        <h1 style="color: #1884BB;">The Newly Created Note</h1>
        <p class="lead"><strong>Subject Line:          </strong><?php print $NoteSubject; ?></p>
		<p class="lead"><strong>Note Body:          </strong><?php print $NoteBody; ?></p>
        <p class="lead"><strong>Author Name:        </strong><?php print $NoteAuthor; ?></p>
		<p class="lead"><strong>Date/Time Created:           </strong><?php print $NoteCdatetime; ?></p>
		<p class="lead"><strong>Last Edited:          </strong><?php print $NoteLastedited; ?></p>
		<p class="lead"><strong>Number Of Characters: </strong><?php print $NoteNumofchar; ?></p>
        <p class="lead"><a href="index.php">Show All Notes</a></p>
    <?php else: ?>
        <h1 style="color: #1884BB;"><u>Create New Note</u></h1>
        <form method="post" action="create.php">
            <label><strong>Subject Line:              </strong>
            <input type="text" class="form-control" name="subjectline" value="<?php print $NoteSubject; ?>">
            </label><?php print $subjectError; ?><br>
			<label><strong>Note Body:   </strong>
            <textarea class="form-control" rows="5" name="notebody"><?php print $NoteBody; ?></textarea>
            </label><?php  ?><br>
            <label>
            <strong>Author Name: </strong>
            <input class="form-control" type="text" name="author" value="<?php print $NoteAuthor; ?>"></label>
            <?php print $AuthorError; ?><br>
            <input class="btn btn-success" type="submit" value="Create Note">
        </form>
    <?php endif; ?>
<?php else: ?>
    <h1 style="color: #1884BB;">Create New Note</h1>
    <form method="post" action="create.php">
        <label><strong>Subject Line:              </strong><input class="form-control" type="text" name="subjectline"></label><br>
		<label><strong>Note Body:   </strong>
        <textarea class="form-control"  rows="5" name="notebody"></textarea></label><br>
        <label><strong>Author Name: </strong>
        <input class="form-control" type="text" name="author"></label><br>
        <input type="submit" class="btn btn-success" value="Create Note">
    </form>
<?php endif; ?>
</body>
</html>
