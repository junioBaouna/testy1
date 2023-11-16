<!-- confirmation.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Confirmation</title>
</head>
<body>
    <?php
    // var_dump($_POST);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Initialisez le tableau d'adresses en dehors de la boucle
       $addresses = [];
       $conn = getDbConnection();

      // Boucle pour récupérer et afficher les adresses
      for ($i = 1; $i <= $_POST['num_addresses']; $i++) {
       $addresses[] = [
        'street' => $_POST['street_' . $i],
        'street_nb' => $_POST['street_nb_' . $i],
        'type' => $_POST['type_' . $i],
        'city' => $_POST['city_' . $i],
        'zipcode' => $_POST['zipcode_' . $i],
         ];

            //POUR Enregistrer des données dans la base de données
            saveToDatabase($conn, $addresses[$i - 1]);

            // Affichage des données
            echo "<p>";
            foreach ($addresses[$i - 1] as $key => $value) {
                echo "<div><strong>$key:</strong> $value </div> ";
            }
            echo "</p>";
        }

        // Formulaire pour valider les adresses
        echo '<form action="validate_addresses.php" method="post">';
        echo '<input type="hidden" name="num_addresses" value="' . $_POST['num_addresses'] . '">';
        echo '<button type="submit">Valider les adresses</button></form>';

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        // Si la méthode de requête n'est pas POST, redirige vers la page d'accueil
        header("Location: index.php");
        exit();
    }

    // Fonction pour enregistrer les données dans la base de données
    function saveToDatabase($conn, $address) {
        $street = $conn->real_escape_string($address['street']);
        $street_nb = $conn->real_escape_string($address['street_nb']);
        $type = $conn->real_escape_string($address['type']);
        $city = $conn->real_escape_string($address['city']);
        $zipcode = $conn->real_escape_string($address['zipcode']);

        insertInstanceIntoTable($conn, $street, $street_nb, $type, $city, $zipcode);
    }

    // Récupérer la connexion à la base de données
    function getDbConnection() {
        $conn = new mysqli("localhost", "root", "", "ecom1_tp2");

        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

        return $conn;
    }

    function insertInstanceIntoTable($conn, $street, $street_nb, $type, $city, $zipcode) {
        $sql = "INSERT INTO address (street, street_nb, type, city, zipcode) VALUES ('$street', '$street_nb', '$type', '$city', '$zipcode')";

        if ($conn->query($sql) !== TRUE) {
            echo "Erreur lors de l'insertion dans la base de données : " . $conn->error;
        } 
    }
    ?>
</body>
</html>