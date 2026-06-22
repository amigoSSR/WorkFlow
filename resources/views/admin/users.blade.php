<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="p-8 max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-4">User Management</h1>
            <p class="text-gray-600 mb-6">Halaman user management akan ditampilkan di sini.</p>
            <a href="{{ route('admin.dashboard') }}" class="bg-primary-container text-white px-4 py-2 rounded">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
