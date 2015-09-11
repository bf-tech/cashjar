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
    protected $fillable = [ 'desc', 'cost', 'user_id', 'groupevent_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The user who paid for the expense.
     */
    public function user()
    {
        return $this->belongsTo('Cashjar\User');
    }

    /**
     * The group or event realted to this expense.
     */
    public function groupevent()
    {
        return $this->belongsTo('Cashjar\Groupevent');
    }
}
