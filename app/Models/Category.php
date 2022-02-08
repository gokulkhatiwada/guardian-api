<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,CreatedBy,UpdatedBy;

    protected $fillable = [
        'name','slug','created_by','updated_by'
    ];

    public function creator(): string
    {
        return 'created_by';
    }

    public function editor(): string
    {
        return 'updated_by';
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by')->withDefault('-');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by')->withDefault('-');
    }


}
