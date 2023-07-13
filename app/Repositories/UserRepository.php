<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;

class UserRepository extends BaseRepository
{
    protected $modelClass = User::class;
    protected $allowFilters = true;
    protected $ignoreValidationException = true;
    // protected $stopOnFirstFailure = true;

    protected $validationClass = [
        // 'update' => UserUpdate::class
    ];

    protected $customFilters = [
        'search'
    ];

    // public function authorize() {
    //     return ($this->x > 10);
    // }

    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|min:5'
        ];
    }

    public function setDataPayload(array $data=[])
    {
        $this->fill($data);
    }

    function search(string $search='')
    {
        $query = $this->getBuilder();
        $query->Where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
        return $query;
    }

    function updateRoles($user)
    {
        $roles = $this->roles ?? [];

        foreach ($user->roles as $role) {
            if (array_search($role->name, $roles) === false) {
                $role->delete();
            }
        }

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'user_id' => $user->id,
                'name' => $role
            ]);
        }
    }
}