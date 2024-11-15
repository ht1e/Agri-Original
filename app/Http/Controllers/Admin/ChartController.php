<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    function getData($date) {
        $data = [];
        $dayofweek = date('w', strtotime($date));

        for($i=$dayofweek-1 ; $i>=1; $i--) {
            $day = $date.' -'.$i.' days';
            $sumday = (int)DonHang::where('dh_thoigian', '=' , date('Y-m-d', strtotime($day)))->where('dh_mattdh', '=', 2)->sum('dh_tonggiatri');
            array_push($data,$sumday);
        }

        for($i=$dayofweek; $i <= 7 ; $i++) { 
            $day = $date.' +'.$i-$dayofweek.' days';
            $sumday = (int)DonHang::where('dh_thoigian', '=' , date('Y-m-d', strtotime($day)))->where('dh_mattdh', '=', 2)->sum('dh_tonggiatri');
            array_push($data,$sumday);
        }

        return $data;
    }

    // public function getLastSevenDay() {
    //     $date = date('Y-m-d');
    //     $dayofweek = date('w', strtotime($date));
    //     $data = $this->getData($dayofweek, $date);
    //     return response()->json(['message' => 'last day','dayofweek' => $dayofweek, 'date' => $date, 'data' => $data]);
    // }

    public function getDataOfWeek($date) {
        $data = $this->getData($date);
        return response()->json(['message' => 'data of week', 'date' => $date, 'data' => $data]);
    }


    public function getDataOfYear($year) {

        $dataYear = DB::select('select * from donhang where YEAR(dh_thoigian) = '. $year);

        $data = [];

        for($i = 1; $i<= 12; $i++) {
            $totalOfMonth = DB::select('select sum(dh_tonggiatri) as tongthang from donhang where dh_mattdh = 2 and YEAR(dh_thoigian) = '. $year .' and MONTH(dh_thoigian) ='. $i);

            if($totalOfMonth[0]->tongthang == null) {
                array_push($data, 0);
            } 
            else {
                array_push($data, (int)$totalOfMonth[0]->tongthang);
            }

        }


        return response()->json(['message' => 'data of year', 'year' => $year, 'dataYear' => $dataYear, 'data' => $data]);
    }

    
}
