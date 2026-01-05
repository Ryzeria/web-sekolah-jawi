<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';

    use HasFactory;

    // Since 'id' is a non-incrementing UUID, set this
    public $incrementing = false;
    protected $keyType = 'string';

    // Disable timestamps if you only have `created_at`
    const UPDATED_AT = null;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'id',
        'id_user',
        'id_paket',
        'jumlah',
        'status',
        'tanggal_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    /**
     * Get the history for the billing record.
     */
    public function history()
    {
        return $this->hasMany(HistoryBilling::class, 'id_billing');
    }
}
