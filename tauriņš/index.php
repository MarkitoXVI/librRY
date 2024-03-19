<?php
// Savienojamies ar datubāzi un iekļaujam nepieciešamās klases un funkcijas
require_once('config.php');
require_once('Book.php');
require_once('User.php');
require_once('Admin.php');

// Izveidojam objektu, lai piekļūtu funkcijām
$book = new Book($pdo);
$user = new User($pdo);
$admin = new Admin($pdo);

// Parādām grāmatu katalogu
$books = $book->getAllBooks();

// Pārbaudam, vai ir izvēlēts lietotājs, un parādam atbilstošu saskarni
if ($loggedIn) {
    if ($user->isAdmin($loggedInUser)) {
        include('admin_panel.php'); // Iekļaujam administratora paneļa saskarni
    } else {
        include('user_panel.php'); // Iekļaujam lietotāja paneļa saskarni
    }
} else {
    include('login_form.php'); // Iekļaujam pieteikšanās formu
}
?>

<!-- Iekļaujam sadaļu grāmatu katalogam -->
<div class="book-catalog">
    <h2>Grāmatu katalogs</h2>
    <ul>
        <?php foreach ($books as $book) : ?>
            <li><?php echo $book['title']; ?> - <?php echo $book['author']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
