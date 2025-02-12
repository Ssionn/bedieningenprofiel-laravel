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

test('plans schema has expected columns', function () {
    $this->assertTrue(
        Schema::hasColumns('plans', [
            'id',
            'name',
            'price',
            'max_teams',
            'max_users_per_team',
            'created_at',
            'updated_at',
        ]),
        'The plans table is missing expected columns.'
    );
});

test('foreign keys are correctly defined', function () {
    $this->assertTrue(
        Schema::hasColumn('teams', 'user_id'),
        'The teams table is missing the owner_id foreign key.'
    );

    $this->assertTrue(
        Schema::hasColumn('user_subscription', 'plan_id'),
        'The user_subscription table is missing the plan_id foreign key.'
    );

    $this->assertTrue(
        Schema::hasColumn('user_subscription', 'user_id'),
        'The user_subscription table is missing the user_id foreign key.'
    );
});
