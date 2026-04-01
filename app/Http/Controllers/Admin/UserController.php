<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     public function __construct()
        {
            $this->authorizeResource(User::class, 'user');
        }
    public function index(Request $request)
        {

            $users = User::where('type', 'admin') 
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->paginate(10);

            return view('admin.users.index', compact('users'));
        }

    // Show create page
    public function create()
    {
       $permissions = config('permissions');

        $groupedPermissions = [];

        foreach ($permissions as $key => $label) {
            $group = explode('.', $key)[0]; // categories, products, etc.
            $groupedPermissions[$group][$key] = $label;
        }

        return view('admin.users.create', compact('groupedPermissions'));
    }

    // Store new user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email'=> $data['email'],
                'email_verified_at'=> now(),
                'type'=> 'admin',
                'password'=> Hash::make($data['password']),
            ]);

            $permissions = $request->post('permissions', []);

            $insertData = [];
            foreach ($permissions as $code) {
                $insertData[] = [
                    'user_id' => $user->id,
                    'permission' => $code,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($insertData)) {
                DB::table('users_permissions')->insert($insertData);
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                             ->with('success', 'User created successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // Show edit page
    public function edit(User $user)
    {
            $permissions = config('permissions');

            $groupedPermissions = [];

            foreach ($permissions as $key => $label) {
                $group = explode('.', $key)[0];
                $groupedPermissions[$group][$key] = $label;
            }

        // Get user permissions as array
        $userPermissions = DB::table('users_permissions')
                             ->where('user_id', $user->id)
                             ->pluck('permission')
                             ->toArray();



        return view('admin.users.edit', compact('user', 'groupedPermissions', 'userPermissions'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // optional
        ]);

        DB::beginTransaction();

        try {
            $user->name = $data['name'];
            $user->email = $data['email'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            // Update permissions
            $permissions = $request->post('permissions', []);

            // Delete old permissions
            DB::table('users_permissions')->where('user_id', $user->id)->delete();

            $insertData = [];
            foreach ($permissions as $code) {
                $insertData[] = [
                    'user_id' => $user->id,
                    'permission' => $code,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($insertData)) {
                DB::table('users_permissions')->insert($insertData);
            }

            DB::commit();

            return redirect()->route('admin.users.index')
                             ->with('success', 'User updated successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function destroy(User $user)
{
    DB::beginTransaction();

    try {
       
        DB::table('users_permissions')->where('user_id', $user->id)->delete();

       
        $user->delete();

        DB::commit();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');

    } catch (\Throwable $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}
}