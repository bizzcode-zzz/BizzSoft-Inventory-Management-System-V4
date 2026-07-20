<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogger;
use App\Services\AuditTrailService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    if (! auth()->user()->hasPermission('users.view')) {
        abort(403);
    }

    if ($request->filled('search')) {
        $search = $request->search;

        $users = User::with('role')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->get();
    } else {
        $users = User::with('role')->get();
    }

    return view('users.index', compact('users'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    if (! auth()->user()->hasPermission('users.create')) {
        abort(403);
    }

    $roles = \App\Models\Role::all();

    return view('users.create', compact('roles'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
{
    if (! auth()->user()->hasPermission('users.create')) {
        abort(403);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,

        'password' => Hash::make($request->password),

        'role_id' => $request->role_id,

        'status' => $request->status,
    ]);


//start activity logs
    $description =
    "Created user: {$user->name}.";

    ActivityLogger::log(
    'Created',
    'User',
    $description
);
    //end activity logs



    return redirect()
        ->route('users.index')
        ->with('success', 'User created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
{
    if (! auth()->user()->hasPermission('users.edit')) {
        abort(403);
    }

    $roles = \App\Models\Role::all();

    return view('users.edit', compact('user', 'roles'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
{
    if (! auth()->user()->hasPermission('users.edit')) {
        abort(403);
    }

    $data = $request->validated();


    $oldUser = $user->replicate();

    // Kapag may bagong password, i-hash ito.
    if (! empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        // Kapag walang bagong password, huwag baguhin ang existing password.
        unset($data['password']);
    }

    $user->update($data);



    // start activity logs ginamit dito auditTrailService.php
    AuditTrailService::logUpdate(
    $oldUser,
    $user,
    'User',
    [
        'name' => 'Name',
        'email' => 'Email',
        'role_id' => 'Role',
    ],
    'name'
);
// end activity logs



    return redirect()
        ->route('users.index')
        ->with('success', 'User updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



// PARA SA DEACTIVATE / ACTIVATE FEATURE: Pindutan ng Admin para i-on o i-off ang account ng user.
    public function toggleStatus(User $user)
{
    if (! auth()->user()->hasPermission('users.edit')) {
        abort(403);
    }

    $user->status = ! $user->status;

    $user->save();

    return redirect()
        ->route('users.index')
        ->with('success', 'User status updated successfully.');
}


public function showResetPassword(User $user)
{
    if (! auth()->user()->hasPermission('users.edit')) {
        abort(403);
    }

    return view('users.reset-password', compact('user'));
}

public function resetPassword(ResetPasswordRequest $request, User $user)
{
    if (! auth()->user()->hasPermission('users.edit')) {
        abort(403);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('users.index')
        ->with('success', 'Password reset successfully.');
}
}
