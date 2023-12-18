<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Chargement de la bibliothèque Vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    
    <!-- Configuration de la page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Liens vers les feuilles de style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     
    <!-- Titre de la page -->
    <title>Escape</title>
</head>

<body>
    <!-- En-tête de la page -->
    <div id="entete">
        <!-- Zone d'inventaire -->
        <div id="inv">
            <ul v-for="item in inventory" @click="use">
                {{ item.title }}
            </ul>
        </div>

        <!-- Bouton de triche -->
        <button id="BouttonTriche" @click="AfficheTriche">Triche</button>
    </div>

    <!-- Section principale de l'application -->
    <div id="app">
        <!-- Affichage du temps -->
        <p>Temps: {{ formattedTime }}</p>
        
        <!-- Affichage du score -->
        <p>{{ AfficheScore }}</p>
        
        <!-- Bouton pour valider le score -->
        <button id="fin" @click="stopTimer">Valide ton score !</button>
    </div>

    <!-- Conteneur de la carte Leaflet -->
    <div id="map"></div>

    <!-- Chargement de la bibliothèque Leaflet -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <!-- Chargement du script de la carte -->
    <script src='assets/map.js'></script>
    
    <!-- Chargement du script pour la gestion du temps -->
    <script src='assets/hourscript.js'></script>
</body>

</html>
