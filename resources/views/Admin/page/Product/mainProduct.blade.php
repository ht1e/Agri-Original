@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5 px-2">
        @if (!empty($items))
            <div class="grid grid-cols-5 gap-5">
                @foreach ($items as $key => $item)
                    @include('Admin.page.Product.cardProduct', ['item' => $item, 'totalAvaiable' => $totalAvaiable])
                @endforeach
            </div>
            {{$items->links()}}
        @endif
    </div>
@endsection

