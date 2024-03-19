// Iegūstam pieteikšanās formas datus
const username = document.getElementById("username").value;
const password = document.getElementById("password").value;

// Veicam AJAX pieprasījumu uz serveri
const xhr = new XMLHttpRequest();
xhr.open("POST", "checkLogin.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onload = function() {
    if (xhr.status === 200) {
        // Pārbaudam, vai atbilde no servera ir "success"
        if (xhr.responseText === "success") {
            // Ja pieteikšanās ir veiksmīga, redirektējam uz galveno lapu
            window.location.href = "index.php";
        } else {
            // Ja pieteikšanās nav veiksmīga, izvadam kļūdas ziņojumu
            alert("Nepareizi pieteikšanās dati!");
        }
    } else {
        // Ja sanāca kļūda, izvadam kļūdas ziņojumu
        alert("Kļūda! Nevar sazināties ar serveri.");
    }
};

// Sūtam datus uz serveri
xhr.send("username=" + username + "&password=" + password);
