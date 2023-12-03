<?php
namespace App\Http\Traits;
use App\Models\Unit;


trait Calculation {
    function totalAmount()
    {
        $units = Unit::where('userId', session('loginId'))->orderBy('id','DESC')->get();
        $colectionArray = array();
        if($units)
        {
            foreach($units as $row)
            {
                $totalAmount = $row->houseRent+$row->gasBill+$row->electricBill+$row->waterBill+$row->carParkingBill+$row->guardBill    +$row->elevatorBill+$row->securityBill+$row->internetBill;
                $otherBill = $row->othersBill;
                if($otherBill)
                {
                    foreach($otherBill as $value)
                    {
                        $totalAmount = $totalAmount + $value['billAmount'];
                    }
                
                }
                $totalAmountArray = array(
                    'id' => $row->id,
                    'totalAmount' => $totalAmount
                );
                $AmountArray[] =  $totalAmountArray;
            }
            
        }
        // dd($totalAmountArray);
        return $AmountArray;
    }
}