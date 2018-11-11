<?php
namespace App\Http\Controllers\Admin;
use App\Events\Event;
use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Libraries\UploadFileHandler;

use Request;
use Hash;
use DB;
use Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel as Excel;
use URL;
use App;
use Redirect;


class GetController extends Controller
{
    public function postDropdowns(){
        $message = "";
        $status = 0;
        $html = "";


        switch (Request::input('type')) {
            case 'getLevels':

            break;

        }
        return response()->json(['status' => $status, 'message' => $message, 'html' => $html]);


    }






}
