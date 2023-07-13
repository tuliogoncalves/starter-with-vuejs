<?php

namespace App\Repositories;

use App\Models\User;
use Scriptpage\Repository\BaseRepository as ScriptpageRepository;

class BaseRepository extends ScriptpageRepository
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
        ];
    }

    public function setDataPayload(array $data=[])
    {
        $this->fill($data);
    }

    function search(string $search='')
    {
        $query = $this->getBuilder();
        // $query->Where('name', 'like', '%' . $search . '%');
        
        return $query;
    }

    protected function appends(): array
    {
        return [];
    }

}