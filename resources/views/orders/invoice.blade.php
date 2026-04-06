@extends('layouts.app')

@section('content')

<div class="no-print text-center mt-4">
    <button onclick="window.print()" class="btn btn-danger">
        🖨️ Print Receipt
    </button>
</div>

@php
use Illuminate\Support\Str;

function line($left, $right = '') {
    $width = 32;
    $left = substr($left, 0, $width);
    $space = $width - strlen($left) - strlen($right);
    return $left . str_repeat(' ', max(1, $space)) . $right;
}
@endphp

<div id="printable">

<pre class="receipt">
      CHICKEN SHOP
        Abbottabad
--------------------------------
Order: {{ $order->order_number }}
Date: {{ $order->created_at->format('d-m-Y H:i') }}
--------------------------------
Customer: {{ $order->details->customer_name ?? '-' }}
Phone: {{ $order->details->phone ?? '-' }}
--------------------------------
{{ line('Item','Total') }}
--------------------------------
@foreach($order->items as $item)
{{ line(Str::limit($item->product_name,16)) }}
{{ line($item->weight.'kg x '.$item->unit_price, number_format($item->total_price,0)) }}
@endforeach
--------------------------------
{{ line('Grand Total', number_format($order->grand_total,0)) }}
--------------------------------

        Thank You
       Visit Again
</pre>

</div>

<style>

/* RECEIPT */
.receipt{
    width: 72mm;
    margin: 0;
    font-family: monospace;
    font-size: 12px;
    line-height: 1.4;
}

/* PRINT FIX */
@media print{

    @page{
        size: 72mm auto;
        margin: 0;
    }

    html, body{
        margin: 0;
        padding: 0;
        height: auto;
    }

    body *{
        visibility: hidden;
    }

    #printable, #printable *{
        visibility: visible;
    }

    #printable{
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block; /* 🔥 key fix */
    }

    .receipt{
        width: 72mm;
        display: inline-block; /* 🔥 key fix */
    }

    .no-print{
        display: none;
    }
}

</style>

@endsection