<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un locataire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Création de Locataire</h1><br>
    
<form method="post" action="../traitement/ajout_locataire.php">
  <label for="nomLocataire">Nom :</label>
  <input type="text" class="form-control" id="nomLocataire" name="nomLocataire" required>

  <label for="prenomLocataire">Prénom :</label>
  <input type="text" class="form-control" id="prenomLocataire" name="prenomLocataire" required>

  <label for="adresse1Locataire">Adresse 1 :</label>
  <input type="text" class="form-control" id="adresse1Locataire" name="adresse1Locataire" required>

  <label for="adresse2Locataire">Adresse 2 :</label>
  <input type="text" class="form-control" id="adresse2Locataire" name="adresse2Locataire">

  <label for="codePostalLocataire">Code postal :</label>
  <input type="text" class="form-control" id="codePostalLocataire" name="codePostalLocataire" required>

  <label for="villeLocataire">Ville :</label>
  <input type="text" class="form-control" id="villeLocataire" name="villeLocataire" required>

  <label for="numTel2Locataire">Numéro de téléphone 2 :</label>
  <input type="tel" class="form-control" id="numTel2Locataire" name="numTel2Locataire">

  <label for="numTel1Locataire">Numéro de téléphone 1 :</label>
  <input type="tel" class="form-control" id="numTel1Locataire" name="numTel1Locataire" required>

  <label for="emailLocataire">E-mail :</label>
  <input type="email" class="form-control" id="emailLocataire" name="emailLocataire" required>
<br>
  <input type="submit" class="btn btn-success form-control" value="Créer"><br><br>
</form>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>