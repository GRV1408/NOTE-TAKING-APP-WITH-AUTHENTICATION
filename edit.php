<?php
require_once 'Note.php';
require_once 'SqliteNoteRepository.php';
$NoteReposit = new \gkushwah\p3\SqliteNoteRepository();
?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])): ?>

    <?php
    $Note = $NoteReposit->getNoteById($_POST['id']);
     ?>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <h1 style="color: #1884BB;"><u>Edit Note</u></h1>
        <form method="post" action="edit.php">
            <input class="form-control" type="hidden" name="NoteId" value="<?php print $_POST['id']; ?>">
            <label><strong>Subject Line:        </strong>
            <input class="form-control" type="text" name="subjectline" value="<?php print $Note->getSubjectline(); ?>"></label><br>
            <label><strong>Note Body:      </strong>
            <textarea class="form-control"  rows="5" name="notebody"><?php print $Note->getNotebody(); ?></textarea></label><br>
			<label><strong>Author Name:   </strong><input class="form-control" type="text" name="author" value="<?php print $Note->getAuthor(); ?>"></label><br>
            <input type="submit" class="btn btn-success" value="Save Note">
        </form>

<?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['NoteId'])): ?>

    <?php
    $NoteSubject = isset($_POST['subjectline']) ? htmlspecialchars(trim($_POST['subjectline'])) : '';
	$NoteBody = isset($_POST['notebody']) ? htmlspecialchars(trim($_POST['notebody'])) : '';
    $NoteAuthor = isset($_POST['author']) ? htmlspecialchars(trim($_POST['author'])) : '';
    date_default_timezone_set('America/Chicago');
	$NoteLastedited = date("l F d, Y - H:i:s a"); 
	$NoteNumofchar = 0;
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
    <?php if ($formIsValid): ?>
        <?php
    
        $aNote = $NoteReposit->getNoteById($_POST['NoteId']);
        $aNote->setSubjectline($NoteSubject);
		$aNote->setNotebody($NoteBody);
        $aNote->setAuthor($NoteAuthor);
		$aNote->setLastedited($NoteLastedited);
		$NoteNumofchar = Strlen($NoteBody);
		$aNote->setNumofchar($NoteNumofchar);
        $NoteReposit->saveNote($aNote);
        ?>
       
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Note</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        </head>
        <body>
        <h1 style="color: #1884BB;" ><u>Note Is Updated Successfully</u></h1>
        <p><a href="index.php">Back to Note List</a></p>
        </body>
        </html>
    <?php else: ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Update Note</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        </head>
        <body>
        <h1 style="color: #1884BB;"><u>Edit Note</u></h1>
        <form method="post" action="edit.php">
            <input  type="hidden" name="NoteId" value="<?php print $_POST['NoteId']; ?>">
            <label><strong>Subject Line:      </strong><input class="form-control" type="text" name="subjectline" value="<?php print $NoteSubject; ?>"></label>
            <?php print $subjectError; ?><br>
			<label><strong>Note Body:    </strong>
            <textarea class="form-control"  rows="5" name="notebody"><?php print $NoteBody; ?></textarea>
            </label><?php  ?><br>
            <label><strong>Author Name: </strong><input class="form-control" type="text" name="author" value="<?php print $NoteAuthor; ?>"></label>
            <?php print $AuthorError; ?><br>
            <input class="btn btn-success" type="submit" value="Save Note">
        </form>
        </body>
        </html>
    <?php endif; ?>

<?php else: ?>
    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
      <h1>No Note Selected for Editing</h1>
      <p><a href="index.php">Back to Note List</a></p>
    </body>
    </html>
<?php endif;?>