<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agama;
use App\Models\Kelamin;
use App\Models\Eselon;
use App\Models\Golongan;
use App\Models\UnitKerja;
use App\Models\Jabatan;
use App\Models\Pegawai;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Kelamin::insert([
            ['id_jenKel' => 1, 'jenis_kelamin' => 'Laki-laki', 'created_at' => now(), 'updated_at' => now()],
            ['id_jenKel' => 2, 'jenis_kelamin' => 'Perempuan', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Agama
        Agama::insert([
            ['id_agama' => 1, 'nama_agama' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
            ['id_agama' => 2, 'nama_agama' => 'Kristen', 'created_at' => now(), 'updated_at' => now()],
            ['id_agama' => 3, 'nama_agama' => 'Katolik', 'created_at' => now(), 'updated_at' => now()],
            ['id_agama' => 4, 'nama_agama' => 'Hindu', 'created_at' => now(), 'updated_at' => now()],
            ['id_agama' => 5, 'nama_agama' => 'Buddha', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Eselon
        Eselon::insert([
            ['id_eselon' => 1, 'nama_eselon' => 'Eselon I', 'created_at' => now(), 'updated_at' => now()],
            ['id_eselon' => 2, 'nama_eselon' => 'Eselon II', 'created_at' => now(), 'updated_at' => now()],
            ['id_eselon' => 3, 'nama_eselon' => 'Eselon III', 'created_at' => now(), 'updated_at' => now()],
            ['id_eselon' => 4, 'nama_eselon' => 'Eselon IV', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Golongan
        Golongan::insert([
            ['id_golongan' => 1, 'golongan' => 'IIIA', 'pangkat' => 'Penata Muda', 'created_at' => now(), 'updated_at' => now()],
            ['id_golongan' => 2, 'golongan' => 'IIIB', 'pangkat' => 'Penata Muda Tk. I', 'created_at' => now(), 'updated_at' => now()],
            ['id_golongan' => 3, 'golongan' => 'IIIC', 'pangkat' => 'Penata', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Unit Kerja
        UnitKerja::insert([
            ['id_unitKerja' => 1, 'nama_unit' => 'Keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['id_unitKerja' => 2, 'nama_unit' => 'Perencanaan', 'created_at' => now(), 'updated_at' => now()],
            ['id_unitKerja' => 3, 'nama_unit' => 'IT & Data', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Jabatan (Struktural & Fungsional)
        Jabatan::insert([
            ['id_jabatan' => 1, 'nama_jabatan' => 'Kepala Subbag', 'id_eselon' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Analis Kepegawaian', 'id_eselon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Surveyor Pemetaan', 'id_eselon' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Dummy Data untuk Pegawai
        Pegawai::insert([
            [
                'id_pegawai' => 1,
                'nip' => '198712102020121001',
                'nama' => 'Andi Wijaya',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1987-12-10',
                'id_kelamin' => 1,
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'id_agama' => 1,
                'id_unit' => 1,
                'tempat_tugas' => 'Kantor Pusat',
                'no_hp' => '08123456789',
                'npwp' => '1234567890',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pegawai' => 2,
                'nip' => '19900515201811002',
                'nama' => 'Siti Rahmawati',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1990-05-15',
                'id_kelamin' => 2,
                'alamat' => 'Jl. Sudirman No. 45, Bandung',
                'id_agama' => 2,
                'id_unit' => 2,
                'tempat_tugas' => 'Kantor Cabang Bandung',
                'no_hp' => '081298765432',
                'npwp' => '9876543210',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
