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
            'customer-create',

            'video-index',
            'video-create',
            'video-edit',
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
            'customer-create',

            'video-index',
            'video-create',
            'video-edit',
        ];
    }
}
