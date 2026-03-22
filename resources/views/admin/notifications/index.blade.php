@extends('layouts.admin.app')

@section('content')
<h1>All Notifications</h1>

<table class="table">
    <thead>
        <tr>
            <th>Message</th>
            <th>Total</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($notifications as $notification)
        <tr @if(is_null($notification->read_at)) style="font-weight:bold;" @endif>
            <td>{{ $notification->data['message'] }}</td>
            <td>${{ $notification->data['total'] ?? '-' }}</td>
            <td>{{ is_null($notification->read_at) ? 'Unread' : 'Read' }}</td>
            <td>{{ $notification->created_at->diffForHumans() }}</td>
            <td>
                @if(is_null($notification->read_at))
                <a href="{{ route('admin.notifications.read', $notification->id) }}" class="btn btn-sm btn-primary">Mark as Read</a>
                @endif
                
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No notifications found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection