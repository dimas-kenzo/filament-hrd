<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = ['alamat','nomor_telepon','user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
