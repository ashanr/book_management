<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Borrow;

class Reader extends Model  implements AuthenticatableContract
{

    use HasFactory, Notifiable, Authenticatable, HasRoles;


        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'user_type',
        'role'
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
