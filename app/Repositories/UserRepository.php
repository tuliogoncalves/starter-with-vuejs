<?php

namespace App\Repositories;

use App\Models\User;
use Scriptpage\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $modelClass = User::class;
    protected $allowFilters = true;
    protected $ignoreValidation = false;
    // protected $stopOnFirstFailure = true;

    protected $validationClass = [
        // 'store' => UserStore::class
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
            'name' => 'required|max:5',
            'email' => 'required|email|min:15'
        ];
    }

    public function setDataPayload(array $data)
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

    protected function appends(): array
    {
        return [];
    }
}