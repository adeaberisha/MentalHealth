<?php
class Therapist{
    private $id;
    private $name;
    private $fee;
    private $areasOfFocus;
    private $specializedSkills;
    private $imageUrl;

    public function __construct($id, $name, $fee, $areasOfFocus, $specializedSkills, $imageUrl){
        $this->id = $id;
        $this->name = $name;
        $this->fee = $fee;
        $this->areasOfFocus = $areasOfFocus;
        $this->specializedSkills = $specializedSkills;
        $this->imageUrl = $imageUrl;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getFee(){
        return $this->fee;
    }
    public function getAreasOfFocus(){
        return $this->areasOfFocus;
    }
    public function getSpecializedSkills(){
        return $this->SpecializedSkills;
    }
    public function getImageUrl(){
        return $this->imageUrl;
    }
    
    public function setName($name){
        $this->name=$name;
    }
    public function setFee($fee){
        $this->fee=$fee;
    }
    public function setAreasOfFocus($areasOfFocus){
        $this->areasOfFocus=$areasOfFocus;
    }
    public function setSpecializedSkills($specializedSkills){
        $this->specializedSkills=$specializedSkills;
    }
    public function setImageUrl($imageUrl){
        $this->imageUrl=$imageUrl;
    }
}
?>