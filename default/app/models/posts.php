<?php
use \KBackend\Libs\Event;
class Posts extends ActiveRecord {

    protected function init(){
        $this->oneToOne('PostType');
        /*Add create vlaue*/
        Event::bind('ORMCreate', function($e, $obj){
            $obj->strid =  BlogUtil::encodeURL($obj->title);
            $obj->create_at = date('Y-m-d h:i:s');
            $obj->modified_in = $obj->create_at;
        }, $this);

        /*Add update value*/
        Event::bind('ORMUpdate', function($e, $obj){
            $obj->modified_in = date('Y-m-d h:i:s');
        }, $this);

    }
	
	/**
     * Devuelve el SQL para paginación
     * @return string sql
     */
    public static function index() {
        return  array(
            'fields' => 'posts.id, title, strid, modified_in, pt.name as post_type',
            'join'   => 'JOIN post_type pt ON post_type_id = pt.id',
        );
    }
	
	static function getAll($page = 1){
		return self::paginate(array(
		    'order' => 'modified_in desc',
			'where' => 'post_type_id = 1'
		),
		$page, 10);		
	}
	
	function getPostBySlug($slug){
		return self::first(
		    array('where' => 'post_type_id = 1 AND strid = :slug'), 
		    array(':slug' => $slug)
		);
	}
	
	function getPageBySlug($slug){
		return $this->find_first("conditions: type_id = 2 AND
		 strid = '$slug'");
	}

    static function getSection($token){
        $a = self::first(
            array('where' =>  'strid=:token'),
            array(':token'=>$token)
        );
        return isset($a->content)?$a->content:'';
    }
}
