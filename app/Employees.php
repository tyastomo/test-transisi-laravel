<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
	protected $primaryKey = 'id';
	public $timestamps = true;
    /*public $incrementing = false;*/

    protected $fillable = [
    	'id',
    	'company_id',
		'name',
		'email'
	];

	public function companies() {
		return $this->belongsTo('App\Companies', 'company_id', 'id');
	}
}
