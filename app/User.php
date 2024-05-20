<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nif', 'email', 'password','language_id','user_name','user_type','entity_id',
//        'updated_by','deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function language() {
        return $this->belongsTo('App\Language','language_id','id');
    }

    public function entity() {
        return $this->belongsTo('App\Entity','entity_id','id');
    }

    public function updatedActor() {

        return $this->hasMany('App\Actor', 'updated_by', 'id');
    }

    public function deletedActor() {

        return $this->hasMany('App\Actor', 'deleted_by', 'id');
    }

    public function updatedActorIniciatesT() {

        return $this->hasMany('App\ActorIniciatesT', 'updated_by', 'id');
    }

    public function deletedActorIniciatesT() {

        return $this->hasMany('App\ActorIniciatesT', 'deleted_by', 'id');
    }

    public function updatedActorName() {

        return $this->hasMany('App\ActorName', 'updated_by', 'id');
    }

    public function deletedActorName() {

        return $this->hasMany('App\ActorName', 'deleted_by', 'id');
    }

    public function updatedCausalLink() {

        return $this->hasMany('App\CausalLink', 'updated_by', 'id');
    }

    public function deletedCausalLink() {

        return $this->hasMany('App\CausalLink', 'deleted_by', 'id');
    }

    public function updatedEntity() {

        return $this->hasMany('App\Entity', 'updated_by', 'id');
    }

    public function deletedEntity() {

        return $this->hasMany('App\Entity', 'deleted_by', 'id');
    }

    public function updatedEntityName() {

        return $this->hasMany('App\EntityName', 'updated_by', 'id');
    }

    public function deletedEntityName() {

        return $this->hasMany('App\EntityName', 'deleted_by', 'id');
    }

    public function updatedEntType() {

        return $this->hasMany('App\EntType', 'updated_by', 'id');
    }

    public function deletedEntType() {

        return $this->hasMany('App\EntType', 'deleted_by', 'id');
    }

    public function updatedEntTypeName() {

        return $this->hasMany('App\EntTypeName', 'updated_by', 'id');
    }

    public function deletedEntTypeName() {

        return $this->hasMany('App\EntTypeName', 'deleted_by', 'id');
    }

    public function updatedLanguage() {

        return $this->hasMany('App\Language', 'updated_by', 'id');
    }

    public function deletedLanguage() {

        return $this->hasMany('App\Language', 'deleted_by', 'id');
    }

    public function updatedProcess() {

        return $this->hasMany('App\Process', 'updated_by', 'id');
    }

    public function deletedProcess() {

        return $this->hasMany('App\Process', 'deleted_by', 'id');
    }

    public function updatedProcessName() {

        return $this->hasMany('App\ProcessName', 'updated_by', 'id');
    }

    public function deletedProcessName() {

        return $this->hasMany('App\ProcessName', 'deleted_by', 'id');
    }

    public function updatedProcessType() {

        return $this->hasMany('App\ProcessType', 'updated_by', 'id');
    }

    public function deletedProcessType() {

        return $this->hasMany('App\ProcessType', 'deleted_by', 'id');
    }

    public function updatedProcessTypeName() {

        return $this->hasMany('App\ProcessTypeName', 'updated_by', 'id');
    }

    public function deletedProcessTypeName() {

        return $this->hasMany('App\ProcessTypeName', 'deleted_by', 'id');
    }

    public function updatedPropAllowedValue() {

        return $this->hasMany('App\PropAllowedValue', 'updated_by', 'id');
    }

    public function deletedPropAllowedValue() {

        return $this->hasMany('App\PropAllowedValue', 'deleted_by', 'id');
    }

    public function updatedPropAllowedValueName() {

        return $this->hasMany('App\PropAllowedValueName', 'updated_by', 'id');
    }

    public function deletedPropAllowedValueName() {

        return $this->hasMany('App\PropAllowedValueName', 'deleted_by', 'id');
    }

    public function updatedProperty() {

        return $this->hasMany('App\Property', 'updated_by', 'id');
    }

    public function deletedProperty() {

        return $this->hasMany('App\Property', 'deleted_by', 'id');
    }

    public function updatedPropertyName() {

        return $this->hasMany('App\PropertyName', 'updated_by', 'id');
    }

    public function deletedPropertyName() {

        return $this->hasMany('App\PropertyName', 'deleted_by', 'id');
    }

    public function updatedPropUnitType() {

        return $this->hasMany('App\PropUnitType', 'updated_by', 'id');
    }

    public function deletedPropUnitType() {

        return $this->hasMany('App\PropUnitType', 'deleted_by', 'id');
    }

    public function updatedPropUnitTypeName() {

        return $this->hasMany('App\PropUnitTypeName', 'updated_by', 'id');
    }

    public function deletedPropUnitTypeName() {

        return $this->hasMany('App\PropUnitTypeName', 'deleted_by', 'id');
    }

    public function updatedRole() {

        return $this->hasMany('App\Role', 'updated_by', 'id');
    }

    public function deletedRole() {

        return $this->hasMany('App\Role', 'deleted_by', 'id');
    }

    public function updatedRoleHasActor() {

        return $this->hasMany('App\RoleHasActor', 'updated_by', 'id');
    }

    public function deletedRoleHasActor() {

        return $this->hasMany('App\RoleHasActor', 'deleted_by', 'id');
    }

    public function updatedRoleHasUser() {

        return $this->hasMany('App\RoleHasUser', 'updated_by', 'id');
    }

    public function deletedRoleHasUser() {

        return $this->hasMany('App\RoleHasUser', 'deleted_by', 'id');
    }

    public function updatedRoleName() {

        return $this->hasMany('App\RoleName', 'updated_by', 'id');
    }

    public function deletedRoleName() {

        return $this->hasMany('App\RoleName', 'deleted_by', 'id');
    }

    public function updatedTransaction() {

        return $this->hasMany('App\Transaction', 'updated_by', 'id');
    }

    public function deletedTransaction() {

        return $this->hasMany('App\Transaction', 'deleted_by', 'id');
    }

    public function updatedTransactionAck() {

        return $this->hasMany('App\TransactionAck', 'updated_by', 'id');
    }

    public function deletedTransactionAck() {

        return $this->hasMany('App\TransactionAck', 'deleted_by', 'id');
    }

    public function updatedTransactionState() {

        return $this->hasMany('App\TransactionState', 'updated_by', 'id');
    }

    public function deletedTransactionState() {

        return $this->hasMany('App\TransactionState', 'deleted_by', 'id');
    }

    public function updatedTransactionType() {

        return $this->hasMany('App\TransactionType', 'updated_by', 'id');
    }

    public function deletedTransactionType() {

        return $this->hasMany('App\TransactionType', 'deleted_by', 'id');
    }

    public function updatedTransactionTypeName() {

        return $this->hasMany('App\TransactionTypeName', 'updated_by', 'id');
    }

    public function deletedTransactionTypeName() {

        return $this->hasMany('App\TransactionTypeName', 'deleted_by', 'id');
    }

    public function updatedTState() {

        return $this->hasMany('App\TState', 'updated_by', 'id');
    }

    public function deletedTState() {

        return $this->hasMany('App\TState', 'deleted_by', 'id');
    }

    public function updatedTStateName() {

        return $this->hasMany('App\TStateName', 'updated_by', 'id');
    }

    public function deletedTStateName() {

        return $this->hasMany('App\TStateName', 'deleted_by', 'id');
    }

    public function updatedValue() {

        return $this->hasMany('App\Value', 'updated_by', 'id');
    }

    public function deletedValue() {

        return $this->hasMany('App\Value', 'deleted_by', 'id');
    }

    public function updatedValueName() {

        return $this->hasMany('App\ValueName', 'updated_by', 'id');
    }

    public function deletedValueName() {

        return $this->hasMany('App\ValueName', 'deleted_by', 'id');
    }

     public function updatedWaitingLink() {

        return $this->hasMany('App\WaitingLink', 'updated_by', 'id');
    }

    public function deletedWaitingLink() {

        return $this->hasMany('App\WaitingLink', 'deleted_by', 'id');
    }

    public function userRole() {
        return $this->hasMany('App\RoleHasUser', 'user_id', 'id');
    }
}
