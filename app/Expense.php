<?php

namespace Cashjar;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'desc', 'cost'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('Cashjar\User');
    }
}
