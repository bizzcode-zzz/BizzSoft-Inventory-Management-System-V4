@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS EXTERNAL: Ginamitan ng page-content selector mula sa app.css asset sheet niyo -->
<div class="container mt-4 page-content">

    <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT -->
    <x-errors />

    <!-- =========================================================================
         🎯 BUSINESS-CENTRIC HEADING SECTION (100% Clean)
         ========================================================================= -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-bold">👤 User Management</h1>
            <p class="text-muted page-description-text">Manage system access, roles, and account statuses.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary px-4 font-weight-bold shadow-sm">
            ➕ Create New User
        </a>
    </div>

    <!-- =========================================================================
         🎯 SEARCH FILTER SECTION (100% Clean)
         ========================================================================= -->
    <div class="mb-4">
        <form action="{{ route('users.index') }}" method="GET" class="form-container">
            <div class="input-group">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control border-dark" 
                    placeholder="🔍 Search user by name or email..." 
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark font-weight-bold px-4">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- =========================================================================
         🎯 DATA TABLE CARD SECTION (100% Clean)
         ========================================================================= -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="m-0 font-weight-bold">📋 Registered System Users</h5>
        </div>
        <div class="card-body p-0 bg-light">
            <div class="table-responsive">
                <table class="table table-bordered table-hover m-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="280" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="align-middle">
                                <td class="font-weight-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $user->role->name }}</span>
                                </td>
                                <td>
                                    @if($user->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- Edit Button -->
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm font-weight-bold shadow-sm">
                                        ✏️ Edit
                                    </a>

                                    <!-- Reset Password Button -->
                                    <a href="{{ route('users.reset-password', $user) }}" class="btn btn-info btn-sm font-weight-bold text-white shadow-sm">
                                        🔑 Reset
                                    </a>

                                    <!-- Toggle Status Form (Deactivate/Activate) -->
                                    <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')

                                        @if($user->status)
                                            <button type="submit" class="btn btn-danger btn-sm font-weight-bold shadow-sm" onclick="return confirm('Deactivate this user?')">
                                                🛑 Deactivate
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm font-weight-bold shadow-sm" onclick="return confirm('Activate this user?')">
                                                ✅ Activate
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No users found matching the criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 🎯 SEAMLESS EXTERNAL: Ginamitan ng footer-bumper-spacer sheet rules blocking engine wrapper -->
    <div class="footer-bumper-spacer"></div>

</div>

@endsection
