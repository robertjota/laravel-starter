<?php

namespace App\Exports;

use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Role::select('id', 'name', 'created_at')->get()->map(function ($role) {
            $role->permissions = $role->getPermissionNames()->implode(', ');
            return $role;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Permisos',
            'Fecha de Creación',
        ];
    }
}
