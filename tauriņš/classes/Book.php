<?php
require_once('DBConnection.php');

class Book extends DBConnection {
    // Funkcija, lai iegūtu visus pieejamos grāmatas
    public function getAllBooks() {
        $query = "SELECT * FROM books";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Funkcija, lai aizņemtu grāmatu
    public function borrowBook($user_id, $book_id, $borrow_date, $return_date) {
        $query = "INSERT INTO borrowings (user_id, book_id, borrow_date, return_date) VALUES (:user_id, :book_id, :borrow_date, :return_date)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':user_id' => $user_id, ':book_id' => $book_id, ':borrow_date' => $borrow_date, ':return_date' => $return_date));
        // Ja vēlaties atjaunot grāmatas pieejamību pēc aizņemšanas, šeit varat veikt atbilstošus grozījumus
        return $stmt->rowCount();
    }

    // Funkcija, lai atgrieztu grāmatu
    public function returnBook($borrow_id) {
        $query = "UPDATE borrowings SET status = 'returned' WHERE id = :borrow_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(':borrow_id' => $borrow_id));
        // Ja vēlaties atjaunot grāmatas pieejamību pēc atgriešanas, šeit varat veikt atbilstošus grozījumus
        return $stmt->rowCount();
    }

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
