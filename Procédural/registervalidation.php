<?php {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
}
    


//function VerifierAdresseMail($email) {
//   return (!preg_match( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) ? false : true;
//}

function check_mdp_format($mdp) {
    $majuscule = preg_match('@[A-Z]@', $mdp);
    $minuscule = preg_match('@[a-z]@', $mdp);
    $chiffre = preg_match('@[0-9]@', $mdp);
    
    if (!$majuscule or !$minuscule or !$chiffre or strlen($mdp) < 8) {
        return false;
    }
    else {
        return true;
    }
}


if(isset($_POST['submit'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $email=htmlspecialchars($_POST['mail']);
    $pass1=htmlspecialchars($_POST['password']);
    $pass2=htmlspecialchars($_POST['password2']);
    if(empty($_POST['nom'])){//le champ nom est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "<script>alert(\"Le nom n'est pas renseigné\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif(empty($_POST['prenom'])){//le champ prenom est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "<script>alert(\"Le prénom n'est pas renseigné\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif(empty($_POST['adresse'])){//le champ prenom est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "<script>alert(\"Votre adresse n'est pas renseignée\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif(empty($_POST['mail'])){//le champ adresse est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "<script>alert(\"L'adresse mail n'est pas renseignée\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif(empty($_POST['password'])){//le champ prenom est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "<script>alert(\"Le mot de passe n'est pas renseigné\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
        echo "<script>alert(\"{$email} n'est pas une adresse email valide\")</script>";
        header("Refresh: 0;URL=register.html"); 
    }
    
    
    elseif(check_mdp_format($_POST['password'])==false){//le champ mot de passe n'est pas conforme
        echo "<script>alert(\"Format du mot de passe incorrect \")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    } elseif($pass1!=$pass2){//on vérifie les mots de passe correspondent
        echo "<script>alert(\"Les mots de passe ne sont pas identiques\")</script>";
        header("Refresh: 0;URL=register.html"); 
        
    }
    else { //tous les champs sont correctes
        $hash=password_hash(($_POST['password']), PASSWORD_DEFAULT); //Hashage du mot de passe
        
        include 'connection_db.php';
        
        $Nouvel_Utilisateur = $connection->prepare('INSERT INTO Utilisateurs (nomUtilsateur, prenomUtilisateur, adresseUtilisateur, emailUtilisateur, passwordUtilisateur) VALUES (:Nom, :Prenom, :Adresse, :Mail, :MDP)');
        $Nouvel_Utilisateur->execute(array('Nom' => $nom, 'Prenom' => $prenom, 'Adresse' => $adresse, 'Mail' => $email, 'MDP' => $hash));
        
        $Nouvel_Utilisateur->closeCursor();

        echo "<script>alert(\"Enregistrement effectué, vous allez être redirigé sur la page de connexion\")</script>";
        header("Refresh: 0;URL=connexion.php"); //redirection sur la page de connexion
    }
}

?>
