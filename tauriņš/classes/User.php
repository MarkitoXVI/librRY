<?php

class User {
    public $id;
    public $name;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    function borrowBook($bookId) {
        
        global $conn;
    
        
        $sql = "SELECT availability FROM Books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();
    
        if ($book['availability']) {
            
            $sql = "UPDATE Books SET availability = 0 WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $bookId);
            $stmt->execute();
    
            $sql = "INSERT INTO BorrowedBooks (user_id, book_id, borrow_date) VALUES (?, ?, CURDATE())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $this->id, $bookId);
            $stmt->execute();
    
            echo "Grāmata ir veiksmīgi aizņemta!";
        } else {
            echo "Atvainojiet, šī grāmata šobrīd nav pieejama.";
        }
    }
    

    function returnBook($bookId) {
        function returnBook($bookId) {
            
            global $conn;
        
            
            $sql = "SELECT * FROM BorrowedBooks WHERE user_id = ? AND book_id = ? AND return_date IS NULL";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $this->id, $bookId);
            $stmt->execute();
            $result = $stmt->get_result();
            $borrow = $result->fetch_assoc();
        
            if ($borrow) {
               
                $sql = "UPDATE Books SET availability = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $bookId);
                $stmt->execute();
        
                $sql = "UPDATE BorrowedBooks SET return_date = CURDATE() WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $borrow['id']);
                $stmt->execute();
        
                echo "Grāmata ir veiksmīgi atgriezta!";
            } else {
                echo "Jūs neesat aizņēmies šo grāmatu.";
            }
        }
        
    }
}
