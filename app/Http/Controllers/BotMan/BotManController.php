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
            if($message == '') {

            }
        });


        $botman->listen();

    }

    public function replyIMG($botman) {

        $linkImg = asset('storage/Images/logo/logo.png');
        $attachment = new Image($linkImg);

       

        $message = OutgoingMessage::create($linkImg)
        ->withAttachment($attachment);

        $botman->reply($message);

    }

    public function askName($botman) {

        $botman->ask("Xin chào ! Tên bạn là gì?", function (Answer $answer) {
            $name = $answer->getText();
            $this->say('Xin chào '.$name);


            $this->ask("'Tôi có thể giúp gì cho bạn'", function (Answer $answer) {
                $request = $answer->getText();
                if($request == 'Tư vấn sản phẩm cho tôi') {
                    $items = DanhMuc::all();
                    foreach($items as $key => $item) {
                        $this->say($item->DM_Ten);
                    }
                    $this->ask("Bạn cần sản phầm loại nào", function (Answer $answer) {

                        $asw = $answer->getText();

                        $idCategory = DanhMuc::where('dm_ten', 'LIKE','%'.$asw.'%')->get();

                        $this->say("bạn chọn ". $idCategory->DM_Ten);
                    });


                }
                
                
            });
        });

    }

}
