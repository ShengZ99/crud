@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User List</h1>

    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="">-- Filter by Status --</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <!-- Add other statuses as needed -->
            </select>
        </div>
    </div>
</form>

    <form action="{{ route('users.bulk-delete') }}" method="POST" id="bulk-delete-form">
        @csrf
        <button type="submit" class="btn btn-danger mb-3">Delete Selected</button>

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><input type="checkbox" class="user-checkbox" name="users[]" value="{{ $user->id }}"></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('.user-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.getElementById('bulk-delete-form').addEventListener('submit', function (event) {
        if (!confirm('Are you sure you want to delete selected users?')) {
            event.preventDefault();
        }
    });
</script>
@endsection