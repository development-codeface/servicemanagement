<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Menus;
use App\Models\Pages;
use App\Models\SubPages;
use App\Models\Attachments;
use App\Models\ServiceType;
use App\Models\Testimonials;
use App\Models\Reviews;
use App\Libraries\UploadFileHandler;


use Request;
use Hash;
use DB;
use Auth;
use URL;
use App;

class PostController extends Controller
{
    //common post function
    public function postManage(){
        $message = "";
        $status = 0;
        $html = "";
        $data = null;

        $url = "";

        switch (Request::input('type')) {
            case 'newCategory':
             
                if(Request::input('category_id')!=''){
                    $update = Categories::find(Request::input('category_id'));
                    $update->update(Request::all()+['category_slug' =>str_slug(Request::input('category_name'))]);
                }else{

                    $create =Categories::create(Request::all()+['category_slug' =>str_slug(Request::input('category_name'))]);
                }
            break;

            case 'newBrand':
                if(Request::input('brand_id')!=''){
                    $update = Brands::find(Request::input('brand_id'));
                    $update->update(Request::all()+['brand_slug' =>str_slug(Request::input('brand_name'))]);
                }else{
                    $create =Brands::create(Request::all()+['brand_slug' =>str_slug(Request::input('brand_name'))]);
                }
            break;
            case 'newMenu':

                if(Request::input('menu_id')!=''){
                    $update = Menus::find(Request::input('menu_id'));
                    $update->update(Request::all());
                }else{

                    $create =Menus::create(Request::all());
                }
                break;

                case 'newPage':

                if(Request::input('page_id')!=''){
                    $update = Pages::find(Request::input('page_id'));
                    $update->update(Request::all());

                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/pages/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'pages_page_id' => $update->page_id,
                            ]);
                        }
                    }
                }else{
                    $addPages=Pages::create(Request::all());
                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/pages/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'pages_page_id' => $addPages->page_id,
                            ]);
                        }
                    }
                }
            break;
            /* case 'newPage':

                if(Request::input('page_id')!=''){

                    $update = Pages::find(Request::input('page_id'));
                    if(Request::input('service_type_id')!='')
                    {
                        $add =ServiceType::create([
                            'type_description' => Request::input('content'),
                        ]);
                    }
                    $update->update(Request::all());

                    $totalUrls = count(Request::input('fileURLs'));
                    
                    $imageURLs = Request::input('fileURLs');
                    $fileURLs = Request::input('fileURLs');
                    $fileLabels = Request::input('fileLabels');
                if(!empty($fileURLs)){

                    for ($i = 0; $i < $totalUrls; $i++) {

                        $ext = explode(".", $fileURLs[$i]);

                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($j = 0; $j < 30; $j++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $filename = md5($randomString);

                        $filepath = 'data/pages/' . $filename . "." . $ext[1];
                        //$oldpath = str_replace(url(),"",$storeImageURLs[$i]);
                        $oldpath = 'data/temp/' . $fileURLs[$i];

                        if (file_exists($oldpath)) {
                            if (rename($oldpath, $filepath) == FALSE) {
                                copy($oldpath, $filepath);

                            }

                            $filename = $filename . "." . $ext[1];
                            $attachment_ext = explode(".", $filename);

                        } else {
                            $filename = $imageURLs[$i];
                            $attachment_ext = explode(".", $filename);

                        }
                        $attachment =Attachments::create([
                            'attachment_url' => $filename,
                            'attachment_ext' => $attachment_ext[1],
                            'pages_page_id' => $update->page_id
                        ]);
                    }

                }

                }else{

                    //$create =Pages::create(Request::all());

                    if(Request::input('service_type_id')!='')
                    {
                        //check the cout first
                        //if exsts update
                        //
                        /*$count = ServiceType::find('service_type_id',Request::input('service_type_id'))->count();
                        $update = ServiceType::find('service_type_id',Request::input('service_type_id'))->first();
                        if($count  > 0){
                           /* $update->type_description= Request::input('description');
                            $update->type_title= Request::input('page-title');*/
                            //$update->save();
                        /*}else {
                            $add = ServiceType::create([
                                'type_description' => Request::input('description'),
                                'type_title' => Request::input('page-title'),
                                'menu_id' => Request::input('menu_id'),
                            ]);
                        }*/
                      /*   $add = ServiceType::create([
                            'type_description' => Request::input('description'),
                            'type_title' => Request::input('page-title'),
                            'menu_id' => Request::input('menu_id'),
                        ]);
                    }
                    else{
                        $add =Pages::create([
                            'content' => Request::input('description'),
                            'title' => Request::input('page_title'),
                        ]);
                    }
                    //Image
                    if(!empty(Request::input('fileURLs'))){
                    $totalUrls = size_of(Request::input('fileURLs'));
                    $fileURLs = Request::input('fileURLs');
                    $fileLabels = Request::input('fileLabels');
                    for($i = 0; $i< $totalUrls; $i++) {
                        $ext = explode(".", $fileURLs[$i]);
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($j = 0; $j < 30; $j++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }

                        $filename = md5($randomString);
                        $filepath = 'data/pages/' . $filename . "." . $ext[1];
                        //$oldpath = str_replace(url(),"",$storeImageURLs[$i]);
                        $oldpath = 'data/temp/' . $fileURLs[$i];
                        if (!file_exists('data/pages/' . $fileURLs[$i])) {

                            if (rename($oldpath, $filepath) == FALSE) {
                                copy($oldpath, $filepath);

                            }
                            $filename = $filename . "." . $ext[1];
                            $attachment_ext = explode(".", $filename);

                        } else {
                            $filename = $fileURLs[$i];
                            $attachment_ext = explode(".", $filename);

                        }
                        $attachment = Attachments::create([
                            'attachment_url' => $filename,
                            'attachment_ext' => $attachment_ext[1],
                            'pages_page_id' => $create->page_id
                        ]);
                    }

                    }
                }

                
                */
              

            case 'newSubPage':
                $result= array();
                //print_r(Request::all());
                
