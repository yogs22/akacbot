<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detail Guru
    </h2>
</x-slot>
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-3 gap-4">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4 col-span-2">
        @if (session()->has('message'))
            <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @include('livewire.loading')

        @if($isModal)
            @include('livewire.teacher_details.create')
        @endif

        <table class="table-fixed w-full overflow-scroll">
            <tbody>
                <tr>
                    <td class="px-4 py-2 font-bold" width="200">NUPTK</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $teacher->nuptk }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Nama</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $teacher->name }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Alamat</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $teacher->address }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">JK</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $teacher->gender }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">No HP</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $teacher->phone_number }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3 text-sm">Tambah Data Pelajaran</button>
        <table class="table-fixed w-full overflow-scroll text-sm">
            <tr class="bg-blue-200">
                <th class="border px-4 py-2">Pelajaran</th>
                <th class="border px-4 py-2">Kelas</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
            @foreach ($lesson_teacher as $lesson)
                <tr>
                    <td class="border px-4 py-2">{{ $lesson->lesson->name }}</td>
                    <td class="border px-4 py-2">{{ $lesson->full_grade }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $lesson->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                              <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button onclick="confirm('Yakin akan menghapus data ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $lesson->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-1 rounded" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
