<?php

namespace Cashjar;

use Illuminate\Database\Eloquent\Model;


class Groupevent extends Model
{
    /**
     * The users that belong to this group.
     */
    public function participants()
    {
        $participants = collect([]);
        $groupevent = Groupevent::findOrFail($this->id);
        foreach ($groupevent->users as $user) {
            if (!$participants->contains($user)) { $participants->push($user); }
        }
        return $participants;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groupevents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['desc', 'paid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The users that belong to this group.
     */
    public function users()
    {
        return $this->belongsToMany('Cashjar\User');
    }

    /**
     * The expenses that belong to this group.
     */
    public function expenses()
    {
        return $this->hasMany('Cashjar\Expense');
    }
}
