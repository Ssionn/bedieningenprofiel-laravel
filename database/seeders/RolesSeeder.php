<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    private readonly array $roles;

    public function __construct()
    {
        $this->roles = RoleEnum::cases();
    }

    public function run(): void
    {
        foreach ($this->roles as $role) {
            $this->createRole($role->value);
        }
    }

    private function createRole(string $role): void
    {
        Role::create([
            'name' => $role,
        ]);
    }
}
