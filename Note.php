<?php
namespace gkushwah\p3;
class Note
{
    private $id;
    private $subjectline = '';
	private $notebody='';
    private $author = '';
	private $cdatetime = '';
	private $lastedited = '';
	private $numofchar = 0;

    public function __construct(){
        //$this->id = uniqid();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getSubjectline()
    {
        return $this->subjectline;
    }

    /**
     * @param string $subjectline
     */
    public function setSubjectline($subjectline)
    {
        $this->subjectline = $subjectline;
    }
	
	/**
     * @return string
     */
    public function getNotebody()
    {
        return $this->notebody;
    }	
	
	/**
     * @param string $notebody
     */
    public function setNotebody($notebody)
    {
        $this->notebody = $notebody;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $Author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getCdatetime()
    {
        return $this->cdatetime;
    }

    /**
     * @param string $Cdatetime
     */
    public function setCdatetime($cdatetime)
    {
        $this->cdatetime = $cdatetime;
    }
	
    /**
     * @return string
     */
    public function getLastedited()
    {
        return $this->lastedited;
    }

    /**
     * @param string $lastedited
     */
    public function setLastedited($lastedited)
    {
        $this->lastedited = $lastedited;
    }
	
    /**
     * @return string
     */
    public function getNumofchar()
    {
        return $this->numofchar;
    }

    /**
     * @param string $numofchar
     */
    public function setNumofchar($numofchar)
    {
        $this->numofchar = $numofchar;
    }
	
}