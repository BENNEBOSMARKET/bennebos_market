<?php

use App\Models\Order;

/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 9/23/2022
 */


function downloadOrderPdf($id){
    $order = Order::with('user', 'address','orderProducts')->find($id);

    $pdf =  Barryvdh\DomPDF\Facade\Pdf::loadView('invoice', ['order' => $order]);
    return $pdf->download('invoice.pdf');
}
