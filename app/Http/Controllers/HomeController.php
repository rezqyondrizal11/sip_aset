<?php

namespace App\Http\Controllers;

use App\Helpers\EncryptionHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\AsetTetap;
use App\Models\AsetTidakTetap;
use App\Models\JenisBarang;
use App\Models\KategoriAset;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $counttetap = user::count();
            $counttidaktetap = KategoriAset::count();
            $counthapus = JenisBarang::count();
            return view('home.indexadmin', compact('counttetap', 'counttidaktetap', 'counthapus'));
        } elseif (Auth::user()->role == 'pegawai') {
            $counttetap = AsetTetap::where('status', 1)->count();
            $counttidaktetap = AsetTidakTetap::count();
            $counthapus =  AsetTetap::where('status', 0)->count();
            return view('home.index', compact('counttetap', 'counttidaktetap', 'counthapus'));
        } else {
            $counttetap = AsetTetap::where('status', 1)->count();
            $counttidaktetap = AsetTidakTetap::count();
            $counthapus =  AsetTetap::where('status', 0)->count();
            return view('home.indexwali', compact('counttetap', 'counttidaktetap', 'counthapus'));
        }
    }
}
