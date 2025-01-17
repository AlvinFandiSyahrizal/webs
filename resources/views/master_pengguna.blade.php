<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .button {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .button a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .form-container {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .actions form {
            display: inline-block;
        }

        .actions button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .actions .edit {
            background-color: #28a745;
        }

        .actions .delete {
            background-color: #dc3545;
        }

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            table, th, td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <h1>Master Pengguna</h1>
    <div class="container">
        @if (session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="flash-message" style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="button">
            <a href="#form-tambah">Tambah Pengguna</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="actions">
                        <a href="{{ route('users.edit', $user->id) }}" class="edit">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="form-tambah" class="form-container">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
