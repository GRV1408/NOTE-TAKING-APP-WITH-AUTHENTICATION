<?php
namespace gkushwah\p3;

interface INoteRepository
{
    public function saveNote($Note);
    public function getAllNotes();
    public function getNoteById($id);
    public function deleteNote($NoteId);
}