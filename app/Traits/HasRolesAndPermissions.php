<?php

namespace App\Traits;

trait HasRolesAndPermissions
{
    public function getAllRoles(){
        return [
            'admin',
            'customer',
        ];
    }

    public function getAllPermissions(){
        return [

        ];
    }

    public function getAllPermissionGroups()
    {
        foreach ($this->getAllPermissions() as $permission) {
            $data[explode('-', $permission)[0]][$permission] = $permission;
        }

        return $data;
    }

    public function getAdminPermissions()
    {
        return [
        ];
    }
}
