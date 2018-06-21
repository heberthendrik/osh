<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Result;
use App\Models\Nrujukan;
use App\Models\Ruang;
use App\Models\Kelas;
use App\Models\Kdlab;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

use DB;

class ApiController extends Controller
{
    public static function visibleData($query){
        if(Auth::user()->id_rs)
        {
            $query = $query->where('id_rs', Auth::user()->id_rs);
        }

        return $query;
    }

    public static function visibleHospital($query){
        if(Auth::user()->id_rs)
        {
            $query = $query->where('id', Auth::user()->id_rs);
        }

        return $query;
    }

    public function getDataDetail($no_rm)
    {
        $q = Customer::where('no_rm', 'LIKE', $no_rm);
        self::visibleData($q);
        $q = $q->get();

        $result = [];
        if ($q) {
            foreach ($q as $r) {
                $result['nama']  = $r->nama;
                $result['alamat'] = $r->alamat;
                $result['sex']  = $r->sex;
                $result['tgl_lahir'] = $r->tgl_lahir;
            }
        }

        return Response::json($result);
    }

    public function getNilaiRujukan($id_kdlab, $id_master)
    {
        $data = Result::find($id_master);

        $q = Nrujukan::where('id_kdlab', $id_kdlab)
            ->where('umur_sat', 'LIKE', $data->umur_sat)
            ->where('age_1', '<=', $data->umur)
            ->where('age_2', '>=', $data->umur)
            ->where('sex', 'LIKE', $data->sex)
            ->where('status', '1')
            ->get();
        $result = [];
        if ($q) {
            foreach ($q as $r) {
                $result['nr_1'] = $r->nr_1;
                $result['nr_2'] = $r->nr_2;
            }
        }

        return Response::json($result);
    }

    public function getLabDetail($id_kdlab){
        $data = Kdlab::find($id_kdlab);

        $result = [];
        if ($data) {
            $result['satuan'] = $data->satuan;
            $result['metoda'] = $data->metoda;
        }

        return Response::json($result);
    }

    /*FILTER*/
    public static function getFilters()
    {
        $hospital = Hospital::distinct();
        self::visibleHospital($hospital);

        $doctor = Doctor::distinct();
        self::visibleData($doctor);

        $ruang = Ruang::distinct();
        self::visibleData($ruang);

        $kelas = Kelas::distinct();
        self::visibleData($kelas);

        $filters['id_rs'] = $hospital->pluck('nama', 'id');
        $filters['id_dokter'] = $doctor->where('status', '1')->pluck('nama', 'id');
        $filters['id_ruang'] = $ruang->where('status', '1')->pluck('nama', 'id');
        $filters['id_kelas'] = $kelas->where('status', '1')->pluck('nama', 'id');
        $filters['id_status'] = Status::where('status', '1')->pluck('nama', 'id');
        $filters['tahun'] = Result::select(DB::raw("date_part('year', created_at) as tahun"))->groupBy('tahun')->orderBy('tahun', 'desc')->pluck('tahun','tahun');

        return $filters;
    }

    public static function getResults($filters = [])
    {
        $year = request()->get('tahun', NULL);
        $no_lab = request()->get('no_lab', null);
        $id_dokter = request()->get('id_dokter', null);
        $id_rs = request()->get('id_rs', null);

        $result = Result::distinct();

        $result = self::visibleData($result);
        if($year){
            $result = $result->where(DB::raw("date_part('year', created_at)"), $year);
        }
        if($no_lab){
            $result = $result->where('no_lab', 'LIKE', $no_lab.'%');
        }
        if($id_dokter){
            $result = $result->where('id_dokter', $id_dokter);
        }
        if($id_rs){
            $result = $result->where('id_rs', $id_rs);
        }

        return $result;
    }
    /*END FILTER*/
}
