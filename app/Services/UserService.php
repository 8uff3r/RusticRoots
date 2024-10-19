<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserRole;

class UserService
{
  public function customers()
  {
    return User::where('role', UserRole::CUSTOMER->value)->get();
  }

  public function admins()
  {
    return User::where('role', UserRole::ADMIN->value)->get();
  }
}
