<?php

namespace App\Imports;

use App\Data\RoleUser;
use App\Models\KelasSiswaModel;
use App\Models\UsersDetail;
use App\Models\UsersModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
class UsersDetailImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if(!array_filter($row)){
            return null;
        }
        DB::beginTransaction();
        try {
            UsersModel::create([
                'email'=>$row['nis'].'@annur.id',
                'password'=>password_hash("school123",PASSWORD_BCRYPT),
                'role'=>RoleUser::SISWA
            ]);
            UsersDetail::create([
                'email'=>$row['nis'].'@annur.id',
                'name'=>$row['nama'],
                'gender'=>$row['jenis_kelamin'],
                'address'=>$row['alamat'],
                'phone'=>$row['telefon'],
                'religion'=>$row['agama'],
                'nis'=>$row['nis'],
                'nisn'=>$row['nisn'],
                'TTL'=>$row['ttl'],
                'nama_ayah'=>$row['nama_ayah'],
                'pekerjaan_ayah'=>$row['pekerjaan_ayah'],
                'alamat_ayah'=>$row['alamat_ayah'],
                'no_hp_ayah'=>$row['no_hp_ayah'],
                'nama_ibu'=>$row['nama_ibu'],
                'pekerjaan_ibu'=>$row['pekerjaan_ibu'],
                'alamat_ibu'=>$row['alamat_ibu'],
                'no_hp_ibu'=>$row['no_hp_ibu'],
                'status'=>$row['status'],
                'image'=>null
            ]);
            KelasSiswaModel::create([
                'id_kelas_foreign'=>$row['id_kelas'],
                'email_foreign'=>$row['nis'].'@annur.id'
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }
}
