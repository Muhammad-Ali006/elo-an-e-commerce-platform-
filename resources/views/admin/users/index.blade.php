@extends('admin.layout')

@section('title', 'Users')

@section('content')
    <div class="page-header">
        <h2>Users</h2>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Joined</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge badge-processing">Admin</span>
                            @else
                                <span class="badge badge-pending">User</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="actions">
                                @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.toggle-admin', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-warning' : 'btn-primary' }}">
                                            {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete user {{ addslashes($user->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @else
                                    <span style="color:#888;font-size:13px;">(you)</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination" style="margin-top:20px;">{{ $users->links() }}</div>
    </div>
@endsection
