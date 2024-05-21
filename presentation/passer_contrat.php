<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer contrat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Passer Contrat</h1><br>
<form method="post" action="../traitement/ajout_contrat.php">

  <label for="etat">Etat :</label>
  <select name="etat" class="form-control" id="etat"  required>
  <option value="valide">valide</option>
  <option value="non valide">non valide</option>
  </select>

  <label for="dateCreation">Date de création :</label>
  <input type="date" class="form-control" id="dateCreation" name="dateCreation" required>

  <label for="dateDebut">Date de début :</label>
  <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>

  <label for="dateFin">Date de fin :</label>
  <input type="date" class="form-control" id="dateFin" name="dateFin" required>

  <label for="numLocation">Choisir l'appartement :</label>
  <!--<input type="number" class="form-control" id="numLocation" name="numLocation" required>-->
 <select name="numLocation" id="numLocation" required class="form-control">
                    <option value=""></option>
                    <?php
                                    // Chemin du fichier XML
                                 $xmlFile = '../donnees/gesap.xml';

                                   // Charger le fichier XML
                                 $xml = simplexml_load_file($xmlFile);

                                   // Parcourir les éléments TARIF du fichier XML
                                 foreach ($xml->APPARTEMENTS->APPARTEMENT as $appartement) {
                                 $NumLocation = $appartement->NumLocation;
                                 $Categorie = $appartement->Categorie;
                                 $Type = $appartement->Type;
                                 $NbPersonnes = $appartement->NbPersonnes;
                                 $AdresseLocation = $appartement->AdresseLocation;

                                 echo '<option value="' . $NumLocation . '">' .' Categorie='.$Categorie.' Type='.$Type. ' NbPersonnes='.$NbPersonnes.' AdresseLocation='.$AdresseLocation.' </option>';
                                  }

                                ?></select>

  <label for="numLocataire">Choisir le locataire :</label>
<select name="numLocataire" id="numLocataire" required class="form-control">
                    <option value=""></option>
                    <?php
                                    // Chemin du fichier XML
                                 $xmlFile = '../donnees/gesap.xml';

                                   // Charger le fichier XML
                                 $xml = simplexml_load_file($xmlFile);

                                   // Parcourir les éléments TARIF du fichier XML
                                 foreach ($xml->LOCATAIRES->LOCATAIRE as $locataire) {
                                 $NumLocataire = $locataire->NumLocataire;
                                 $nomLocataire = $locataire->NomLocataire;
                                 $prenomLocataire = $locataire->PrenomLocataire;

                                 echo '<option value="' . $NumLocataire . '">' .$nomLocataire.' '.$prenomLocataire.' </option>';
                                  }

                                ?></select>
<br>
  <input type="submit" class="btn btn-success form-control" value="Passer le contrat"><br><br>
</form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>