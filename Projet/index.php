<?php
// Inclusion du framework Flight
require 'flight/Flight.php';

// Démarrage de la session
session_start();

// Paramètres de connexion à la base de données PostgreSQL
$host = "localhost";
$port = "5432";
$database = "postgres";
$user = "postgres";
$password = "postgres";

// Connexion à la base de données PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

// Configuration de la connexion à la base de données pour le framework Flight
Flight::set('db', $conn);

// Vérification de la connexion à la base de données
if (!$conn) {
  echo "Erreur de connexion à la base de données.";
} else {
  $result = pg_query($conn, "SELECT nom FROM objet");
}

// Définition des routes pour le framework Flight

// Route pour récupérer les objets depuis la base de données
Flight::route('GET /objet', function () {
  $link = Flight::get('db');
  $sql = "SELECT *, ST_AsGeoJSON(position) as position FROM objet";
  $requete = pg_query($link, $sql);

  $objet = [];
  if ($result = $requete) {
    while ($ligne = pg_fetch_object($result)) {
        $objet[$ligne->id] = $ligne;
    }
  }

  Flight::json(['objet' => $objet]);
});



// Route pour récupérer les niveaux de zoom depuis la base de données
Flight::route('GET /zoom', function () {
  $link = Flight::get('db');
  $sql2 = "SELECT id, zoom FROM objet";
  $requete2 = pg_query($link, $sql2);

  $zoom = [];
  if ($result = $requete2) {
    while ($ligne2 = pg_fetch_object($result)) {
        $zoom[$ligne2->id] = $ligne2->zoom;
    }
  }

  Flight::json(['zoom' => $zoom]);
});


// Route pour récupérer la base de donnée des utilisateurs avec leur score
Flight::route('GET /', function () {

  $conn = Flight::get('db');

  $table=[];
// Fais une requête qui permet de séléctioner les 10 meilleurs
  $query = "SELECT username, score FROM halloffame ORDER BY score  LIMIT 10 ";
  $result = pg_query($conn , $query);
// Pour récupérer les noms et les scores en même temps a voir des 10 meilleurs
  while($row=pg_fetch_assoc($result)){
      $table[] = ['username' => $row['username'], 'score' => $row['score']];
      }

  Flight::render('PagePresentation',['log'=>null,'table'=>$table]);
});



// Route qui récupère le nom d'utilisateur depuis "PagePresentation" et le met dans la base de donnée
Flight::route('POST /PagePresentation', function () {

  $conn=Flight::get('db');

  $user=$_POST['user'];
  $_SESSION['user'] = $user;

// Vérifie si le nom d'utilisateur est vide
  if ($user == '') {
      echo '<script> 
      alert("Ecris quelque chose au moins. Fais gaffe on va te jeter aux crocodiles !");
      setTimeout(function() {
          window.location.href = "/";
      }); // Redirection après 0,5 seconde
  </script>';
  exit();
  }

// Vérifie si le nom d'utilisateur est déjà pris si non on doit changer de nom
  $VerifQuery = "SELECT username FROM halloffame WHERE username LIKE '$user'";
  $VerifResult = pg_query($conn, $VerifQuery);
  $rowCount = pg_num_rows($VerifResult);
  if ($rowCount > 0) {
      echo '<script> 
      alert("change de nom, celui ci est déja pris déso :D ");
      setTimeout(function() {
          window.location.href = "/";
      }); // Redirection après 0,5 seconde
    </script>';
  exit();
  }

// Requête SQL qui sert à envoyer le nom d'utilisateur dans la base de données
  $query = "INSERT INTO halloffame (username) VALUES ('$user')";
  $result=pg_query($conn, $query);
// Requete SQL qui renvoie les 10 username avec le meilleur temps
  $table=[];
  $query = "SELECT username, score FROM halloffame ORDER BY score  LIMIT 10 ";
  $result = pg_query($conn , $query);
// Pour recuperer les noms et les scores en meme temps a voir (pour l'instant ca marche pas)
  while($row=pg_fetch_assoc($result)){
      $table[] = ['username' => $row['username'], 'score' => $row['score']];
      }

  Flight::render('PagePresentation',['log'=>$user,'table'=>$table]);
});



// Route qui récupère le score depuis "hourscript" et le met dans la base de donnée
Flight::route('POST /indexx', function(){
    
  $conn = Flight::get('db');

  $score = $_POST['score'];
  $user = $_SESSION['user'];

// Requête pour ajouter le score à l'utilisateur en train de jouer
  $query = "UPDATE halloffame SET score = $score*123 WHERE username LIKE '$user'";
  $result = pg_query($conn, $query);

  pg_close($conn);
});


Flight::route('/accueil', function () {
  Flight::render('accueil');
});


Flight::start();
?>  