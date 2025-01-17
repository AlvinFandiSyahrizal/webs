<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .cards {
    display: flex;
    gap: 20px;
    margin-top: 20px;
        }

        .card {
    flex: 1;
    background-color: #007BFF; /* Warna biru */
    color: white;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
        }

        .card h2 {
    font-size: 36px;
    margin: 0;
        }

        .card p {
    font-size: 16px;
    margin: 10px 0 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: block;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar ul li a.active,
        .sidebar ul li a:hover {
            background-color: rgb(0, 191, 255);
            color: white;
        }

        .content {
            width: 80%;
            padding: 30px;
        }

        .button {
            margin-bottom: 20px;
            text-align: left;
        }

        .button a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
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

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .flash-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
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
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-width: 100%; height: auto;">
            </div>

            <ul class="menu">
                <li><a href="#" id="dashboardBtn" class="active">DASHBOARD</a></li>
                <li><a href="#" id="masterPenggunaBtn">MASTER PENGGUNA</a></li>
                <li><a href="{{ route('logout') }}">LOGOUT</a></li>
            </ul>
        </div>

        <div class="content">
            <!-- Dashboard Content -->
            <div id="dashboardContent">
                <h1>Dashboard</h1>
                <div class="cards">
                    <div class="card">
                        <h2>{{ $usersCount }}</h2>
                        <p>Pengguna Terdaftar</p>
                    </div>
                    <div class="card">
                        <h2>{{ $activeUsersCount }}</h2>
                        <p>Pengguna Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Master Pengguna Content -->
            <div id="masterPenggunaContent" style="display: none;">
                <h1>Master Pengguna</h1>

                <!-- Tombol tambah pengguna -->
                <div class="button">
                    <a id="toggleFormBtn" href="#">Tambah Pengguna</a>
                </div>

                <!-- Table -->
                <div id="tableSection">
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
                </div>

                <!-- Form tambah pengguna -->
                <div id="formSection" class="form-container" style="display: none;">
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
                        <button type="button" id="cancelFormBtn">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dashboardBtn = document.getElementById('dashboardBtn');
        const masterPenggunaBtn = document.getElementById('masterPenggunaBtn');
        const dashboardContent = document.getElementById('dashboardContent');
        const masterPenggunaContent = document.getElementById('masterPenggunaContent');

        const toggleFormBtn = document.getElementById('toggleFormBtn');
        const tableSection = document.getElementById('tableSection');
        const formSection = document.getElementById('formSection');
        const cancelFormBtn = document.getElementById('cancelFormBtn');

        dashboardBtn.addEventListener('click', (e) => {
            e.preventDefault();
            dashboardContent.style.display = 'block';
            masterPenggunaContent.style.display = 'none';
            dashboardBtn.classList.add('active');
            masterPenggunaBtn.classList.remove('active');
        });

        masterPenggunaBtn.addEventListener('click', (e) => {
            e.preventDefault();
            masterPenggunaContent.style.display = 'block';
            dashboardContent.style.display = 'none';
            masterPenggunaBtn.classList.add('active');
            dashboardBtn.classList.remove('active');
        });

        toggleFormBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const isTableVisible = tableSection.style.display !== 'none';
            tableSection.style.display = isTableVisible ? 'none' : 'block';
            formSection.style.display = isTableVisible ? 'block' : 'none';
        });

        cancelFormBtn.addEventListener('click', () => {
            tableSection.style.display = 'block';
            formSection.style.display = 'none';
        });
    </script>
</body>
</html>
