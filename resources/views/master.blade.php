<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- 1. Ini adalah link "ajaib" yang membuat Tailwind CSS bekerja --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- 2. Judul halaman yang dinamis --}}
    <title>@yield('title', 'Aplikasi Karyawan')</title>

</head>
<body class="bg-gray-100 text-gray-800">

    {{-- 3. Bagian Navigasi Utama --}}
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                {{-- Logo/Brand --}}
                <a class="text-2xl font-bold" href="/">Manajemen Karyawan</a>
                
                {{-- Link Navigasi --}}
                <ul class="flex space-x-6">
                    <li><a href="{{ route('employees.index') }}" class="hover:text-blue-200">Employees</a></li>
                    <li><a href="{{ route('departments.index') }}" class="hover:text-blue-200">Departments</a></li>
                    <li><a href="{{ route('positions.index') }}" class="hover:text-blue-200">Positions</a></li>
                    <li><a href="{{ route('attendances.index') }}" class="hover:text-blue-200">Attendances</a></li>
                    <li><a href="{{ route('salaries.index') }}" class="hover:text-blue-200">Salaries</a></li>
                </ul>

            </div>
        </div>
    </nav>

    {{-- 4. Konten Utama Halaman --}}
    <main class="container mx-auto px-4 mt-8">
        {{-- Di sinilah semua konten dari file (index, create, edit) akan dimasukkan --}}
        @yield('content')
    </main>
    
    {{-- (Tidak perlu script JS seperti Bootstrap, Tailwind adalah CSS murni) --}}
</body>
</html>