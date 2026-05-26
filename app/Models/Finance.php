<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'transaction_type',
        'amount',
        'description',
        'transaction_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}