<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['cle', 'organisation_id', 'e_mail', 'nom', 'prenom', 'telephon_fixe', 'service', 'fonction'];

    protected $table = 'contact';

    /**
     * Get the owning organisation of the contact
     *
     * @return array<string, string>
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }
}
