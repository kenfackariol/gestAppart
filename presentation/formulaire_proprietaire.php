<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un propriétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Création de Propriétaire</h1><br>
<form method="post" action="../traitement/ajout_proprietaire.php" style="font-family: cursive;">
  <label for="nom">Nom :</label>
  <input type="text" class="form-control" id="nom" name="nom" required>

  <label for="prenom">Prénom :</label>
  <input type="text" class="form-control" id="prenom" name="prenom" required>

  <label for="adresse1">Adresse :</label>
  <input type="text" class="form-control" id="adresse1" name="adresse1" required>

  <label for="adresse2">Complément d'adresse :</label>
  <input type="text" class="form-control" id="adresse2" name="adresse2">

  <label for="codePostal">Code postal :</label>
  <input type="text" class="form-control" id="codePostal" name="codePostal" required>

  <label for="ville">Ville :</label>
  <input type="text" class="form-control" id="ville" name="ville" required>

  <label for="numTel1">Numéro de téléphone 1 :</label>
  <input type="text" class="form-control" id="numTel1" name="numTel1" required>

  <label for="numTel2">Numéro de téléphone 2 :</label>
  <input type="text" class="form-control" id="numTel2" name="numTel2">

  <label for="email">Email :</label>
  <input type="email" class="form-control" id="email" name="email" required>

  <label for="caCumule">Chiffre d'affaires cumulé :</label>
  <input type="number" class="form-control" id="caCumule" name="caCumule" step="0.01" required>
<br>
  <input type="submit" class="btn btn-success form-control" value="Créer"><br><br>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
</body>
</html>