<?php

namespace App\Http\Controllers;

use App\Http\Resources\Users\UserResource;
use App\Services\Users\GetAllUsers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private GetAllUsers $getAllUsers) {}

    /**
     * Retrieves a list of users.
     */
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'integer|min:1'
        ]);

        return UserResource::collection(
            $this->getAllUsers->execute($request->get('page', 1))
        );
    }
}
