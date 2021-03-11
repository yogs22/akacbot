<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detail Siswa
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

        <table class="table-fixed w-full overflow-scroll">
            <tbody>
                <tr>
                    <td class="px-4 py-2 font-bold" width="200">NISN</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->nisn }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Nama</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->name }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Alamat</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->address }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">JK</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->gender }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">No HP</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->phone_number }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Tempat / Tgl Lahir</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->fullbirth }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Agama</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->religion }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Wali Murid</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->parent->name }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold">Jurusan</td>
                    <td class="px-4 py-2" width="10">:</td>
                    <td class="px-4 py-2">{{ $student->major->code }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <table class="table-fixed w-full overflow-scroll">
            @foreach ($student->scores as $score)
                {{-- {{ $score->value }} --}}
            @endforeach
        </table>
    </div>
</div>
