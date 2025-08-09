<?php

namespace App\Enums;

enum LookStatusEnum: string
{
    case ACTIVE = 'active';
    case DELETED = 'deleted';
    case TESTING = 'testing';
    case HIDDEN = 'hidden';
}
