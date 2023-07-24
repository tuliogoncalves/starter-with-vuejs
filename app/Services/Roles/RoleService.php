<?php

namespace App\Services\Roles;

class RoleService
{
    static function listOfRoles() {
        return Array(
            self::addListRole('admin', 'Adminstrador'),
            self::addListRole('admin.index', 'Adminstrador(index)'),
            self::addListRole('admin.store', 'Adminstrador(store)'),
            self::addListRole('admin.update', 'Adminstrador(update)'),
            self::addListRole('admin.show', 'Adminstrador(update)'),
            self::addListRole('admin.edit', 'Adminstrador(update)'),
            self::addListRole('info', 'PHP-Info'),
            self::addListRole('getdata', 'Repositories getData()')
        );
    }

    private static function addListRole($id, $name): array {
        return [
            'id' => $id,
            'name' => $name
        ];
    }
}