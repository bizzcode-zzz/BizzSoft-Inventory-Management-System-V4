@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Reset Password</h2>

    <form action="{{ route('users.reset-password.update', $user) }}" method="POST">

        @csrf
        @method('PATCH')

        <div class="mb-3">

            <label class="form-label">

                User

            </label>

            <input
                type="text"
                class="form-control"
                value="{{ $user->name }}"
                readonly>

        </div>

        <div class="mb-3">

            <label class="form-label">

                New Password

            </label>

            <input
                type="password"
                name="password"
                class="form-control">

        </div>

        <div class="mb-3">

            <label class="form-label">

                Confirm Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control">

        </div>

        <button class="btn btn-primary">

            Reset Password

        </button>

        <a
            href="{{ route('users.index') }}"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection