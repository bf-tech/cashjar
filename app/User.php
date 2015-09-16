<?php

namespace Cashjar;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public function owees() {
        $members = collect([]);

        $participantingIn = collect([]);
        foreach ($this->groupevents as $groupevent) {
            if ($groupevent->paid == false) {
                $participantingIn->push($groupevent);
            }
        }

        foreach ($participantingIn as $groupevent) {
            foreach ($groupevent->users as $user) {
                if ((!$members->contains('id', $user->id)) and ($user->id != $this->id)) { $members->push($user); }
            }
        }
        return $members;
    }



    /**
     * How much money you owe to the person.
     * @param User::id
     */
    public function owe($receiver_id)
    {
        $toPay = 0;
        $toGetPaid = 0;
        $receiver = User::findOrFail($receiver_id);
        foreach ($receiver->expenses as $expense) {
            $groupevent = Groupevent::findOrFail($expense->groupevent_id);
            if ($groupevent->participants()->contains('id', $this->id) and ($groupevent->paid == false)) {
                $toPay += ($expense->cost / $groupevent->participants()->count());
            }
        }

        foreach ($this->expenses as $expense) {
            $groupevent = Groupevent::findOrFail($expense->groupevent_id);
            if ($groupevent->participants()->contains('id', $receiver->id) and ($groupevent->paid == false)) {
                $toGetPaid += ($expense->cost / $groupevent->participants()->count());
            }
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