@extends('Admin.layout.main')

@section('content')
    <div class="w-full h-full mt-5 px-2 grid grid-cols-6 grid-rows-3">
        <div class="top col-span-6 grid grid-cols-3 row-span-1 gap-16">
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1>SOLD</h1>
                <h2>{{number_format(10000, 0, '', '.')}}</h2>
            </div>
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1>TOTAL MONEY</h1>
                <h2>{{number_format(10000, 0, '', '.')}} VND</h2>
            </div>
            <div class="col-span-1 text-center border-2 h-[90%]">
                <h1>INCOME</h1>
                <h2>{{number_format(1000, 0, '', '.')}} VND</h2>
            </div>
        </div>
        <div class="mid row-span-2 col-span-6  grid grid-cols-3 gap-16">
            <div class="chart col-span-2 border-2 text-center p-2">
                <canvas id="myChart"></canvas>
            </div>
            <div class="selection col-span-1 border-2 text-center">
                <h1>Thời Gian</h1>
                <div class=" mt-5">
                    <label for="" class="px-2 py-2 ">
                        Từ:
                        <input class="px-2 py-1 border-none rounded-xl" type="date" name="dateStart">
                    </label>
                </div>
                <div class=" mt-10">
                    <label for="" class="px-2 py-2 ">
                        Đến:
                        <input class="px-2 py-1 border-none rounded-xl" type="date" name="dateEnd">
                    </label>
                </div>
                <button class="px-4 py-1 border-2 rounded-lg mt-5 hover:bg-slate-200">Xem</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('./resources/js/Admin/Admin.js')
    @vite('./resources/js/Admin/Dashboard/Dashboard.js')
@endsection