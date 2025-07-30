<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return User::create($data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User deleted']);
    }
}