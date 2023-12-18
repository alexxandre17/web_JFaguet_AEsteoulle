<html lang="fr">
  <head>
    <meta charset="UTF-8">

    <title>Bienvenue</title>
    
    <link rel="stylesheet" href="stylePagePresentation.css">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    
  </head>


  <body>
    
    <header>
      
      <div id="entete">
        ASTERIX & OBELIX <br>
        MISSION </br>
        CLEOPATRE 
      </div>  
    </header>  

    <div id="contenu">

      <div id="image">
          <img src="https://static.cinemagia.ro/img/resize/db/movie/00/43/06/asterix-obelix-mission-cleopatre-751814l-imagine.jpg" >
      </div>  
      <div id="image2">
          <img src="https://static.cinemagia.ro/img/resize/db/movie/00/43/06/asterix-obelix-mission-cleopatre-751814l-imagine.jpg" >
      </div> 
      
       <!-- Section de texte expliquant le contexte du jeu -->
      <div class="texte">
        <p> Cesar a besoin d'un palais en Egypte et c'est toi numéro bis qui va créer ce palais. Pour lui montrer que l'Egypte est le plus grand de
          tout les peuples tu vas devoir construire un palais en 3 mois. 
          Tous mes architectes sont occupées ce sera donc à toi de construire ce palais.<br>
          Tu as 3 mois jour pour jour top chrono. <br>
          <br>
          Inscris toi et construis ce palais dans les temps commence par trouver des pierres ! (sinon je te jeterai aux crocodiles les crocodiles).
        </p>
        <br> 
      </div>

        
<!-- Formulaire d'inscription qui permet de récuperer le nom d'utilisateur -->
      <div id="formulaire">
        <?php
          if (isset($log) && !empty($log)) {
            echo "<p>Bonjour : " . $log . "</p>";
            echo "<a href='/accueil?deco=true'> En route vers l'Egypte</a>";
          } else {
            echo '
            <form method="post" action="/PagePresentation">
              <div>
                <label>Username : <input type="text" name="user"></label>
              </div>
              <div>
              <button type="submit" class="button-asterix">Envoyer</button>
              </div>
            </form>';
          }
        ?>
      </div>
      
<!-- Section du Hall of Fame avec un tableau affichant les meilleurs scores -->
      <div id="hallOfFame">
        
        <h1> Hall Of Fame </h1>
        <table>
            <thead>
                <tr>
                    <th>Classment</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
            <?php   
            $rank = 1;  
             foreach ($table as $user) {
                echo '<tr>';
                echo '<td>' . $rank++ . '</td>';
                echo '<td>' . $user['username'] . '</td>';
                echo '<td>' . $user['score'] . '</td>';
                echo '</tr>';
              }
            ?>
            </tbody>
        </table>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  </body>
</html>