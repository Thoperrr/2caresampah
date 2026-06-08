<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\ClientProfile;
use App\Models\BankProfile; // <-- CORRECT





class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'points_balance',
        'phone',
        'address'
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

    public function clientProfile()
    {
        return $this->hasOne(ClientProfile::class);
    }

    public function bankProfile()
    {
        return $this->hasOne(BankProfile::class, 'user_id', 'id');
    }

    public function pointRedemptions()
    {
        return $this->hasMany(PointRedemption::class);
    }
    public function pointTransactions()
    {
        return $this->hasMany(\App\Models\Point::class);
    }

    // Forum subscriptions (many-to-many)
    public function subscribedForums()
    {
        return $this->belongsToMany(Forum::class, 'forum_user', 'user_id', 'forum_id');
    }

    // Check if user is subscribed to a forum
    public function isSubscribedTo($forum)
    {
        return $this->subscribedForums()->where('forum_id', $forum->id)->exists();
    }
}
