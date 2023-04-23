<!-- BEN OMRANE et ZAIT -->
<?php
// Déclaration de la classe DB qui va permettre de se connecter à une base de données
class DB {
    // Variables pour se connecter à la base de données
    private $host = 'localhost'; // Le nom de l'hôte (serveur) où se trouve la base de données
    private $username = 'root'; // Le nom d'utilisateur pour se connecter à la base de données
    private $password = ''; // Le mot de passe pour se connecter à la base de données
    private $database = 'siteweb'; // Le nom de la base de données à laquelle on veut se connecter

    // Variable pour stocker la connexion à la base de données
    private $connexion;
    
    // Constructeur de la classe, permet de se connecter à la base de données
    public function __construct($host = null, $username = null, $password = null, $database = null) {
        // Si des paramètres sont passés au constructeur, on les utilise pour se connecter à la base de données
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
		
        // Connexion à la base de données via l'objet PDO
        // L'option PDO::MYSQL_ATTR_INIT_COMMAND permet de définir l'encodage à utiliser pour les échanges avec la base de données
		$this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}
	
	// Getter pour obtenir la connexion à la base de données
	public function getConnexion() {
		return $this->connexion;
	}
	
	// Fonction pour exécuter une requête SQL et retourner les résultats sous forme d'objets
	public function query($sql, $params = array()) {
		$req = $this->connexion->prepare($sql); // Préparation de la requête SQL
		$req->execute($params); // Exécution de la requête SQL avec les éventuels paramètres fournis
		return $req->fetchAll(PDO::FETCH_OBJ); // Récupération des résultats sous forme d'objets
	}
	
	// Fonction pour préparer une requête SQL
	public function prepare($sql) {
    	return $this->connexion->prepare($sql); // Préparation de la requête SQL
	}
	
	// Fonction pour obtenir l'ID de la dernière ligne insérée dans la base de données
	public function getLastInsertId() {
    	return $this->connexion->lastInsertId(); // Récupération de l'ID de la dernière ligne insérée dans la base de données
	}
}
?>
