<?php

namespace Cashjar;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public function owees() {
        $members = collect([]);
        $users = User::all();
        foreach ($users as $user) {
            if ((!$members->contains($user)) and ($user->id != $this->id)) { $members->push($user); }
        }
        return $members;
    }

    /**
     * How much money you owe to the person.
     * @param User::id
     */
    public function owe($receiver)
    {
        $toPay = 0;
        $toGetPaid = 0;
        $expenses = DB::table('expenses')->where('user_id', $receiver)->get();
        foreach ($expenses as $expense) {
            $toPay += ($expense->cost / Groupevent::findOrFail($expense->groupevent_id)->participants()->count());
        }
        $expenses = DB::table('expenses')->where('user_id', $this->id)->get();
        foreach ($expenses as $expense) {
            $toGetPaid += ($expense->cost / Groupevent::findOrFail($expense->groupevent_id)->participants()->count());
        }
        return $toPay - $toGetPaid;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The groups that the user is part of.
     */
    public function groupevents()
    {
        return $this->belongsToMany('Cashjar\Groupevent');
    }

    /**
     * The expenses that belong to the user.
     */
    public function expenses()
    {
        return $this->hasMany('Cashjar\Expense');
    }
}