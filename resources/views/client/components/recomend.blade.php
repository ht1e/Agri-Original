<div class="pl-2 py-4">
    <h1 class="font-semibold py-2">{{$titleRecomend}}</h1>
    <div class=" grid grid-cols-4 gap-2">
        @foreach($dataProducts as $key => $product)
        @include('client.components.cardProduct', ['item' => $product])
        @endforeach
    </div>
</div>