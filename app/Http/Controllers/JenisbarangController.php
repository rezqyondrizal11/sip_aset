<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisBarang;
use App\Models\KategoriAset;
use App\Models\Unit;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class JenisbarangController extends Controller
{

    public function index(Request $request)
    {


        $data = JenisBarang::orderBy('name', 'ASC')
            ->get();



        return view('jenis-barang.index', compact('data'));
    }


    public function create()
    {

        return view('jenis-barang.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = $request->all();

        $data = JenisBarang::create($input);
        return redirect()->route('jenisbarang.index')
            ->with('success', 'Jenis Barang created successfully');
    }


    public function edit($id)
    {

        $data = JenisBarang::find($id);

        return view('jenis-barang.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',

        ]);


        $input = $request->all();

        $user = JenisBarang::find($request->id);
        $user->update($input);

        return redirect()->route('jenisbarang.index')
            ->with('success', 'Jenis Barang updated successfully');
    }




    public function destroy($id)
    {
        JenisBarang::find($id)->delete();
        return redirect()->route('jenisbarang.index')
            ->with('success', 'Jenis Barang Aset deleted successfully');
    }
}
