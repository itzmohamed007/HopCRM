<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['cle', 'nom', 'adresse', 'code_postal', 'ville', 'statut'];

    protected $table = 'organisation';

    /**
     * Get the contacts owned by the organization.
     *
     * @return array<string, string>
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
