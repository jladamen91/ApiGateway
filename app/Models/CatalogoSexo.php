<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CatalogoSexo
 * 
 * @property int $CatalogoSexoKey
 * @property string $CatalogoSexoNombre
 *
 * @package App\Models
 */
class CatalogoSexo extends Model
{
	protected $table = 'CatalogoSexo';
	protected $primaryKey = 'CatalogoSexoKey';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'CatalogoSexoKey' => 'int'
	];

	protected $fillable = [
		'CatalogoSexoNombre'
	];
}
