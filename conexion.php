<?php
class ConexionBD {
    private static $host = "beukuvlrhrmlx8gqe7xo-mysql.services.clever-cloud.com";
    private static $db = "beukuvlrhrmlx8gqe7xo";
    private static $user = "us5cns1bqofgsggs";
    private static $pass = "sdRA1urjC406Qc95V68g";
    private static $charset = "utf8mb4";
    private static $pdo = null;

    public static function getConexion() {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
            try {
                self::$pdo = new PDO($dsn, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true, // Mantiene la conexión persistente
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    // Puedes cerrar la conexión si realmente lo necesitas, aunque con PDO persistente no es tan necesario
    public static function cerrarConexion() {
        self::$pdo = null;
    }
}
?>
