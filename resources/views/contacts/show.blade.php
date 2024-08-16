@extends('layouts.app')

@section('content')
    <h1>Contact Details</h1>

    <div>
        <strong>Name:</strong> {{ $contact->name }}
    </div>
    <div>
        <strong>Email:</strong> {{ $contact->email }}
    </div>
    <div>
        <strong>Phone:</strong> {{ $contact->phone }}
    </div>
    <div>
        <strong>Address:</strong> {{ $contact->address }}
    </div>

    <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit Contact</a>
    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Contact</button>
    </form>
@endsection
