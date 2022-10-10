<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Convocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'inscription_start_date',
        'inscription_end_date',
        'start_time',
        'end_time',
        'presencial_limit',
        'virtual_limit',
        'zoom_url',
        'whatsapp_url',
        'logo_path',
        'is_visible',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'inscription_start_date' => 'date',
        'inscription_end_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_visible' => 'boolean',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
