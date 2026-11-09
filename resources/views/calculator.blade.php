<x-app-layout>
    <x-slot name="title">Kalkulator</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Utilitas" title="Kalkulator"
                       subtitle="Operasi aritmatika sederhana dengan Laravel." />
    </x-slot>

    @php
        $inputClass = 'block w-full rounded-xl border-slate-300 text-lg font-semibold text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
        $format = fn ($n) => rtrim(rtrim(number_format($n, 4, ',', '.'), '0'), ',');
        $selected = old('operator', $operator ?? 'tambah');
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <form method="GET" action="{{ route('calculator') }}"
              class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">

            <div class="grid gap-4 sm:grid-cols-[1fr_auto_1fr] sm:items-start">
                <div>
                    <label for="angka1" class="block text-sm font-medium text-slate-700">Angka pertama</label>
                    <input type="number" step="any" id="angka1" name="angka1" required placeholder="0"
                           value="{{ old('angka1', $angka1 !== null ? $angka1 + 0 : '') }}"
                           class="mt-1.5 {{ $inputClass }} @error('angka1') border-rose-400 @enderror">
                    @error('angka1') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <span class="block text-sm font-medium text-slate-700">Operasi</span>
                    <div class="mt-1.5 grid grid-cols-4 gap-1 rounded-xl bg-slate-100 p-1">
                        @foreach ($operators as $value => $symbol)
                            <label class="cursor-pointer">
                                <input type="radio" name="operator" value="{{ $value }}" class="peer sr-only" @checked($selected === $value)>
                                <span class="flex h-10 w-11 items-center justify-center rounded-lg text-lg font-semibold text-slate-500 transition peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm hover:text-slate-800">
                                    {{ $symbol }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('operator') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="angka2" class="block text-sm font-medium text-slate-700">Angka kedua</label>
                    <input type="number" step="any" id="angka2" name="angka2" required placeholder="0"
                           value="{{ old('angka2', $angka2 !== null ? $angka2 + 0 : '') }}"
                           class="mt-1.5 {{ $inputClass }} @error('angka2') border-rose-400 @enderror">
                    @error('angka2') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                Hitung
            </button>

            @if ($hasil !== null)
                <div class="mt-8 rounded-2xl bg-slate-900 px-6 py-6 text-white">
                    <p class="text-sm text-slate-400">
                        {{ $format($angka1) }} {{ $simbol }} {{ $format($angka2) }} =
                    </p>
                    <p class="mt-1 text-4xl font-bold tracking-tight break-all">{{ $format($hasil) }}</p>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
