<?php
include_once 'DatabaseConnection.php';

class TherapistRepository {
    private $connection;

    function __construct() {
        $conn = new DatabaseConnection;
        $this->connection = $conn->startConnection();
    }

    function insertTherapist($therapist) {
        $conn = $this->connection;

        $name = $therapist->getName();
        $fee = $therapist->getFee();
        $areasOfFocus = $therapist->getAreasOfFocus();
        $specializedSkills = $therapist->getSpecializedSkills();
        $imageUrl = $therapist->getImageUrl();

        $sql = "INSERT INTO therapists (name, fee, areas_of_focus, specialized_skills, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $fee, $areasOfFocus, $specializedSkills, $imageUrl]);

        echo "<script>alert('Therapist has been inserted successfully!');</script>";
    }

    function getAllTherapists() {
        $conn = $this->connection;

        $sql = "SELECT * FROM therapists"; 
        $stmt = $conn->query($sql);
        $therapists = $stmt->fetchAll();

        return $therapists;
    }


    function getTherapistById($id){
        $conn = $this->connection;

        $sql = "SELECT * FROM therapists WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $therapist = $stmt->fetch();

        return $therapist;
    }

    // function getThreeTherapists(){
    //     $conn = $this->connection;
    
    //     $therapistIds = [5, 6, 7];
    
    //     // Construct a parameterized query
    //     $sql = "SELECT * FROM therapists WHERE id IN (:id1, :id2, :id3)";
    
    //     // Prepare the statement
    //     $stmt = $conn->prepare($sql);
    
    //     // Bind parameters
    //     $stmt->bindParam(':id1', $therapistIds[0], PDO::PARAM_INT);
    //     $stmt->bindParam(':id2', $therapistIds[1], PDO::PARAM_INT);
    //     $stmt->bindParam(':id3', $therapistIds[2], PDO::PARAM_INT);
    
    //     // Execute the statement
    //     $stmt->execute();
    
    //     // Fetch the results
    //     $therapists = $stmt->fetchAll();
    
    //     return $therapists;
    // }

    function getTherapistsByIds($therapistsIds){
        $conn = $this->connection;
    
        // Create a parameterized query based on the number of product IDs
        $placeholders = implode(',', array_fill(0, count($therapistsIds), '?'));
    
        $sql = "SELECT * FROM therapists WHERE id IN ($placeholders)";
        
        $stmt = $conn->prepare($sql);
    
        // Bind parameters dynamically
        foreach ($therapistsIds as $index => $therapistId) {
            $stmt->bindValue($index + 1, $therapistId, PDO::PARAM_INT);
        }

        $stmt->execute();
        $therapists = $stmt->fetchAll();

        return $therapists;

    }

    function updateTherapist($id, $name, $fee, $areasOfFocus, $specializedSkills, $imageUrl){
        $conn = $this->connection;

        $sql = "UPDATE therapists SET name=?, fee=?, areas_of_focus=?, specialized_skills=?, image_url=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $fee, $areasOfFocus, $specializedSkills, $imageUrl, $id]);

        echo "<script>alert('Update was successful');</script>";
    }

    function deleteTherapist($id){
        $conn=$this->connection;
        $sql = "DELETE FROM therapists WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        echo "<script>alert('Delete was successful');</script>";
    }
}

?>