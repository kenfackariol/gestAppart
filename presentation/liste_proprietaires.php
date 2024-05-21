
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des proprietaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style> body{ font-family: cursive;} </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Rechercher Propriétaire</h1><br>
<form method="POST" action="">

    <div class="form-group">
        <label for="rechercher"></label>
        <input type="text" class="form-control" id="rechercher" name="rechercher" placeholder="Rechercher un proprietaire selon le nom..." >
    </div>

</form>
</div>
</div>
</div>
<br>
<br>
<h2>Liste des proprietaires</h2>

<?php
// Charger le contenu du fichier XML

$xmlFile = '../donnees/gesap.xml';

            // Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Récupérer tous les locataires
$proprietaires = $xml->PROPRIETAIRES->PROPRIETAIRE;

// Afficher le tableau
echo '<table class="table table-striped" id="tableau">';
echo '<tr><th>Numéro Propriétaire</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Code Postal</th><th>Ville</th><th>Numéro de Téléphone</th><th>Email</th><th>Action</th></tr>';

foreach ($proprietaires as $proprietaire) {
    $num = $proprietaire->Num;
    $nom = $proprietaire->Nom;
    $prenom = $proprietaire->Prenom;
    $adresse = $proprietaire->Adresse1;
    $codePostal = $proprietaire->CodePostal;
    $ville = $proprietaire->Ville;
    $telephone = $proprietaire->NumTel1;
    $email = $proprietaire->Email;

    echo '<tr>';
    echo "<td>$num</td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$adresse</td>";
    echo "<td>$codePostal</td>";
    echo "<td>$ville</td>";
    echo "<td>$telephone</td>";
    echo "<td>$email</td>";
    echo "<td><a class='btn btn-primary' href='../traitement/voir_appartement.php?num=$num'>Voir le(s) appartement(s)</a></td>";
    echo '</tr>';
}

echo '</table>';
?>

</tbody>
</table>
</div>
</div>
</div>
<script>
// Récupérer l'élément de recherche
var searchInput = document.getElementById("rechercher");

// Ajouter un gestionnaire d'événements pour détecter les changements dans la barre de recherche
searchInput.addEventListener("input", function(event) {
  var searchTerm = event.target.value.toLowerCase(); // Convertir la saisie en minuscules pour une recherche insensible à la casse
  var tableau=document.getElementById("tableau");
  // Parcourir chaque ligne du tableau et afficher/masquer en fonction de la correspondance avec le terme de recherche
  for (var i = 0; i < tableau.rows.length; i++) {
    var row = tableau.rows[i];
    var name = row.cells[1].textContent.toLowerCase(); // Supposer que le nom du locataire est dans la deuxième cellule
    
    if (name.includes(searchTerm)) {
      row.style.display = ""; // Afficher la ligne si le terme de recherche est inclus dans le nom
    } else {
      row.style.display = "none"; // Masquer la ligne sinon
    }
  }
});

</script>
<!-- Ajout du CDN de Bootstrap 5 pour les scripts Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
