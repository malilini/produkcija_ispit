<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'classes/database.php';

$db = new Database();

$unosi = $db->get_unosi();

$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['tekst'])) {
        $message = 'Molim unesi tekst!';
    
    } else {

        $db->create_unos($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naslovna</title>
</head>
    <body>

        <h3>Moja aplikacija za produkciju</h3>
        <h6>Ispit 23.4.2021.</h6>
        <br><br>

        <div>
            <?php if(!empty($message)) {echo $message; } ?>
                <form method="POST">
                    <input type="text" name="tekst" placeholder="Unesi neki tekst"><br><br>
                    <input type="submit" value="Spremi">
                </form>     
        </div>
        <hr>  
        <br><br>

        <h3> Ispis teksta</h3>
        <table border="1">
            <tr>
                <th>#</th>
                <th>Tekst</th>
                <th colspan="2">Akcije</th>
            </tr>
                <?php if(!empty($unosi)): ?>
                    <?php foreach($unosi as $unos): ?>
                        <tr>
                            <td><?php echo $unos['id']; ?> </td>                        
                            <td><?php echo $unos['tekst']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $unos['id']; ?>">Ažuriraj</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $unos['id']; ?>">Izbriši</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
        </table>
        <br>
        <br>
        <br>
        Ovo je dodao predavač za provjeru implementacije i konfiguracije CI/CD dijela ispita.
    </body>
</html>
