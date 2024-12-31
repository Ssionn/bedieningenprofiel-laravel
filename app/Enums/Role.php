<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Teamleader = 'teamleader';
    case UserNoTeam = 'user_no_team';
    case User = 'user';
}
