<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function getRoleClientAttribute()
    {
        $client_id = Session::get('client_id');
        if( !$client_id )
            return null;

        $uc = UserClient::where('user_id', $this->id)->where('client_id', $client_id)->first();
        if( !$uc )
            return null;
        
        return $uc->role;
    }

    /*protected function roleClient(): Attribute
    {
        return Attribute::make(
            get: function() {

                $client_id = Session::get('client_id');
                if( !$client_id )
                    return null;

                $uc = UserClient::where('user_id', $this->id)->where('client_id', $client_id)->first();
                if( !$uc )
                    return null;
                
                return $uc->role;
            },
        );
    }*/
}
