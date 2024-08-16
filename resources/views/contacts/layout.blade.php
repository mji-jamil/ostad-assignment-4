<!DOCTYPE html>
<html>
<head>
    <title>Contact Management</title>
</head>
<body>
<header>
    <nav>
        <a href="{{ route('contacts.index') }}">Contacts</a>
        <a href="{{ route('contacts.create') }}">Create Contact</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; 2024 Contact Management</p>
</footer>
</body>
</html>