//                $addPages=SubPages::create(Request::all());
//                echo $addPages->sub_page_id;
                // $subpage_page_title_sub =  Request::input('subpage_page_title_sub');
                // $subpage_page_title_desc =  Request::input('subpage_decrip_sub');

                // // $result = array_merge($subpage_page_title_sub, $subpage_page_title_desc);
                // print_r($subpage_page_title_sub);
                // foreach( $subpage_page_title_sub as $sub){
                //     $result['title'][] =$sub;
                // }
                // foreach( $subpage_page_title_desc as $sub){
                //     $result['desc'][] =$sub;
                // }
                // print_r($result);
                // if(!empty($subpage_page_title_sub)){
                //     foreach($subpage_page_title_sub as $sub){
                //         echo 'dfdf';
                //         DB::table('sub_pages')->insert(
                //             ['subpage_page_title' => $sub, 'subpage_decrip' => 0]
                //         );
                //     }
                // }
                
                if(Request::input('page_id')!=''){
                    $update = SubPages::find(Request::input('page_id'));
                    $update->update(Request::all());

                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {

                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/subpages/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'subpages_page_id' => $update->sub_page_id,
                            ]);
                        }
                    }
                }else{

                    $addPages=SubPages::create(Request::all());

                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/subpages/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'subpages_page_id' => $addPages->sub_page_id,
                                'pages_page_id' => Request::input('pages_page_id'),
                            ]);
                        }
                    }
                }
                break;
            case 'newBanner':

                if(Request::input('page_id')!=''){


                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {

                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/banners/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'menu_id' => Request::input('menu_id'),
                                'service_type_id' => Request::input('service_type_id'),
                            ]);
                        }
                    }
                }else{



                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/banners/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Attachments::create([
                                'attachment_url' => time() . '-' . $imageURL[$i],
                                'menu_id' => Request::input('menu_id'),
                                'service_type_id' => Request::input('service_type_id'),

                            ]);
                        }
                    }
                }
                break;
            case 'newTestimonial':


                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/testimonials/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Testimonials::create([
                                'test_image' => time() . '-' . $imageURL[$i],
                                'title' => Request::input('title'),
                                'sub_title' => Request::input('sub_title'),
                                'content' => Request::input('content'),
                            ]);
                        }
                    }

                break;

            case 'editTestimonial':

                $update =Testimonials::find(Request::input('testimonial_id'));
                $update->title =Request::input('title') ;
                $update->sub_title =Request::input('sub_title') ;
                $update->content =Request::input('content') ;

                $update->save();
                if(!empty(Request::input('fileURLs'))) {
                  //  $totalUrls = count(Request::input('fileURLs'));
                    $imageURLs = Request::input('fileURLs');
                    $fileURLs = Request::input('fileURLs');
                    $fileLabels = Request::input('fileLabels');

//                    for ($i = 0; $i < $totalUrls; $i++) {

                        $ext = explode(".", $fileURLs[0]);

                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($j = 0; $j < 30; $j++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $filename = md5($randomString);

                        $filepath = 'data/testimonials/' . $filename . "." . $ext[1];
                        //$oldpath = str_replace(url(),"",$storeImageURLs[$i]);
                        $oldpath = 'data/temp/' . $fileURLs[0];

                        if (file_exists($oldpath)) {
                            if (rename($oldpath, $filepath) == FALSE) {
                                copy($oldpath, $filepath);

                            }

                            $filename = $filename . "." . $ext[1];
                            $attachment_ext = explode(".", $filename);

                        } else {
                            $filename = $imageURLs[0];
                            $attachment_ext = explode(".", $filename);

                        }
                        $brd = Testimonials::find($update->testimonial_id);
                        $brd->test_image = $filename;
                        $brd->save();
//                    }
                }
                break;
                case 'newReview':


                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));

                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/reviews/' . time() . '-' . $imageURL[$i];

                            $oldpath = 'data/temp/' . $imageURL[$i];

                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image =Reviews::create([
                                'client_img' => time() . '-' . $imageURL[$i],
                                'title' => Request::input('title'),
                                'sub_title' => Request::input('sub_title'),
                                'content' => Request::input('content'),
                            ]);
                        }
                    }

                break;

            case 'editReview':

                $update =Reviews::find(Request::input('review_id'));
                $update->title =Request::input('title') ;
                $update->sub_title =Request::input('sub_title') ;
                $update->content =Request::input('content') ;

                $update->save();
                if(!empty(Request::input('fileURLs'))) {
                  //  $totalUrls = count(Request::input('fileURLs'));
                    $imageURLs = Request::input('fileURLs');
                    $fileURLs = Request::input('fileURLs');
                    $fileLabels = Request::input('fileLabels');

//                    for ($i = 0; $i < $totalUrls; $i++) {

                        $ext = explode(".", $fileURLs[0]);

                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = '';
                        for ($j = 0; $j < 30; $j++) {
                            $randomString .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $filename = md5($randomString);

                        $filepath = 'data/reviews/' . $filename . "." . $ext[1];
                        //$oldpath = str_replace(url(),"",$storeImageURLs[$i]);
                        $oldpath = 'data/temp/' . $fileURLs[0];

                        if (file_exists($oldpath)) {
                            if (rename($oldpath, $filepath) == FALSE) {
                                copy($oldpath, $filepath);

                            }

                            $filename = $filename . "." . $ext[1];
                            $attachment_ext = explode(".", $filename);

                        } else {
                            $filename = $imageURLs[0];
                            $attachment_ext = explode(".", $filename);

                        }
                        $brd = Reviews::find($update->review_id);
                        $brd->client_img = $filename;
                        $brd->save();
//                    }
                }
                break;
                case 'editServicePage':

                $update =Pages::find(Request::input('page_id'));
                $update->title =Request::input('title') ;
                $update->content =Request::input('content') ;

                $update->save();
                break;
                case 'editClientPage':

                $update =Pages::find(Request::input('page_id'));
                $update->title =Request::input('title') ;
                $update->content =Request::input('content') ;

                $update->save();
                break;


        }
        return response()->json(['status' => $status, 'message' => $message, 'html' => $html, 'data' => $data, 'url' => $url]);

    }


    public function postRemove(){
        $message = "";
        $status = 0;
        $html = "";
        $data = "";


        switch (Request::input('type')) {

            case 'deleteOurTeam':
                $get =OurTeam::find(Request::input('our_team_id'));
                if (file_exists('data/pooja/' . $get->image) )
                    unlink('data/pooja/' . $get->image);
                $delete =OurTeam::where('our_team_id', Request::input('our_team_id'))->delete();
            break;

            case 'deleteQuestion':
                $delete =CategoryHasQuestions::where('questions_question_id', Request::input('delete_id'))->delete();
                $delete =Answers::where('questions_question_id', Request::input('delete_id'))->delete();
                $delete =Questions::where('question_id', Request::input('delete_id'))->delete();
            break;



            case 'deleteENcategory':
                $getList =CategoryHasQuestions::where('categories_category_id', Request::input('delete_id'))->get();
                foreach ($getList as $get){
                    $delete =Answers::where('questions_question_id', $get->question_id)->delete();
                    $delete =Questions::where('question_id', $get->question_id)->delete();
                }
                $get = Attachments::where('categories_category_id', Request::input('delete_id'))->first();
                if (file_exists('data/category/' . $get->attachment_url) && $get->attachment_url != '')
                    unlink('data/category/' . $get->attachment_url);
                $delete = Attachments::where('categories_category_id', Request::input('delete_id'))->delete();
                $delete =EnCategories::where('category_id', Request::input('delete_id'))->delete();
            break;
            case 'deleteAvatar':
                $get = Avatar::where('avatar_id', Request::input('delete_id'))->first();
                if (file_exists('data/avatar/' . $get->avatar) && $get->avatar != '')
                    unlink('data/avatar/' . $get->avatar);
                $delete =Avatar::where('avatar_id', Request::input('delete_id'))->delete();
            break;
            case 'removeImage':

                $getattachment = Attachments::where('attachment_id', Request::input('id'))->get();

                foreach ($getattachment as $attachment) {
                    $image_path = public_path("data/pages/{$attachment->attachment_url}");
                    unlink($image_path);

                }
                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();
                $status=1;
            break;
            case 'removeSubPageImage':

                $getattachment = Attachments::where('attachment_id', Request::input('id'))->get();

                foreach ($getattachment as $attachment) {
                    $image_path = public_path("data/subpages/{$attachment->attachment_url}");
                    unlink($image_path);

                }

                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();
                $status=1;
            break;
            case 'removeBanner':

                $getattachment = Attachments::where('attachment_id', Request::input('id'))->get();

                foreach ($getattachment as $attachment) {
                    $image_path = public_path("data/banners/{$attachment->attachment_url}");
                    unlink($image_path);

                }

                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();
                $status=1;
                break;
            case 'removeTestImage':

                $getattachment = Attachments::where('attachment_id', Request::input('id'))->get();

                foreach ($getattachment as $attachment) {
                    $image_path = public_path("data/testimonials/{$attachment->attachment_url}");
                    unlink($image_path);

                }

                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();
                $status=1;
                break;

                case 'removeclientImage':

                $getattachment = Reviews::where('review_id', Request::input('id'))->get();

                foreach ($getattachment as $attachment) {
                    $image_path = public_path("data/reviews/{$attachment->attachment_url}");
                    unlink($image_path);

                }

                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();
                $status=1;
                break;
            case 'delete_banner':

                $getattachment = Attachments::where('attachment_id', Request::input('delete_id'))->delete();


/*                DB::table('attachments')->where('attachment_id', '=', Request::input('id'))->delete();*/
                $status=1;
                break;

                case 'delete_testimonials':

                Testimonials::find(Request::input('delete_id'))->delete();

                $status = 1;
                break;
                case 'delete_reviews':

                Reviews::find(Request::input('delete_id'))->delete();

                $status = 1;
                break;

        }
        return response()->json(['status' => $status, 'message' => $message, 'html' => $html, 'data' => $data]);

    }


    public function postFileUpload(){

        $option = array(

            'upload_dir' => 'data/temp/',
        );
       
        $upload_handler = new UploadFileHandler($option);
    }


}
