<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('id', 'name', 'email', 'created_at')->get()->map(function ($user) {
            $user->roles = $user->getRoleNames()->implode(', ');
            return $user;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Correo Electrónico',
            'Roles',
            'Fecha de Creación',
        ];
    }
}
