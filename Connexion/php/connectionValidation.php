<?php

session_start();

class LoginInformations {

    private $_userEmail;
    private $_userPassword;

    public function __construct(array $data) {

        $this->hydrate($data);

    }

    protected function hydrate(array $data) {

        /*
        * Vérification du nombre d'informations passées en paramètre (= au nombre d'attribut).
        */
        if (count($data) == 2) {

            foreach($data as $key => $value) {

                $method = "set".ucfirst($key);

                if (method_exists($this,$method)) {
                    $this->$method($value);
                }

            }

            return true;

        } else {

            return false;

        }

    }

    // Setters de la classe LoginInformations

    protected function setUserEmail($value) {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_userEmail = $value;

        }

    }

    protected function setUserPassword($value) {

        if(is_string($value) && strlen($value) <= 16) {

            $this->_userPassword = $value;

        }

    }

    // ==================================================

    // Getters de la classe LoginInformations

    public function getUserEmail() {

        return $this->_userEmail;

    }

    public function getUserPassword() {

        return $this->_userPassword;

    }

    // ==================================================

}


class DatabaseManager
{

    private $_dbConnection;

    // Constructeur de la classe

    public function __construct(PDO $connectionInformations)
    {

        $tmpDbConnection = $connectionInformations;
        $tmpDbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_dbConnection = $tmpDbConnection;

    }

    // Méthode permettant de vérifier qu'un utilisateur existe.

    public function checksBeforeConnection($userEmail)
    {

        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("SELECT * FROM Users WHERE mail_address = :userEmail");
        $tmpRes->bindValue(":userEmail", $userEmail);
        $tmpRes->execute();

        if ($tmpRes->fetch() != null) {

            $tmpRes->closeCursor();
            return true;

        } else {

            $tmpRes->closeCursor();
            return false;

        }

    }

    // Méthode permettant de récupérer les informations d'un utilisateur dans la base de données.

    public function getUserInformations($userEmail)
    {

        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("SELECT * FROM Users WHERE mail_address = :userEmail");
        $tmpRes->bindValue(":userEmail", $userEmail);
        $tmpRes->execute();

        $output = $tmpRes->fetch(PDO::FETCH_ASSOC);

        $listToUse = [];

        foreach ($output as $key => $value) {
            $listToUse[$key] = $value;
        }

        return $listToUse;

    }

}


if (isset($_POST['email']) & isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $dataList = [
        'userEmail' => $email,
        'userPassword' => $password
    ];

    // Informations de connexion à la base de données :
    $db = new PDO("mysql:host=localhost;dbname=dendo_jitensha","iris1","password1");
    $dbConnection = new DatabaseManager($db);

    $connectionInformations = new LoginInformations($dataList);

    if ($dbConnection->checksBeforeConnection($connectionInformations->getUserEmail())) {

        $res = $dbConnection->getUserInformations($connectionInformations->getUserEmail());

        if (password_verify($connectionInformations->getUserPassword(),$res['password'])) {

            $_SESSION['idUser'] = $res['id_user'];
            $_SESSION['lastName'] = $res['lastname'];
            $_SESSION['firstName'] = $res['firstname'];
            $_SESSION['userEmail'] = $res['mail_address'];

            header("location:../../Profil/profil.php");

        } else {

            echo "<p>Le mot de passe est incorrect !</p>";
            echo "<p> <a href=\"../connection.html\"> > Retourner au formulaire de connexion </a> </p>";

        }

    } else {

        echo "<p>L'espace personnel n'existe pas !</p>";
        echo "<p> <a href=\"../connection.html\"> > Retourner au formulaire de connexion </a> </p>";
        echo "<p> <a href=\"../../Inscription/registration.html\"> > S'inscrire </a> </p>";

    }

} else {
    header("location:../connection.html");
}
