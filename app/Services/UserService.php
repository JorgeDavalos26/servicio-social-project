<?php 

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class UserService {

    private $nameOfService;

    function __construct($nameOfService) {
        $this->nameOfService = $nameOfService;
    }

    public function getUser() {
        return Auth::user();
    }

    public function getUsername() {
        return Auth::user()->username;
    }

    public function getEmail() {
        return Auth::user()->email;
    }

    public function isAdmin() {
        return Auth::user()->isAdmin;
    }

    public function isSupport() {
        return Auth::user()->isSupport;
    }

}