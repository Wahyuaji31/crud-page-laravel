<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa; // Import model Mahasiswa
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
    
        if (strlen($katakunci)) {
            $data = Mahasiswa::where('nim', 'like', "%{$katakunci}%")
                ->orWhere('nama', 'like', "%{$katakunci}%")
                ->orWhere('jurusan', 'like', "%{$katakunci}%")
                ->orderBy('nim', 'desc') // Urutkan jika diperlukan
                ->paginate($jumlahbaris);
        } else {
            $data = Mahasiswa::orderBy('nim', 'desc')->paginate(3);
        }
        return view('mahasiswa.index')->with('data', $data);
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:Mahasiswa,nim',
            'nama'=> 'required',
            'jurusan' => 'required',     
        ]);
        $data = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];
        Mahasiswa::create($data);
        return redirect()->to('Mahasiswa')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mahasiswa::where('nim', $id)->first();
        return view('Mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        {
            $request->validate([
                'nama'=> 'required',
                'jurusan' => 'required',     
            ]);
            $data = [
                'nama'=>$request->nama,
                'jurusan'=>$request->jurusan,
            ];
            Mahasiswa::where('nim', $id)->update($data);
            return redirect()->to('Mahasiswa')->with('success', 'Berhasil melakukan update data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mahasiswa::where('nim', $id)->delete();
        return redirect()->to('Mahasiswa')->with('success', 'data berhasil di hapus');
    }
}
