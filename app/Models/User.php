<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|AssignAsset[] $assign_assets
 * @property Collection|AssignProject[] $assign_projects
 * @property Collection|AttendanceManager[] $attendance_managers
 * @property Collection|Awardee[] $awardees
 * @property Collection|EmployeeLeafe[] $employee_leaves
 * @property Collection|Employee[] $employees
 * @property Collection|EventAttendee[] $event_attendees
 * @property Collection|Event[] $events
 * @property Collection|Expense[] $expenses
 * @property Collection|MeetingAttendee[] $meeting_attendees
 * @property Collection|Meeting[] $meetings
 * @property Collection|PostReply[] $post_replies
 * @property Collection|Post[] $posts
 * @property Collection|Team[] $teams
 * @property Collection|TrainingInvite[] $training_invites
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    protected $table = 'users';
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];
    
    public function assign_assets()
    {
        return $this->hasMany(AssignAsset::class);
    }
    
    public function assign_projects()
    {
        return $this->hasMany(AssignProject::class);
    }
    
    public function attendance_managers()
    {
        return $this->hasMany(AttendanceManager::class);
    }
    
    public function awardees()
    {
        return $this->hasMany(Awardee::class);
    }
    
    public function employee_leaves()
    {
        return $this->hasMany(EmployeeLeafe::class);
    }
    
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
    public function event_attendees()
    {
        return $this->hasMany(EventAttendee::class, 'attendee_id');
    }
    
    public function events()
    {
        return $this->hasMany(Event::class, 'coordinator_id');
    }
    
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    
    public function meeting_attendees()
    {
        return $this->hasMany(MeetingAttendee::class, 'attendee_id');
    }
    
    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'coordinator_id');
    }
    
    public function post_replies()
    {
        return $this->hasMany(PostReply::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function teams()
    {
        return $this->hasMany(Team::class, 'member_id');
    }
    
    public function training_invites()
    {
        return $this->hasMany(TrainingInvite::class);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')
                    ->withPivot('id')
                    ->withTimestamps();
    }
    
    /**
     * @return HasOne
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }
    
    public function role()
    {
        return $this->hasOne('App\Models\UserRole', 'user_id', 'id');
    }
    
    public function isHR()
    {
        $userId   = Auth::user()->id;
        $userRole = UserRole::where('user_id', $userId)->first();
        if ($userRole->role_id == 7 || $userRole->role_id == 1) {
            return true;
        }
        
        return false;
    }
    
    public function notAnalyst(): bool
    {
        $userId   = Auth::user()->id;
        $userRole = UserRole::where('user_id', $userId)->first();
        if ($userRole->role_id != 3) {
            return true;
        }
        
        return false;
    }
    
    public function isCoordinator(): bool
    {
        $userId   = Auth::user()->id;
        $userRole = UserRole::where('user_id', $userId)->first();
        $roleIds  = [2, 5, 7, 8, 9, 10, 14, 16];
        if (in_array($userRole->role_id, $roleIds)) {
            return true;
        }
        
        return false;
    }
    
    public function isManager(): bool
    {
        $userId   = Auth::user()->id;
        $userRole = UserRole::where('user_id', $userId)->first();
        if ($userRole->role_id == 16) {
            return true;
        }
        
        return false;
    }
    
    public function project(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
