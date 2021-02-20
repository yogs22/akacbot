<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Siswa
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Data Siswa</button>

            @if($isModal)
                @include('livewire.students.create')
            @endif

            @include('livewire.loading')

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">NISN</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">JK</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Tempat & Tgl Lahir</th>
                        <th class="px-4 py-2">No Handphone</th>
                        <th class="px-4 py-2">Agama</th>
                        <th class="px-4 py-2">Wali Murid</th>
                        <th class="px-4 py-2">Jurusan</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $row->nisn }}</td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">{{ $row->gender }}</td>
                            <td class="border px-4 py-2">{{ $row->address }}</td>
                            <td class="border px-4 py-2">{{ $row->birthplace }}, {{ $row->birthdate }}</td>
                            <td class="border px-4 py-2">{{ $row->phone_number }}</td>
                            <td class="border px-4 py-2">{{ $row->religion }}</td>
                            <td class="border px-4 py-2">{{ $row->parent->name }}</td>
                            <td class="border px-4 py-2">{{ $row->major->name }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button onclick="confirm('Yakin akan menghapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="10">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
