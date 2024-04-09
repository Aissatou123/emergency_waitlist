document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const patientList = document.getElementById('patient-list');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Envoi de la requête au serveur pour authentifier l'utilisateur
        fetch('script.php', {
            method: 'POST',
            body: JSON.stringify({ username: username, password: password }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Si l'authentification réussit, afficher la liste des patients
                document.getElementById('login-form').style.display = 'none';
                patientList.style.display = 'block';
                fetchPatientList(); // Charger la liste des patients après la connexion
            } else {
                // Si l'authentification échoue, afficher un message d'erreur
                alert("Nom d'utilisateur ou mot de passe incorrect.");
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'authentification:', error);
        });
    });

    function fetchPatientList() {
        // Envoyer une requête Ajax pour obtenir la liste des patients depuis le serveur PHP
        // Remplir la liste des patients avec les données reçues
        const patients = [
            { nom: "Patient 1", gravite_blessure: "Légère", heure_arrivee: "2024-04-02 10:00:00" },
            { nom: "Patient 2", gravite_blessure: "Modérée", heure_arrivee: "2024-04-02 10:15:00" },
            { nom: "Patient 3", gravite_blessure: "Grave", heure_arrivee: "2024-04-02 10:30:00" }
        ];

        const patientsList = document.getElementById('patients');
        patientsList.innerHTML = '';
        patients.forEach(patient => {
            const listItem = document.createElement('li');
            listItem.textContent = `${patient.nom} - Gravité: ${patient.gravite_blessure} - Heure d'arrivée: ${patient.heure_arrivee}`;
            patientsList.appendChild(listItem);
        });
    }
});
