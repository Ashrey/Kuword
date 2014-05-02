<?php
class PostType extends ActiveRecord {
	public function initialize(){
       
    }

    public function __toString(){
        return $this->name;
    }
}
