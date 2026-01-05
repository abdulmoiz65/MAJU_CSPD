<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = Admin::orderBy('created_at', 'desc')->paginate(10);
        return view('cspd_admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('cspd_admin.pages.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:admins',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['maju.edu.pk', 'jinnah.edu'];
                    $domain = substr(strrchr($value, '@'), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Only @maju.edu.pk and @jinnah.edu email addresses are allowed.');
                    }
                },
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        return view('cspd_admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = Admin::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($user->id),
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['maju.edu.pk', 'jinnah.edu'];
                    $domain = substr(strrchr($value, '@'), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Only @maju.edu.pk and @jinnah.edu email addresses are allowed.');
                    }
                },
            ],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = Admin::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
