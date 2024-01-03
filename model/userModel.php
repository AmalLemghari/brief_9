    <?php
    require_once('database.php');

    class UserModel
    {
        private $id;
        private $nom;
        private $prenom;
        private $email;
        private $pass;
        private $tel;
        private $role;
        private $conn;

        public function __construct()
        {

            $this->conn = Database::getDb()->getConn();
        }


        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getnom()
        {
            return $this->nom;
        }

        public function setnom($nom)
        {
            $this->nom = $nom;
        }
        public function getprenom()
        {
            return $this->prenom;
        }

        public function setprenom($prenom)
        {
            $this->prenom = $prenom;
        }

        public function getemail()
        {
            return $this->email;
        }

        public function setemail($email)
        {
            $this->email = $email;
        }
        public function getpass()
        {
            return $this->pass;
        }

        public function setpass($pass)
        {
            $this->pass = $pass;
        }
        public function gettel()
        {
            return $this->tel;
        }

        public function settel($tel)
        {
            $this->tel = $tel;
        }
        public function getrole()
        {
            return $this->role;
        }

        public function setrole($role)
        {
            $this->role = $role;
        }

        public function register()
        {
            $emailCheckQuery = "SELECT COUNT(*) FROM user WHERE email=:email";
            $emailCheckStmt = $this->conn->prepare($emailCheckQuery);
            $emailCheckStmt->bindParam(":email", $this->email);
            $emailCheckStmt->execute();
            $emailCount = $emailCheckStmt->fetchColumn();

            if ($emailCount > 0) {
                return "L'email existe déjà.";
            }

            $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);

            $query = "INSERT INTO `user` (nom, prenom, email, pass, tel,role)
                    VALUES (:username, :surname, :email, :password, :tel,'membre')";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $this->nom);
            $stmt->bindParam(":surname", $this->prenom);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->pass);
            $stmt->bindParam(":tel", $this->tel);

            $stmt->execute();
        }

        public function login()
        {
            $query = "SELECT iduser,nom, pass FROM user WHERE email=:email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($this->pass, $result['pass'])) {
                session_start();
                $_SESSION['iduser'] = $result['iduser'];
                $_SESSION['nom'] = $result['nom'];
                return true;
            } else {
                return false;
            }
        }

        public function logout()
        {
            session_destroy();
            header("Location: ../view/login.php");
            exit();
        }

    }
