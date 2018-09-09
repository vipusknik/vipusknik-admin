<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Laravelrus\LocalizedCarbon\{
    Traits\LocalizedEloquentTrait
};

use App\Models\Institution\Institution;


class User extends Authenticatable
{
    /**
     * Package traits
     */
    use LocalizedEloquentTrait;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'location',
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'     => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function toggleActiveStatus()
    {
        $this->is_active = ! $this->is_active;

        return $this;
    }

    public function getNameOrUsernameAttribute()
    {
        return $this->getNameOrUsername();
    }

    /**
     * Returns first name attribute of this user
     *
     * @return string | null
     */
    public function getName()
    {
        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    /**
     * Returns first name (if exists)
     * or username i.e login of the user
     *
     * @return string
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Checks if this user has role in team
     *
     * @return boolean
     */
    public function isInTeam()
    {
        $teamMembers = explode(
            '|', config('entrust.roles.groups.team')
        );

        return $this->hasRole($teamMembers);
    }
    
    /**
     * Check if user is not in web-site team
     * @return boolean
     */
    public function isNotInTeam()
    {
        return ! $this->isInTeam();
    }
    
    /**
     * Checks if this user has clients' role
     *
     * @return boolean
     */
    public function isInClients()
    {
        $clients = explode(
            '|', config('entrust.roles.groups.clients')
        );

        return $this->hasRole($clients);
    }

    /**
     * Check if user is not in registered clients
     * @return boolean
     */
    public function isNotInClients()
    {
        return ! $this->isInClients();
    }
    

    public function isNotActive()
    {
        return ! $this->is_active;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function hasNoAccess()
    {
        return ($this->isNotInTeam() && $this->isNotInClients()) || $this->isNotActive();
    }

    public function scopeTeam($query)
    {
        return $query->whereHas('roles', function ($query) {
            
            $query->whereIn('name', ['developer', 'moderator', 'admin']);
            
        });
    }
    public function scopeClients($query)
    {
        return $query->whereHas('roles', function ($query) {
            
            $query->where('name', 'college');
            
        });
    }

    public function scopeExcept($query, $user)
    {
        return $query->where('id', '!=', get_id($user));
    }

    public function owns($related)
    {
        return $this->id === $related->user_id;
    }

    /**
     * Relations
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function institutions()
    {
        return $this->belongsToMany(Institution::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
