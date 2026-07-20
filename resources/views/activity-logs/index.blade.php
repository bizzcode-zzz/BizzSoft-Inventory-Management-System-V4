@extends('layouts.app')

@section('content')
<div class="card-header d-flex justify-content-between align-items-center">

    <h4 class="mb-0">
        Activity Logs
    </h4>

</div>



<div class="card-body">

    <form action="{{ route('activity-logs.index') }}" method="GET">

        <div class="row mb-3">

            <div class="col-md-6">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search activity logs..."
                    value="{{ request('search') }}"
                >

            </div>

            <div class="col-md-2">

                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    Search
                </button>

            </div>

        </div>




         <div class="row mb-3">

    <div class="col-md-3">

        <select name="module" class="form-select">

            <option value="" {{ request('module') == '' ? 'selected' : '' }}>
                All Modules
            </option>

            <option value="Product" {{ request('module') == 'Product' ? 'selected' : '' }}>
                Product
            </option>

            <option value="Category" {{ request('module') == 'Category' ? 'selected' : '' }}>
                Category
            </option>

            <option value="Supplier" {{ request('module') == 'Supplier' ? 'selected' : '' }}>
                Supplier
            </option>

            <option value="Purchase" {{ request('module') == 'Purchase' ? 'selected' : '' }}>
                Purchase
            </option>

            <option value="Sales" {{ request('module') == 'Sales' ? 'selected' : '' }}>
                Sales
            </option>

            <option value="User" {{ request('module') == 'User' ? 'selected' : '' }}>
                User
            </option>

        </select>

    </div>

    <div class="col-md-3">

        <select name="action" class="form-select">

            <option value="" {{ request('action') == '' ? 'selected' : '' }}>
                All Actions
            </option>

            <option value="Created" {{ request('action') == 'Created' ? 'selected' : '' }}>
                Created
            </option>

            <option value="Updated" {{ request('action') == 'Updated' ? 'selected' : '' }}>
                Updated
            </option>

            <option value="Deleted" {{ request('action') == 'Deleted' ? 'selected' : '' }}>
                Deleted
            </option>

        </select>

    </div>

</div>

    </form>





   




<div class="table-responsive">

    <table class="table table-bordered table-hover align-middle">

        <thead class="table-dark">

            <tr>

                <th>Date & Time</th>

                <th>User</th>

                <th>Module</th>

                <th>Action</th>

                <th>Description</th>

            </tr>

        </thead>

        <tbody>

            <tbody>

    @forelse($activityLogs as $activityLog)

        <tr>

            <td>
                {{ $activityLog->created_at->format('M d, Y h:i A') }}
            </td>

            <td>
                {{ $activityLog->user->name ?? 'System' }}
            </td>

            <td>

                <span class="badge bg-primary">

                    {{ $activityLog->module }}

                </span>

            </td>

            <td>

    @if($activityLog->action == 'Created')

        <span class="badge bg-success">
            {{ $activityLog->action }}
        </span>

    @elseif($activityLog->action == 'Updated')

        <span class="badge bg-warning text-dark">
            {{ $activityLog->action }}
        </span>

    @elseif($activityLog->action == 'Deleted')

        <span class="badge bg-danger">
            {{ $activityLog->action }}
        </span>

    @else

        <span class="badge bg-secondary">
            {{ $activityLog->action }}
        </span>

    @endif

</td>

            <td style="white-space: pre-line;">
    {{ $activityLog->description }}
</td>

        </tr>

    @empty

        <tr>

            <td colspan="5" class="text-center">
                No activity logs found.
            </td>

        </tr>

    @endforelse

</tbody>

        </tbody>

    </table>

</div>
<div class="mt-3">
    {{ $activityLogs->links() }}
</div>

@endsection