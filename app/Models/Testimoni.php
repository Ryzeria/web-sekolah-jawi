<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';

    use HasFactory;

    // Since 'id' is a non-incrementing UUID, set this
    public $incrementing = false;
    protected $keyType = 'string';

    // Disable timestamps if you only have `created_at`
    const UPDATED_AT = null;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'id',
        'nama',
        'profesi',
        'pesan',
        'foto_url',
        'urutan',
    ];
}
