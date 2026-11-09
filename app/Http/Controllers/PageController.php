<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Halaman beranda. Mendukung query ?user=Nama untuk sapaan dinamis.
     */
    public function index()
    {
        $user = request()->query('user');

        return view('home', compact('user'));
    }

    /**
     * Profil mahasiswa berdasarkan NRP.
     */
    public function student($nrp = '5025241176')
    {
        $nama = 'Shifa Alya Dewi';
        $departemen = 'Teknik Informatika';
        $universitas = 'Institut Teknologi Sepuluh Nopember';
        $status = 'Mahasiswa Aktif';
        $minat = 'Web Development';

        return view('student', compact(
            'nrp',
            'nama',
            'departemen',
            'universitas',
            'status',
            'minat'
        ));
    }

    /**
     * Halaman ide proyek Agentic AI. Mendukung ?mode=dark.
     */
    public function agent($tema = 'General Assistant Agent')
    {
        $temaMap = [
            'database-health' => 'Database Health Checker & Performance Monitor Agent',
        ];

        $namaTema = $temaMap[$tema] ?? $tema;
        $mode = request()->query('mode', 'light') === 'dark' ? 'dark' : 'light';

        return view('agent', compact(
            'tema',
            'namaTema',
            'mode'
        ));
    }

    /**
     * Form Kalkulator IPK (GET /kalkulator-ipk).
     * Jika form disubmit, nilai divalidasi lalu diarahkan ke /kalkulator-ipk/{ipk1}/{ipk2}.
     */
    public function ipkForm(Request $request)
    {
        if ($request->hasAny(['ipk1', 'ipk2'])) {
            $data = $request->validate($this->ipkRules(), $this->ipkMessages());

            return redirect()->route('ipk', [
                'ipk1' => $data['ipk1'],
                'ipk2' => $data['ipk2'],
            ]);
        }

        return view('ipk', [
            'ipk1' => null,
            'ipk2' => null,
            'rataRata' => null,
            'predikat' => null,
        ]);
    }

    /**
     * Hasil Kalkulator IPK (GET /kalkulator-ipk/{ipk1}/{ipk2}).
     */
    public function ipk($ipk1, $ipk2)
    {
        $validator = Validator::make(
            compact('ipk1', 'ipk2'),
            $this->ipkRules(),
            $this->ipkMessages()
        );

        if ($validator->fails()) {
            return redirect()->route('ipk.form')->withErrors($validator);
        }

        $ipk1 = (float) $ipk1;
        $ipk2 = (float) $ipk2;

        $rataRata = ($ipk1 + $ipk2) / 2;
        $predikat = $this->predikatIpk($rataRata);

        return view('ipk', compact(
            'ipk1',
            'ipk2',
            'rataRata',
            'predikat'
        ));
    }

    /**
     * Kalkulator sederhana (GET /kalkulator?angka1=..&operator=..&angka2=..).
     */
    public function calculator(Request $request)
    {
        $operators = [
            'tambah' => '+',
            'kurang' => '−',
            'kali'   => '×',
            'bagi'   => '÷',
        ];

        $angka1 = $angka2 = $simbol = $hasil = $operator = null;

        if ($request->hasAny(['angka1', 'angka2', 'operator'])) {
            $data = $request->validate([
                'angka1'   => ['required', 'numeric'],
                'angka2'   => ['required', 'numeric'],
                'operator' => ['required', 'in:' . implode(',', array_keys($operators))],
            ], [
                'required' => 'Kolom ini wajib diisi.',
                'numeric'  => 'Masukkan angka yang valid.',
                'in'       => 'Operator tidak dikenal.',
            ]);

            $angka1 = (float) $data['angka1'];
            $angka2 = (float) $data['angka2'];
            $operator = $data['operator'];
            $simbol = $operators[$operator];

            if ($operator === 'bagi' && $angka2 == 0) {
                return back()->withInput()->withErrors(['angka2' => 'Tidak bisa membagi dengan nol.']);
            }

            $hasil = match ($operator) {
                'tambah' => $angka1 + $angka2,
                'kurang' => $angka1 - $angka2,
                'kali'   => $angka1 * $angka2,
                'bagi'   => $angka1 / $angka2,
            };
        }

        return view('calculator', compact('angka1', 'angka2', 'operator', 'simbol', 'hasil', 'operators'));
    }

    private function ipkRules(): array
    {
        return [
            'ipk1' => ['required', 'numeric', 'between:0,4'],
            'ipk2' => ['required', 'numeric', 'between:0,4'],
        ];
    }

    private function ipkMessages(): array
    {
        return [
            'required' => 'IPK wajib diisi.',
            'numeric'  => 'IPK harus berupa angka (gunakan titik, contoh 3.75).',
            'between'  => 'IPK harus di antara 0.00 dan 4.00.',
        ];
    }

    /**
     * Predikat kelulusan (mengacu pada ketentuan umum pendidikan tinggi di Indonesia).
     */
    private function predikatIpk(float $ipk): array
    {
        return match (true) {
            $ipk >= 3.51 => ['label' => 'Dengan Pujian (Cum Laude)', 'color' => 'emerald'],
            $ipk >= 3.01 => ['label' => 'Sangat Memuaskan', 'color' => 'indigo'],
            $ipk >= 2.76 => ['label' => 'Memuaskan', 'color' => 'sky'],
            $ipk >= 2.00 => ['label' => 'Cukup', 'color' => 'amber'],
            default      => ['label' => 'Perlu Ditingkatkan', 'color' => 'rose'],
        };
    }
}
