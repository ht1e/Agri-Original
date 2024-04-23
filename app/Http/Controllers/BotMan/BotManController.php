<?php

namespace App\Http\Controllers\BotMan;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\SanPham;

class BotManController extends Controller
{
    public function handle() {

        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {

            if($message == 'bắt đầu') {
                $this->askName($botman);
            }
            else {

            }
        });


        $botman->listen();

    }

    // public function replyIMG($botman) {

    //     $linkImg = asset('storage/Images/logo/logo.png');
    //     $attachment = new Image($linkImg);

       

    //     $message = OutgoingMessage::create($linkImg)
    //     ->withAttachment($attachment);

    //     $botman->reply($message);

    // }

    public function askName($botman) {

        $botman->ask("Xin chào ! Tên bạn là gì?", function (Answer $answer) {
            $name = $answer->getText();
            $this->say('Xin chào '.$name);


            $this->ask("Tôi có thể giúp gì cho bạn", function (Answer $answer) {
                $request = $answer->getText();
                if(strtolower($request) == 'tư vấn sản phẩm cho tôi') {
                    $items = DanhMuc::all();
                    foreach($items as $key => $item) {
                        $this->say($item->DM_Ten);
                    }
                    $this->ask("Bạn cần sản phầm loại nào", function (Answer $answer) {

                        $asw = $answer->getText();

                        $category = DanhMuc::whereRaw("LOWER(`dm_ten`) LIKE '%".strtolower($asw)."%'")->first();

                        $products = SanPham::where('sp_madm', $category->DM_Ma)->get();


                        foreach($products as $product) {
                            $linkImg = asset($product->SP_HinhAnh);
                            $attachment = new Image($linkImg);
                        
                            // $message = OutgoingMessage::create($product->SP_Ten.'<br>'.$product->SP_MoTa.'<br>'.number_format($product->SP_Gia, 0, '', '.').'đ')
                            // ->withAttachment($attachment);

                            $des = $product->SP_Ten.'<br>'.$product->SP_MoTa.'<br>'.number_format($product->SP_Gia, 0, '', '.').'đ';

                            $message = OutgoingMessage::create($des)
                            ->withAttachment($attachment);

                            //route('productDetails', ['id' => $product->SP_Ma])
    
                            $this->say($message);
                        }
                        
                    


                        //$this->say("bạn chọn ". $category->DM_Ten);
                    });


                }
                
                
            });
        });

    }

}
