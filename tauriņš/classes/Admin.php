<?php
require_once('DBConnection.php');

class Admin extends DBConnection {
    // Funkcija, lai pievienotu jaunu grāmatu
    public function addBook($title, $author, $publication_year) {
        $query = "INSERT INTO books (title, author, publication_year) VALUES (:title, :author, :publication_year)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':title' => $title, ':author' => $author, ':publication_year' => $publication_year));
        return $stmt->rowCount();
    }

    // Funkcija, lai dzēstu grāmatu
    public function deleteBook($book_id) {
        $query = "DELETE FROM books WHERE id = :book_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':book_id' => $book_id));
        return $stmt->rowCount();
    }

    // Funkcija, lai rediģētu grāmatas informāciju
    public function editBook($book_id, $title, $author, $publication_year) {
        $query = "UPDATE books SET title = :title, author = :author, publication_year = :publication_year WHERE id = :book_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':book_id' => $book_id, ':title' => $title, ':author' => $author, ':publication_year' => $publication_year));
        return $stmt->rowCount();
    }


}
?>
