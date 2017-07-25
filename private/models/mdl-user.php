<?php

define("TABLE_USERS", "users");

/** User Exists
 * Controle l'existance d'un utilisateur en base de doonée
 * (Basé sur l'adresse email)
 * et retourne un booléen (TRUE si l'utilisateur existe)
 * @param (string) $email
 */
function userExists($email) {
    global $pdo; // appel de la base de données
    $q = "SELECT id FROM `".TABLE_USERS."` WHERE email=:email"; // requète
    $q = $pdo->prepare($q);
    $q->bindValue(":email", $email, PDO::PARAM_STR);
    $q->execute();
    return $q->fetch(PDO::FETCH_OBJ) ? true : false;
    //Si fetch repère une occurrence il envoie true. sinon il renvoie false :) 
}

function getUserByEmail($email) {
    global $pdo;
    $q = "SELECT id, firstname, lastname, email, roles, password FROM `".TABLE_USERS."` WHERE email=:email";
    $q = $pdo->prepare($q);
    $q->bindValue(":email", $email, PDO::PARAM_STR);
    $q->execute();
    return $q->fetch(PDO::FETCH_OBJ);
    //Si fetch repère une occurrence il envoie un objet. sinon il renvoie false :) 
}

/** Add User
 * Ajoute un utilisateur dans la BDD puis retourne l'id utilisateur en cas de
 * succès ou false en cas d'echec
 */
function addUser($params=[]) {
    global $pdo, $default_users_roles;
    $login      = isset($params['login']) ? $params['login'] : null;
    $password   = isset($params['password']) ? $params['password'] : null;
    $firstname  = isset($params['firstname']) ? $params['firstname'] : null;
    $lastname   = isset($params['lastname']) ? $params['lastname'] : null;
    $gender     = isset($params['gender']) ? $params['gender'] : null;
    $birthday   = isset($params['birthday']) ? $params['birthday'] : null;

    $q = "INSERT INTO `".TABLE_USERS."` (`firstname`,`lastname`,`roles`,`email`,`password`,`genre`,`birthday`,`signup_datetime`) VALUES (:firstname, :lastname, :roles, :email, :password, :gender, :birthday, NOW())";
    $q = $pdo->prepare($q);
    $q->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $q->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $q->bindValue(":roles", implode(ROLES_GLUE, $default_users_roles), PDO::PARAM_STR);
    $q->bindValue(":email", $login, PDO::PARAM_STR);
    $q->bindValue(":password", $password, PDO::PARAM_STR);
    $q->bindValue(":gender", $gender, PDO::PARAM_STR);
    $q->bindValue(":birthday", $birthday, PDO::PARAM_STR);
    $q->execute();
    $q->closeCursor(); //Supprime la requete de la mémoire de PDO.

    return $pdo->lastInsertId();
}