<?php
Load::model('places');
class PlacesController extends ScaffoldController{
	public $_model = 'places';

	
	function before_filter(){
		$this->ptitle = __('Places');
	}
	
}
