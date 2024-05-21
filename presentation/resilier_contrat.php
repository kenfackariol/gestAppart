<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier contrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Resilier Contrat</h1><br>
<form method="post" action="../traitement/resiliation_contrat.php">
<br><br><br>
  <label for="numContrat">Choisir le contrat à résilier :</label>
  <select name="numContrat" id="numContrat" required class="form-control">
                    <option value=""></option>
                                <?php
                                // Chemin du fichier XML
                             $xmlFile = '../donnees/gesap.xml';

                               // Charger le fichier XML
                             $xml = simplexml_load_file($xmlFile);

                               // Parcourir les éléments TARIF du fichier XML
                             foreach ($xml->CONTRATS->CONTRAT as $contrat) {
                             $NumContrat = $contrat->NumContrat;
                             $Etat = $contrat->Etat;
                             $DateCreation = $contrat->DateCreation;
                             $DateDebut = $contrat->DateDebut;
                             $Datefin = $contrat->Datefin;
                             $NumLocation = $contrat->NumLocation;
                             $NumLocataire = $contrat->NumLocataire;
                             echo '<option value="' . $NumContrat . '">' . ' Etat='.$Etat.' DateCreation='.$DateCreation. ' DateDebut='.$DateDebut.' DateFin='.$Datefin.' NumLocation='.$NumLocation.' NumLocataire='.$NumLocataire. ' </option>';
                              }

                                ?></select>
<br>
  <input type="submit" class="btn btn-success form-control" value="Résilier le contrat">
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>