@extends('layout.master')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <h3 class="text-3xl font-extrabold text-indigo-400 mb-8 text-center">🖊️ Ubah Profil</h3>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
        <!-- Kolom Kiri: Info Profil -->
        <div class="bg-gray-50 p-6 rounded-xl shadow-md border border-gray-200 text-center">
            @if ($user->profile && $user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}"
                    class="w-36 h-36 object-cover rounded-full mx-auto shadow border border-gray-300 mb-4">
            @else
                <div class="w-36 h-36 bg-gray-200 rounded-full flex items-center justify-center mx-auto text-gray-500 shadow mb-4">
                    <i class="fas fa-user text-4xl"></i>
                </div>
            @endif

            <h5 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h5>
            <p class="text-gray-600 text-sm">{{ $user->email }}</p>
            <p class="mt-2 text-gray-500"><strong>No HP:</strong> {{ $user->profile->phone_number ?? '-' }}</p>
            <p class="text-gray-500"><strong>Alamat:</strong> {{ $user->profile->address ?? '-' }}</p>
        </div>

        <!-- Kolom Kanan: Form Edit Profil -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="md:col-span-2 space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 shadow-sm">
            </div>

            <div>
                <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-1">No HP</label>
                <input id="phone_number" name="phone_number" type="text" value="{{ old('phone_number', $user->profile->phone_number ?? '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 shadow-sm">
            </div>

            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <input id="address" name="address" type="text" value="{{ old('address', $user->profile->address ?? '') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 shadow-sm">
            </div>

            <div>
                <label for="profile_picture" class="block text-sm font-semibold text-gray-700 mb-2">Ubah Foto</label>
                <input id="profile_picture" name="profile_picture" type="file"
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0 file:font-semibold
                        file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 transition">
            </div>

            <!-- Tombol -->
            <div class="flex justify-between items-center pt-6">
                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2 bg-gradient-to-r from-indigo-300 to-blue-300 text-black rounded-full shadow-md hover:brightness-105 transition duration-200 ease-in-out font-semibold">
                    <i class="fas fa-save text-black"></i> Simpan
                </button>

                <a href="{{ url()->previous() }}"
    class="px-6 py-2 bg-gradient-to-r from-gray-300 to-gray-500 text-black rounded-full hover:brightness-110 hover:scale-105 transform transition duration-200 ease-in-out font-semibold shadow-md">
    <i class="fas fa-arrow-left text-black mr-2"></i> Kembali
</a>

            </div>
        </form>
    </div>
</div>
@endsection
