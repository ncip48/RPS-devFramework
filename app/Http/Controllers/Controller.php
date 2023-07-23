<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getGuard()
    {
        if (Auth::guard('web')->check()) {
            return 'web';
        } else if (Auth::guard('institute')->check()) {
            return 'institute';
        } else if (Auth::guard('personal')->check()) {
            return 'personal';
        }
    }

    public function getRoleName()
    {
        if (Auth::guard('web')->check()) {
            return 'Superadmin';
        } else if (Auth::guard('institute')->check()) {
            return 'Institusi';
        } else if (Auth::guard('personal')->check()) {
            return 'Personal';
        }
    }

    public function responseJson(bool $success, $data, string $message, int $status = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function isAdminGuard()
    {
        if (Auth::guard('web')->check()) {
            return true;
        } else if (Auth::guard('institute')->check()) {
            return false;
        } else if (Auth::guard('personal')->check()) {
            return false;
        }
    }

    public static function getInstituteId()
    {
        if (Auth::guard('web')->check()) {
            return null;
        } else if (Auth::guard('institute')->check()) {
            return Auth::guard('institute')->user()->id;
        } else if (Auth::guard('personal')->check()) {
            return Auth::guard('personal')->user()->institute_id;
        }
    }

    public static function isPersonalGuard()
    {
        if (Auth::guard('web')->check()) {
            return false;
        } else if (Auth::guard('institute')->check()) {
            return false;
        } else if (Auth::guard('personal')->check()) {
            return true;
        }
    }

    public static function getPersonalId()
    {
        if (Auth::guard('web')->check()) {
            return null;
        } else if (Auth::guard('institute')->check()) {
            return null;
        } else if (Auth::guard('personal')->check()) {
            return Auth::guard('personal')->user()->id;
        }
    }
}
