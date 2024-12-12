<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class KategoriController extends Controller
{

    public function index(Request $request)
    {


        $data = KategoriAset::orderBy('name', 'ASC')
            ->get();



        return view('category-aset.index', compact('data'));
    }


    public function create()
    {

        return view('category-aset.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $input = $request->all();

        $data = KategoriAset::create($input);
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Aset created successfully');
    }


    public function edit($id)
    {

        $data = KategoriAset::find($id);

        return view('category-aset.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',

        ]);


        $input = $request->all();

        $user = KategoriAset::find($request->id);
        $user->update($input);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Aset updated successfully');
    }
    public function show($id)
    {

        $category = KategoriAset::find($id);
        if ($category) {
            $category->status = $category->status == 1 ? 0 : 1; // Toggle between 1 and 0
            $category->save();

            return response()->json([
                'status' => $category->status,
                'message' => 'Status updated successfully.'
            ]);
        }

        return response()->json(['message' => 'Category not found.'], 404);
    }

    public function destroy($id)
    {
        KategoriAset::find($id)->delete();
        return redirect()->route('kategori.index')
            ->with('success', 'Kategori Aset deleted successfully');
    }
}
