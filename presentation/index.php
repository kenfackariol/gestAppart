<?php
    session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Gestion_Appart</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
  </head>
  <style>
  html {
  height: 100%;
}
body {
  margin: 0;
  padding: 0;
  font-family: cursive;
  background-color: rgba(0, 255, 255, 0.082);  
}
.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
 
  width: 400px;
  padding: 40px;
  background-color: black;
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
  border-radius: 10px;
}
 
.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}
 
.login-box .user-box {
  position: relative;
}
 
.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid white;
  outline: none;
  background: transparent;
}
 
.login-box .user-box label {
  position: absolute;
  top: 0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: 0.5s;
}
 
.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03e9f4;
  font-size: 12px;
  
}
 
.login-box form a {
  text-decoration: none;
  text-transform: uppercase;
  color: #03e9f4;
  position: relative;
  padding: 10px;
  transition: 0.5s;
  margin-top: 40px;
  letter-spacing: 4px;
  overflow: hidden;
  display: inline-block; 
 
}
.login-box form a:hover {
  background-color: #03e9f4;
  color: white;
  box-shadow: 0 0 10px  #03e9f4 ,0 0 20px #03e9f4 ,0 0 50px  #03e9f4 ,0 0 100px  #03e9f4;
  border: 1px #f7f7f7;
 
}
 
.login-box form a span {
  position: absolute;
}
 
 
.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  height: 2px;
  width: 100%;
  background: linear-gradient(90deg, transparent, #03e9f4);
  animation: spanTOP 1s linear infinite
}
@keyframes spanTOP {
  0% {
    left: -100%;
  }
  50%,
  100% {
    left: 100%;
  }
  
}
.login-box a span:nth-child(2) {
  right: 0;
  top: -100%;
  height: 100%;
  width: 2px;
  background: linear-gradient(180deg, transparent, #03e9f4);
  animation: spanRight 1s linear infinite;
  animation-delay: 0.25s;
}
@keyframes spanRight {
  0% {
    top: -100%;
  }
  50%,
  100% {
    top: 100%;
  }
  
}
.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  height: 2px;
  width: 100%;
  background: linear-gradient(270deg, transparent, #03e9f4);
  animation: spanBottom 1s linear infinite;
  animation-delay: 0.50s;
}
@keyframes spanBottom {
  0% {
    right: -100%;
  }
  50%,
  100% {
    right: 100%;
  }
  
}
 
.login-box a span:nth-child(4) {
  left: 0;
  bottom: -100%;
  height: 100%;
  width: 2px;
  background: linear-gradient(0deg, transparent, #03e9f4);
  animation: spanLeft 1s linear infinite;
  animation-delay: 0.70s;
}
@keyframes spanLeft {
  0% {
    bottom: -100%;
  }
  50%,
  100% {
    bottom: 100%;
  }
  
}
 #nom_manquant{
 	position : relative;
     top: -25px;
}
#mdp_manquant{
	position : relative;
	top: -20px;
}
  </style>
  <body>    
    <div class="login-box">
      <h2>Authentification</h2>
      <form method="post" action="login.php" >
        <div class="user-box">
          <input type="text" id="username" class="form-control" name="nom" required="" autocomplete="off"/>
          <label for="username">Nom d'utilisateur </label>
          <span id="nom_manquant"> </span>
        </div>
        <div class="user-box">
          <input type="password" id="password" class="form-control" name="pass" required=""/>
          <label for="password">Mot de passe </label>
         <span id="mdp_manquant"> </span>
     </div>

       
   <!-- <i id="bouton_envoi">  Se connecter</i> -->
       <button type="submit" class="btn btn-success form-control">se connecter</button><br><br><br>

       <?php
     if(isset($_SESSION['erreur'])){
      echo $_SESSION['erreur'];
      UNSET($_SESSION['erreur']);
     }

      ?>
      </form>
    </div>
    <script src='scripts/vanilla-tilt.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>      
</body>
</html>
<script type="text/javascript">
var validation = document.getElementById("bouton_envoi");
var nom = document.getElementById("username");
var mdp = document.getElementById("password");
var mdp_manq= document.getElementById("mdp_manquant");
var nom_manq= document.getElementById("nom_manquant");
var nom_valid= /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï])?/;
var mdp_valid=/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
validation.addEventListener("click", f_valid);
function f_valid(e){
	if(nom.validity.valueMissing){
		e.preventDefault();
		nom_manq.textContent = "Le nom ne peut pas être vide";
		nom_manq.style.color="red";
	}
	else if(nom.length<3 || nom.length>12){
		nom_manq.textContent = "Le nom ne peux pas être court ou très long";
		nom_manq.style.color = 'red';
	}
	else if(nom_valid.test(nom.value) == false) {
		event.preventDefault();
		nom_manq.textContent = "Nous n\'acceptons pas ce type de nom";
		nom_manq.style.color= 'orange';
	}
	else if(mdp.validity.valueMissing){
		e.preventDefault();
		mdp_manq.textContent = "Le mot de passe ne peut pas être vide";
		mdp_manq.style.color = 'red';
	}
	else if(mdp_valid.test(mdp.value) == false) {
		event.preventDefault();
		mdp_manq.textContent = "Nous n\'acceptons pas un mot de passe faible";
		mdp_manq.style.color= 'orange';
	}
	else{
	nom_manq.textContent = "Ce champ es valide";
	nom_manq.style.color = 'green';
	mdp_manq.textContent = "Ce champ es valide";
	mdp_manq.style.color = 'green';
	}
}

</script>