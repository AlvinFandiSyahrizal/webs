<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
            background-color: #007BFF;
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
                <img src="{{ auth()->user()->dashboard_logo ? asset('storage/' . auth()->user()->dashboard_logo) : asset('path/to/default/dashboard-logo.png') }}" alt="Logo Dashboard">
            </div>


            <ul class="menu">
                <li><a href="#" id="dashboardBtn" class="active">DASHBOARD</a></li>
                <li><a href="#" id="masterPenggunaBtn">MASTER PENGGUNA</a></li>
                <li><a href="{{ route('logout') }}">LOGOUT</a></li>
            </ul>
        </div>

        <!-- Button for Settings in Dashboard -->
            <div style="position: absolute; top: 20px; right: 20px;">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#settingsModal">
                        <i class="bi bi-gear"></i> Pengaturan
                    </button>
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

            <div id="masterPenggunaContent" style="display: none;">
                <h1>Master Pengguna</h1>

                <div class="button">
                    <a id="toggleFormBtn" href="#">Tambah Pengguna</a>
                </div>

                <div id="formSection" style="display: none;">
                    <div class="form-container">
                        <h3>Form Tambah Pengguna</h3>
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
                                    <a href="#"
                                       class="edit btn btn-primary btn-sm"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editModal"
                                       data-id="{{ $user->id }}"
                                       data-name="{{ $user->name }}"
                                       data-email="{{ $user->email }}">
                                       Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div>
                            <label for="editPassword_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="editPassword_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Settings -->
<div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">Pengaturan Website</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="background_image" class="form-label">Gambar Latar Belakang</label>
                        <input type="file" class="form-control" name="background_image" id="background_image">
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                    </div>

                    <div class="mb-3">
                        <label for="menu_order" class="form-label">Susunan Menu Navigasi</label>
                        <input type="text" class="form-control" name="menu_order" id="menu_order" placeholder="Misal: Home, Dashboard, Logout">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script>

        document.getElementById('dashboardBtn').addEventListener('click', function() {
            document.getElementById('dashboardContent').style.display = 'block';
            document.getElementById('masterPenggunaContent').style.display = 'none';
            this.classList.add('active');
            document.getElementById('masterPenggunaBtn').classList.remove('active');
        });

        document.getElementById('masterPenggunaBtn').addEventListener('click', function() {
            document.getElementById('dashboardContent').style.display = 'none';
            document.getElementById('masterPenggunaContent').style.display = 'block';
            this.classList.add('active');
            document.getElementById('dashboardBtn').classList.remove('active');
        });

        document.getElementById('toggleFormBtn').addEventListener('click', function() {
            const formSection = document.getElementById('formSection');
            const tableSection = document.getElementById('tableSection');

            if (formSection.style.display === 'none') {
                formSection.style.display = 'block';
                tableSection.style.display = 'none';
                this.textContent = 'Kembali ke Tabel Pengguna';
            } else {
                formSection.style.display = 'none';
                tableSection.style.display = 'block';
                this.textContent = 'Tambah Pengguna';
            }
        });

        const editButtons = document.querySelectorAll('.edit');
        editButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userEmail = this.getAttribute('data-email');
                const form = document.getElementById('editForm');
                form.action = '/users/' + userId;
                document.getElementById('editId').value = userId;
                document.getElementById('editName').value = userName;
                document.getElementById('editEmail').value = userEmail;
            });
        });
    </script>
</body>
</html>
