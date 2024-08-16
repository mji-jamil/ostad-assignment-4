@extends('layouts.app')

@section('content')
    <h1>Edit Contact</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $contact->name) }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $contact->email) }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $contact->phone) }}">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" name="address">{{ old('address', $contact->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
