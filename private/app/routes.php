<?php

// On définit la liste des pages du site
$router = [
// NOM DE LA ROUTE => ["PAGE",       "ACCES RESTREINT ?"]

  // Page d'accueil
  "home"            => ["home.php",               false], // accueil

  // Foodtrucks
  "foodtrucks"      => ["foodtrucks.php",         false], // liste de foodtrucks
  "foodtruck"       => ["foodtruck.php",          false], // un foodtruck
  "add-foodtruck"   => ["add-foodtruck.php",      true], // ajouter
  "edit-foodtruck"  => ["edit-foodtruck.php",     true], // modifier
  "delete-foodtruck"=> ["delete-foodtruck.php",   true], // effacer


  // Contact
  "contact"         => ["contact.php",            false], // page ajouter un contact

  // Users
  "profile"         => ["profile.php",            true], //profil utilisateur
  "settings"        => ["settings.php",           true], //reglage du profil utilisateur
  "register"        => ["register.php",           false], // enregistrement de l'utilisateur
  "login"           => ["login.php",              false], // connexion de l'utilisateur
  "lostpwd"         => ["lostpwd.php",            false], // page mot de passe perdu
  "renewpwd"        => ["renewpwd.php",           false], // page renouveler le mot de passe
  "logout"          => [null,                     true], // page déconnexion

  // Page d'Erreur
  "404"             => ["404.php",                false] // page erreur 404
];
