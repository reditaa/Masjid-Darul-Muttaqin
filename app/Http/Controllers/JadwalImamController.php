<?php

namespace App\Http\Controllers;

use App\Models\JadwalImam;
use App\Models\JadwalJumat;
use App\Models\Pengurus;
use Illuminate\Http\Request;

class JadwalImamController extends Controller
{


    public function index()
    {

        $jadwalImam = JadwalImam::with([

            'dzuhurImam1.anggota',
            'dzuhurImam2.anggota',
            'dzuhurImam3.anggota',

            'asharImam1.anggota',
            'asharImam2.anggota',
            'asharImam3.anggota',

        ])->get();



        $jadwalJumat = JadwalJumat::with([

            'khatib.anggota',
            'imam.anggota'

        ])->get();



        return view(
            'jadwal-imam.index',
            compact(
                'jadwalImam',
                'jadwalJumat'
            )
        );

    }







    public function create()
    {

        $pengurus = Pengurus::with('anggota')
            ->where('status','Aktif')
            ->get();


        return view(
            'jadwal-imam.create',
            compact('pengurus')
        );

    }








    public function store(Request $request)
    {


        $request->validate([

            'hari'=>'required',

        ]);





        // ==========================
        // JADWAL JUMAT
        // ==========================


        if($request->hari == 'Jumat')
        {


            $request->validate([

                'pasaran'=>'required',

                'khatib_jumat'=>'required',

                'imam_jumat'=>'required',

            ]);



            JadwalJumat::create([


                'pasaran'=>$request->pasaran,


                'khatib_id'=>$request->khatib_jumat,


                'imam_id'=>$request->imam_jumat,


            ]);



            return redirect()
                ->route('jadwal-imam.index')
                ->with(
                    'success',
                    'Jadwal Jumat berhasil ditambahkan'
                );

        }







        // ==========================
        // DZUHUR + ASHAR
        // ==========================


        $request->validate([


            'dzuhur_imam_1'=>'required',

            'dzuhur_imam_2'=>'required',

            'dzuhur_imam_3'=>'nullable',



            'ashar_imam_1'=>'required',

            'ashar_imam_2'=>'required',

            'ashar_imam_3'=>'nullable',


        ]);






        JadwalImam::create([


            'hari'=>$request->hari,



            'dzuhur_imam_1'=>$request->dzuhur_imam_1,

            'dzuhur_imam_2'=>$request->dzuhur_imam_2,

            'dzuhur_imam_3'=>$request->dzuhur_imam_3,



            'ashar_imam_1'=>$request->ashar_imam_1,

            'ashar_imam_2'=>$request->ashar_imam_2,

            'ashar_imam_3'=>$request->ashar_imam_3,


        ]);




        return redirect()

            ->route('jadwal-imam.index')

            ->with(
                'success',
                'Jadwal Imam berhasil ditambahkan'
            );

    }








    public function edit(JadwalImam $jadwalImam)
    {

        $pengurus = Pengurus::with('anggota')
            ->where('status','Aktif')
            ->get();


        return view(
            'jadwal-imam.edit',
            compact(
                'jadwalImam',
                'pengurus'
            )
        );

    }








    public function update(Request $request, JadwalImam $jadwalImam)
    {


        $data = $request->validate([


            'hari'=>'required',


            'dzuhur_imam_1'=>'required',

            'dzuhur_imam_2'=>'required',

            'dzuhur_imam_3'=>'nullable',



            'ashar_imam_1'=>'required',

            'ashar_imam_2'=>'required',

            'ashar_imam_3'=>'nullable',


        ]);



        $jadwalImam->update($data);



        return redirect()

            ->route('jadwal-imam.index')

            ->with(
                'success',
                'Jadwal berhasil diubah'
            );

    }








    public function destroy(JadwalImam $jadwalImam)
    {


        $jadwalImam->delete();


        return redirect()

            ->route('jadwal-imam.index')

            ->with(
                'success',
                'Jadwal berhasil dihapus'
            );

    }


}