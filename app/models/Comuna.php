<?php

class Comuna extends \Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comunas';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('created_at', 'updated_at');

	public function byRegion($id){
		return Comuna::where('region_id', '=', $id)->get();
	}
}