@extends('main')

@section('content')

    @foreach($list as $key => $i)
        {{ $i['quantity']}}
        @foreach($i->products as $p)
            {{ $p['name'] }}
            {{ $p['thumb']}}
           
            {{ number_format($p['price'],0,',','.')}} đ
            
</br>
        @endforeach
    @endforeach

@endsection

