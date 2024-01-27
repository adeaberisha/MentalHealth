<?php 
include_once 'databaseConnection.php';

class UserRepository{
    private $connection;

    function __construct(){
        $conn = new DatabaseConenction;
        $this->connection = $conn->startConnection();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    

    // public function userExists($email) {
    //     $query = "SELECT * FROM users WHERE email = :email";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    
    //     return $stmt->rowCount() > 0 ? "User exists" : "User not found";
    // }
    
    // public function validateCredentials($email, $password) {
    //     $query = "SELECT * FROM users WHERE email = :email";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //     if (!$user) {
    //         return "User not found"; // User not found
    //     }
    
    //     if (password_verify($password, $user['password'])) {
    //         return "Valid credentials"; // Valid credentials
    //     } else {
    //         return "Invalid password"; // Invalid password
    //     }
    // }

    function insertUser($user){

        $conn = $this->connection;

        $id = $user->getId();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $sql = "INSERT INTO users (id,email,password) VALUES (?,?,?)";

        $statement = $conn->prepare($sql);

        $statement->execute([$id,$email,$password]);

        echo "<script> alert('User has been inserted successfuly!'); </script>";

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

    function updateUser($id,$email,$password){
         $conn = $this->connection;

         $sql = "UPDATE users SET email=?, password=? WHERE id=?";

         $statement = $conn->prepare($sql);

         $statement->execute([$email,$password,$id]);

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