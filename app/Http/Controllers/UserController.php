<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Scalar\String_;

class UserController extends Controller
{
    public function index()
    {
        return inertia('Users/Index', [
            'users' => User::query()
                ->when(request()->input('search'), function ($query, $search){
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => auth()->user()->can('edit', $user),
                    ]
                ]),
            'filters' => request()->only(['search']),
            'can' => [
                'createUser' => auth()->user()->can('create', User::class),
            ]
        ]);
    }

    public function create()
    {
        return inertia('Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);
        User::create($validated);
        return redirect('/users');
    }

    public function edit(string $id)
    {
        return inertia('Users/Edit', [
           'user' => User::find($id, ['name', 'email'])
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($request->user()->cannot('edit', $user)) {
            abort(401);
        }
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validated);
        return redirect('/users');
    }
}
