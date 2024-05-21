<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un appartement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Création d'Appartement</h1><br>
<form method="post" action="../traitement/ajout_appartement.php" enctype="multipart/form-data">
  <label for="categorie">Catégorie :</label>
  <input type="text" class="form-control" id="categorie" name="categorie" required>

  <label for="type">Type :</label>
  <input type="text" class="form-control" id="type" name="type" required>

  <label for="nbPersonnes">Nombre de personnes :</label>
  <input type="number" class="form-control" id="nbPersonnes" name="nbPersonnes" required>

  <label for="adresseLocation">Adresse de la location :</label>
  <input type="text" class="form-control" id="adresseLocation" name="adresseLocation" required>

  <label for="photo">Photo :</label>
  <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
    <!-- Restreindre le choix au dossier spécifique -->
    <input type="hidden" name="imagePath" value="images" />

  <label for="equipements">Équipements :</label>
  <input type="text" class="form-control" id="equipements" name="equipements" required>

  <label for="codeTarif">Choisir le tarif :</label>
  <!--input type="number" class="form-control" id="codeTarif" name="codeTarif" required-->
  <select name="codeTarif" id="codeTarif" required class="form-control">
                    <option value=""></option>
                                <?php
                                    // Chemin du fichier XML
                                 $xmlFile = '../donnees/gesap.xml';

                                   // Charger le fichier XML
                                 $xml = simplexml_load_file($xmlFile);

                                   // Parcourir les éléments TARIF du fichier XML
                                 foreach ($xml->TARIFS->TARIF as $tarif) {
                                 $codeTarif = $tarif->CodeTarif;
                                 $prixSemHS = $tarif->PrixsemHS;
                                 $prixSemBS = $tarif->PrixSemBS;
                                 echo '<option value="' . $codeTarif . '">'.' PrixSemHS='.$prixSemHS.' PrixSemBS='.$prixSemHS. '</option>';
                                  }

                                ?></select>

  <label for="num">Choisir le propriétaire :</label>
  <!--input type="text" class="form-control" id="nom" name="nom" required-->
  <select name="num" id="num" required class="form-control">
                    <option value=""></option>
                                <?php
                                    // Chemin du fichier XML
                                    $xmlFile = '../donnees/gesap.xml';

                                    // Charger le fichier XML
                                  $xml = simplexml_load_file($xmlFile);
 
                                    // Parcourir les éléments TARIF du fichier XML
                                  foreach ($xml->PROPRIETAIRES->PROPRIETAIRE as $proprietaire) {
                                  $numproprio = $proprietaire->Num;
                                  $nomproprio = $proprietaire->Nom;
                                  $prenomproprio = $proprietaire->Prenom;

                                  echo '<option value="' . $numproprio . '">' .$nomproprio.' '.$prenomproprio. '</option>';
                                   }

                                ?></select>

  <br>

  <input type="submit" class="btn btn-success form-control" value="Créer"><br><br>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>