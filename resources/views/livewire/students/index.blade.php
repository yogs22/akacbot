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

            <table class="table-fixed w-full overflow-scroll">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">NISN</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">JK</th>
                        <th class="px-4 py-2">No HP</th>
                        <th class="px-4 py-2">Agama</th>
                        <th class="px-4 py-2">Wali Murid</th>
                        <th class="px-4 py-2">Jurusan</th>
                        <th class="px-4 py-2" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $row->nisn }}</td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">{{ $row->gender }}</td>
                            <td class="border px-4 py-2">{{ $row->phone_number }}</td>
                            <td class="border px-4 py-2">{{ $row->religion }}</td>
                            <td class="border px-4 py-2">{{ $row->parent->name }}</td>
                            <td class="border px-4 py-2">{{ $row->major->code }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                      <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <a href="{{ route('student.detail', $row->id) }}" title="Detail">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 8a1 1 0 011-1h1V6a1 1 0 012 0v1h1a1 1 0 110 2H9v1a1 1 0 11-2 0V9H6a1 1 0 01-1-1z" />
                                            <path fill-rule="evenodd" d="M2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8zm6-4a4 4 0 100 8 4 4 0 000-8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </a>
                                <button onclick="confirm('Yakin akan menghapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
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
