<?php

use Illuminate\Support\Facades\Schema;

test('users schema has expected columns', function () {
    $this->assertTrue(
        Schema::hasColumns('users', [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'avatar',
            'role_id',
            'team_id',
            'remember_token',
            'created_at',
            'updated_at',
        ]),
        'The users table is missing expected columns.'
    );
});

test('teams schema has expected columns', function () {
    $this->assertTrue(
        Schema::hasColumns('teams', [
            'id',
            'name',
            'description',
            'owner_id',
            'created_at',
            'updated_at',
        ]),
        'The teams table is missing expected columns.'
    );
});

test('roles schema has expected columns', function () {
    $this->assertTrue(
        Schema::hasColumns('roles', [
            'id',
            'name',
            'global_team_id',
            'created_at',
            'updated_at',
        ]),
        'The roles table is missing expected columns.'
    );
});

test('foreign keys are correctly defined', function () {
    $this->assertTrue(
        Schema::hasColumn('users', 'team_id'),
        'The users table is missing the team_id foreign key.'
    );

    $this->assertTrue(
        Schema::hasColumn('users', 'role_id'),
        'The users table is missing the role_id foreign key.'
    );

    $this->assertTrue(
        Schema::hasColumn('teams', 'owner_id'),
        'The teams table is missing the owner_id foreign key.'
    );
});
