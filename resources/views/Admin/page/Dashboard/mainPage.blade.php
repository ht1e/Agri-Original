@extends('Admin.layout.main')

@section('content')
    <div class="w-full h-full mt-5 px-2 grid grid-cols-6 grid-rows-3">
        <div class="top col-span-6 grid grid-cols-3 row-span-1 gap-16">
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1 class="text-2xl uppercase my-2">Tổng thu nhập</h1>
                <h2 class="py-4 text-xl">{{number_format($totalSold, 0, '', '.')}}đ</h2>
            </div>
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1 class="text-2xl uppercase my-2">Tổng số người dùng</h1>
                <h2 class="py-4 text-xl">{{number_format($totalUser, 0, '', '.')}}</h2>
            </div>
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1 class="text-2xl uppercase my-2">Tổng số đơn hàng</h1>
                <h2 class="py-4 text-xl">{{number_format($totalOrder, 0, '', '.')}}</h2>
            </div>
        </div>
        <div class="mid row-span-2 col-span-6  grid grid-cols-3 gap-16">
            <div class="chart col-span-2 border-2 text-center p-2">
                <canvas id="myChart"></canvas>
            </div>
            <div class="selection col-span-1 border-2 text-center">
                <h1 class="px-4 py-2 border-b-2 text-xl">Thời Gian</h1>
                <div class="py-5">
                    <h2>Thống kê theo tuần</h2>
                    <div class=" mt-5">
                        <input class="px-2 py-1 border rounded-xl" type="week" name="selectWeek" id="selectWeek">
                    </div>
                    <button class="px-4 py-1 border-2 rounded-lg mt-5 hover:bg-slate-200" id="btnShowChartOfWeek">Xem</button>
                </div>

                <div class="py-5 border-t">
                    <h2>Thống kê theo năm</h2>
                    <div class=" mt-5">
                        <select class="px-2 py-1 border rounded-xl" type="year" name="selectYear" id="selectYear" value="{{date('Y')}}">
                            @foreach ($listYear as $year)
                                <option value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="px-4 py-1 border-2 rounded-lg mt-5 hover:bg-slate-200" id="btnShowChartOfYear">Xem</button>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('./resources/js/Admin/Admin.js')
    @vite('./resources/js/Admin/Dashboard/Dashboard.js')
@endsection