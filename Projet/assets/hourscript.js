

Vue.createApp({
  data(){
  return{
    running: false, // Indique si le chronomètre est en cours d'exécution
    startTime: 0, // Heure de démarrage du chronomètre
    currentTime: 0, // Temps écoulé depuis le démarrage du chronomètre
    score:0, // Score basé sur le temps écoulé
  }},

  computed: {
    // Formatage du temps sous forme d'heures, minutes et secondes
    formattedTime() {
      const seconds = Math.floor(this.currentTime / 1000);
      const minutes = Math.floor(seconds / 60);
      const hours = Math.floor(minutes / 60);
      return `${hours}:${minutes % 60}:${seconds % 60}`;
    },
// Fonction qui modifie le score en focntion du temps ( attention cette fonction ne sert pas a afficher le score mais le modifie juste)
    AfficheScore(){
      this.score = Math.floor(this.currentTime / 1000);
    }
  },
  mounted: function() {
    // Démarrer le chronomètre dès que la page est chargée
    this.startTimer();
  },

  methods: {
    startTimer: function() {
      // Utiliser setInterval pour incrémenter le chronomètre chaque seconde
      this.startTime = Date.now() - this.currentTime;
      this.running = true;

      // Mettre à jour le temps toutes les secondes 
      this.interval = setInterval(() => {
        this.currentTime = Date.now() - this.startTime;
      }, 1000);
    },
    stopTimer: function() {
      // Arrêter le chronomètre en effaçant l'intervalle
      clearInterval(this.interval);
      this.running = false;
      var data = new FormData();
      console.log(this.score);
      data.append('score', this.score);
    
      fetch('/indexx', {
        method: 'post',
        body: data,
      })
      .then(response => {
        // Rediriger vers /PagePresentation si la réponse est réussie
        if (response.ok) {
          window.location.href = '/';
        }
      })
    },
  },
}).mount('#app');
