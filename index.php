<!-- index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Adresse Form</title>
</head>
<body>
    <!-- Formulaire initial pour demander le nombre d'adresses -->
    <form action="address_form.php" method="post">
        <label for="num_addresses">veuillez saisir le nombre d'adresses ?</label>
        <input type="number" name="num_addresses" required>
        <button type="submit">Continuer</button>
    </form>
</body>
</html>