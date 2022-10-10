<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscription extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'convocation_id',
        'school_id',
        'code',
        'name',
        'email',
        'phone',
        'education',
        'modality',
        'receipt_path',
        'approved',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function convocation()
    {
        return $this->belongsTo(Convocation::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
