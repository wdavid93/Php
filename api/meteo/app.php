<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Météo</title>
</head>
<body>
    <h1>Consultez la météo d'une ville</h1>
    
    <!-- Formulaire pour saisir le nom de la ville -->
    <form method="post">
        <label for="city">Ville:</label>
        <input type="text" id="city" name="city" required>
        <button type="submit">Afficher la météo</button>
    </form>
    
    <?php
    // Fonction pour obtenir les coordonnées géographiques de la ville
    function getCoordinates($city) {
        // URL de l'API de géocodage de Nominatim
        $geocodeUrl = "https://nominatim.openstreetmap.org/search?q=" . urlencode($city) . "&format=json&limit=1";
        
        // Initialisation de la session cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $geocodeUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Définir l'en-tête User-Agent pour l'API Nominatim
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: MonApp/1.0'));
        
        // Exécution de la requête
        $jsonData = curl_exec($ch);
        
        // Vérification des erreurs
        if (curl_errno($ch)) {
            echo 'Erreur cURL: ' . curl_error($ch);
            return false;
        }
        
        // Fermeture de la session cURL
        curl_close($ch);
        
        // Décodage des données JSON en tableau PHP
        $geoData = json_decode($jsonData, true);
        
        // Vérification si les données ont été récupérées correctement
        if (isset($geoData[0])) {
            return [
                'latitude' => $geoData[0]['lat'],
                'longitude' => $geoData[0]['lon']
            ];
        } else {
            return false;
        }
    }

    // Fonction pour obtenir les données météo à partir des coordonnées
    function getWeather($latitude, $longitude) {
        // URL de l'API Open-Meteo pour obtenir les données météo
        $weatherUrl = "https://api.open-meteo.com/v1/forecast?latitude=" . $latitude . "&longitude=" . $longitude . "&current_weather=true";
        
        // Initialisation de la session cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $weatherUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Exécution de la requête
        $jsonData = curl_exec($ch);
        
        // Vérification des erreurs
        if (curl_errno($ch)) {
            echo 'Erreur cURL: ' . curl_error($ch);
            return false;
        }
        
        // Fermeture de la session cURL
        curl_close($ch);
        
        // Décodage des données JSON en tableau PHP
        $weatherData = json_decode($jsonData, true);
        
        // Vérification si les données ont été récupérées correctement
        if (isset($weatherData['current_weather'])) {
            return $weatherData['current_weather'];
        } else {
            return false;
        }
    }

    // Vérifiez si un nom de ville a été soumis via le formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['city'])) {
        // Récupération du nom de la ville depuis le formulaire
        $city = htmlspecialchars($_POST['city']);
        
        // Obtention des coordonnées géographiques de la ville
        $coordinates = getCoordinates($city);
        
        if ($coordinates) {
            // Obtention des données météo à partir des coordonnées
            $weather = getWeather($coordinates['latitude'], $coordinates['longitude']);
            
            if ($weather) {
                // Affichage des informations météo
                echo "<h2>Informations météo pour $city :</h2>";
                echo "<p>Température actuelle : " . $weather['temperature'] . "°C</p>";
                echo "<p>Conditions météorologiques : " . $weather['weathercode'] . "</p>";
            } else {
                echo "<p>Impossible de récupérer les données météo pour la ville spécifiée.</p>";
            }
        } else {
            echo "<p>Impossible de trouver la ville spécifiée.</p>";
        }
    }
    ?>
</body>
</html>
