@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Create User</h2>

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>

            <input
                type="password"
                name="password"
                class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>

            <select
                name="role_id"
                class="form-select">

                @foreach($roles as $role)

                    <option value="{{ $role->id }}">

                        {{ $role->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">

            <label class="form-label">Status</label>

            <select
                name="status"
                class="form-select">

                <option value="1">Active</option>

                <option value="0">Inactive</option>

            </select>

        </div>

        <button class="btn btn-success">

            Save User

        </button>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection