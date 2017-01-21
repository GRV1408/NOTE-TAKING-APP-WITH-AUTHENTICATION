<?php
require_once 'SqliteNoteRepository.php';
require_once 'Note.php';


$NoteReposit = new \gkushwah\p3\SqliteNoteRepository();

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php", TRUE, 302);
    exit;
}
//date_default_timezone_set('America/Chicago');
$NoteList = $NoteReposit->getAllNotes();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NoteList</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>  
     .classa{float: right;
    color: red;
    font-size: larger;}
    </style>
</head>
<body>
<marquee width="50%"><h2 style="color: #7A83CD";>Hello Admin <?php echo $_SESSION['user']; ?></h2></marquee>
    <a class="classa lead" style="color: red"; href="login.php?logout"><mark>|  Logout  |</mark></a>
<p class="lead"><a href="create.php" style="color: #DD4700;"><mark>| Add New Note |</mark></a></p>
<p class="lead" style="text-align: center;"><strong style="color: #26A471;"> <u>ALL NOTES</u></strong></p>
<table class="table table-bordered">
    <tr>
        <th style="color: #7A83CD;">Subject line</th>
		<th style="color: #7A83CD;">Date/Time Created</th>
        <th style="color: #7A83CD;">Last Edited</th>
        <th style="color: #7A83CD;">Number of Characters</th>
    </tr>
    <?php
    foreach($NoteList as $Note) {
        print '<tr>';
        print '<td><a href="show.php?id=' . $Note->getId() . '">'. $Note->getSubjectline() .'</a></td>';
		print '<td>' . $Note->getCdatetime() . '</td>';
		print '<td>' . $Note->getLastedited() . '</td>';
        print '<td>' . $Note->getNumofchar() . '</td>';
        print '</tr>';
    }
    ?>
</table>
<?php ?>
</body>
</html>
