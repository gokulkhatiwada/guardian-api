<?php

namespace App\Models;

use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string description
 * @property string meta_title
 * @property string meta_description
 * @property string email
 * @property string contact
 * @property string address
 * @property integer updated_by
 */

class Setting extends Model
{
    use HasFactory, UpdatedBy;

    protected  $fillable = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'email',
        'contact',
        'address',
        'updated_by'
    ];

    public function editor(): string
    {
        return 'updated_by';
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }

    public function get($key=null, $default=null){
        if($this->$key == null && $default != null){
            return $default;
        }
        if($key == null && $default == null){
            return $this->first();
        }
        if(!is_null($this->first())){
            return $this->first()->$key;
        } else {
            return null;
        }

    }


}
