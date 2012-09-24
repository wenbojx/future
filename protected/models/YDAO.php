<?php
class YDAO extends CActiveRecord{

    public function __construct(){
        parent::__construct($scenario);
    }
    public function tableName(){
        return parent::tableName();
    }
    public function save($runValidation=false,$attributes=null){
        return parent::save($runValidation,$attributes);
    }
    public function insert($attributes=null){
        return parent::insert($attributes);
    }
    public function update($attributes=null){
        return parent::update($attributes);
    }
    public function delete(){
        return parent::delete();
    }
    public function find($condition='',$params=array()){
        return parent::find($condition, $params);
    }
    public function findAll($condition='',$params=array()){
        return parent::findAll($condition, $params);
    }
    public function findByPk($pk,$condition='',$params=array()){
        return parent::findByPk($pk,$condition,$params);
    }
    public function findAllByPk($pk,$condition='',$params=array()){
        return parent::findAllByPk($pk,$condition,$params);
    }
    public function findByAttributes($attributes,$condition='',$params=array()){
        return parent::findByAttributes($attributes,$condition,$params);
    }
    public function findAllByAttributes($attributes,$condition='',$params=array()){
        return parent::findAllByAttributes($attributes,$condition,$params);
    }
    public function findBySql($sql,$params=array()){
        return parent::findBySql($sql,$params);
    }
    public function findAllBySql($sql,$params=array()){
        return parent::findAllBySql($sql,$params);
    }
    public function count($condition='',$params=array()){
        return parent::count($condition,$params);
    }
    public function countByAttributes($attributes,$condition='',$params=array()){
        return parent::countByAttributes($attributes,$condition,$params);
    }
    public function countBySql($sql,$params=array()){
        return parent::countBySql($sql, $params);
    }
    public function updateByPk($pk,$attributes,$condition='',$params=array()){
        return parent::updateByPk($pk,$attributes,$condition,$params);
    }
    public function updateAll($attributes,$condition='',$params=array()){
        return parent::updateAll($attributes,$condition,$params);
    }
    public function deleteByPk($pk,$condition='',$params=array()){
        return parent::deleteByPk($pk,$condition,$params);
    }
    public function deleteAll($condition='',$params=array()){
        return parent::deleteAll($condition,$params);
    }
    public function deleteAllByAttributes($attributes,$condition='',$params=array()){
        return parent::deleteAllByAttributes($attributes,$condition,$params);
    }
}






