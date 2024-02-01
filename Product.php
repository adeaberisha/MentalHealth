<?php
class Product{
    private $id;
    private $name;
    private $price;
    private $imagePath;
    private $category;
    private $addedByUser;
    private $dateOfAddition;

    public function __construct($id,$name,$price,$imagePath,$category,$addedByUser,$dateOfAddition){

        $this->id=$id;
        $this->name=$name;
        $this->price=$price;
        $this->imagePath=$imagePath;
        $this->category=$category;
        $this->addedByUser=$addedByUser;
        $this->dateOfAddition=$dateOfAddition;

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

    public function getCategory(){
        return $this->category;
    }

    public function getAddedByUser(){
        return $this->addedByUser;
    }

    public function getDateOfAddition(){
        return $this->dateOfAddition;
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

    public function setCategory($category){
        $this->category=$category;
    }

    public function setAddedByUser($addedByUser){
        $this->addedByUser=$addedByUser;
    }

    public function setDateOfAddition($dateOfAddition){
        $this->dateOfAddition=$dateOfAddition;
    }

}
?>