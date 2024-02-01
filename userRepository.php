<?php 

class userRepository{
    private $connection;

    function __construct(){
        $conn = new DatabaseConnection;
        $this->connection = $conn->startConnection();
    }

    public function insertUser($email,$password,$role) {

        $conn = $this->connection;

        // Check if the email already exists
        $checkQuery = "SELECT * FROM users WHERE email = :email";
        $checkStatement = $conn->prepare($checkQuery);
        $checkStatement->bindParam(':email', $email);
        $checkStatement->execute();
    
        if ($checkStatement->rowCount() > 0) {
            echo "<script>alert('Email already exists!');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'Register.php'; }, 1000);</script>";
            exit();
        } else {
            // If email doesn't exist, proceed with the insertion
            $insertQuery = "INSERT INTO users (email, password, role) VALUES (:email, :password, :role)";
            $insertStatement = $conn->prepare($insertQuery);
            $insertStatement->bindParam(':email', $email);
            $insertStatement->bindParam(':password', $password);
            $insertStatement->bindParam(':role', $role);
    
            if ($insertStatement->execute()) {
                echo "<script>alert('User has been registered successfully!');</script>";
                
                // Delay the redirection by 2 seconds
                echo "<script>setTimeout(function(){ window.location.href = 'LoginForm.php'; }, 1000);</script>";
            } else {
                echo "<script>alert('Error!');</script>";
                echo "<script>setTimeout(function(){ window.location.href = 'Register.php'; }, 1000);</script>";
                exit();
            }
        }
    }

    function getAllUsers(){
        $conn = $this->connection;

        $sql = "SELECT * FROM users ";

        $statement = $conn->query($sql);
        $users = $statement->fetchAll();

        return $users;
    }

    function getUserById($id){
        $conn = $this->connection;

        $sql = "SELECT * FROM users WHERE id='$id'";

        $statement = $conn->query($sql);
        $user = $statement->fetch();

        return $user;
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
    }

    function updateUser($id,$email){
         $conn = $this->connection;

         $sql = "UPDATE users SET email=?, WHERE id=?";

         $statement = $conn->prepare($sql);

         $statement->execute([$email,$id]);

         echo "<script>alert('update was successful'); </script>";
    } 

    function deleteUser($id){
        $conn = $this->connection;

        $sql = "DELETE FROM users WHERE id=?";

        $statement = $conn->prepare($sql);

        $statement->execute([$id]);

        echo "<script>alert('delete was successful'); </script>";
   } 
}

?>