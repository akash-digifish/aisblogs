<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom Styles -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
            background-color: #343a40;
        }

        .sidebar a {
            color: #ccc;
            text-decoration: none;
            padding: 15px;
            display: block;
        }

        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }

        footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
    <!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="content">
        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page-Specific Scripts -->
    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Enable time picker with AM/PM -->
<script>
    flatpickr("input[name='published_at']", {
        enableTime: true,
        dateFormat: "Y-m-d h:i K", // 12-hour with AM/PM
        time_24hr: false
    });
</script>

</body>
</html>
