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
            'max_teams',
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
            'user_id',
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
            'team_id',
            'name',
            'permissions',
            'created_at',
            'updated_at',
        ]),
        'The roles table is missing expected columns.'
    );
});

test('foreign keys are correctly defined', function () {
    $this->assertTrue(
        Schema::hasColumn('teams', 'user_id'),
        'The teams table is missing the owner_id foreign key.'
    );
});
