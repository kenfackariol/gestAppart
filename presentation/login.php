<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
    session_start();
    $login=$_POST['nom'];
    $mots=$_POST['pass'];
    /*include "../donnees/Connexion.php";

    $reponse=$bdd->query('SELECT nom, mot_de_passe FROM utilisateur');

   
    
    while($donne=$reponse->fetch()){
        // $_SESSION['utilisateur']=$donne['id_utilisateur'];
        if($login==$donne['nom'] && $mots==$donne['mot_de_passe'] )  {
            $_SESSION['nom']=$donne['nom'];
            
            //header('location:index.php');
          
            header('location:index_accueil.php');

         }else{
   
            $_SESSION['erreur']="<div class='alert alert-warning'  role='alert'>Mot de passe ou nom d'utilisateur incorrect...</div>";
            header('location:index.php');
         }
    }
        $reponse->closecursor();*/

        //require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

foreach ($xml->UTILISATEURS->UTILISATEUR as $utilisateur) {

    if ($utilisateur->nom == $login && $utilisateur->mot_de_passe==$mots) {

        $_SESSION['nom']=$utilisateur->nom;
      
        header('location:index_accueil.php');

    exit();
    }
}

$_SESSION['erreur']="<div class='alert alert-warning'  role='alert'>Mot de passe ou nom d'utilisateur incorrect...</div>";
header('location:index.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      