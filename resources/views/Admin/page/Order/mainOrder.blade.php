@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5">
       <h1 class="text-center text-xl font-bold">{{$title}}</h1>
       @include('Admin.page.Order.tableOrder', ['items' => $items])
    </div>
@endsection
