<?php

namespace Cashjar;

use Illuminate\Database\Eloquent\Model;
use DB;

class Groupevent extends Model
{
    /**
     * The users that belong to this group.
     */
    public function participants()
    {
        return DB::table('groupevent_user')->where('groupevent_id', $this->id)->count();
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
        return $this->belongsTo('Cashjar\User');
    }

    /**
     * The expenses that belong to this group.
     */
    public function expenses()
    {
        return $this->hasMany('Cashjar\Expense');
    }
}
