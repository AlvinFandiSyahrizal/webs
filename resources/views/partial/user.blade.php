<div>
    <h2>Master Pengguna</h2>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Tambah Pengguna</button>
    </form>
    <h3>Daftar Pengguna</h3>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
</div>
