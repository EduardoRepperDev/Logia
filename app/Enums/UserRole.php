<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case Coordinator = 'coordinator';
    case TrainerSenior = 'trainer_senior';
    case TrainerJunior = 'trainer_junior';
    case Student = 'student';
    case Guest = 'guest';
}
