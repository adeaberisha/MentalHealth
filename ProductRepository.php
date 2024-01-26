<?php
include_once("DatabaseConnection.php");

class ProductRepository{
    private $connection;

    function __construct(){
        $conn = new DatabaseConnection;
        $this->connection = $conn->startConnection();
    }

    function insertProduct($product){
        $conn = $this->connection;

        $name = $product->getName();
        $price = $product->getPrice();
        $imagePath = $product->getImagePath();

        $sql = "INSERT INTO Product (name,price,image_path) VALUES (?,?,?)"; //SQL Query per insertimin e te dhenave per tabelen product
        $statement = $conn->prepare($sql); //$conn eshte database connection object, prepare() eshte metode qe thirret mbi database connection object
        //-per ta bere gati SQL statement per ekzekutim. $statement i bie te jete objekt qe prezanton prepared statement, 
        //-mund te perdoret per te ekzekutuar query dhe per te marre rezultate.
        $statement->execute([$name,$price,$imagePath]); //metoda execute() perdoret me nje array 
        //-qe permban vlerat qe do te lidhen ne placeholders(?) ne prepared statement

        echo "<script>alert('Product has been inserted successfully!');</script>";
    }

    function getAllProducts(){
        $conn = $this->connection;

        $sql = "SELECT * FROM Product"; //SQL Query per te marre te gjitha produktet
        $statement = $conn->query($sql);//per me ekzekutu queryn qe eshte ne variablen $sql, metoda query() perdoret per query qe kane deklaraten SELECT
        $products = $statement->fetchAll();//fetchAll() i merr te gjitha rreshtat prej result set qe ndodhet ne $statement, secili rresht riprezentohet si nje array
        //-nese nuk ka me rows per te bere fetch kthen false. Data qe e kemi marre ruhet ne $product.

        return $products;
    }

    function getProductById($id){
        $conn = $this->connection;

        $sql = "SELECT * FROM Product WHERE id=?"; //SQL Query per te marre produktin ne baze te ID-se te caktuar
        $statement = $conn->prepare($sql);//edhe pse eshte deklarata SELECT perdorim prepare() sepse eshte parameterized
        $statement->execute([$id]);
        $product = $statement->fetch(); //fetch() e merr rreshtin e pare prej result set qe ndodhet ne $statement, pra e merr nje array  me te dhena

        return $product;
    }

    function getProductsByIds($productIds){
        $conn = $this->connection;
    
        $placeholders = implode(',', array_fill(0, count($productIds), '?'));
        //count($productIds) tregon numrin e elementeve ne array-in $productIds
        //array_fill(0, count($productIds), '?') e krijon nje array me vleren '?' dhe me gjatesine barabarte me nr te product IDve
        //array_fill eshte funksion qe merr 3 parametra: indexin e fillimit, numrin e elementeve, dhe value '?'
        //implode() ben join elementet e array ne string, tndame permes presjes
        //dmth krejt elementet e array-it qe osht kriju permes array_fill i bashkon edhe krijohet string i pikepytjeve tndame me presje
        //psh nese jon 3 id, $placeholders i bjen qe ka me permbajt '?,?,?'
        //me pas $placeholders e perdorim per me i represent '?,?,?' ne query
    
        $sql = "SELECT * FROM Product WHERE id IN ($placeholders)";

        $statement = $conn->prepare($sql);
    
        //Iterojme ne array te id-ve. Per cdo iterim, caktohet vlera e indexit te $index dhe elementi te $productId
        foreach ($productIds as $index => $productId) {
            $statement->bindValue($index + 1, $productId, PDO::PARAM_INT);
        }
        //Per me lidh id tproduktit si parameter te prepared statement perdoret qekjo bindValue
        //indexat fillojne prej 0, por ne SQL te parametrat fillojne prej 1, andaj kemi $index+1 per me match me query
        
        $statement->execute();
        $products = $statement->fetchAll();

        return $products;

    }

    // function getThreeProducts(){
    //     $conn = $this->connection;

    //     $productIds = [5,6,7]; //id e produkteve qe na nevojiten

    //     $sql = "SELECT * FROM Product WHERE id IN (:id1,:id2,:id3)";

    //     $statement = $conn->prepare($sql);

    //     $statement->bindParam(':id1', $productIds[0], PDO::PARAM_INT); //metoda bindParam() lidh parametrin :id1 ne query me vleren e $productIds[0]
    //     $statement->bindParam(':id2', $productIds[1], PDO::PARAM_INT); //PDO::PARAM_INT perdoret per te trajtuar vleren si integer dhe per me mbrojt prej injections
    //     $statement->bindParam(':id3', $productIds[2], PDO::PARAM_INT);

    //     $products = $statement->execute();

    //     $products = $statement->fetchAll();

    //     return $products;
    // }

    function updateProduct($id,$name,$price,$imagePath){
        $conn = $this->connection;

        $sql = "UPDATE Product SET name=?,price=?,image_path=? WHERE id=?";//SQL Query per te bere update nje produkt
        $statement = $conn->prepare($sql);
        $statement->execute([$name,$price,$imagePath]);

        echo "<script>alert('Update was successful');</script>";
    }

    function deleteProduct($id){
        $conn = $this->connection;

        $sql = "DELETE from Product WHERE id=?";
        $statement = $conn->prepare($sql);
        $statement->execute([$id]); //pra execute() merr si parameter vleren qe do te lidhet ne placeholder

        echo "<script>alert('Delete was successful!');</script>";
    }
}
?>