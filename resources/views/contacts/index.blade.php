@extends('layouts.app')

@section('content')
    <h1>Contact List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Create New Contact</a>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary ml-2">Show All Contacts</a>
    </div>

    <form method="GET" action="{{ route('contacts.index') }}" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search by name or email" value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>

    @if($contacts->isEmpty())
        <p>No contacts available.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>
                    Name
                    <form method="GET" action="{{ route('contacts.index') }}" style="display:inline;">
                        <input type="hidden" name="sort" value="name">
                        <input type="hidden" name="direction" value="{{ $sortField == 'name' && $sortDirection == 'asc' ? 'desc' : 'asc' }}">
                        <button type="submit" class="btn btn-link p-0 ml-2">
                            @if ($sortField == 'name')
                                @if ($sortDirection == 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @else
                                ↕
                            @endif
                        </button>
                    </form>
                </th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>
                    Created At
                    <form method="GET" action="{{ route('contacts.index') }}" style="display:inline;">
                        <input type="hidden" name="sort" value="created_at">
                        <input type="hidden" name="direction" value="{{ $sortField == 'created_at' && $sortDirection == 'asc' ? 'desc' : 'asc' }}">
                        <button type="submit" class="btn btn-link p-0 ml-2">
                            @if ($sortField == 'created_at')
                                @if ($sortDirection == 'asc')
                                    ▲
                                @else
                                    ▼
                                @endif
                            @else
                                ↕
                            @endif
                        </button>
                    </form>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
