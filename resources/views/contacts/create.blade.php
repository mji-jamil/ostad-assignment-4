@extends('layouts.app')

@section('content')
    <h1>Create New Contact</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" name="address">{{ old('address') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Contact</button>
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
