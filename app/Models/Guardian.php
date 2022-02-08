<?php

namespace App\Models;

use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string api_key
 * @property string base_url
 * @property integer updated_by
 */

class Guardian extends Model
{
    use HasFactory, UpdatedBy;

    protected $table = 'guardian_api_credentials';

    protected $fillable = [
        'api_key',
        'base_url',
        'updated_by'
    ];

    public function editor(): string
    {
        return 'updated_by';
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by')->withoutGlobalScopes();
    }
}
