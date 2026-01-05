<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    protected $table = 'fitur';

    use HasFactory;

    // Since 'id' is a non-incrementing UUID, set this
    public $incrementing = false;
    protected $keyType = 'string';

    // Disable timestamps if you only have `created_at`
    const UPDATED_AT = null;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'id',
        'title',
        'description',
        'icon',
        'urutan',
        'type',
        'is_active',
    ];

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'fitur_paket', 'id_fitur', 'id_paket')
            ->using(FiturPaket::class)->withPivot('value');
    }
}
