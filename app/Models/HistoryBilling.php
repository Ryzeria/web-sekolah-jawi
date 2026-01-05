<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBilling extends Model
{
    protected $table = 'history_billing';

    use HasFactory;

    // Since 'id' is a non-incrementing UUID, set this
    public $incrementing = false;
    protected $keyType = 'string';

    // Disable timestamps if you only have `created_at`
    const UPDATED_AT = null;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'id',
        'id_billing',
        'id_paket',
        'status_sebelumnya',
        'status_baru',
        'tanggal',
    ];

    public function billing()
    {
        // A history record belongs to one billing record
        return $this->belongsTo(Billing::class, 'id_billing');
    }
}
