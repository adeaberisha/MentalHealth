<?php
class Product{
    private $id;
    private $name;
    private $price;
    private $imagePath;

    public function __construct($id,$name,$price,$imagePath){

        $this->id=$id;
        $this->name=$name;
        $this->price=$price;
        $this->imagePath=$imagePath;

    }

    public function getID(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }
    
    public function getPrice(){
        return $this->price;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function setPrice($price){
        $this->price=$price;
    }

    public function setImagePath($imagePath){
        $this->imagePath=$imagePath;
    }

}
?>