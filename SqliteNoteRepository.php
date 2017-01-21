<?php
namespace gkushwah\p3;

require_once 'INoteRepository.php';
require_once 'Note.php';


class SqliteNoteRepository implements INoteRepository
{
    private $db;
    private $fileName = 'data/data.sqlite';

     public function __construct(){
        //open the database
        $this->db = new \PDO('sqlite:' . $this->fileName);

        //create the table if not exists
        $this->db->exec("CREATE TABLE IF NOT EXISTS Notes (Id INTEGER PRIMARY KEY, Subjectline TEXT, Notebody TEXT,Author TEXT, Cdatetime TEXT, Lastedited TEXT, Numofchar TEXT)");
    }
    public function saveNote($Note)
    {
       if ($Note->getId() != '') {
            //Update
            $stmh = $this->db->prepare("UPDATE Notes SET Subjectline = :subjectline, Notebody = :notebody, Author = :author, Cdatetime = :cdatetime, Lastedited = :lastedited, Numofchar = :numofchar WHERE id = :id");
            $aSubjectline = $Note->getSubjectline();
            $aNotebody = $Note->getNotebody();
            $aAuthor = $Note->getAuthor();
            $aCdatetime = $Note->getCdatetime();
            $aLastedited = $Note->getLastedited();
            $aNumofchar = $Note->getNumofchar();
            $aId = $Note->getId();

            $stmh->bindParam(':subjectline', $aSubjectline);
            $stmh->bindParam(':notebody', $aNotebody);
            $stmh->bindParam(':author', $aAuthor);
            $stmh->bindParam(':cdatetime', $aCdatetime);
            $stmh->bindParam(':lastedited', $aLastedited);
            $stmh->bindParam(':numofchar', $aNumofchar);
            $stmh->bindParam(':id', $aId);
            return $stmh->execute();
        } else {
            //Insert
            $stmh = $this->db->prepare("insert into Notes (Subjectline, Notebody, Author, Cdatetime, Lastedited, Numofchar) values (:subjectline, :notebody, :author, :cdatetime, :lastedited, :numofchar)");
            $aSubjectline = $Note->getSubjectline();
            $aNotebody = $Note->getNotebody();
            $aAuthor = $Note->getAuthor();
            $aCdatetime = $Note->getCdatetime();
            $aLastedited = $Note->getLastedited();
            $aNumofchar = $Note->getNumofchar();
            $stmh->bindParam(':subjectline', $aSubjectline);
            $stmh->bindParam(':notebody', $aNotebody);
            $stmh->bindParam(':author', $aAuthor);
            $stmh->bindParam(':cdatetime', $aCdatetime);
            $stmh->bindParam(':lastedited', $aLastedited);
            $stmh->bindParam(':numofchar', $aNumofchar);
            return $stmh->execute();
        } 

        /*$dataArray = $this->getAllNotes();
        $dataArray[$Note->getId()] = $Note;
        $serialData = serialize($dataArray);
        file_put_contents($this->fileName, $serialData);
        */
    }

    public function getAllNotes()
    {    
        $NoteList = array();
        $result = $this->db->query('SELECT * FROM Notes');
        foreach($result as $row) {
            $aNote = new Note();
            $aNote->setSubjectline($row['Subjectline']);
            $aNote->setNotebody($row['Notebody']);
            $aNote->setAuthor($row['Author']);
            $aNote->setCdatetime($row['Cdatetime']);
            $aNote->setLastedited($row['Lastedited']);
            $aNote->setNumofchar($row['Numofchar']);
            $aNote->setId($row['Id']);
            $NoteList[$aNote->getId()] = $aNote;
        }
        return $NoteList;
    }

    public function getNoteById($id)
    {
        $stmh = $this->db->prepare("SELECT * from Notes WHERE Id = :id");
        $sid = intval($id);
        $stmh->bindParam(':id', $sid);
        $stmh->execute();
        $stmh->setFetchMode(\PDO::FETCH_ASSOC);

        if ($row = $stmh->fetch()) {
            $aNote = new Note();
            $aNote->setId($row['Id']);
            $aNote->setSubjectline($row['Subjectline']);
            $aNote->setNotebody($row['Notebody']);
            $aNote->setAuthor($row['Author']);
            $aNote->setCdatetime($row['Cdatetime']);
            $aNote->setLastedited($row['Lastedited']);
            $aNote->setNumofchar($row['Numofchar']);
            return $aNote;
        } else {
            return new Note();
        }
       
    }

    public function deleteNote($NoteId)
    {
      $stmh = $this->db->prepare("DELETE FROM Notes WHERE id = :id");
        $stmh->bindParam(':id', intval($NoteId));
        return $stmh->execute();
    }

}