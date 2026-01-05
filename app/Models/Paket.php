<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    public $incrementing = false;
    protected $keyType = 'string';
    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'nama_paket',
        'harga',
        'harga_normal',
        'diskon_persen',
        'deskripsi',
        'durasi_bulan',
        'is_active',
        'is_popular',
    ];

    /**
     * The features that belong to the package.
     * Defines a many-to-many relationship.
     */
    public function fiturs()
    {
        return $this->belongsToMany(Fitur::class, 'fitur_paket', 'id_paket', 'id_fitur')
            ->using(FiturPaket::class)->withPivot('value')->orderBy('urutan', 'asc');
    }
}
