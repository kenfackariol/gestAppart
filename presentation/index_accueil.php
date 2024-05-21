<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Gestion des Appartements</title>
    <link rel="shortcut icon" href="images/LogoAppart1.png" type="image/png">
    <link rel="stylesheet" href="styles/style_Accueil1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="file:///E:/fontawesome/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  </head> 
  <body>
    <nav>
      <div class="logo" data-tilt><img src="images/LogoAppart1.png" alt="logo" width="105px" height="52px"></div>
      <label for="btn" class="icon">
        <span class="fa fa-bars"></span>
      </label>
      <input type="checkbox" id="btn">
      <ul>
        <li><a href="#" onclick="loadIframe('msg_bienvenue.php')">Accueil</a></li>
        <li>
          <label for="btn-1" class="show">Structure +</label>
          <a href="#">Structure</a>
          <input type="checkbox" id="btn-1">
          <ul>            
            <li><a href="#" onclick="loadIframe('formulaire_proprietaire.php')">Créer Propriétaire</a></li>
            <li><a href="#" onclick="loadIframe('formulaire_tarif.php')">Créer Tarif</a></li>
            <li><a href="#" onclick="loadIframe('formulaire_appartement.php')">Créer Appartement</a></li>
            <li><a href="#" onclick="loadIframe('formulaire_locataire.php')">Créer Locataire</a></li>
          </ul>
        </li>

        <li>
          <label for="btn-2" class="show">Traitement +</label>
          <a href="#">Traitement</a>
          <input type="checkbox" id="btn-2">
          <ul>
            <li><a href="#" onclick="loadIframe('passer_contrat.php')">Passer Contrat</a></li>
            <li><a href="#" onclick="loadIframe('modifier_contrat.php')">Modifier Contrat</a></li>
            <li><a href="#" onclick="loadIframe('resilier_contrat.php')">Résilier Contrat</a></li>             
            <li><a href="#" onclick="loadIframe('liste_proprietaires.php')">Rechercher Proprio</a></li>
            <li><a href="#" onclick="loadIframe('liste_locataires.php')">Rechercher locataire</a></li>            
          </ul>
        </li>

        <li>
          <label for="btn-3" class="show">Modification +</label>
          <a href="#">Modification</a>
          <input type="checkbox" id="btn-3">
          <ul>            
            <li><a href="#" onclick="loadIframe('liste_appartements.php')">Modifier Appart</a></li> 
            <li><a href="#" onclick="loadIframe('modification_proprietaires.php')">Modifier Proprio</a></li>
            <li><a href="#" onclick="loadIframe('modification_locataires.php')">Modifier Locataire</a></li>
            <li><a href="#" onclick="loadIframe('modification_tarifs.php')">Modifier Tarif</a></li>                   
          </ul>
        </li>

        <li>
          <label for="btn-4" class="show">Impression +</label>
          <a href="#">Impression</a>
          <input type="checkbox" id="btn-4">
          <ul>
            <li><a href="#" onclick="loadIframe('../traitement/imprimer_liste_locataires.php')">Liste Locataires</a></li>
            <li><a href="#" onclick="loadIframe('../traitement/imprimer_liste_proprietaires.php')">Liste Propriétaires</a></li>
            <li><a href="#" onclick="loadIframe('../traitement/imprimer_liste_appartements.php')">Liste Appartements</a></li>    
            <li><a href="#" onclick="loadIframe('../presentation/formulaire_contrat.php')">Contrat</a></li>         
          </ul>
        </li>
        <!--   <li>
          <label for="btn-2" class="show">Services +</label>
          <a href="#">Services</a>
          <input type="checkbox" id="btn-2">
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">App Design</a></li>
            <li>
              <label for="btn-3" class="show">More +</label>
              <a href="#">More <span class="fa fa-plus"></span></a>
              <input type="checkbox" id="btn-3">
              <ul>
                <li><a href="#">Submenu-1</a></li>
                <li><a href="#">Submenu-2</a></li>
                <li><a href="#">Submenu-3</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Contact</a></li>
        -->
      </ul>
    </nav>
    <div class="content">      
      <iframe id="charge_pages" src="msg_bienvenue.php"> </iframe>          
    </div>
    <div class="image">      
      <img src="images/Img1.png" alt="image">   
    </div>
   
	<script src='scripts/loadIframe.js'></script>
	<script src='scripts/toggleMenu.js'></script>
  <script src='scripts/vanilla-tilt.js'></script>

    

  </body>
</html>
