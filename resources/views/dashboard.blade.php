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

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background-color: rgb(0, 191, 255);
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin: 0;
            font-size: 2.5em;
        }

        .card p {
            margin: 10px 0 0;
        }

        .settings-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

    #settingsBtn {
        font-size: 18px;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s;
        }

#settingsBtn:hover {
    background-color:rgb(250, 250, 250);
    }

    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Website Logo" style="max-width: 100%; height: auto;">
            </div>

            <ul class="menu">
                <li><a href="{{ route('dashboard') }}" class="active">DASHBOARD</a></li>
                <li><a href="{{ route('users.index') }}">MASTER PENGGUNA</a></li>
                <li><a href="{{ route('logout') }}">LOGOUT</a></li>
            </ul>
        </div>

        <div class="content">


            <div class="settings-button">
                <button id="settingsBtn" title="Settings">
                    ⚙️
                </button>
            </div>

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
    </div>
</body>
</html>
