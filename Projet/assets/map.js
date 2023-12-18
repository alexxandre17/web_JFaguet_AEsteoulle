// Création d'une carte Leaflet centrée sur une position spécifique
var map = L.map('map').setView([31.209273691043816, 29.953704980303385], 5);

// Ajout d'une couche de tuiles OpenStreetMap à la carte
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Création d'une couche WMS (Web Map Service) pour afficher des données géospatiales
var triche = L.tileLayer.wms("http://localhost:8081/geoserver/wms", {
  layers: 'projet_web:triche',
  format: 'image/PNG',
  transparent: true,
})

// Variable pour stocker les objets
var objets;

// Initialisation de l'application Vue.js
var app = Vue.createApp({
  data() {
    return {
      inventory: [],  // Liste des objets collectés
      pass: "",
      markersLayer: L.layerGroup(),  // Groupe de marqueurs sur la carte
    };
  },

  methods: {
    // Fonction pour afficher ou masquer la couche WMS sur la carte
    AfficheTriche() {
      if (map.hasLayer(triche)) {
        map.removeLayer(triche);
      } else {
        triche.addTo(map);
      }
    },

    // Fonction pour récupérer les objets depuis le serveur
    base_objet() {
      fetch('objet')
        .then(result => result.json())
        .then(result => {
          objets = result.objet;
          markers = L.layerGroup();

          // Boucle à travers les objets pour créer des marqueurs sur la carte
          for (let key in objets) {
            if (objets.hasOwnProperty(key)) {
              var items = objets[key];
              var logoMarker = L.icon({
                iconUrl: items.image,
                iconSize: [70, 70],
              });

              // Récupération des coordonnées du marqueur
              var lat = JSON.parse(items.position).coordinates[1];
              var lon = JSON.parse(items.position).coordinates[0];

              // Création d'un marqueur avec une popup
              layer = L.marker(([lat, lon]), { title: items.id, icon: logoMarker }).bindPopup(items.comment).addTo(map).setOpacity(0);
              markers.addLayer(layer);
            }
          }

          // Ajout du groupe de marqueurs à la carte
          map.addLayer(markers);

          // Gestion de l'événement de clic sur un marqueur
          markers.eachLayer(function (layer) {
            layer.on('click', function (event) {
              // Logique de traitement du clic sur un marqueur
              marker = event.target
              var key = marker.options.title;
              var items = objets[key];
              var objet = {
                id: key,
                title: items.nom,
                img: items.image,
                type: items.type,
                bloque: items.bloque,
                bloqueur: items.bloqueur,
                zoom: items.zoom
              };
              if (objet.bloque === 'f') {
                map.removeLayer(marker);
                app.addToInv(objet);
              } else {
                if (objet.bloque != 'f' && objet.type == 'String') {
                  el = document.getElementsByName(objet.bloqueur)
                  if (el[0].id == "vg") {
                    el[0].addEventListener('click', function () {
                      id = el[0].id
                      document.getElementById(id).remove()
                      map.removeLayer(marker);
                      app.addToInv(objet);
                    })
                  }
                  else {
                  }

                } else {
                  if (objet.bloque == 't' && objet.type == 'code') {
                    el = document.getElementById("bt")
                    el.addEventListener('click', function () {
                      pass = document.getElementById("code").value
                      if (pass == '2002') {
                        map.removeLayer(marker);
                        app.addToInv(objet);
                      } else {
                      }
                    })
                  }
                }
              }
            });
          });
        });
    },

    // Fonction pour ajouter un objet à l'inventaire
    addToInv(objet) {
      var invElement = document.getElementById('inv');
      var listItem = document.createElement('img');
      listItem.setAttribute('class', 'ull')
      listItem.setAttribute('id', objet.id);
      listItem.setAttribute('name', objet.title)
      listItem.src = objet.img;
      invElement.appendChild(listItem);
    },

    // Fonction pour afficher ou masquer les marqueurs en fonction du niveau de zoom
    PrintMarker() {
      map.on('zoom', () => {
        fetch('zoom')
          .then(result => result.json())
          .then(result => {
            markers.eachLayer(function (layer) {
              key = layer.options.title
              if (map.getZoom() >= result.zoom[key]) {
                layer.setOpacity(1);
              } else {
                layer.setOpacity(0);
              }
            })
          })
      })
    },
  }
}).mount('#entete');

// Appel des fonctions base_objet et PrintMarker au chargement de la page
console.log(app.base_objet());
console.log(app.PrintMarker());

// Fonction qui vérifie la fin du jeu en fonction de la présence de certains éléments
function fin_du_jeu() {
  var obj1 = document.getElementById("cleo");
  var obj2 = document.getElementById("car");
  var maDiv = document.getElementById("fin");
  maDiv.style.display = 'none';
  if (obj1 != null && obj2 != null) {
    alert("Tu as réussi à construire le palais. Félicitations ! Valide ton score et regarde si tu fais partie des 10 premiers !");

    maDiv.style.display = "block";
    return;
  }

  setTimeout(fin_du_jeu, 1000);
}

// Appel initial de la fonction fin_du_jeu
fin_du_jeu();
