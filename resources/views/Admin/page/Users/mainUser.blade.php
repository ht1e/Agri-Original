@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5">
        @include('Admin.page.Users.tableUsers', ['listusers' => $listuser])
    </div>
@endsection
