<?php

namespace App\Models\config;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CONF_MONEY extends Model
{
    use HasFactory;

    protected $table = 'CONF_MONEY';
    protected $primaryKey = 'money_key';
    public $incrementing = false;

    protected $fillable = [
       'money_key',
       'money_key',
       'money_change',
       'money_descript',
       'money_keySat',
       'money_status',
   ];

   public function getCreatedAtAttribute($value){
    return Carbon::parse($value)->format('d-m-Y');
}

public function getUpdatedAtAttribute($value){
    return Carbon::parse($value)->format('d-m-Y');
}

public function money($key)
{
    return $this->where('money_key', $key)->first();
}

public function money_id($id)
{
    return $this->where('money_id', $id)->first();
}

public function monies()
{
    return $this->where('money_status', 'Alta')->orderBy('money_id', 'desc')->get();
}

public function money_sat()
{
    return $this->hasOne('App\Models\cat_sat\CAT_SAT_MONEDA', 'c_Moneda', 'money_key');
}



}
