<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DonHang;


class PaymentController extends Controller
{
    //

    public function vnpay_payment(Request $request) {

        $total = (int)$request->input('total');

        $idOrder = (int)DonHang::max('dh_ma') + 1 . "";
        // dd($total, $idOrder);



        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout";
        $vnp_TmnCode = "5IHE69U2";//Mã website tại VNPAY 
        $vnp_HashSecret = "0A12A34540XUN0TQAHWH2P5ODX6UWRGP"; //Chuỗi bí mật
        
        $vnp_TxnRef = $idOrder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan vnpay test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params
        $inputData = array(
            "vnp_Version" => "2.1.0", //Phiên bản cũ là 2.0.0, 2.0.1 thay đổi sang 2.1.0
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        
        //Build querystring phiên bản cũ 2.0.0, 2.0.1
        // foreach ($inputData as $key => $value) {
        //     if ($i == 1) {
        //         $hashdata .= '&' . $key . "=" . $value;
        //     } else {
        //         $hashdata .= $key . "=" . $value;
        //         $i = 1;
        //     }
        //     $query .= urlencode($key) . "=" . urlencode($value) . '&';
        // }

        //Chuyển thành:
        
        //Build querystring phiên bản mới 2.1.0
        
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            
                //Tạo vnp_SecureHash và tạo URL chuyển hướng phiên bản cũ 2.0.0, 2.0.1
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                // $vnp_Url .= 'vnp_SecureHashType=MD5&vnp_SecureHash=' . $vnpSecureHash;
                // hoặc
                // $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                // $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;

                // Chuyển thành:
                //Tạo vnp_SecureHash và tạo URL chuyển hướng phiên bản mới 2.1.0
            
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        }

            // vui lòng tham khảo thêm tại code demo

        return back()->withInput();

    }

    public function rs_vnpay_payment(Request $request) {


        return back()->withInput();

    }
}
