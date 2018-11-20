<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\Technician;
use App\Models\Csvdata;
use App\Models\User;
use App\Models\AspAdmin;
use App\Models\Job;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Parts;
use App\Models\PartsOrder;
use App\Models\Notes;
use App\Models\Claim;
use App\Models\WareHouse;
use App\Models\ProductReplacement;
use App\Models\GRN;
use App\Models\RMA;
use App\Models\Files;
use App\Models\AspFile;
use App\Models\TechFile;
use App\Models\AspTech;
use App\Models\MultipleParts;
use App\Models\Mileage;
use App\Models\Faulty;
use App\Models\Symptom;
use App\Models\Resolutions;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;


use App\Libraries\UploadFileHandler;
use Illuminate\Support\Facades\Input;

use Maatwebsite\Excel\Facades\Excel;
use Request;
use Response;
use View;
use Carbon;
use Hash;
use DB;
use Auth;
use URL;
use App;

class PostController extends Controller
{
    //common post function
    public function postManage(Request $request){
        $message = "";
        $status = 0;
        $html = "";
        $data = null;
        $count="";
        $ass_tech_id="";
        $amount = "";
        $url = "";
		$part_qty = "";
		$service_item_group = "";

        switch (Request::input('type')) {
            case 'newsec':
                dd('hh');
                break;
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
            case 'editCsv':
                $update = Csvdata::find(Request::input('id'));
                $update->joblocation1 =Request::input('joblocation1') ;
                $update->docno1 =Request::input('docno1') ;
                $update->textbox94 =Request::input('textbox94') ;
                $update->save() ;
            break;
            case 'newUpload':
                if(Request::input('upload_id')!=''){
                    $update = Upload::find(Request::input('upload_id'));
                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {  
                        $totalUrls = count(Request::input('fileURLs'));
                        dd($totalUrls);
                        for ($i = 0; $i < $totalUrls; $i++) {
                            $filepath = 'data/uploads/' . time() . '-' . $imageURL[$i];
                            $oldpath = 'data/temp/' . $imageURL[$i];
                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $brd=Upload::find($update->upload_id);
                            $brd->upload_url =time() . '-' . $imageURL[$i];
                            $brd->save();
                        }
                    }
                }else{
                    $imageURL = Request::input('fileURLs');
                    if ($imageURL) {
                        $totalUrls = count(Request::input('fileURLs'));
                        for ($i = 0; $i < $totalUrls; $i++) {
                            $ext = explode(".", $imageURL[$i]);
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $randomString = '';
                            for ($j = 0; $j < 30; $j++) {
                                $randomString .= $characters[rand(0, strlen($characters) - 1)];
                            }
                            $filename =  md5($randomString);
                            $filepath = 'data/uploads/' . time() . '-' . $imageURL[$i];
                            $oldpath = 'data/temp/' . $imageURL[$i];
                            if (file_exists($oldpath)) {
                                if (rename($oldpath, $filepath) == FALSE) {
                                    copy($oldpath, $filepath);
                                } elseif (file_exists('data/temp/' . $imageURL[$i])) {
                                    unlink('data/temp/' . $imageURL[$i]);
                                }
                            }
                            $image = Upload::create([
                                'upload_url' => time() . '-' . $imageURL[$i],
                                'upload_file_name' => $filename,

                            ]);
                        }
                    }
                }
            break;
            case 'newTechnician':
                if(Request::input('id')!=''){		
                    $pass=Request::input('password');
                    $update = User::find(Request::input('id'));
                    $update->username =Request::input('username') ;
                    $update->email =Request::input('email') ;
                    $update->password =Hash::make($pass) ;
                    $update->user_role_id ='3' ;
                    $update->save();	
					$data['admin']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                        ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                        ->where('asp_admin.asp_admin_id','=',Auth::user()->id)
                        ->first();		
					$var= $data['admin']->warehouse_code;
					$upd = DB::table('asp_tech')->where('asp_technician','=',Request::input('id'))
                        ->update(['warehouse_code' =>$var ]);
                }else{
                    $pass=Request::input('password');
                    $image = User::create([
                        'username' => Request::input('username'),
                        'email' => Request::input('email'),
                        'password' => Hash::make($pass),
                        'user_role_id' => '3',
                    ]);
                    $asp = AspTech::create([
                        'asp_technician' =>$image->id,
                        'warehouse_id' => Request::input('warehouse_id'),
                        'warehouse_code' => Request::input('code'),
                        'asp_admin_id' => Request::input('asp_id'),
                    ]);         
                    $status=1;
                }
            break;
            case 'newTechnicianTss':
				if(Request::input('id')!=''){
                    $pass=Request::input('password');
                    $update = User::find(Request::input('id'));
                    $update->username =Request::input('username') ;
                    $update->email =Request::input('email') ;
                    $update->password =Hash::make($pass) ;
                    $update->user_role_id ='3' ;
                    $update->save();	
					$upd = DB::table('asp_tech')->where('asp_technician','=',Request::input('id'))
                        ->update(['warehouse_code' =>Request::input('tech') ]);
                }else{
                    $pass=Request::input('password');
                    $image = User::create([
                        'username' => Request::input('username'),
                        'email' => Request::input('email'),
                        'password' => Hash::make($pass),
                        'user_role_id' => '3',
                    ]);
                    $asp = AspTech::create([
                        'asp_technician' =>$image->id,
                        'warehouse_id' => Request::input('warehouse_id'),
                        'warehouse_code' => Request::input('tech'),
                        'asp_admin_id' => Request::input('asp_id'),
                    ]);
                    $status=1;
                }
                // }
            break;
            case 'newAspAdmin':
                if(Request::input('id')!=''){
                    $pass=Request::input('password');
                    $update = User::find(Request::input('id'));
                    $update->email =Request::input('email') ;
                    $update->password =Hash::make($pass);
                    $update->save();
                    $update4 = WareHouse::where('warehouse_id','=',Request::input('warehouse_id'))->first();
                    $update4->name = Request::input('name') ;
                    // $update4->warehouse_id = Request::input('warehouse_id') ;
                    $update4->code = Request::input('code') ; 
                    $update4->address = Request::input('address') ;
                    $update4->tel_number1 =Request::input('phone1') ;
                    $update4->tel_number2 =Request::input('phone2') ;
                    $update4->save();
                    $upd = DB::table('asp_admin')->where('asp_admin_id','=',Request::input('id'))
                        ->update(['warehouse_code' =>Request::input('code') ]);
                }else{
                    $pass=Request::input('password');
                    $image = User::create([
                        'email' => Request::input('email'),
                        'password' => Hash::make($pass),
                        'user_role_id' =>2,
                    ]);
                    $ware = WareHouse::create([
                        'warehouse_id' => Request::input('warehouse'),
                        'name' => Request::input('name'),
                        'code' =>Request::input('code'),
                        'address' =>Request::input('address'),
                        'tel_number1' =>Request::input('phone1'),
                        'tel_number2' =>Request::input('phone2'),
                    ]);   
                    $asp = AspAdmin::create([
                        'asp_admin_id' =>$image->id,
                        'asp_warehouse_id' => Request::input('warehouse'),
                        'warehouse_code' => Request::input('code'),
                    ]);
                }
            break;
            case 'newMileage':
                $asp = Mileage::create([       
                    'min_mil' => Request::input('min_mil'),
                    'max_mil' => Request::input('max_mil'),
                    'mil_amount' => Request::input('mil_amount'),
                ]);
            break;
            case 'newFaulty':
                $asp = Faulty::create([
                    'faulty_code' => Request::input('faul_code'),
                    'faulty_description' => Request::input('faul_desc'),
                    'service_item_group' => Request::input('faul_item'),
                ]);
            break;
            case 'newSymptom':
                $asp = Symptom::create([
                    'symptom_code' => Request::input('sym_code'),
                    'symptom_description' => Request::input('sym_desc'),
                ]);
            break;
            case 'newResolution':
                $asp = Resolutions::create([
                    'resolution_code' => Request::input('res_code'),
                    'resolution_description' => Request::input('res_desc'),
                ]);
            break;
            case 'newWarehouse':
                if(Request::input('id')!=''){
                    $update = WareHouse::find(Request::input('id'));
                    $update->warehouse_id =Request::input('warehouse') ;
                    $update->name =Request::input('name') ;
                    $update->code =Request::input('code') ;
                    $update->address =Request::input('address') ;
                    $update->tel_number1 =Request::input('phone1') ;
                    $update->tel_number2 =Request::input('phone2') ;
                    $update->save();
                    $status=1;
                }else{
                    $image = WareHouse::create([
                        'warehouse_id' => Request::input('warehouse'),
                        'name' => Request::input('name'),
                        'code' =>Request::input('code'),
                        'address' =>Request::input('address'),
                        'tel_number1' =>Request::input('phone1'),
                        'tel_number2' =>Request::input('phone2'),
                    ]);
                    $status=1;
                }
            break;
            case 'newJob':
               if(Request::input('jobid')!=''){	 
                    $update = Job::find(Request::input('jobid'));
                    $update->asp_location =Request::input('asp_location') ;
                    $update->remark = Request::input('remark');
                    $update->description =Request::input('description');
                    $update->seriel_number =Request::input('seriel_number');
                    $update->change_code =Request::input('change_code');
                    $update->faulty_code =Request::input('faulty');
                    $update->symptom =Request::input('symptom');
                    $update->resolution =Request::input('resolution');
                    //$update->turn_fround_time =Request::input('turn_fround_time');
                    $update->technician =Request::input('technician') ;
                    $update->product = Request::input('product') ;
                    $update->save();
                    $status=1;
                    $update2 = Appointment::find(Request::input('jobid'));
                    $update2->appointment_time =Request::input('datepicker') ;
                    $update2->time = Request::input('time');
                    $update2->save();
			    }else{   
				    $cust = Customer::create([
                        'firstname' => Request::input('first_name'),
                        'lastname' => Request::input('last_name'),
                        'cu_address' => Request::input('address'),
                        'pincode' => Request::input('pin_code'),
                        'phone_no' => Request::input('phone'),
                        'bussiness_number' => Request::input('bus_num'),
                    ]);
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $image = Job::create([
                        'job_location' => Request::input('job_location'),
                        'repaire_order_no' => Request::input('rep_order_no'),
                        'remark' => Request::input('remark'),
                        //'turn_fround_time' => Request::input('turn_fround_time'),
                        'description' => Request::input('description'),
                        'seriel_number' => Request::input('seriel_number'),
                        'change_code' => Request::input('change_code'),
                        'faulty_code' => Request::input('faulty'),
                        'symptom' => Request::input('symptom'),
                        'resolution' => Request::input('resolution'),
                        'customer_id' => $cust->cu_id,
                        'remark' => Request::input('remark'),
                        'status' => 68,
                        'asp_location' => Request::input('asp_location'),
                        'technician' => Request::input('technician'),
                        'product' => Request::input('product'),
                        'job_type' => 'sw',
                        'creator' => Auth::user()->id,
                        'job_date' => Carbon::now(),
                        'created_at' => Carbon::now(),
                        'updated_at'=> Carbon::now(),
                    ]);
					$cust = Appointment::create([
                        'appointment_time' => $startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => 'created',
                        'job_id' =>  $image->job_id,
                    ]);
                    $prdct = ProductReplacement::create([
                        'product_id' => Request::input('product'),
                        'order_date' => Carbon::now(),
                    ]); 
			    }
                $status=1;
            break;   
            case 'newAppointmentAsp':
                if(Request::input('app_id')!=''){
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' => $startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob1 = Job::find(Request::input('job_id'));
                    $updjob1->status =71 ;
                    $updjob1->save();
                    $status=1;
                }else{
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' => $startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob = Job::find(Request::input('job_id'));
                    $updjob->status =71 ;
                    $updjob->save();
                    $status=1;
                }
            break;
            case 'newAppointmentTech':       
                if(Request::input('app_id')!=''){
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' => $startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob1 = Job::find(Request::input('job_idapp'));
                    $updjob1->status =71 ;
                    $updjob1->save();
                    $status=1;
                }else{
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' =>$startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob = Job::find(Request::input('job_id'));
                    $updjob->status =71 ;
                    $updjob->save();
                    $status=1;
                }
            break;
            case 'newAppointment':                   
                if(Request::input('app_id')!=''){
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' =>$startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob1 = Job::find(Request::input('job_id'));
                    $updjob1->status =71 ;
                    $updjob1->save();
                    $status=1;
                }else{
                    $getattachment = Appointment::where('job_id', Request::input('job_id'))->delete();
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $app = Appointment::create([
                        'appointment_time' =>  $startdate,
                        'time' => Request::input('time'),
                        'appoinment_status' => Request::input('status'),
                        'job_id' => Request::input('job_id'),
                        'appoinment_status' => 'created',
                    ]);
                    $status=1;
                    $updjob = Job::find(Request::input('job_id'));
                    $updjob->status =71 ;
                    $updjob->save();
                    $status=1;
                }
            break;
            case 'JobAssign':
                $update = Job::find(Request::input('job_id'));
                $update->asp_location =Request::input('warehouse_id') ;
                $update->save();
                $status=1;
            break;
            case 'JobAssignTech':
                $update = Job::find(Request::input('job_id'));				
                $update->technician =Request::input('user_id') ;             
                $update->save();
                $status=1;
            break;
            case 'JobAssignWare':
                $update = Job::find(Request::input('job_id'));
                $update->asp_location =Request::input('code') ;
                $update->technician =NULL ;
                $update->save();
                $update = Job::find(Request::input('job_id'));
                $update->asp_location =Request::input('code') ;
                $update->save();
                $status=1;
                $query = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                    ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                    ->where('asp_tech.warehouse_code','=',Request::input('code'))
                    ->where('users.user_role_id','=',3)
                    ->get();
			    $coun= $query->count();
                $url = Request::input('job_id');
                if($coun != 0){	
                    foreach($query  as $quer){ 
                        $html .= '<option value="">Please Select</option>
                            <option value='.$quer->id.'>'.$quer->email.'</option>';
                        }
			        $status=1;
			    }else{        
                   $html .= '<option value="">Please Select</option>';
				   $status=1;
                }
            break;
            case 'editSparePart':
                $update = Parts::find(Request::input('part_id'));
                $update->part_no =Request::input('part_no') ;
                $update->parts_description =Request::input('descr') ;
                $update->last_kit_bom_used =Request::input('kit_bom') ;
                $update->dealer_price =Request::input('delaer_price') ;
                $update->customer_price =Request::input('cus_price') ;
                $update->TASS_price =Request::input('tass_price') ;
                $update->avl_qty =Request::input('avl_qty') ;
                $update->save();
                $status=1;
            break;
            case 'editProduct':
                $update = Product::find(Request::input('product_no'));
                $update->product_type =Request::input('prod_typ') ;
                $update->service_item_group =Request::input('prod_item') ;
                $update->product_description =Request::input('prod_descr') ;
                $update->bu_code =Request::input('bu_code') ;
                $update->sub_code =Request::input('sbu_code') ;
                $update->save();
                $status=1;
            break;
            case 'editMileage':
                $update = Mileage::find(Request::input('mil_id'));
                $update->min_mil =Request::input('min_mil') ;
                $update->max_mil =Request::input('max_mil') ;
                $update->mil_amount =Request::input('mil_amount') ;
                $update->save();
                $status=1;
            break;
            case 'editFaulty':
                $upd = DB::table('faultylist')->where('faulty_id','=',Request::input('faulty_id'))
                    ->update(['faulty_code' => Request::input('faul_code'),
                    'faulty_description' => Request::input('faul_desc'),
                    'service_item_group' => Request::input('faul_item')
                ]);
                $status=1;      
            break;
            case 'editSymptom':
                $upd = DB::table('symptoms')->where('symptom_id','=',Request::input('symptom_id'))
                    ->update(['symptom_code' => Request::input('sym_code'),
                    'symptom_description' => Request::input('sym_desc')
                ]);
                $status=1;
            break;
            case 'editResolution':
                $upd = DB::table('resolutions')->where('resolution_id','=',Request::input('resolution_id'))
                    ->update(['resolution_code' => Request::input('res_code'),
                    'resolution_description' => Request::input('res_desc')
                ]);
                $status=1;
            break;
            case 'techFile':
                $app = TechFile::create([
                    'file_id' => Request::input('url'),
                    'tehnician' => Request::input('user_id'),
                ]);
                $status=1;
            break;
            case 'editJob':
                $update = Job::find(Request::input('job_id'));
                if(Request::input('asp_location'))
                    $update->asp_location =Request::input('asp_location') ;
                $update->remark =Request::input('remark');
                $update->description =Request::input('description');
                $update->change_code =Request::input('change_code');
                $update->seriel_number =Request::input('seriel_number');
                $update->faulty_code =Request::input('faulty');
                $update->resolution =Request::input('resolution');
                $update->symptom =Request::input('symptom');
                    //$update->turn_fround_time =Request::input('turn_fround_time');
                if(Request::input('technician'))
                    $update->technician =Request::input('technician') ;
                $update->product =Request::input('product') ;
                $update->save();
                $status=1;
                if(Request::input('appointment_time')!=''){
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $upd = DB::table('appointment')->where('job_id','=',Request::input('job_id'))
                        ->update(['appointment_time' =>$startdate ]);
                    $status=1;
                }
                else{ 
                    $date=Request::input('datepicker'); 
                    if($date){
                        $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                        $updatej = Job::find(Request::input('job_id'));
                        $updatej->status =71;
                        $updatej->save();
                        $status=1;
                        $app = Appointment::create([
                            'appointment_time' => $startdate,
                            'time' => Request::input('time'),
                            'job_id' => $updatej->job_id,
                            'appoinment_status' => 'created',
            
                        ]);
                    }                  
                } 
                if(Request::input('cu_id')!=''){
                    $update1 = Customer::find(Request::input('cu_id'));
                    $update1->firstname =Request::input('fname') ;
                    $update1->lastname =Request::input('lname') ;
                    $update1->cu_address =Request::input('address') ;
                    $update1->pincode =Request::input('pincode') ;
                    $update1->phone_no =Request::input('phone_no') ;
                    $update1->bussiness_number =Request::input('busines_no') ;
                    $update1->save();
                    $update1=1;
                }else{
                    $cust = Customer::create([
                        'firstname' => Request::input('fname'),
                        'lastname' => Request::input('lname'),
                        'cu_address' => Request::input('address'),
                        'pincode' => Request::input('pincode'),
                        'phone_no' => Request::input('phone_no'),
                        'bussiness_number' => Request::input('busines_no'),
                    ]);
                    $update22 = Job::find(Request::input('job_id'));
                    $update22->customer_id =$cust->cu_id ;
                    $update22->save();
                }
            break;
            case 'editaspJob':
                if(Request::input('cu_id')!=''){
                    $update1 = Customer::find(Request::input('cu_id'));
                    $update1->firstname =Request::input('fname') ;
                    $update1->lastname =Request::input('lname') ;
                    $update1->cu_address =Request::input('address') ;
                    $update1->phone_no =Request::input('phone_no') ;
                    $update1->save();
                }
                $status=1;
                if(Request::input('appointment_time')!=''){
                    $date=Request::input('datepicker');
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $upd = DB::table('appointment')->where('job_id','=',Request::input('job_id'))
                        ->update(['appointment_time' =>$startdate ]);
                    $status=1; 
                }else{
                    $date=Request::input('datepicker');
                    if($date){
                        $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                        $updatej = Job::find(Request::input('job_id'));
                        $updatej->status =71;
                        $updatej->save();
                        $status=1;
                        $app = Appointment::create([
                            'appointment_time' => $startdate,
                            'time' => Request::input('time'),
                            'job_id' => $updatej->job_id,
                            'appoinment_status' => 'created',
                        ]);
                    }  
                }
            break;
            case 'newParts':
                $faulty=Request::input('faulty');
                $symptom=Request::input('symptom');
                $resolution=Request::input('resolution');
                $job = Request::segment(2);
                if(Request::input('part_id')!=''){	
                    $date=Request::input('del_date');
                    if(Request::input('reject') == '1'|| Request::input('reject') == '2' || Request::input('rejectApproved') == 'NOT_APPROVED'){
                        $startdate=NULL;
                        if($date){
                            $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                        }
                        $update = PartsOrder::find(Request::input('part_id'));
                        $update->delivery_date = $startdate ;
                        $update->isapprove = Request::input('reject');
                        $update->approver = Auth::user()->id;
                        $update->apprv_remarks = Request::input('note');
                        $update->remark = Request::input('remark');
                        $update->save();
                        $name = Request::input('parts');
                        $description =Request::input('qnty');
                        $mul_id =Request::input('ml_id');
                        $part_n =Request::input('part_n');
                        $count = count($name);
                        for($i = 0; $i < $count; $i++){
                            //$multipleid = $mul_id[$i];
                            if(!array_key_exists($i,$mul_id)){
                                $objModel = new MultipleParts();
                                $objModel->order_id = Request::input('part_id');
                                $objModel->parts = $name[$i];
                                $objModel->quantity = $description[$i];
                                $objModel->save();
                                $qty =  DB::table('parts_list')->where('part_id', $name[$i])->first();
                                if($qty){
                                    $avlqty=$qty->avl_qty;
                                    DB::table('parts_list')
                                    ->where('part_id', $name[$i])
                                    ->update([
                                        'avl_qty' =>$avlqty - $description[$i],
                                    ]);
                                }
                            }else {
                                DB::table('muliple_parts')
                                ->where('mul_part_id', $mul_id[$i])
                                ->update([
                                    'parts' => $name[$i],
                                    'quantity' => $description[$i],
                                ]);
                                $qty =  DB::table('parts_list')->where('part_id', $name[$i])->first();
                                if($qty){
                                    $avlqty = $qty->avl_qty;
                                    DB::table('parts_list')
                                    ->where('part_id', $name[$i])
                                    ->update([
                                        'avl_qty' =>$avlqty - $description[$i],
                                    ]);
                                }
                            }
                        }
                        $statusVal =76; 
                        if(Request::input('reject') == '2') {
                            $statusVal =105; 
                        }else if(Request::input('reject') == '1'){
                            $statusVal =104; 
                        }    
                        $update = Job::find(Request::input('jobid'));
                        $update->faulty_code = $faulty;
                        $update->symptom = $symptom ;
                        $update->resolution = $resolution ;
                        if($statusVal == 105 || $statusVal ==104){
                            $update->status =$statusVal;
                        }
                        $update->save();
                        $status=1;                 
                    }   
                }else{
                    $startdate=NULL;
                    $date=Request::input('del_date');
                    if($date){
                        $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    }
                    $parts = PartsOrder::create([
                    'creator' => Auth::user()->id,
                    'location' => Request::input('location'),
                    'remark' => Request::input('remark'),
                    'apprv_remarks' => Request::input('note'),
                    'isapprove' => Request::input('reject'),
                    'delivery_date' => $startdate,
                    'order_date' =>Carbon::now(),
                    'type'=>'with_job',
                    ]);
					$status=76;
					if($parts->delivery_date){	
					    $status = 104;
					}
                    $update = Job::find(Request::input('jobid'));
                    $update->parts_order = $parts->part_order_id ;
                    $update->faulty_code = $faulty;
                    $update->symptom = $symptom ;
                    $update->resolution = $resolution ;
                    $update->status =$status;
                    $update->save();
                       $status=1;
                    $name = Request::input('parts');
                    $description =Request::input('qnty');
                    if(count($name) >= count($description))
                        $count = count($description);
                    else 
                        $count = count($name);                  
                    for($i = 0; $i < $count; $i++){
                        $objModel = new MultipleParts();
                        $objModel->order_id = $parts->part_order_id;
                        $objModel->parts = $name[$i];
                        $objModel->quantity = $description[$i];
                        $objModel->save();
                        $qty =  DB::table('parts_list')->where('part_id', $name[$i])->first();
                        if($qty){
                            $avlqty=$qty->avl_qty;
                            DB::table('parts_list')
                            ->where('part_id', $name[$i])
                            ->update([
                                'avl_qty' =>$avlqty - $description[$i],
                            ]);
                        }
                       
                    }
                }
            break;
            case 'edit-parts':
                $update = Job::find(Request::input('job_id'));       
                $update->faulty_code = Request::input('faulty') ; 
                $update->symptom = Request::input('symptom') ;
                $update->resolution = Request::input('resolution') ;
                $update->save();
                $name = Request::input('parts');   
                $description =Request::input('qty');
                $mul_id =Request::input('ml_id');
                $part_n =Request::input('part_n');
                $count = count($mul_id);
                if(!empty($name)){
                    for($i = 0; $i < $count; $i++){
                        DB::table('muliple_parts')
                            ->where('mul_part_id', $mul_id[$i])
                            ->update([
                                'parts' => $part_n[$i],
                                'quantity' => $description[$i],
                            ]);    
                    }
                }else{
                    for($i = 0; $i < $count; $i++){
                        DB::table('muliple_parts')
                        ->where('mul_part_id', $mul_id[$i])
                        ->update([
                            'parts' => $name[$i],
                            'quantity' => $description[$i],
                        ]);
                    }
                }
            break;
            case 'editpartsOrder':
                $date=Request::input('del_date');
                if($date){
                    $startdate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
                    $update = PartsOrder::find(Request::input('part_id'));
                    $update->delivery_date = $startdate ;
                    $update->isapprove = Request::input('approve') ;
                    $update->approver = Auth::user()->id;
                    $update->save();
                    if(Request::input('job_id')){
                        $update = Job::find(Request::input('job_id'));
                        $update->status = 104 ;
                        $update->save();
                    }   
                }                              
                $status=1;
                $name = Request::input('parts');
                $description =Request::input('qty');
                $mul_id =Request::input('ml_id');
                $part_n =Request::input('part_n');
                $count = count($mul_id);
                if(!empty($name)){
                    for($i = 0; $i < $count; $i++){
                        $mulp =  DB::table('muliple_parts')->where('parts', $part_n[$i])->first();
                        DB::table('muliple_parts')
                            ->where('mul_part_id', $mul_id[$i])
                            ->update([
                                'parts' => $part_n[$i],
                                'quantity' => $description[$i],
                            ]);
                        $qty =  DB::table('parts_list')->where('part_id', $part_n[$i])->first();
                        $avlqty=$qty->avl_qty;
                        $mlqty=$mulp->quantity;
                        $cqty=$description[$i];
                        $diff = $mlqty-$cqty ;
                        if($mlqty>$cqty){
                            DB::table('parts_list')
                                ->where('part_id', $part_n[$i])
                                ->update([
                                    'avl_qty' =>$avlqty + $diff,
                            ]);
                        }else{
                            DB::table('parts_list')
                                ->where('part_id', $part_n[$i])
                                ->update([
                                    'avl_qty' =>$avlqty - $diff,
                                ]); 
                        }            
                    }
              }else{
                for($i = 0; $i < $count; $i++){
                    DB::table('muliple_parts')
                    ->where('mul_part_id', $mul_id[$i])
                    ->update([
                        'parts' => $name[$i],
                        'quantity' => $description[$i],
                    ]);
                    $qty =  DB::table('parts_list')->where('part_id', $name[$i])->first();
                    $avlqty=$qty->avl_qty;
                    DB::table('parts_list')
                        ->where('part_id', $name[$i])
                        ->update([
                            'avl_qty' =>$avlqty - $description[$i],
                        ]);
                    }
                }
                if(Request::input('note')){
                    $update = PartsOrder::find(Request::input('part_id'));
                    $update->isapprove = Request::input('reject') ;
                    $update->approver = Auth::user()->id;
                    $update->save();
                    $notes = Notes::create([
                        'part_order' =>$update->part_order_id,
                        'note_date' => Carbon::now(),
                        //'isapprove' => Request::input('reject'),
                        'creater' => Auth::user()->id,
                        'note' => Request::input('note'),
                    ]);
                    $update = Job::find(Request::input('job_id'));
                    $update->status = 105 ;
                    $update->save();
                }
            break;
            case 'newClaim':
                 if(Request::input('claim_id')!=''){
                    //$getattachment = Claim::where('job_id', Request::input('jobid'))->delete();
                    $update = Claim::find(Request::input('claim_id'));
                    $update->claim_amount = Request::input('amount') ;
                    $update->mileage = Request::input('mileage') ;
                    $update->labour =  Request::input('labour');
                    if(Request::input('remark'))
                        $update->remarks = Request::input('remark') ;
                    if(Request::input('reject'))
                        $update->isapprove = Request::input('reject') ;
                    $update->save();
                    $status=1;
                    $update = Job::find(Request::input('jobid'));
                    //$update->symptom = Request::input('symptom') ;    
                    //$update->resolution = Request::input('resolution');
                    //$update->faulty_code = Request::input('faulty');
                    $update->status = 63 ; 
                    $update->save();
                    $status=1;
            }else{
                //$getattachment = Claim::where('job_id', Request::input('jobid'))->delete();				            				   					    
                $notes = Claim::create([
                    'claim_amount' => Request::input('amount'),
                    'mileage' =>  Request::input('mileage'),
                    'labour' =>  Request::input('labour'),
                    'job_id' => Request::input('jobid'),
                    'remarks' => Request::input('remark'),
                    'created_at' => Carbon::now(),
                    'isapprove' =>  Request::input('reject'),
                ]);
                $update = Job::find(Request::input('jobid'));
                $createdDateFormte  = date('d-m-Y', strtotime($update->created_at));
                $claimCreated       =  date('d-m-Y', strtotime(Carbon::now()));
                $parsedate1=Carbon::parse($createdDateFormte);
                $parsedate2=Carbon::parse($claimCreated);   
                $date_diff=$parsedate1->diffInDays($parsedate2);
                //$update->symptom = Request::input('symptom');
                //$update->resolution = Request::input('resolution');
                //$update->faulty_code = Request::input('faulty');
                $update->status = 63;
                $update->turn_fround_time = $date_diff;
                $update->save();
                $status=1;
            }
            break;
            case 'editclaim':
                $update = Claim::find(Request::input('claim_id'));
                $update->claim_amount = Request::input('amount') ;
                $update->mileage = Request::input('mileage') ;
                $update->remarks = Request::input('remark') ;
                $update->isapprove = Request::input('approve') ;
                $update->save();
                $status=1;
            break;
            case 'ChangeStatus':
                // $update = Job::find(Request::input('job_id'));
                // $update->status = Request::input('status');
                // $update->technician = Request::input('tech');
                // $update->save();
                $status=Request::input('status');
                $job_id=Request::input('job_id');
                // $sql = "UPDATE jobs SET status = $status WHERE id = $job_id";
                $upd = DB::table('jobs')
                    ->where('job_id','=',Request::input('job_id'))
                    ->update(['status' => Request::input('status')]);
                $status=1;
            break;  
            case 'filter_list':
                $date=explode("-" ,Request::input('dateRange'));
                $startdate= date('Y-m-d', strtotime($date[0]));
                $enddate=date('Y-m-d', strtotime($date[1]));
                $query = Job::leftjoin('users','users.id','=','jobs.technician')
                    ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
                    ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
                    ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
                    ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                    ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
                    ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                    ->leftjoin('job_status','job_status.status_id','=','jobs.status')
                    ->where('jobs.status','=',63)
                    ->whereBetween('job_date', [$startdate, $enddate])
                    ->get();
                $count=$query->count();
                if($count===0){
                    $status=0;
                }else{
                    $html = '<tbody>
                    <caption class="bottom"></caption>
                    <thead>
                        <tr>
                            <th>Job date</th>
                            <th>Status</th>
                            <th>ASP Name</th>
                            <th>ASP Technician</th> 
                            <th>Job Location</th>
                            <th>Repair Order No</th> 
                            <th> Bill No Name</th>
                            <th> Contact Number</th>
                            <th> Turn Around Time</th>
                            <th> Appointment Date</th>
                            <th> Seriel No</th>
                            <th> Purchase Date</th>
                            <th> Item No</th>
                            <th> Description</th>
                            <th> Location</th>
                            <th> Quantity</th>
                            <th> Delivery Date</th>
                        </tr>
                    </thead>';
                    foreach($query  as $quer){
                        $html .= '<tr>
                        <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
                        <td>'.$quer->status_code .'</td>
                        <td>'.$quer->name .'</td>
                        <td>'.$quer->username .'</td>
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>';
                    }
                    $html .='</tbody>';
                    $status=1;
                }
              break;

            case 'filter_parts':
		        $date=explode("-" ,Request::input('dateRange'));
                /**work around */
                $datesrray =  explode("/",trim($date[0]));
                $datefromate = $datesrray[1].'/'.$datesrray[0].'/'.$datesrray[2];
                $date[0]   = $datefromate;
                $datesrray =  explode("/",trim($date[1]));
                $datefromate = $datesrray[1].'/'.$datesrray[0].'/'.$datesrray[2];
                $date[1]   = $datefromate;
                /*** end here */
                $d1= date('d-m-Y', strtotime($date[0]));
                $d2= date('d-m-Y', strtotime($date[1]));
                $startdate=  date('Y-m-d', strtotime($date[0]));
                $enddate=date('Y-m-d', strtotime($date[1]));
                $query = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                ->whereBetween('order_date', [$startdate, $enddate])
                ->get();
                $count=$query->count();
                if($count===0){
                  $status=0;
                }else{
                    $html = '<tbody>
                    <caption class="bottom"></caption>
                    <thead>
                        <tr>
                            <th>Model</th> 
                            <th>Part No</th>      
                            <th>Description</th>
                            <th>Order Qty</th>
                            <th>Supplied</th>
                            <th>Job No</th>
                            <th>Delivery Date</th>
                            <th> Invoice</th>        
                            <th> ETA</th>       
                            <th> Qty still pending </th>
                            <th> Asp Company Name</th>
                            <th> Order No</th>
                            <th> Request Date</th>
                            <th> Status </th> 
                        </tr>
                    </thead>';
                    foreach($query  as $quer){
                        $html .= '<tr> 
                            <td>'.$quer->part_no .'</td>
                            <td>'.$quer->part_no .'</td>
                            <td>'.$quer->parts_description .'</td>
                            <td>'.$quer->quantity .'</td>
                            <td>'.$quer->quantity .'</td>
                            <td>'.$quer->repaire_order_no .'</td>
                            <td>'.$quer->delivery_date .'</td>
                            <td></td>
                            <td></td>
                            <td>'.$quer->quantity .'</td>
                            <td>'.$quer->name .'</td>
                            <td>'.$quer->order_id.'</td>
                            <td>'.$quer->mul_date.'</td>
                            <td></td>
                        </tr>';
                    }
                    $html .='</tbody>';
                    $status=1;
                }
			break;
            case 'filter_parts_teh':
                $query = PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                    ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                    ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                    ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
			        ->where('jobs.asp_location','=',Request::input('asp'))
                    ->get();
                $count=$query->count();
                if($count===0){
                    $status=0;
                }else{
                    $html = '<tbody>
                            <caption class="bottom"></caption>
                            <thead>
                                <tr>
                                    <th>Model</th> 
                                    <th>Part No</th>      
                                    <th>Description</th>
                                    <th>Order Qty</th>
                                    <th>Supplied</th>
                                    <th>Job No</th>
                                    <th>Delivery Date</th>
                                    <th> Invoice</th>        
                                    <th> ETA</th>       
                                    <th> Qty still pending </th>
                                    <th> Asp Company Name</th>
                                    <th> Order No</th>
                                    <th> Request Date</th>
                                    <th> Status </th>
                                </tr>
                            </thead>';
                    foreach($query  as $quer){
                        $html .= '<tr>
                            <td>'.$quer->part_no .'</td>
                                <td>'.$quer->part_no .'</td>
                                <td>'.$quer->parts_description .'</td>
                                <td>'.$quer->quantity .'</td>
                                <td>'.$quer->quantity .'</td>
                                <td>'.$quer->repaire_order_no .'</td>
                                <td>'.$quer->delivery_date .'</td>
                                <td></td>
                                <td></td>
                                <td>'.$quer->quantity .'</td>
                                <td>'.$quer->name .'</td>
                                <td>'.$quer->order_id.'</td>
                                <td>'.$quer->mul_date.'</td>
                                <td></td>
                            </tr>';
                        }
                    $html .='</tbody>';
                    $status=1;
                }
			break;				 
            case 'filter_asp':


               
               $query = Job::leftjoin('users','users.id','=','jobs.technician')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
         ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
             ->where('jobs.status','=',63)
              ->where('jobs.asp_location','=',Request::input('asp'))
             ->get();
 
             $count=$query->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
                 <th>Job Id</th>
                     <th>Status</th>
                     <th>ASP Name</th>
                     <th>ASP Technician</th>
                   
                     <th>Job Location</th>
                     <th>Repair Order No</th>
                    
                     <th> Bill No Name</th>
                 
                     <th> Contact Number</th>
                   
                     <th> Turn Around Time</th>
                                          <th> Appointment Date</th>
                     <th> Seriel No</th>
                     <th> Purchase Date</th>
                     <th> Item No</th>
                     <th> Description</th>
                     <th> Location</th>
                     <th> Quantity</th>
                     <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                    $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
                    <td>'.$quer->job_id .'</td>
                        <td>'.$quer->status_code .'</td>
                        <td>'.$quer->name .'</td>
                        <td>'.$quer->username .'</td>

                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        
                        <td>'.$quer->cu_address .'</td>
                       
                        <td>'.$quer->phone_no .'</td>
                      
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             }
              
               break;



               case 'filter_tech':


               
               $query = Job::leftjoin('users','users.id','=','jobs.technician')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
         ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
             ->where('jobs.status','=',63)
              ->where('jobs.technician','=',Request::input('technician'))
             ->get();
    
             $count=$query->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
                 <th>Job Id</th>
                     <th>Status</th>
                     <th>ASP Name</th>
                     <th>ASP Technician</th>
                   
                     <th>Job Location</th>
                     <th>Repair Order No</th>
                    
                     <th> Bill No Name</th>
                 
                     <th> Phone No/Business Number</th>
                   
                     <th> Turn Around Time</th>                    
                      <th> Appointment Date</th>
                     <th> Seriel No</th>
                     <th> Purchase Date</th>
                     <th> Item No</th>
                     <th> Description</th>
                     <th> Location</th>
                     <th> Quantity</th>
                     <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                    $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
                    <td>'.$quer->job_id .'</td>
                        <td>'.$quer->status_code .'</td>
                        <td>'.$quer->name .'</td>
                        <td>'.$quer->username .'</td>

                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                       
                        <td>'.$quer->cu_address .'</td>
                       
                        <td>'.$quer->phone_no .'</td>
                      
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             }
               
               break;


               case 'filter_stat':


             
               $query = Job::leftjoin('users','users.id','=','jobs.technician')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
         ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
             //->where('jobs.status','=',41)
              ->where('jobs.status','=',Request::input('status'))
             ->get();
    			   
   $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
             $count=$query->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
                <th>Job Id</th>
                    <th>Status</th>
                    <th>ASP Name</th>
                    <th>ASP Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                    
                    <th> Bill No Name</th>
                
                    <th> Contact Number</th>
                  
                    <th> Turn Around Time</th>                 
                       <th> Appointment Date</th>
                    <th> Seriel No</th>
                    <th> Purchase Date</th>
                    <th> Item No</th>
                    <th> Description</th>
                    <th> Location</th>
                    <th> Quantity</th>
                    <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                  $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" data-id="{{$job->job_id}}">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$quer->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" data-id="{{$job->job_id}}"">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="sel_ware" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             }
               
               break;

               case 'filter_csvs':


             
               $query = Job::leftjoin('users','users.id','=','jobs.technician')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
              ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
              ->where('jobs.job_type','=','csero')
             ->get();
   			   
   $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
             $count=$query->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>

                    <th>Status</th>
                    <th>ASP Name</th>
                    <th>ASP Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                   
                    <th> Bill No Name</th>
                
                    <th> Contact Number</th>
                  
                    <th> Turn Around Time</th>                    <th> Appointment Date</th>
                    <th> Seriel No</th>
                    <th> Purchase Date</th>
                    <th> Item No</th>
                    <th> Description</th>
                    <th> Location</th>
                    <th> Quantity</th>
                    <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                     $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" id="getele"  onchange="onChangestatus(this)"  data-id="'.$quer->job_id.'">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$st->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" onchange="selectWarehouse(this)" data-id="'.$quer->job_id.'">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="assigntech" id="getid" onchange="assignTn(this)" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
			 }
    $html .='</tbody>
           ';

            $status=1;
             }
               
               break;



               case 'filter_sws':
             
               $query = Job::leftjoin('users','users.id','=','jobs.technician')
             ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
             ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location') 
             ->leftjoin('asp_list','asp_admin.asp_warehouse_id','=','asp_list.warehouse_id')
            ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
               ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
         ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
               ->leftjoin('job_status','job_status.status_id','=','jobs.status')
              ->where('jobs.job_type','=','sw')
             ->get();
   			   
   $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
             $count=$query->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
              
                    <th>Status</th>
                    <th>ASP Name</th>
                    <th>ASP Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                    
                    <th> Bill No Name</th>
                
                    <th>Contact Number</th>
                  
                    <th> Turn Around Time</th>                    <th> Appointment Date</th>
                    <th> Seriel No</th>
                    <th> Purchase Date</th>
                    <th> Item No</th>
                    <th> Description</th>
                    <th> Location</th>
                    <th> Quantity</th>
                    <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                     $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" id="getele"  onchange="onChangestatus(this)"  data-id="'.$quer->job_id.'">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$st->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" onchange="selectWarehouse(this)" data-id="'.$quer->job_id.'">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="assigntech" id="getid" onchange="assignTn(this)" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             }
               
               break;

               case 'get_faulty':
               $res11 = Request::input('res');
              
                     $results = DB::table('faultylist')->where('faulty_description', 'LIKE', '%'.$res11.'%')
                     ->orWhere('faulty_code', 'LIKE', '%'.$res11.'%' )
                     
                     ->first();
                    
                     $count=Faulty::where('faulty_description', 'LIKE', '%'.$res11.'%')
                     ->orWhere('faulty_code', 'LIKE', '%'.$res11.'%' )->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
               
                    <th>Code</th>
                    <th>Description</th>
                    <th>Service Item Group</th>
                  
               
                </tr>
                </thead>
                ';
    

                    $html .= '<tr>
                    
                        <td>'.$results->faulty_code.'</td>
                        <td>'.$results->faulty_description.'</td>
                        <td>'.$results->service_item_group.'</td>
                       
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             
               break;

               case 'get_symptom':
               $res22 = Request::input('res');
              
                     $results = DB::table('symptoms')->where('symptom_description', 'LIKE', '%'.$res22.'%')
                     ->orWhere('symptom_code', 'LIKE', '%'.$res22.'%' )
                     ->first();
                    
                     $count=DB::table('symptoms')->where('symptom_description', 'LIKE', '%'.$res22.'%')
                     ->orWhere('symptom_code', 'LIKE', '%'.$res22.'%' )->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
               
                    <th>Code</th>
                    <th>Description</th>
                  
               
                </tr>
                </thead>
                ';
    

                    $html .= '<tr>
                    
                        <td>'.$results->symptom_code.'</td>
                        <td>'.$results->symptom_description.'</td>
                       
                       
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             
               break;

               case 'get_resolution':

               $res33 = Request::input('res');
              
                     $results = DB::table('resolutions')->where('resolution_description', 'LIKE', '%'.$res33.'%')
                     ->orWhere('resolution_code', 'LIKE', '%'.$res33.'%' )
                     ->first();
                    
                     $count=DB::table('resolutions')->where('resolution_description', 'LIKE', '%'.$res33.'%')
                     ->orWhere('resolution_code', 'LIKE', '%'.$res33.'%' )->count();
             
             if($count===0){
                 $status=0;
             }
             else{
                $html = '

                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
               
                    <th>Code</th>
                    <th>Description</th>
                  
               
                </tr>
                </thead>
                ';
    

                    $html .= '<tr>
                    
                        <td>'.$results->resolution_code.'</td>
                        <td>'.$results->resolution_description.'</td>
                        
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
             
               break;
                 case 'job_tech':

                 $query = User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                 ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                 ->where('asp_tech.warehouse_code','=',Request::input('att'))
                 ->where('users.user_role_id','=',3)
               
                ->get();

                
             
                $html.= '<option value="">Please Select</option>';
foreach($query as $quer){
  $html.= '<option value="'.$quer->id.'">'.$quer->email.'</option>';
}
                $status=1;

                 break;


        case 'part_descrip':

        $query = Parts::where('part_id','=',Request::input('desc'))
        ->first();
   
     
            $html .= '<h8>'.$query->parts_description.'</h8>
            ';
        
            
        
        $status=1;
      
        case 'claim_amount':
       
        $value= Request::input('status');

        if((0 <= $value) && ($value <= 44)){
            $am= Mileage::where('min_mil','=',0)->first();
           $amount= $am->mil_amount;
           
          
           $status=1;
         }
         elseif((45 <= $value) && ($value <= 99)){
            $am= Mileage::where('min_mil','=',45)->first();
            $amount= $am->mil_amount;
           
            $status=1;
         }
         elseif((100 <= $value) && ($value <= 150)){
            $am= Mileage::where('min_mil','=',100)->first();
            $amount= $am->mil_amount;
            
            $status=1;
         }
         elseif((151 <= $value) && ($value <= 999999)){
            $am= Mileage::where('min_mil','=',151)->first();
            $amount= $am->mil_amount;
            
            $status=1;
         }
         else{
         
            $status=3;
         }
        
         

        break;

		
		case 'avl_part_qty':
		
		 $am= Parts::where('part_id','=',Request::input('status'))->first();
		 $part_qty = $am->avl_qty;
		 $status=1;
		break;
		
		case 'get_service_type':
		
		 $am= Product::where('product_no','=',Request::input('status'))->first();
		
		$service_item_group = $am->service_item_group;
		 $status=1;
		break;

                 case 'filter_asp_all':


               
                 $query = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
              ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                 ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
           ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
		       ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
              ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                 ->leftjoin('job_status','job_status.status_id','=','jobs.status')
               //->where('jobs.status','=',41)
                ->where('jobs.asp_location','=',Request::input('asp'))
               ->get();
			   
			   
   $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
               $count=$query->count();
             
               if($count===0){
                   $status=0;
               }
               else{
                $html = '
  
                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
               
                    <th>Action</th>
                    <th>Status</th>
                    <th>Asp Name</th>
                    <th>Asp Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                   
                    <th> Bill No Name</th>
                
                    <th> Contact Number</th>
                  
                    <th> Turn Around Time</th>                   
 <th> Appointment Date</th>
                    <th> Seriel No</th>
                    <th> Purchase Date</th>
                    <th> Item No</th>
                    <th> Description</th>
                    <th> Location</th>
                    <th> Quantity</th>
                    <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                    $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" id="getele"  onchange="onChangestatus(this)"  data-id="'.$quer->job_id.'">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$st->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" onchange="selectWarehouse(this)" data-id="'.$quer->job_id.'">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="assigntech" id="getid" onchange="assignTn(this)" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
               }
                
                 break;
  
  
  
                 case 'filter_tech_all':
  
  
                 
                 $query = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
              ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                 ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
           ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                 ->leftjoin('job_status','job_status.status_id','=','jobs.status')
				  ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
              ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
               //->where('jobs.status','=',41)
                ->where('jobs.technician','=',Request::input('technician'))
               ->get();
			   
       $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
               
               $count=$query->count();
             
               if($count===0){
                   $status=0;
               }
               else{
                $html = '
  
                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
                <th>Job date</th>
               
                    <th>Action</th>
                    <th>Status</th>
                    <th>Asp Name</th>
                    <th>Asp Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                   
                    <th> Bill No Name</th>
                
                    <th> Contact Number</th>
                  
                    <th> Turn Around Time</th>                   
 <th> Appointment Date</th>
                    <th> Seriel No</th>
                    <th> Purchase Date</th>
                    <th> Item No</th>
                    <th> Description</th>
                    <th> Location</th>
                    <th> Quantity</th>
                    <th> Delivery Date</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                   $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" id="getele"  onchange="onChangestatus(this)"  data-id="'.$quer->job_id.'">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$st->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" onchange="selectWarehouse(this)" data-id="'.$quer->job_id.'">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="assigntech" id="getid" onchange="assignTn(this)" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->turn_fround_time.'</td>
                        <td>'.$quer->appointment_time.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
               }
                 
                 break;

                 case 'filter_list_all':

				$date=explode("-" ,Request::input('dateRange'));
                 /**work around */
                 $datesrray =  explode("/",trim($date[0]));
               $datefromate = $datesrray[1].'/'.$datesrray[0].'/'.$datesrray[2];
               $date[0]   = $datefromate;
               $datesrray =  explode("/",trim($date[1]));
               $datefromate = $datesrray[1].'/'.$datesrray[0].'/'.$datesrray[2];
               $date[1]   = $datefromate;
               /*** end here */
                $d1= date('d-m-Y', strtotime($date[0]));
                $d2= date('d-m-Y', strtotime($date[1]));
            

               $startdate=  date('Y-m-d', strtotime($date[0]));
                
               $enddate=date('Y-m-d', strtotime($date[1]));
				
			
                 

                 $query = Job::leftjoin('users','users.id','=','jobs.technician')
               ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
              ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                 ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
           ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                 ->leftjoin('job_status','job_status.status_id','=','jobs.status')
				   ->leftjoin('asp_admin','asp_admin.warehouse_code','=','jobs.asp_location')
              ->leftjoin('asp_list','asp_list.code','=','jobs.asp_location')
                 
            ->whereBetween('job_date', [$startdate, $enddate])
                 
               ->get();
 $sts = DB::table('job_status')->where('complete_status','=',0)->get();
    $warehouses = DB::table('asp_list')->get();
	
	$techs = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',Request::input('asp'))
                ->where('users.user_role_id','=',3)
              
               ->get(); 
               $count=$query->count();
             
               if($count===0){
                   $status=0;
               }
               else{
                $html = '
 
                <tbody>
                <caption class="bottom">    
                </caption>
<thead>
                <tr>
               <th>Job date</th>
               
                    <th>Action</th>
                    <th>Status</th>
                    <th>Asp Name</th>
                    <th>Asp Technician</th>
                  
                    <th>Job Location</th>
                    <th>Repair Order No</th>
                               
                                <th> Bill To Name</th>
                               
                                <th> Contact Number</th>
                                <th> Complaints/Remarks</th>
                                <th> Symptom Code</th>
                                <th> Resolution Code</th>
                                <th>Change Code Proof</th>
                               
                                
                               
                                <th> Turn Around Time</th>
                                <th> Appointment Date</th>
                                <th> Order Date</th>
                               
                                <th> Item No(Model No)</th>
                                <th> Seriel No</th>
                                <th> Service Item Group</th>
                                <th> Purchase Date</th>
                                <th> Item No(Part No)</th>
                                <th> Description</th>
                                <th> Location</th>
                                <th> Quantity</th>
                </tr>
                </thead>
                ';
    foreach($query  as $quer){

                   $html .= '<tr>
                    <td>'.date('d-m-Y', strtotime($quer->job_date)) .'</td>
					<td><a class="btnsedit"  data-tooltip="View" href='.URL::route('ViewJob',$quer->job_id).' ><i class="fa fa-eye pad"></i></a>
					 <a class="btnsedit"  data-tooltip="Edit" href='.URL::route('EditJob',$quer->job_id).' ><i class=" edi pad fa fa-edit"></i></a>
					 <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id='.$quer->job_id .'  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
					</td>
                         <td>
						 <select class="changestatus" id="getele"  onchange="onChangestatus(this)"  data-id="'.$quer->job_id.'">
						   <option value="'.$quer->status_id.'">'.$quer->status_code.'-'.$quer->status_description.'</option>'
;
						 foreach($sts as $st){
						 $html.= '<option value="'.$st->status_id.'">'.$st->status_code.' - '.$st->status_description.'</option>';
						 }
						  $html.= '</select></td>
							
                      <td>
						 <select class="sel_ware" onchange="selectWarehouse(this)" data-id="'.$quer->job_id.'">
						   <option value="'.$quer->code.'">'.$quer->code.'-'.$quer->name.'</option>';
                        foreach($warehouses as $ware){
						 $html.= '<option value="'.$ware->code.'">'.$ware->code.' - '.$ware->name.'</option>';
						 }
						 $html.= '</select></td>
                       <td>
						 <select class="assigntech" id="getid" onchange="assignTn(this)" data-id="{{$job->job_id}}"">';
						   if($quer->id){
						   $html.=  '<option value="'.$quer->id.'">'.$quer->email.'</option>}';
	}
						   $html.= '<option value="">Select Technician</option>'
						   ;
						   foreach($techs as $te){
						 $html.= '<option value="'.$te->id.'">'.$te->email.' </option>';
						 }
						 $html.= '</select></td> 
                       
                        <td>'.$quer->job_location .'</td>
                        <td>'.$quer->repaire_order_no .'</td>
                        <td>'.$quer->cu_address .'</td>   
                        <td>'.$quer->phone_no .'</td>
                        <td>'.$quer->remark.'</td>
                        <td>'.$quer->symptom_description.'</td>
                        <td>'.$quer->resolution_description.'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$quer->description.'</td>
                        <td></td>
                        <td>'.$quer->warehouse_id.'</td>
                        <td></td>
                        
                    </tr>';
    }
    $html .='</tbody>
           ';

            $status=1;
               }
                
                 break;




                case 'export':
                $date=explode("-" ,Request::input('dateRange'));
               
                $startdate= date('Y-m-d', strtotime($date[0]));
                $enddate=date('Y-m-d', strtotime($date[1]));
                $query = Job::leftjoin('users','users.id','=','jobs.technician')
                ->leftjoin('customers','customers.cu_id','=','jobs.customer_id')
               ->leftjoin('faultylist','faultylist.faulty_id','=','jobs.faulty_code')
                  ->leftjoin('symptoms','symptoms.symptom_id','=','jobs.symptom')
            ->leftjoin('resolutions','resolutions.resolution_id','=','jobs.resolution')
                  ->leftjoin('job_status','job_status.status_id','=','jobs.status')
    
              
                  ->where('jobs.status','=',63)
            ->whereBetween('job_date', [$startdate, $enddate])
                  // $attendances = $query->get();
                ->get();
                $paymentsArray = []; 

                foreach ($query as $payment) {
                    $paymentsArray[] = $payment->toArray();
                }  

                Excel::create('jobs', function($excel) use ($invoicesArray) {

                    // Set the spreadsheet title, creator, and description
                    $excel->setTitle('Jobs');
                    $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
                    $excel->setDescription('payments file');
            
                    // Build the spreadsheet, passing in the payments array
                    $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                        $sheet->fromArray($paymentsArray, null, 'A1', false, false);
                    });
            
                })->download('csv');
                break;


                 case 'customer_not_in':
                 
         
                $update = Job::find(Request::input('jobidcus'));
                $update->status = 80;
                $update->save();

                $status=1;
                break;

                case 'wait_serv_mat':
                 
                $update = Job::find(Request::input('jobidser'));
                $update->status =79;
                $update->save();

                $status=1;
                break;

                case 'tech_suport':
              
                $update = Job::find(Request::input('jobsup'));
                $update->status =91;
                $update->save();

                $status=1;
                break;
                case 'asp_spoil':
            
                $update = Job::find(Request::input('jo_id_spoil'));
                $update->status =75;
                $update->save();

                $status=1;
                break;
                case 'estimate':
          
                $update = Job::find(Request::input('jo_id_est'));
                $update->status =50;
                $update->save();

                $status=1;
                break;
                case 'email_update':
          
                $update = Job::find(Request::input('jo_id_email'));
                $update->status =83;
                $update->save();

                $status=1;
                break;
                case 'request_cn':
          
                $update = Job::find(Request::input('jo_id_cn'));
                $update->status =87;
                $update->save();

                $status=1;
                break;
                case 'request_ex':
          
                $update = Job::find(Request::input('jo_id_ex'));
                $update->status =88;
                $update->save();

                $status=1;
                break;
                case 'hard_copy':
          
                $update = Job::find(Request::input('jo_id_cpy'));
                $update->status =92;
                $update->save();

                $status=1;
                break;
                case 'tech_support':
          
                $update = Job::find(Request::input('jo_id_suport'));
                $update->status =95;
                $update->save();

                $status=1;
                break;
                case 'exchange_comp':
          
                $update = Job::find(Request::input('jo_id_ex_com'));
                $update->status =96;
                $update->save();

                $status=1;
                break;
                case 'pend_part':
          
                $update = Job::find(Request::input('jo_id_part'));
                $update->status =101;
                $update->save();

                $status=1;
                break;
                case 'del_grn':
          
                $update = Job::find(Request::input('jo_id_grn'));
                $update->status =102;
                $update->save();

                $status=1;
                break;
                case 'del_rma':
          
                $update = Job::find(Request::input('jo_id_rma'));
                $update->status =103;
                $update->save();

                $status=1;
                break;
                case 'Changedelivery':
        
                $update = Job::find(Request::input('job_id'));
                $update->is_del_parts = 1;

                $update->status = 101;
                $update->save();

                $status=1;
                break;
                case 'Changedelivery_grn':
               
                $update = Job::find(Request::input('job_id'));
                $update->is_del_prod = 1;
                $update->status = 102;
                $update->save();

                $status=1;
                break;
                case 'Changedelivery_rma':
        
                $update = Job::find(Request::input('job_id'));
                $update->is_del_prod = 1;
                $update->status = 103;
                $update->save();

                $status=1;
                break;
                case 'newPartsWoJob':

                $parts = PartsOrder::create([
                    // 'parts_item' => Request::input('parts'),
                    // 'parts_qty' => Request::input('qnty'),
                    'creator' => Auth::user()->id,
                    'location' => Request::input('location'),
                    //'remark' => Request::input('remark'),
                    'order_date' =>Carbon::now(),
                    'type'=>'with_out_job',

                ]);
              
                $name = Request::input('parts');
                  
                $description =Request::input('qnty');
                
                if(count($name) >= count($description))
                    $count = count($description);
                    
                else $count = count($name);
           
                for($i = 0; $i < $count; $i++){
                    $objModel = new MultipleParts();
                    $objModel->order_id = $parts->part_order_id;
                    $objModel->parts = $name[$i];
                    $objModel->quantity = $description[$i];
                  
                    $objModel->save();
                }
               
                
                break;


             case 'downloadpdf':
           
             $pdf = PDF::loadView('pdf', compact('user'));
             return $pdf->download('invoice.pdf');
             break;


                case 'editrma':

                $startdate1=NULL;
                $startdate2=NULL;
                $startdate3=NULL;
                      $date=Request::input('purchase_date');
                 
                   if($date){
                      $startdate1 = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
  
                   }

                $update = RMA::find(Request::input('gma_id'));
                $update->amount = Request::input('amount') ;
                $update->ex_number = Request::input('ex_number') ;

                  $update->purchase_date = $startdate1;
                  $update->seriel_no = Request::input('seriel_no') ;
                  $update->warranty_card = Request::input('warranty_card') ;
                  $update->panel_serial_no = Request::input('panel_serial_no') ;
                  $update->panel_model = Request::input('panel_model') ;
                  $update->delear_Account_numner = Request::input('dealer_accnt_num') ;
                  $update->complaints = Request::input('complaint') ;
                  $update->reason_for_return = Request::input('reason') ;
                  $update->vertical_line = Request::input('vert_line') ;
                  $update->vertical_block	 = Request::input('vert_block') ;
                  $update->hori_line = Request::input('hori_line') ;
                  $update->horil_block = Request::input('hori_block') ;
                  $update->no_display = Request::input('no_disp') ;
                  $update->abnormal_color	 = Request::input('abnorm_colour') ;
                  $update->uniformity_defect = Request::input('unif_defect') ;
                  $update->dot_screen = Request::input('dot_screen') ;
                  $update->white_screen = Request::input('whit_screen') ;
                  $update->flicker = Request::input('flicker') ;
                  $update->back_light = Request::input('blck_defct') ;
                  $update->abnormal_pic = Request::input('abnorm_pic') ;
                  $update->other = Request::input('other') ;

                    $update->save();
                   
                      
                    $date3=Request::input('del_date');
               
                 if($date3){
                    $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();

                 }
                    
                   
                    $update = ProductReplacement::find(Request::input('prdct_repl_id'));
                    $update->delivery_date = $startdate3 ;
                    $update->is_approve = Request::input('approve');
                    $update->approver = Auth::user()->id; 
                    $update->rejected_remark = Request::input('note') ;

                    $update->save();
                       $status=1;
                    break;


                    case 'newPartsCreate':

                    $parts = Parts::create([
                      
                        'part_no' =>  Request::input('part_no'),
                        'parts_description' => Request::input('descr'),
                        'last_kit_bom_used' => Request::input('kit_bom'),
                        'dealer_price'=> Request::input('delaer_price'),
                        'customer_price' => Request::input('cus_price'),
                        'TASS_price' => Request::input('tass_price'),
                        'avl_qty' => Request::input('avl_qty'),
                    ]);
                    $status=1;
                    break;
            
                    case 'newProduct':

                    $parts = Product::create([
                      
                        'product_no' => Request::input('prod_no'),
                        'sub_code' => Request::input('sbu_code'),
                        'bu_code' => Request::input('bu_code'),
                        'product_description'=> Request::input('prod_descr'),
                        'service_item_group' => Request::input('prod_item'),
                        'product_type' => Request::input('prod_typ'),
                    ]);
                    $status=1;
                    break;

                  case 'newFilleShare':

                  break;

                    case 'editgrn':
                    $startdate1=NULL;
                    $startdate2=NULL;
                    $startdate22 =NULL;
                    $date=Request::input('purchase_date');
                 $date2=Request::input('goods_date');
                 if($date){
                    $startdate1 = Carbon::createFromFormat('d-m-Y', $date)->toDateString();

                 }
                 
              if($date2){
                $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();

              }

                    $update = GRN::find(Request::input('grn_id'));
                        $update->amount = Request::input('amount') ;
                        $update->ex_number = Request::input('ex_number') ;
                        $update->reason_for_retrun = Request::input('reason') ;
                        $update->seriel_no = Request::input('seriel_no') ;
                        $update->tech_prob = Request::input('tech_proof') ;
                        $update->dented = Request::input('dented') ;
                        $update->photogr = Request::input('photo') ;
                        $update->return_acc = Request::input('ret_acc') ;
                        $update->spare_part_no = Request::input('spare_part_no') ;
                        $update->purchase_date = $startdate1 ;
                        $update->goods_date = $startdate2 ;
                      
                        $update->save();

                        $date22=Request::input('del_date');
                        if($date22){
                            $startdate22 = Carbon::createFromFormat('d-m-Y', $date22)->toDateString();

                        }
                      
                        $update = ProductReplacement::find(Request::input('prdct_repl_id'));
                        $update->product_id = Request::input('product') ;

                        $update->delivery_date = $startdate22  ;
                        $update->is_approve = Request::input('approve') ;
                        $update->rejected_remark = Request::input('note') ;

                        $update->approver = Auth::user()->id; 
    
    
                        $update->save();
                           $status=1;
                        break;

                      case 'editgrnasp':
                      $startdate1=NULL;
                    $startdate2=NULL;
                    $date=Request::input('purchase_date');
                 $date2=Request::input('goods_date');
                 if($date){
                    $startdate1 = Carbon::createFromFormat('d-m-Y', $date)->toDateString();

                 }
                 
              if($date2){
                $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();

              }
                      $update = GRN::find(Request::input('grn_id'));
                      $update->amount = Request::input('amount') ;
                      $update->ex_number = Request::input('ex_number') ;
                      $update->reason_for_retrun = Request::input('reason') ;
                      $update->seriel_no = Request::input('seriel_no') ;
                      $update->tech_prob = Request::input('tech_proof') ;
                      $update->dented = Request::input('dented') ;
                      $update->photogr = Request::input('photo') ;
                      $update->return_acc = Request::input('ret_acc') ;
                      $update->spare_part_no = Request::input('spare_part_no') ;
                      $update->purchase_date = $startdate1 ;
                      $update->goods_date =  $startdate2 ;
                        $update->save();
                       
                        $update1 = ProductReplacement::find(Request::input('prdct_repl_id'));
                        $update1->product_id = Request::input('product') ;
                        $update1->qty = Request::input('qnty') ;
                        $update1->save();
                        $status=1;
                      break;
                      case 'editrmaasp':

                      $startdate1=NULL;
                      
                      $date=Request::input('purchase_date');
                 
                   if($date){
                      $startdate1 = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
  
                   }
                      $update = RMA::find(Request::input('gma_id'));
                      $update->amount = Request::input('amount') ;
                      $update->ex_number = Request::input('ex_number') ;

                        $update->purchase_date =$startdate1 ;
                        $update->seriel_no = Request::input('seriel_no') ;
                        $update->warranty_card = Request::input('warranty_card') ;
                        $update->panel_serial_no = Request::input('panel_serial_no') ;
                        $update->panel_model = Request::input('panel_model') ;
                        $update->delear_Account_numner = Request::input('dealer_accnt_num') ;
                        $update->complaints = Request::input('complaint') ;
                        $update->reason_for_return = Request::input('reason') ;
                        $update->vertical_line = Request::input('vert_line') ;
                        $update->vertical_block	 = Request::input('vert_block') ;
                        $update->hori_line = Request::input('hori_line') ;
                        $update->horil_block = Request::input('hori_block') ;
                        $update->no_display = Request::input('no_disp') ;
                        $update->abnormal_color	 = Request::input('abnorm_colour') ;
                        $update->uniformity_defect = Request::input('unif_defect') ;
                        $update->dot_screen = Request::input('dot_screen') ;
                        $update->white_screen = Request::input('whit_screen') ;
                        $update->flicker = Request::input('flicker') ;
                        $update->back_light = Request::input('blck_defct') ;
                        $update->abnormal_pic = Request::input('abnorm_pic') ;
                        $update->other = Request::input('other') ;
                        $update->save();
                       
                        $update1 = ProductReplacement::find(Request::input('prdct_repl_id'));
                        $update1->product_id = Request::input('product') ;
                        $update1->qty = Request::input('qnty') ;
                        $update1->save();
                        $status=1;
                        
                      break;


                case 'newrma':
                  
               $prdct = ProductReplacement::create([
                'product_id' => Request::input('product'),
                'qty' =>  Request::input('qnty'),
                'product_replacement_type' => 'rma',
                'order_date' => Carbon::now(),
                'location' => Request::input('location'),
                'creator' => Auth::user()->id,

            ]);
           $product=Request::input('product');
            if(isset( $_POST['submit'] )){
                
                $panel_serial_no=$_POST['panel_serial_no'];
                $product=$_POST['product'];
                $qnty=$_POST['qnty'];
                $symptom=$_POST['symptom']; 
                $reason=$_POST['reason'];   
                $location=$_POST['location'];
                     $flag=0;
               $file=$_FILES['files'];
               $file_name = $file['name'];
               $file_tmp = $file['tmp_name'];	
               $file_ext = explode('.',$file_name); 
               $file_ext = strtolower(end($file_ext));
               $allowed = array("gif","png","jpg","jpeg");
           if(in_array($file_ext,$allowed)){
               $file_name_new = uniqid('',true).'.'.$file_ext;

               $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                if(move_uploaded_file($file_tmp,$file_destination)){

               $flag= 1 ;
                        }                  }     
          if($flag==1){  

           
            $rma = RMA::create([
                'panel_serial_no' => $panel_serial_no,
                'model' => Request::input('product'),
                'symptom' =>$symptom,
                'reason_for_return' => $reason,
                'issue_image' => time() . '-' .$file_name_new,
                'order_id' => $prdct->product_replacement_id,

            ]);
            
               }
                         }
                
                break;
           



                case 'emailexists':
              
                if(Request::input('id')!=''){
                  
                    $user = DB::table('users')->find(Request::input('id'));
                    if($user->email == Request::input('email')){
                        return response()->json('true');
                    }else{
                        return response()->json('Email already exist!');
                    }
                }else{
                   
                    $user = DB::table('users')->where('email', Request::input('email'))->count();
                    if($user != 0){
                        
                        return response()->json('Email already exist!');
                    }else{
                       
                        return response()->json('true');
                    }

                }
                
                break;
                
                case 'product_excists':
              
                if(Request::input('id')!=''){
                  
                    $user = DB::table('products')->find(Request::input('id'));
                    if($user->product_no == Request::input('prod_no')){
                        return response()->json('true');
                    }else{
                        return response()->json('Product already exist!');
                    }
                }else{
                   
                    $user = DB::table('products')->where('product_no', Request::input('prod_no'))->count();
                    if($user != 0){
                        
                        return response()->json('Product already exist!');
                    }else{
                       
                        return response()->json('true');
                    }

                }
                
                break;


                case 'email11exists':
               
                if(Request::input('id')!=''){
                  
                    $user = DB::table('users')->find(Request::input('id'));
                    if($user->email == Request::input('email')){
                        return response()->json('true');
                    }else{
                        return response()->json('Email already exist!');
                    }
                }else{
                   
                    $user = DB::table('users')->where('email', Request::input('email'))->count();
                    if($user != 0){
                        $status=1;
                        return response()->json('Email already exist!');
                    }else{
                        $status=0;
                        return response()->json('true');
                    }

                }
                
                break;

                case 'warehouseexists':
           
                if(Request::input('warehouse_id')!=''){
                  
                    $user = DB::table('asp_list')->find(Request::input('id'));
                    if($user->warehouse_id == Request::input('warehouse')){
                        return response()->json('true');
                    }else{
                        return response()->json('WareHouse already exist!');
                    }
                }else{
                    
                    $user = DB::table('asp_list')->where('warehouse_id', Request::input('warehouse'))->count();
                    if($user != 0){
                        $status=1;
                        return response()->json('WareHouse already exist!');
                    }else{
                        $status=0;
                        return response()->json('true');
                    }

                }
                
                break;

                case 'codeexists':
              
                if(Request::input('code')!=''){
                  
                    $user = DB::table('asp_list')->find(Request::input('code'));
                    if($user->email == Request::input('code')){
                        return response()->json('true');
                    }else{
                        return response()->json('Code already exist!');
                    }
                }else{
                   
                    $user = DB::table('users')->where('code', Request::input('email'))->count();
                    if($user != 0){
                        
                        return response()->json('Code already exist!');
                    }else{
                       
                        return response()->json('true');
                    }

                }
                
                break;
        }
        return response()->json(['status' => $status,'jobid' => $ass_tech_id, 'message' => $message, 'html' => $html, 'data' => $data, 'url' => $url , 'amount'=>$amount,'aval_qty'=>$part_qty,'service_item_group'=>$service_item_group]);

    }

public  function postCsv(\Illuminate\Http\Request $request){
        $message = "";
        $status = 0;
        $html = "";
        $data = "";
        $d = "";
        $appt_date=NULL;
        if($request->hasFile('upload-file')){
            $path = $request->file('upload-file')->getRealPath();
            $data['datas'] = Excel::load($path, function($reader) {})->get();	
            foreach ($data['datas'] as $dat) {
                $id = DB::table('customers')->insertGetId(
                ['cu_address' => $dat->bill_to_name, 
                'phone_no'=>$dat->phone_no_business_no]);

                $user = DB::table('jobs')->where('repaire_order_no', $dat->repair_order_no)->count();
                $sym = DB::table('symptoms')->where('symptom_code', $dat->symptom_code)->first();
                $res = DB::table('resolutions')->where('resolution_code', $dat->resolution_code)->first();
                $serv_item = DB::table('products')->where('product_no', $dat->item_no)->first();
		        $date=$dat->appointment_date_time;	   
                if($user == 0){
                    $id1 = DB::table('jobs')->insertGetId(
                        ['job_location' => $dat->job_location, 
                        'repaire_order_no'=>$dat->repair_order_no,
                        'change_code'=>$dat->change_code_proof,
                        'seriel_number'=>$dat->serial_no,
                        'product'=>$dat->model_no,
                        'remark'=>$dat->complaints_remark,
                        'asp_location'=>$dat->technician_code,
                        'description'=>$dat->description,
                        //'turn_fround_time'=>$dat->turn_fround_time,
                        'servicetype'=> $dat->serv_item_group,
                        'status' =>68,
                        'job_date' => Carbon::now(),
                        'created_at' =>Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'customer_id' =>$id,
                        'job_type' =>'csero']);
                    if($sym){
                        $updjob1 = Job::find($id1 );
                        $updjob1->symptom =$sym->symptom_id ;
                        $updjob1->save();
                    }
                    if($res){
                        $updjob1 = Job::find($id1 );
                        $updjob1->resolution =$res->resolution_id ;
                        $updjob1->save();
                    }
                    if($serv_item){
                        $updjob1 = Job::find($id1 );
                        $updjob1->servicetype =$serv_item->service_item_group ;
                        $updjob1->save();
                    }
                    if($date!= null){
                        $dateForamte =explode("/" ,trim($date));
                        $strdatefromate = $dateForamte[1].'/'.$dateForamte[0].'/'.$dateForamte[2];
                        $appt_date = date("Y-m-d", strtotime($strdatefromate));
                        $app = Appointment::create([
                            'appointment_time' => $appt_date,
                            //'time' => $date,
                            'job_id' => $id1,
                            'appoinment_status' => 'created',
                        ]);	
                    }
                }else{
                    return redirect()->back()->with('alert', 'Data Duplication Found Please Try again!');
                }
            }
            return back()->with('success','Insert Record successfully.');
        }
    }

    function postRmaasp(){
            $message = "";
            $status = 0;
            $html = "";
            $data = "";
            $view = '';
            $startdate1 = NULL;
            $startdate3 = NULL;
            $startdate4 = NULL;
            if (Request::input('rmaid') != ''){
                $date1 = Request::input('purchase_date');
                if ($date1){
                    $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                }
                $flag = 0;
                $file = $_FILES['files'];
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                $file_ext = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext));
                $allowed = array(
                    "gif",
                    "png",
                    "jpg",
                    "jpeg",
                    "pdf",
                    "xls",
                    "xlsx"
                );
                if (in_array($file_ext, $allowed)){
                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'data/products/' . time() . '-' . $file_name_new;
                    if (move_uploaded_file($file_tmp, $file_destination)){
                        $flag = 1;
                    }
                }
                if ($flag == 1){
                    $update2 = RMA::find(Request::input('rmaid'));
                    $update2->panel_serial_no = Request::input('panel_serial_no');
                    $update2->model = Request::input('model');
                    // $update2->other_symptom =Request::input('other_sym') ;
                    $update2->reason_for_return = Request::input('reason');
                    // $update2->product_id =Request::input('product') ;
                    $update2->panel_model = Request::input('panel_model');
                    $update2->seriel_no = Request::input('ser_num');
                    $update2->warranty_card = Request::input('warr_num');
                    $update2->vertical_line = Request::input('vert_line');
                    $update2->vertical_block = Request::input('vert_block');
                    $update2->hori_line = Request::input('hori_line');
                    $update2->horil_block = Request::input('hori_block');
                    $update2->no_display = Request::input('no_disp');
                    $update2->issue_image = time() . '-' . $file_name_new;
                    $update2->abnormal_color = Request::input('abnorm_colour');
                    $update2->uniformity_defect = Request::input('unif_defect');
                    $update2->dot_screen = Request::input('dot_screen');
                    $update2->white_screen = Request::input('whit_screen');
                    $update2->flicker = Request::input('flicker');
                    $update2->back_light = Request::input('blck_defct');
                    $update2->abnormal_pic = Request::input('abnorm_pic');
                    $update2->back_light = Request::input('panel_model');
                    $update2->other = Request::input('other');
                    $update2->delear_Account_numner = Request::input('dealer_accnt_no');
                    $update2->delear_nam = Request::input('dealer_name');
                    $update2->delear_addr = Request::input('dealer_address');
                    $update2->complaints = Request::input('complaints');
                    $update2->purchase_date = $startdate1;
                    //$update2->credit_note = Request::input('credit_not');
                    //$update2->is_cn_ex = Request::input('approve11');
                    $update2->save();
                }else{
                    $update2 = RMA::find(Request::input('rmaid'));
                    $update2->panel_serial_no = Request::input('panel_serial_no');
                    $update2->model = Request::input('model');
                    // $update2->other_symptom =Request::input('other_sym') ;
                    $update2->reason_for_return = Request::input('reason');
                    // $update2->product_id =Request::input('product') ;
                    $update2->panel_model = Request::input('panel_model');
                    $update2->seriel_no = Request::input('ser_num');
                    $update2->warranty_card = Request::input('warr_num');
                    $update2->vertical_line = Request::input('vert_line');
                    $update2->vertical_block = Request::input('vert_block');
                    $update2->hori_line = Request::input('hori_line');
                    $update2->horil_block = Request::input('hori_block');
                    $update2->no_display = Request::input('no_disp');
                    $update2->abnormal_color = Request::input('abnorm_colour');
                    $update2->uniformity_defect = Request::input('unif_defect');
                    $update2->dot_screen = Request::input('dot_screen');
                    $update2->white_screen = Request::input('whit_screen');
                    $update2->flicker = Request::input('flicker');
                    $update2->back_light = Request::input('blck_defct');
                    $update2->abnormal_pic = Request::input('abnorm_pic');
                    $update2->back_light = Request::input('panel_model');
                    $update2->other = Request::input('other');
                    $update2->delear_Account_numner = Request::input('dealer_accnt_no');
                    $update2->delear_nam = Request::input('dealer_name');
                    $update2->delear_addr = Request::input('dealer_address');
                    $update2->complaints = Request::input('complaints');
                    $update2->purchase_date = $startdate1;
                    //$update2->credit_note = Request::input('credit_not');
                    //$update2->is_cn_ex = Request::input('approve11');
                    $update2->save();
                }
            }else{
                $prdct = ProductReplacement::create([
                    // 'product_id' => Request::input('product'),
                    'qty' => Request::input('qnty') , 
                    'product_replacement_type' => 'rma', 
                    'order_date' => Carbon::now() , 
                    'location' => Request::input('location') , 
                    'creator' => Auth::user()->id, ]);
            // $product=Request::input('product');
                if (isset($_POST['submit'])){
                    $panel_serial_no = $_POST['panel_serial_no'];
                    // $product=$_POST['product'];
                    // $symptom=$_POST['symptom'];
                    $reason = $_POST['reason'];
                    $location = $_POST['location'];
                    $flag = 0;
                    $file = $_FILES['files'];
                    $file_name = $file['name'];
                    $file_tmp = $file['tmp_name'];
                    $file_ext = explode('.', $file_name);
                    $file_ext = strtolower(end($file_ext));
                    $allowed = array(
                        "gif",
                        "png",
                        "jpg",
                        "jpeg",
                        "pdf",
                        "xls",
                        "xlsx"
                    );
                    if (in_array($file_ext, $allowed)){
                        $file_name_new = uniqid('', true) . '.' . $file_ext;
                        $file_destination = 'data/products/' . time() . '-' . $file_name_new;
                        if (move_uploaded_file($file_tmp, $file_destination)){
                            $flag = 1;
                        }
                    }
    
                    if ($flag == 1){
                        $date1 = Request::input('purchase_date');
                        if ($date1){
                            $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                        }
                        $date3 = Request::input('appl_date');
                        if ($date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
                        }
                        $date4 = Request::input('date_rece');
                        if ($date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
                        }
                        $rma = RMA::create(['panel_serial_no' => $panel_serial_no, 
                            'model' => Request::input('product') , 
                            'other_symptom' => Request::input('other_sym') ,
                            // 'symptom' =>$symptom,
                            'reason_for_return' => $reason, 
                            'issue_image' => time() . '-' . $file_name_new, 
                            'order_id' => $prdct->product_replacement_id, 
                            'amount' => Request::input('amount') , 
                            //'ex_number' => Request::input('ex_number') , 
                            //'credit_note' => Request::input('credit_not') , 
                            'panel_model' => Request::input('panel_model') , 
                            'seriel_no' => Request::input('ser_num') , 
                            'warranty_card' => Request::input('warr_num') , 
                            'vertical_line' => Request::input('vert_line') , 
                            'vertical_block' => Request::input('vert_block') , 
                            'hori_line' => Request::input('hori_line') , 
                            'horil_block' => Request::input('hori_block') , 
                            'no_display' => Request::input('no_disp') , 
                            'abnormal_color' => Request::input('abnorm_colour') , 
                            'uniformity_defect' => Request::input('unif_defect') , 
                            'dot_screen' => Request::input('dot_screen') , 
                            'white_screen' => Request::input('whit_screen') , 
                            'flicker' => Request::input('flicker') , 
                            'back_light' => Request::input('blck_defct') , 
                            'abnormal_pic' => Request::input('abnorm_pic') , 
                            'other' => Request::input('other') , 
                            'delear_Account_numner' => Request::input('dealer_accnt_no') , 
                            'dealer_nam' => Request::input('dealer_name') , 
                            'dealer_addr' => Request::input('dealer_addr') , 
                            'complaints' => Request::input('complaints') , 
                            'purchase_date' => $startdate1, 
                            'application_date' => $startdate3, 
                            'date_received' => $startdate4, ]);
                        $updatejob = Job::find(Request::input('jobid'));
                        $updatejob->product_replacement = $prdct->product_replacement_id;
                        //$updatejob->symptom = Request::input('symptom');
                        //$updatejob->resolution = Request::input('resolution');
                        //$updatejob->faulty_code = Request::input('faulty');
                        $updatejob->status = 67;
                        $updatejob->save();
                        $status = 1;
                    }
                  else
                    {
                    $date1 = Request::input('purchase_date');
                    if ($date1)
                        {
                        $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                        }
    
                    $date3 = Request::input('appl_date');
                    if ($date3)
                        {
                        $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
                        }
    
                    $date4 = Request::input('date_rece');
                    if ($date4)
                        {
                        $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
                        }
    
                    $rma = RMA::create(['panel_serial_no' => $panel_serial_no, 
                    'model' => Request::input('product') , 
                    'other_symptom' => Request::input('other_sym') ,
                    // 'symptom' =>$symptom,
                    'reason_for_return' => $reason, 
                    'order_id' => $prdct->product_replacement_id, 
                    'amount' => Request::input('amount') , 
                    //'ex_number' => Request::input('ex_number') ,
                    //'credit_note' => Request::input('credit_not') , 
                    'panel_model' => Request::input('panel_model') , 
                    'seriel_no' => Request::input('ser_num') , 
                    'warranty_card' => Request::input('warr_num') , 
                    'vertical_line' => Request::input('vert_line') , 
                    'vertical_block' => Request::input('vert_block') , 
                    'hori_line' => Request::input('hori_line') , 
                    'horil_block' => Request::input('hori_block') , 
                    'no_display' => Request::input('no_disp') , 
                    'abnormal_color' => Request::input('abnorm_colour') , 
                    'uniformity_defect' => Request::input('unif_defect') , 
                    'dot_screen' => Request::input('dot_screen') , 
                    'white_screen' => Request::input('whit_screen') , 
                    'flicker' => Request::input('flicker') , 
                    'back_light' => Request::input('blck_defct') , 
                    'abnormal_pic' => Request::input('abnorm_pic') , 
                    'other' => Request::input('other') , 
                    'delear_Account_numner' => Request::input('dealer_accnt_no') , 
                    'dealer_nam' => Request::input('dealer_name') , 
                    'dealer_addr' => Request::input('dealer_addr') , 
                    'complaints' => Request::input('complaints') , 
                    'purchase_date' => $startdate1, 
                    'application_date' => $startdate3, 
                    'date_received' => $startdate4, 
                    //'is_cn_ex' => Request::input('approve11') , 
                     ]);
                    $updatejob = Job::find(Request::input('jobid'));
                    $updatejob->product_replacement = $prdct->product_replacement_id;
                    //$updatejob->symptom = Request::input('symptom');
                    //$updatejob->resolution = Request::input('resolution');
                    //$updatejob->faulty_code = Request::input('faulty');
                    $updatejob->status = 67;
                    $updatejob->save();
                    $status = 1;
                    }
                }
            }
    
            return (Auth::user()->user_role_id == 2) ? Redirect::route('AspJobs') : Redirect::route('TechJobs') ;
        }
    




function postGrnasp(){
	$message = "";
	$status = 0;
	$html = "";
	$data = "";
	$view = '';
	$startdate1 = NULL;
	$startdate2 = NULL;
	$startdate3 = NULL;
	$startdate4 = NULL;
	if (Request::input('grnid') != ''){
		$date1 = Request::input('purchase_date');
		if ($date1){
			$startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
		}
		$date2 = Request::input('goods_date');
		if ($date2){
			$startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
		}
		$date3 = Request::input('place_order');
		if ($date3){
			$startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
		}
		$date4 = Request::input('comp_date');
		if ($date4){
			$startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
		}
        $flag1 = false;
        $flag2 = false;
		$file_name_new1 = NULL;
		$file_name_new = NULL;
		$img1 = NULL;
		$img2 = NULL;
		$file = $_FILES['files'];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));
		$allowed = array(
			"gif",
			"png",
			"jpg",
			"jpeg",
			"pdf",
			"xls",
			"xlsx"
		);
		if (in_array($file_ext, $allowed)){
			$file_name_new = uniqid('', true) . '.' . $file_ext;
			$file_destination = 'data/products/' . time() . '-' . $file_name_new;
			if (move_uploaded_file($file_tmp, $file_destination)){
				$img1 = time() . '-' . $file_name_new;
				$flag1 = true;
			}
		}
		$file1 = $_FILES['proof'];
		$file_name1 = $file1['name'];
		$file_tmp1 = $file1['tmp_name'];
		$file_ext1 = explode('.', $file_name1);
		$file_ext1 = strtolower(end($file_ext1));
		$allowed = array(
			"gif",
			"png",
			"jpg",
			"jpeg",
			"pdf",
			"xls",
			"xlsx"
		);
		if (in_array($file_ext1, $allowed)){
			$file_name_new1 = uniqid('', true) . '.' . $file_ext1;
			$file_destination1 = 'data/products/' . time() . '-' . $file_name_new1;
			if (move_uploaded_file($file_tmp1, $file_destination1)){
				$img2 = time() . '-' . $file_name_new1;
				$flag2 = true;
			}
		}
        $update2 = GRN::find(Request::input('grnid'));
        // $update2->product_id =Request::input('product') ;
        $update2->reason_for_retrun = Request::input('reason');
        $update2->tech_prob = Request::input('tech_proof');
        $update2->dented = Request::input('dented');
        $update2->photogr = Request::input('photo');
        $update2->purchase_date = $startdate1;
        $update2->goods_date = $startdate2;
        if($flag1)
            $update2->issue_image = $img1;
        if($flag2)
            $update2->attach_proof = $img2;
        $update2->return_acc = Request::input('ret_acc');
        $update2->pending_part = Request::input('pending_part');
        //$update2->amount = Request::input('amount');
        //$update2->ex_number = Request::input('ex_number');
        $update2->spare_part_no = Request::input('part_no');
        $update2->seriel_no = Request::input('seriel_no');
        //$update2->is_ex_cn = Request::input('approve');
        $update2->dealer_address = Request::input('dealer_address');
        $update2->dealer_name = Request::input('dealer_name');
        $update2->dealer_acc = Request::input('delaer_acc');
        // $update2->complaints =Request::input('complaints') ;
        // $update2->other =Request::input('other') ;
        //$update2->credit_note = Request::input('credit_not');
        $update2->place_order = $startdate3;
        $update2->save();	
	}else{
		$prdct = ProductReplacement::create(['product_id' => Request::input('product') , 'qty' => Request::input('qnty') , 'product_replacement_type' => 'grn', 'order_date' => Carbon::now() , 'location' => Request::input('location') , 'creator' => Auth::user()->id, ]);
		$product = Request::input('product');
		if (isset($_POST['submit']))
			{
			$product = $_POST['product'];
			$reason = $_POST['reason'];
			$flag = 0;
			$file_name_new1 = NULL;
			$file_name_new = NULL;
			$img1 = NULL;
			$img2 = NULL;
			$file = $_FILES['files'];
			$file_name = $file['name'];
			$file_tmp = $file['tmp_name'];
			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));
			$allowed = array(
				"gif",
				"png",
				"jpg",
				"jpeg",
				"pdf",
				"xls",
				"xlsx"
			);
			if (in_array($file_ext, $allowed))
				{
				$file_name_new = uniqid('', true) . '.' . $file_ext;
				$file_destination = 'data/products/' . time() . '-' . $file_name_new;
				if (move_uploaded_file($file_tmp, $file_destination))
					{
					$img1 = time() . '-' . $file_name_new;
					$flag = 1;
					}
				}

			$file1 = $_FILES['proof'];
			$file_name1 = $file1['name'];
			$file_tmp1 = $file1['tmp_name'];
			$file_ext1 = explode('.', $file_name1);
			$file_ext1 = strtolower(end($file_ext1));
			$allowed = array(
				"gif",
				"png",
				"jpg",
				"jpeg",
				"pdf",
				"xls",
				"xlsx"
			);
			if (in_array($file_ext1, $allowed))
				{
				$file_name_new1 = uniqid('', true) . '.' . $file_ext1;
				$file_destination1 = 'data/products/' . time() . '-' . $file_name_new1;
				if (move_uploaded_file($file_tmp1, $file_destination1))
					{
					$img2 = time() . '-' . $file_name_new1;
					$flag = 2;
					}
				}

			if ($flag == 1 || $flag == 2)
				{
				$date1 = Request::input('purchase_date');
				if ($date1)
					{
					$startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
					}

				$date2 = Request::input('goods_date');
				if ($date2)
					{
					$startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
					}

				$date3 = Request::input('place_order');
				if ($date3)
					{
					$startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
					}

				$date4 = Request::input('comp_date');
				if ($date4)
					{
					$startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
					}

				$rma = GRN::create(['reason_for_retrun' => Request::input('reason') , 'tech_prob' => Request::input('tech_proof') , 'dented' => Request::input('dented') , 'photogr' => Request::input('photo') , 'purchase_date' => $startdate1, 'goods_date' => $startdate2, 'application_date' => $startdate3, 'complaint_date' => $startdate4, 'return_acc' => Request::input('ret_acc') , 'pending_part' => Request::input('pending_part') , 'dealer_address' => Request::input('dealer_address') , 'dealer_name' => Request::input('dealer_name') , 'dealer_acc' => Request::input('delaer_acc') , 'issue_image' => $img1, 'attach_proof' => $img2, 'order_id' => $prdct->product_replacement_id, 'amount' => Request::input('amount') , 'ex_number' => Request::input('ex_number') , 'spare_part_no' => Request::input('part_no') , 'seriel_no' => Request::input('seriel_no') , 'complaints' => Request::input('complaints') , 'credit_note' => Request::input('credit_not') , 'other' => Request::input('other') , 'is_ex_cn' => Request::input('approve') , 'place_order' => $startdate3, ]);
				$updatejob = Job::find(Request::input('jobid'));
				$updatejob->product_replacement = $prdct->product_replacement_id;
				$updatejob->symptom = Request::input('symptom');
				$updatejob->resolution = Request::input('resolution');
				$updatejob->faulty_code = Request::input('faulty');
				$updatejob->status = 64;
				$updatejob->save();
				$status = 1;
				}
			  else
				{
				$date1 = Request::input('purchase_date');
				if ($date1)
					{
					$startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
					}

				$date2 = Request::input('goods_date');
				if ($date2)
					{
					$startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
					}

				$date3 = Request::input('place_order');
				if ($date3)
					{
					$startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
					}

				$date4 = Request::input('comp_date');
				if ($date4)
					{
					$startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
					}

				$rma = GRN::create(['reason_for_retrun' => Request::input('reason') , 'tech_prob' => Request::input('tech_proof') , 'dented' => Request::input('dented') , 'photogr' => Request::input('photo') , 'purchase_date' => $startdate1, 'goods_date' => $startdate2, 'application_date' => $startdate3, 'complaint_date' => $startdate4, 'return_acc' => Request::input('ret_acc') , 'credit_note' => Request::input('credit_not') , 'order_id' => $prdct->product_replacement_id, 'amount' => Request::input('amount') , 'ex_number' => Request::input('ex_number') , 'spare_part_no' => Request::input('part_no') , 'seriel_no' => Request::input('seriel_no') , 'place_order' => $startdate3, 'dealer_address' => Request::input('dealer_address') , 'dealer_name' => Request::input('dealer_name') , 'dealer_acc' => Request::input('delaer_acc') , ]);
				$updatejob = Job::find(Request::input('jobid'));
				$updatejob->product_replacement = $prdct->product_replacement_id;
				$updatejob->symptom = Request::input('symptom');
				$updatejob->resolution = Request::input('resolution');
				$updatejob->faulty_code = Request::input('faulty');
				$updatejob->status = 64;
				$updatejob->save();
				$status = 1;
				}
			}
		}

	return (Auth::user()->user_role_id == 2) ? Redirect::route('AspJobs') : Redirect::route('TechJobs') ;
	}




                public  function postRma(){
                    $message = "";
                    $status = 0;
                    $html = "";
                    $data = "";
                    $view = '';
                    $startdate1=NULL;
                    $startdate3=NULL;
                    $startdate4=NULL;
               if(Request::input('rmaid')!=''){
				
				$date1=Request::input('purchase_date');
				if($date1){
                                $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                            }
							
							$flag= 0 ;
					$file=$_FILES['files'];
					   $file_name = $file['name'];
                                   $file_tmp = $file['tmp_name'];	
                                   $file_ext = explode('.',$file_name); 
                                   $file_ext = strtolower(end($file_ext));
                                   $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                                 if(in_array($file_ext,$allowed)){
                                   $file_name_new = uniqid('',true).'.'.$file_ext;
                    
                                   $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                                    if(move_uploaded_file($file_tmp,$file_destination)){
                    
                                   $flag= 1 ;
                                            }
								 }
								 if($flag== 1){
									 $update2 = RMA::find(Request::input('rmaid'));
                $update2->panel_serial_no =Request::input('panel_serial_no') ;
                $update2->model =Request::input('model') ;
                //$update2->other_symptom =Request::input('other_sym') ;
                $update2->reason_for_return =Request::input('reason') ;
                //$update2->product_id =Request::input('product') ;
                $update2->panel_model =Request::input('panel_model') ;
                $update2->seriel_no =Request::input('ser_num') ;
                $update2->warranty_card =Request::input('warr_num') ;
                $update2->vertical_line =Request::input('vert_line') ;
                $update2->issue_image =time() . '-' .$file_name_new ;
                $update2->hori_line =Request::input('hori_line') ;
                $update2->horil_block =Request::input('hori_block') ;
                $update2->no_display =Request::input('no_disp') ;
                $update2->abnormal_color =Request::input('abnorm_colour') ;
                $update2->uniformity_defect =Request::input('unif_defect') ;
                $update2->dot_screen =Request::input('dot_screen') ;
                $update2->white_screen =Request::input('whit_screen') ;
                $update2->flicker =Request::input('flicker') ;
                $update2->back_light =Request::input('blck_defct') ;
                $update2->abnormal_pic =Request::input('abnorm_pic') ;
                $update2->back_light =Request::input('panel_model') ;
                $update2->other =Request::input('other') ;
                 $update2->delear_Account_numner =Request::input('dealer_accnt_no') ;
                $update2->delear_nam =Request::input('dealer_name') ;
                $update2->delear_addr =Request::input('dealer_address') ;
                $update2->complaints =Request::input('complaints') ;
                $update2->purchase_date =$startdate1 ;
                $update2->credit_note =Request::input('credit_not') ;
				$update2->save();
								 }
								 else{
									 $update2 = RMA::find(Request::input('rmaid'));
                $update2->panel_serial_no =Request::input('panel_serial_no') ;
                $update2->model =Request::input('model') ;
                //$update2->other_symptom =Request::input('other_sym') ;
                $update2->reason_for_return =Request::input('reason') ;
                //$update2->product_id =Request::input('product') ;
                $update2->panel_model =Request::input('panel_model') ;
                $update2->seriel_no =Request::input('ser_num') ;
                $update2->warranty_card =Request::input('warr_num') ;
                $update2->vertical_line =Request::input('vert_line') ;
                $update2->vertical_block =Request::input('vert_block') ;
                $update2->hori_line =Request::input('hori_line') ;
                $update2->horil_block =Request::input('hori_block') ;
                $update2->no_display =Request::input('no_disp') ;
                $update2->abnormal_color =Request::input('abnorm_colour') ;
                $update2->uniformity_defect =Request::input('unif_defect') ;
                $update2->dot_screen =Request::input('dot_screen') ;
                $update2->white_screen =Request::input('whit_screen') ;
                $update2->flicker =Request::input('flicker') ;
                $update2->back_light =Request::input('blck_defct') ;
                $update2->abnormal_pic =Request::input('abnorm_pic') ;
                $update2->back_light =Request::input('panel_model') ;
                $update2->other =Request::input('other') ;
                 $update2->delear_Account_numner =Request::input('dealer_accnt_no') ;
                $update2->delear_nam =Request::input('dealer_name') ;
                $update2->delear_addr =Request::input('dealer_address') ;
                $update2->complaints =Request::input('complaints') ;
                $update2->purchase_date =$startdate1 ;
                $update2->credit_note =Request::input('credit_not') ;
				$update2->save();
								 }
				
				
				
				
							}
							else{
								 $prdct = ProductReplacement::create([
                        //'product_id' => Request::input('product'),
                        'qty' =>  Request::input('qnty'),
                        'product_replacement_type' => 'rma',
                        'order_date' => Carbon::now(),
                        'location' => Request::input('location'),
                        'creator' => Auth::user()->id,
        
                    ]);
                   $product=Request::input('product');
                    if(isset( $_POST['submit'] )){
                        
                        $panel_serial_no=$_POST['panel_serial_no'];
                        //$product=$_POST['product'];
                     
                        //$symptom=$_POST['symptom']; 
                        $reason=$_POST['reason'];   
                        $location=$_POST['location'];
                             $flag=0;
                       $file=$_FILES['files'];
                       $file_name = $file['name'];
                       $file_tmp = $file['tmp_name'];	
                       $file_ext = explode('.',$file_name); 
                       $file_ext = strtolower(end($file_ext));
                       $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                   if(in_array($file_ext,$allowed)){
                       $file_name_new = uniqid('',true).'.'.$file_ext;
        
                       $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                        if(move_uploaded_file($file_tmp,$file_destination)){
        
                       $flag= 1 ;
                                }                  }     
                  if($flag==1){  
        
                   
                    
           
                    $date1=Request::input('purchase_date');
                    if($date1){
                        $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                    }
                    $date3=Request::input('appl_date');
                if( $date3){
                    $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();

                }
                $date4=Request::input('date_rece');
                if( $date4){
                    $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();

                }
                    $rma = RMA::create([
                        'panel_serial_no' => $panel_serial_no,
                        'model' => Request::input('product'),
                        'other_symptom' => Request::input('other_sym'),
                        //'symptom' =>$symptom,
                        'reason_for_return' => $reason,
                        'issue_image' => time() . '-' .$file_name_new,
                        'order_id' => $prdct->product_replacement_id,
                        'amount' => Request::input('amount'),
                        'ex_number' => Request::input('ex_number'),
                        'panel_model' => Request::input('panel_model'),
                        'seriel_no' => Request::input('ser_num'),
                        'warranty_card' => Request::input('warr_num'),
                        'vertical_line' => Request::input('vert_line'),
                        'vertical_block' => Request::input('vert_block'),
                        'hori_line' => Request::input('hori_line'),
                        'horil_block' => Request::input('hori_block'),
                        'no_display' => Request::input('no_disp'),
                        'abnormal_color' => Request::input('abnorm_colour'),
                        'uniformity_defect' => Request::input('unif_defect'),
                        'dot_screen' => Request::input('dot_screen'),
                        'white_screen' => Request::input('whit_screen'),
                        'flicker' => Request::input('flicker'),
                        'back_light' => Request::input('blck_defct'),
                        'abnormal_pic' => Request::input('abnorm_pic'),
                        'other' => Request::input('other'),
                        'delear_Account_numner' => Request::input('dealer_accnt_no'),
				        'dealer_nam' => Request::input('dealer_name'),
                        'dealer_addr' => Request::input('dealer_addr'),
                        'complaints' => Request::input('complaints'),
                        'purchase_date' => $startdate1,
                        'application_date' => $startdate3,
                        'date_received' => $startdate4,
                        'credit_note' => Request::input('credit_not'),
                    ]);
                    $updatejob = Job::find(Request::input('jobid'));
                    $updatejob->product_replacement =$prdct->product_replacement_id ;
                    //$updatejob->symptom = Request::input('symptom') ;
                    //$updatejob->resolution = Request::input('resolution') ;
                   // $updatejob->faulty_code = Request::input('faulty') ;
                    $updatejob->status =67 ;
                    $updatejob->save();
                       $status=1;
                  
                    
                       }
                       else{
                       
           
                        $date1=Request::input('purchase_date');
                        if($date1){
                            $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                        }
                        $date3=Request::input('appl_date');
                        if( $date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
        
                        }
                        $date4=Request::input('date_rece');
                        if( $date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
        
                        }
                        $rma = RMA::create([
                            'panel_serial_no' => $panel_serial_no,
                            'model' => Request::input('product'),
                            'other_symptom' => Request::input('other_sym'),
                            //'symptom' =>$symptom,
                            'reason_for_return' => $reason,
                            'order_id' => $prdct->product_replacement_id,
                            'amount' => Request::input('amount'),
                            'ex_number' => Request::input('ex_number'),
                            'panel_model' => Request::input('panel_model'),
                            'seriel_no' => Request::input('ser_num'),
                            'warranty_card' => Request::input('warr_num'),
                            'vertical_line' => Request::input('vert_line'),
                            'vertical_block' => Request::input('vert_block'),
                            'hori_line' => Request::input('hori_line'),
                            'horil_block' => Request::input('hori_block'),
                            'no_display' => Request::input('no_disp'),
                            'abnormal_color' => Request::input('abnorm_colour'),
                            'uniformity_defect' => Request::input('unif_defect'),
                            'dot_screen' => Request::input('dot_screen'),
                            'white_screen' => Request::input('whit_screen'),
                            'flicker' => Request::input('flicker'),
                            'back_light' => Request::input('blck_defct'),
                            'abnormal_pic' => Request::input('abnorm_pic'),
                            'other' => Request::input('other'),
                                 'delear_Account_numner' => Request::input('dealer_accnt_no'),
				'dealer_nam' => Request::input('dealer_name'),
                  'dealer_addr' => Request::input('dealer_addr'),
                            'complaints' => Request::input('complaints'),
                            'purchase_date' => $startdate1,
                            'application_date' => $startdate3,
                            'date_received' => $startdate4,
                            'credit_note' => Request::input('credit_not'),
                        ]);
                        $updatejob = Job::find(Request::input('jobid'));
                        $updatejob->product_replacement =$prdct->product_replacement_id ;
                        $updatejob->symptom = Request::input('symptom') ;
                $updatejob->resolution = Request::input('resolution') ;
                $updatejob->faulty_code = Request::input('faulty') ;
                        $updatejob->status =67 ;
                        $updatejob->save();
                           $status=1;
							}
                   
                       }
                             }
                             
                                   return Redirect::route('TechJobs');

                    }
            
        
        
        
        
                    public  function postGrn(){
                        $message = "";
                        $status = 0;
                        $html = "";
                        $data = "";
                        $view = '';
                        $startdate1=NULL;
                        $startdate2=NULL;
                        $startdate3=NULL;
                        $startdate4=NULL;
                    if(Request::input('grnid')!=''){
							  
				  /*$update1 = ProductReplacement::find(Request::input('prodct_rep_id'));
				  dd($update1);
                $update1->product_id =Request::input('product') ;
                
				
				$update1->save();*/
				
				$date1=Request::input('purchase_date');
                                    if($date1){
                                        $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();

                                    }
                                $date2=Request::input('goods_date');
                                if( $date2){
                                    $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();

                                }
                          $date3=Request::input('place_order');
                        if( $date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();

                        }
                        $date4=Request::input('comp_date');
                        if( $date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();

                        }
					$flag= 0 ;
					$file_name_new1 = NULL;
										$file_name_new = NULL;
										$img1 = NULL;
										$img2 = NULL;
					$file=$_FILES['files'];
					   $file_name = $file['name'];
                                   $file_tmp = $file['tmp_name'];	
                                   $file_ext = explode('.',$file_name); 
                                   $file_ext = strtolower(end($file_ext));
                                   $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                                 if(in_array($file_ext,$allowed)){
                                   $file_name_new = uniqid('',true).'.'.$file_ext;
                    
                                   $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                                    if(move_uploaded_file($file_tmp,$file_destination)){
                                                        $img1 = time() . '-' .$file_name_new;

                                   $flag= 1 ;
                                            }
								 }
								  $file1=$_FILES['proof'];
					              $file_name1 = $file1['name'];
                                   $file_tmp1 = $file1['tmp_name'];	
                                   $file_ext1 = explode('.',$file_name1); 
                                   $file_ext1 = strtolower(end($file_ext1));
                                   $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                                 if(in_array($file_ext1,$allowed)){
                                   $file_name_new1 = uniqid('',true).'.'.$file_ext1;
                    
                                   $file_destination1 = 'data/products/' . time() . '-' .$file_name_new1;
                                    if(move_uploaded_file($file_tmp1,$file_destination1)){
                    $img2 = time() . '-' .$file_name_new1;
                                   $flag= 2 ;
                                            }
								 }
								 
								 if($flag== 1|| $flag==2){
									 $update2 = GRN::find(Request::input('grnid'));
                //$update2->product_id =Request::input('product') ;
                $update2->reason_for_retrun =Request::input('reason') ;
                $update2->tech_prob =Request::input('tech_proof') ;
                $update2->dented =Request::input('dented') ;
                $update2->photogr =Request::input('photo') ;
                $update2->purchase_date = $startdate1;
                $update2->goods_date = $startdate2;
                 $update2->issue_image = $img1;
                $update2->attach_proof = $img2;

                $update2->return_acc =Request::input('ret_acc') ;
                $update2->amount =Request::input('amount') ;
                $update2->ex_number =Request::input('ex_number') ;
                $update2->spare_part_no =Request::input('part_no') ;
                $update2->seriel_no =Request::input('seriel_no') ; 
	$update2->dealer_address =Request::input('dealer_address') ; 
				$update2->dealer_name =Request::input('dealer_name') ; 
				$update2->dealer_acc =Request::input('delaer_acc') ; 				
		//$update2->complaints =Request::input('complaints') ;
                //$update2->other =Request::input('other') ;
                $update2->credit_note =Request::input('credit_not') ;
                $update2->place_order = $startdate3;
                 $update2->save(); 
								 }
								 else{
									  $update2 = GRN::find(Request::input('grnid'));
                //$update2->product_id =Request::input('product') ;
                $update2->reason_for_retrun =Request::input('reason') ;
                $update2->tech_prob =Request::input('tech_proof') ;
                $update2->dented =Request::input('dented') ;
                $update2->photogr =Request::input('photo') ;
                $update2->purchase_date = $startdate1;
                $update2->goods_date = $startdate2;
                $update2->return_acc =Request::input('ret_acc') ;
                $update2->amount =Request::input('amount') ;
                $update2->ex_number =Request::input('ex_number') ;
                $update2->spare_part_no =Request::input('part_no') ;
                $update2->seriel_no =Request::input('seriel_no') ; 
	$update2->dealer_address =Request::input('dealer_address') ; 
				$update2->dealer_name =Request::input('dealer_name') ; 
				$update2->dealer_acc =Request::input('delaer_acc') ; 				
		//$update2->complaints =Request::input('complaints') ;
                //$update2->other =Request::input('other') ;
                $update2->credit_note =Request::input('credit_not') ;
                $update2->place_order = $startdate3;
                 $update2->save();
								 }
				
				        
						  }
						  else{
							  $prdct = ProductReplacement::create([
                            'product_id' => Request::input('product'),
                            'qty' =>  Request::input('qnty'),
                            'product_replacement_type' => 'grn',
                            'order_date' => Carbon::now(),
                            'location' => Request::input('location'),
                            'creator' => Auth::user()->id,
            
                        ]);
                       $product=Request::input('product');
                        if(isset( $_POST['submit'] )){
                            
                         
                            $product=$_POST['product'];
                          
                            $reason=$_POST['reason'];   
                           
                                 $flag=0;
								 $file_name_new1 = NULL;
										$file_name_new = NULL;
										$img1 = NULL;
										$img2 = NULL;
                           $file=$_FILES['files'];
                           $file_name = $file['name'];
                           $file_tmp = $file['tmp_name'];	
                           $file_ext = explode('.',$file_name); 
                           $file_ext = strtolower(end($file_ext));
                           $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                       if(in_array($file_ext,$allowed)){
                           $file_name_new = uniqid('',true).'.'.$file_ext;
            
                           $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                            if(move_uploaded_file($file_tmp,$file_destination)){
            								   $img1 = time() . '-' .$file_name_new;

                           $flag= 1 ;
                                    }                  }     
									 $file1=$_FILES['proof'];
									 
										 $file_name1 = $file1['name'];
                                   $file_tmp1 = $file1['tmp_name'];	
                                   $file_ext1 = explode('.',$file_name1); 
                                   $file_ext1 = strtolower(end($file_ext1));
                                   $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                                 if(in_array($file_ext1,$allowed)){
                                   $file_name_new1 = uniqid('',true).'.'.$file_ext1;
                    
                                   $file_destination1 = 'data/products/' . time() . '-' .$file_name_new1;
                                    if(move_uploaded_file($file_tmp1,$file_destination1)){
                    
                                   $flag=2;
								   
								   $img2 = time() . '-' .$file_name_new1;
								   
                                            }
								 }		
                      if($flag==1 || $flag==2){  
            
                       
                      
                        $date1=Request::input('purchase_date');
                            if($date1){
                                $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();

                            }
                        $date2=Request::input('goods_date');
                        if( $date2){
                            $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();

                        }
                        $date3=Request::input('place_order');
                        if( $date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();

                        }
                        $date4=Request::input('comp_date');
                        if( $date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();

                        }
                                $rma = GRN::create([
                                    'reason_for_retrun' =>Request::input('reason'),
                                    'tech_prob' =>Request::input('tech_proof'),
                                    'dented' =>Request::input('dented'),
                                    'photogr' =>Request::input('photo'),
                                    'purchase_date' =>$startdate1,
                                    'goods_date' =>  $startdate2,
                                    'application_date' =>  $startdate3,
                                    'complaint_date' =>  $startdate4,
                                    'return_acc' =>Request::input('ret_acc'),
                                   'issue_image' => $img1,
                                    'attach_proof' => $img2,
                                    'order_id' => $prdct->product_replacement_id,
                                    'amount' =>Request::input('amount'),
                                    'ex_number' =>Request::input('ex_number'),
                                   'spare_part_no' =>Request::input('part_no'),
                                   'seriel_no' =>Request::input('seriel_no'),
                                   'complaints' =>Request::input('complaints'),
                                   'other' =>Request::input('other'),
								   'dealer_address' => Request::input('dealer_address'),
                               'dealer_name' => Request::input('dealer_name'),
                               'dealer_acc' => Request::input('delaer_acc'),
                                   'credit_note' => Request::input('credit_not'),
                                   'place_order' =>  $startdate3,
                                ]);
                        $updatejob = Job::find(Request::input('jobid'));
                    $updatejob->product_replacement =$prdct->product_replacement_id ;
                    $updatejob->symptom = Request::input('symptom') ;
                $updatejob->resolution = Request::input('resolution') ;
                $updatejob->faulty_code = Request::input('faulty') ;
                    $updatejob->status =64 ;
                    $updatejob->save();
                       $status=1;
                        
                           }
                           else{
                          
                            $date1=Request::input('purchase_date');
                                if($date1){
                                    $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();

                                }
                            $date2=Request::input('goods_date');
                            if( $date2){
                                $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();

                            }
                            $date3=Request::input('place_order');

                            if( $date3){
                                $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
    
                            }
                            $date4=Request::input('comp_date');
                            if( $date4){
                                $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
    
                            }
                            $rma = GRN::create([
                                'reason_for_retrun' =>Request::input('reason'),
                                'tech_prob' =>Request::input('tech_proof'),
                                'dented' =>Request::input('dented'),
                                'photogr' =>Request::input('photo'),
                                'purchase_date' =>$startdate1,
                                'goods_date' =>$startdate2,
                                'application_date' =>  $startdate3,
                                'complaint_date' =>  $startdate4,
                                'return_acc' =>Request::input('ret_acc'),
                                'credit_note' => Request::input('credit_not'),
                                'order_id' => $prdct->product_replacement_id,
                                'amount' =>Request::input('amount'),
                                'ex_number' =>Request::input('ex_number'),
                               'spare_part_no' =>Request::input('part_no'),
                               'seriel_no' =>Request::input('seriel_no'),
                'dealer_address' => Request::input('dealer_address'),
                               'dealer_name' => Request::input('dealer_name'),
                               'dealer_acc' => Request::input('delaer_acc'),
                                   'place_order' =>  $startdate3,

                            ]);
                            $updatejob = Job::find(Request::input('jobid'));
                        $updatejob->product_replacement =$prdct->product_replacement_id ;
                        $updatejob->symptom = Request::input('symptom') ;
                        $updatejob->resolution = Request::input('resolution') ;
                        $updatejob->faulty_code = Request::input('faulty') ;
                        $updatejob->status =64 ;
                        $updatejob->save();
                           $status=1;
						  }
                        
                           }
                          
                                 }
                                  return Redirect::route('TechJobs');
                
                        }
        


    function postRmaTss(){
	    $message = "";
	    $status = 0;
	    $html = "";
	    $data = "";
	    $view = '';
	    $startdate1 = NULL;
	    $startdate3 = NULL;
	    $startdate4 = NULL;
	    $startdate5 = NULL;
	    if (Request::input('rmaid') != ''){
		    $date5 = Request::input('del_date');
		    if ($date5){
			    $startdate5 = Carbon::createFromFormat('d-m-Y', $date5)->toDateString();
			    $update1 = ProductReplacement::find(Request::input('prodct_rep_id'));
			    $update1->delivery_date = $startdate5;
			    $update1->save();
			}
		    $date1 = Request::input('purchase_date');
		    if ($date1){
			    $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
			}
		    $flag = 0;
		    $file = $_FILES['files'];
		    $file_name = $file['name'];
		    $file_tmp = $file['tmp_name'];
		    $file_ext = explode('.', $file_name);
		    $file_ext = strtolower(end($file_ext));
		    $allowed = array(
			    "gif",
			    "png",
			    "jpg",
			    "jpeg",
			    "pdf",
			    "xls",
			    "xlsx"
		    );
		    if (in_array($file_ext, $allowed)){
			    $file_name_new = uniqid('', true) . '.' . $file_ext;
			    $file_destination = 'data/products/' . time() . '-' . $file_name_new;
			    if (move_uploaded_file($file_tmp, $file_destination)){
				    $flag = 1;
				}
			}
		    if ($flag == 1){
			    $update2 = RMA::find(Request::input('rmaid'));
			    $update2->panel_serial_no = Request::input('panel_serial_no');
			    $update2->model = Request::input('model');
			    // $update2->other_symptom =Request::input('other_sym') ;
			    $update2->reason_for_return = Request::input('reason');
			    // $update2->product_id =Request::input('product') ;
			    $update2->panel_model = Request::input('panel_model');
			    $update2->seriel_no = Request::input('ser_num');
			    $update2->warranty_card = Request::input('warr_num');
			    $update2->vertical_line = Request::input('vert_line');
                $update2->vertical_block = Request::input('vert_block');
                $update2->hori_line = Request::input('hori_line');
                $update2->horil_block = Request::input('hori_block');
                $update2->no_display = Request::input('no_disp');
                $update2->abnormal_color = Request::input('abnorm_colour');
                $update2->uniformity_defect = Request::input('unif_defect');
                $update2->dot_screen = Request::input('dot_screen');
                $update2->white_screen = Request::input('whit_screen');
                $update2->flicker = Request::input('flicker');
                $update2->back_light = Request::input('blck_defct');
                $update2->issue_image = time() . '-' . $file_name_new;
                $update2->abnormal_pic = Request::input('abnorm_pic');
			    // $update2->back_light =Request::input('panel_model') ;
			    $update2->other = Request::input('other');
			    $update2->delear_Account_numner = Request::input('dealer_accnt_no');
                $update2->dealer_nam = Request::input('dealer_name');
                $update2->dealer_addr = Request::input('dealer_addr');
                $update2->complaints = Request::input('complaints');
                $update2->purchase_date = $startdate1;
                $update2->credit_note = Request::input('credit_not');
                $update2->is_cn_ex = Request::input('approve');
                $update2->ex_number = Request::input('ex_number');
                $update2->rma_remarks = Request::input('rma_remarks'); 
                $update2->save();
			}else{
			    $update2 = RMA::find(Request::input('rmaid'));
			    $update2->panel_serial_no = Request::input('panel_serial_no');
			    $update2->model = Request::input('model');
			    // $update2->other_symptom =Request::input('other_sym') ;
			    $update2->reason_for_return = Request::input('reason');
			    // $update2->product_id =Request::input('product') ;
                $update2->panel_model = Request::input('panel_model');
                $update2->seriel_no = Request::input('ser_num');
                $update2->warranty_card = Request::input('warr_num');
                $update2->vertical_line = Request::input('vert_line');
                $update2->vertical_block = Request::input('vert_block');
                $update2->hori_line = Request::input('hori_line');
                $update2->horil_block = Request::input('hori_block');
                $update2->no_display = Request::input('no_disp');
                $update2->abnormal_color = Request::input('abnorm_colour');
                $update2->uniformity_defect = Request::input('unif_defect');
                $update2->dot_screen = Request::input('dot_screen');
                $update2->white_screen = Request::input('whit_screen');
                $update2->flicker = Request::input('flicker');
                $update2->back_light = Request::input('blck_defct');
                $update2->abnormal_pic = Request::input('abnorm_pic');
			    // $update2->back_light =Request::input('panel_model') ;
                $update2->other = Request::input('other');
                $update2->delear_Account_numner = Request::input('dealer_accnt_no');
                $update2->dealer_nam = Request::input('dealer_name');
                $update2->dealer_addr = Request::input('dealer_addr');
                $update2->complaints = Request::input('complaints');
                $update2->purchase_date = $startdate1;
                $update2->credit_note = Request::input('credit_not');
                $update2->is_cn_ex = Request::input('approve');
                $update2->ex_number = Request::input('ex_number');
                $update2->rma_remarks = Request::input('rma_remarks'); 
                $update2->save();
			}
		}else{
		    $date5 = Request::input('del_date');
		    if ($date5){
			    $startdate5 = Carbon::createFromFormat('d-m-Y', $date5)->toDateString();
		    }
		    $prdct = ProductReplacement::create(['product_id' => Request::input('product') , 'qty' => Request::input('qnty') , 'delivery_date' => $startdate5, 'product_replacement_type' => 'rma', 'order_date' => Carbon::now() , 'location' => Request::input('location') , 'creator' => Auth::user()->id, ]);
		    $product = Request::input('product');
		    if (isset($_POST['submit'])){
			    $panel_serial_no = $_POST['panel_serial_no'];
			    // $product=$_POST['product'];
			    // $symptom=$_POST['symptom'];
			    $reason = $_POST['reason'];
			    // $location=$_POST['location'];
			    $flag = 0;
			    $file = $_FILES['files'];
			    $file_name = $file['name'];
			    $file_tmp = $file['tmp_name'];
			    $file_ext = explode('.', $file_name);
			    $file_ext = strtolower(end($file_ext));
			    $allowed = array(
                    "gif",
                    "png",
                    "jpg",
                    "jpeg",
                    "pdf",
                    "xls",
                    "xlsx"
			    );
			    if (in_array($file_ext, $allowed)){
				    $file_name_new = uniqid('', true) . '.' . $file_ext;
				    $file_destination = 'data/products/' . time() . '-' . $file_name_new;
				    if (move_uploaded_file($file_tmp, $file_destination)){
					    $flag = 1;
					}
				}
			    if ($flag == 1){
				    $date1 = Request::input('purchase_date');
				if ($date1){
					$startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
				}
				$date3 = Request::input('appl_date');
				if ($date3){
					$startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
				}

				$date4 = Request::input('date_rece');
				if ($date4){
					$startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
				}
				$rma = RMA::create([
                    'panel_serial_no' => $panel_serial_no, 
                    'model' => Request::input('product') , 
                    'other_symptom' => Request::input('other_sym') ,
                    // 'symptom' =>$symptom,
                    'reason_for_return' => $reason, 
                    'issue_image' => time() . '-' . $file_name_new, 
                    'order_id' => $prdct->product_replacement_id, 
                    'amount' => Request::input('amount') , 
                    'ex_number' => Request::input('ex_number') , 
                    'panel_model' => Request::input('panel_model') , 
                    'seriel_no' => Request::input('ser_num') , 
                    'warranty_card' => Request::input('warr_num') , 
                    'vertical_line' => Request::input('vert_line') , 
                    'vertical_block' => Request::input('vert_block') , 
                    'hori_line' => Request::input('hori_line') , 
                    'horil_block' => Request::input('hori_block') , 
                    'no_display' => Request::input('no_disp') , 
                    'abnormal_color' => Request::input('abnorm_colour') , 
                    'uniformity_defect' => Request::input('unif_defect') , 
                    'dot_screen' => Request::input('dot_screen') , 
                    'white_screen' => Request::input('whit_screen') , 
                    'flicker' => Request::input('flicker') , 
                    'back_light' => Request::input('blck_defct') , 
                    'abnormal_pic' => Request::input('abnorm_pic') , 
                    'other' => Request::input('other') , 
                    'delear_Account_numner' => Request::input('dealer_accnt_no') , 
                    'dealer_nam' => Request::input('dealer_name') , 
                    'dealer_addr' => Request::input('dealer_addr') , 
                    'complaints' => Request::input('complaints') , 
                    'purchase_date' => $startdate1, 
                    'application_date' => $startdate3, 
                    'date_received' => $startdate4, 
                    'credit_note' => Request::input('credit_not') , 
                    'ex_number'   => Request::input('ex_number') ,
                    'rma_remarks' => Request::input('rma_remarks'),
                    'is_cn_ex' => Request::input('approve'),
                ]);
				$updatejob = Job::find(Request::input('jobid'));
				$updatejob->product_replacement = $prdct->product_replacement_id;
				//$updatejob->symptom = Request::input('symptom');
				//$updatejob->resolution = Request::input('resolution');
				//$updatejob->faulty_code = Request::input('faulty');
				$updatejob->status = 67;
				$updatejob->save();
				$status = 1;
			}else{
				$date1 = Request::input('purchase_date');
			    if ($date1){
				    $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
			    }
				$date3 = Request::input('appl_date');
				if ($date3){
					$startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
				}

				$date4 = Request::input('date_rece');
				if ($date4){
					$startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
				}
				$rma = RMA::create(['panel_serial_no' => $panel_serial_no, 'model' => Request::input('product') , 'other_symptom' => Request::input('other_sym') , 'reason_for_return' => $reason, 'order_id' => $prdct->product_replacement_id, 'amount' => Request::input('amount') , 'ex_number' => Request::input('ex_number') , 'panel_model' => Request::input('panel_model') , 'seriel_no' => Request::input('ser_num') , 'warranty_card' => Request::input('warr_num') , 'vertical_line' => Request::input('vert_line') , 'vertical_block' => Request::input('vert_block') , 'hori_line' => Request::input('hori_line') , 'horil_block' => Request::input('hori_block') , 'no_display' => Request::input('no_disp') , 'abnormal_color' => Request::input('abnorm_colour') , 'uniformity_defect' => Request::input('unif_defect') , 'dot_screen' => Request::input('dot_screen') , 'white_screen' => Request::input('whit_screen') , 'flicker' => Request::input('flicker') , 'back_light' => Request::input('blck_defct') , 'abnormal_pic' => Request::input('abnorm_pic') , 'other' => Request::input('other') , 'delear_Account_numner' => Request::input('dealer_accnt_no') , 'dealer_nam' => Request::input('dealer_name') , 'dealer_addr' => Request::input('dealer_addr') , 'complaints' => Request::input('complaints') , 'purchase_date' => $startdate1, 'application_date' => $startdate3, 'date_received' => $startdate4, 'credit_note' => Request::input('credit_not') , 'is_cn_ex' => Request::input('approve') , ]);
				$updatejob = Job::find(Request::input('jobid'));
				$updatejob->product_replacement = $prdct->product_replacement_id;
				$updatejob->symptom = Request::input('symptom');
				$updatejob->resolution = Request::input('resolution');
				$updatejob->faulty_code = Request::input('faulty');
				$updatejob->status = 67;
				$updatejob->save();
				$status = 1;
				}
			}
		}

	return Redirect::route('Jobs');
	}         
                
    public  function postGrnTss(){
        $message = "";
        $status = 0;
        $html = "";
        $data = "";
        $view = '';
        $startdate1=NULL;
        $startdate2=NULL;
        $startdate3=NULL;
        $startdate4=NULL;
        $startdate5=NULL;
        if(Request::input('grnid')!=''){
            $date5=Request::input('del_date');
            if($date5){		
                $startdate5 = Carbon::createFromFormat('d-m-Y', $date5)->toDateString();
                $update1 = ProductReplacement::find(Request::input('prodct_rep_id'));
                $update1->delivery_date = $startdate5;	
                $update1->save();
            }
            $date1=Request::input('purchase_date');
            if($date1){
                $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
            }
            $date2=Request::input('goods_date');
            if( $date2){
                $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
            }
            $date3=Request::input('place_order');
            if($date3){
                $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
            }
            $date4=Request::input('del_date');
            if( $date4){
                $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
            }
            $flag1= false ;
            $flag2= false ;
            $file_name_new1 = NULL;
            $file_name_new = NULL;
            $img1 = NULL;
            $img2 = NULL;
            $file=$_FILES['files'];
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];	
            $file_ext = explode('.',$file_name); 
            $file_ext = strtolower(end($file_ext));
            $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
            if(in_array($file_ext,$allowed)){
                $file_name_new = uniqid('',true).'.'.$file_ext;
                $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                if(move_uploaded_file($file_tmp,$file_destination)){
                    $img1 = time() . '-' .$file_name_new;
                    $flag1= true ;
                }
            }
            $file1=$_FILES['proof'];
            $file_name1 = $file1['name'];
            $file_tmp1 = $file1['tmp_name'];	
            $file_ext1 = explode('.',$file_name1); 
            $file_ext1 = strtolower(end($file_ext1));
            $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
            if(in_array($file_ext1,$allowed)){
                $file_name_new1 = uniqid('',true).'.'.$file_ext1;
                $file_destination1 = 'data/products/' . time() . '-' .$file_name_new1;
                if(move_uploaded_file($file_tmp1,$file_destination1)){
                    $img2 = time() . '-' .$file_name_new1;
                    $flag2 = true ;
                }
            }						 	
            $update2 = GRN::find(Request::input('grnid'));
            $update2->reason_for_retrun =Request::input('reason') ;
            $update2->tech_prob =Request::input('tech_proof') ;
            $update2->dented =Request::input('dented') ;
            $update2->photogr =Request::input('photo') ;
            $update2->purchase_date = $startdate1;
            $update2->goods_date = $startdate2;
            $update2->grn_remarks = Request::input('grn_remarks') ;
            if($flag1)
                $update2->issue_image = $img1;
            if($flag2) 
                $update2->attach_proof = $img2;   
            $update2->return_acc =Request::input('ret_acc') ;
            $update2->pending_part =Request::input('pending_part') ;
            $update2->amount =Request::input('amount') ;
            $update2->ex_number =Request::input('ex_number') ;
            $update2->spare_part_no =Request::input('part_no') ;
            $update2->seriel_no =Request::input('seriel_no') ;   
            $update2->is_ex_cn =Request::input('approve') ; 
            $update2->dealer_name =Request::input('dealer_name') ; 
            $update2->dealer_acc =Request::input('delaer_acc') ; 
            $update2->dealer_address =Request::input('dealer_address') ; 
            $update2->credit_note =Request::input('credit_not') ;
            $update2->sell_price =Request::input('sell_price') ;
            $update2->place_order =$startdate3;
            $update2->save();	        	
		}else{
				$date4=Request::input('del_date');
                if( $date4){
                    $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
                }
				$prdct = ProductReplacement::create([
                'product_id' => Request::input('product'),
                'qty' =>  Request::input('qnty'),
                'product_replacement_type' => 'grn',
                'order_date' => Carbon::now(),
				'delivery_date' => $startdate4,
                'creator' => Auth::user()->id,
                ]);
                $product=Request::input('product');
                if(isset( $_POST['submit'] )){               
                    $product=$_POST['product'];
                    $reason=$_POST['reason'];   
                    $flag=0;
                    $file_name_new1 = NULL;
                    $file_name_new = NULL;
                    $img1 = NULL;
                    $img2 = NULL;
                    $file=$_FILES['files'];	   
					$file_name = $file['name'];
                    $file_tmp = $file['tmp_name'];	
                    $file_ext = explode('.',$file_name); 
                    $file_ext = strtolower(end($file_ext));
                    $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                    if(in_array($file_ext,$allowed)){
                        $file_name_new = uniqid('',true).'.'.$file_ext;
                        $file_destination = 'data/products/' . time() . '-' .$file_name_new;
                        if(move_uploaded_file($file_tmp,$file_destination)){
                            $flag= 1 ;
							$img1 = time() . '-' .$file_name_new;
                        }                  
                    }   			                                 
                    $file1=$_FILES['proof'];	 
					$file_name1 = $file1['name'];
                    $file_tmp1 = $file1['tmp_name'];	
                    $file_ext1 = explode('.',$file_name1); 
                    $file_ext1 = strtolower(end($file_ext1));
                    $allowed = array("gif","png","jpg","jpeg","pdf","xls", "xlsx");
                    if(in_array($file_ext1,$allowed)){
                        $file_name_new1 = uniqid('',true).'.'.$file_ext1;
                        $file_destination1 = 'data/products/' . time() . '-' .$file_name_new1;
                        if(move_uploaded_file($file_tmp1,$file_destination1)){
                            $flag=2;   
                            $img2 = time() . '-' .$file_name_new1;  
                        }
					}						              									
                    if($flag==1 || $flag==2){  
                        $date1=Request::input('purchase_date');
                        if($date1){
                            $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                        }
                        $date2=Request::input('goods_date');
                        if( $date2){
                            $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
                        }
                        $date3=Request::input('place_order');
                        if( $date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
                        }
                        $date4=Request::input('del_date');
                        if($date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
                        }	
                        $rma = GRN::create([
                            'reason_for_retrun' =>Request::input('reason'),
                            'tech_prob' =>Request::input('tech_proof'),
                            'dented' =>Request::input('dented'),
                            'photogr' =>Request::input('photo'),
                            'purchase_date' =>$startdate1,
                            'goods_date' =>  $startdate2,
                            'application_date' =>  $startdate3,
                            'complaint_date' =>  $startdate4,
                            'return_acc' =>Request::input('ret_acc'),
                            'pending_part' =>Request::input('pending_part'),        
                            'issue_image' => $img1,
                            'grn_remarks' => Request::input('grn_remarks'),
                            'attach_proof' => $img2,
                            'order_id' => $prdct->product_replacement_id,
                            'amount' =>Request::input('amount'),
                            'ex_number' =>Request::input('ex_number'),
                            'spare_part_no' =>Request::input('part_no'),
                            'seriel_no' =>Request::input('seriel_no'),
                            'complaints' =>Request::input('complaints'),
                            'other' =>Request::input('other'),
                            'credit_note' => Request::input('credit_not'),
                            'sell_price' => Request::input('sell_price'),
                            'is_ex_cn' => Request::input('approve'),
                            'dealer_name' => Request::input('dealer_name'),
                            'dealer_acc' => Request::input('delaer_acc'),
                            'dealer_address' => Request::input('dealer_address'),
                            'place_order' => $startdate3,
                            'delivery_date' => $startdate4,
                        ]);	
                        $updatejob = Job::find(Request::input('jobid'));
                        $updatejob->product_replacement =$prdct->product_replacement_id ;
                        //$updatejob->symptom = Request::input('symptom') ;
                        $updatejob->resolution = Request::input('resolution') ;
                        $updatejob->faulty_code = Request::input('faulty') ;
                        $updatejob->status =64 ;
                        $updatejob->save();
                        $status=1;
                    }else{          
                        $date1=Request::input('purchase_date');
                        if($date1){
                            $startdate1 = Carbon::createFromFormat('d-m-Y', $date1)->toDateString();
                        }
                        $date2=Request::input('goods_date');
                        if( $date2){
                            $startdate2 = Carbon::createFromFormat('d-m-Y', $date2)->toDateString();
                        }
                        $date3=Request::input('place_order');
                        if( $date3){
                            $startdate3 = Carbon::createFromFormat('d-m-Y', $date3)->toDateString();
                        }
                        $date4=Request::input('del_date');
                        if( $date4){
                            $startdate4 = Carbon::createFromFormat('d-m-Y', $date4)->toDateString();
                        }	
                        $rma = GRN::create([
                            'reason_for_retrun' =>Request::input('reason'),
                            'tech_prob' =>Request::input('tech_proof'),
                            'dented' =>Request::input('dented'),
                            'photogr' =>Request::input('photo'),
                            'purchase_date' =>$startdate1,
                            'goods_date' =>$startdate2,
                            'application_date' =>  $startdate3,
                            'complaint_date' =>  $startdate4,
                            'return_acc' =>Request::input('ret_acc'),
                            'pending_part' =>Request::input('pending_part'),
                            'is_ex_cn' => Request::input('approve'),
                            'credit_note' => Request::input('credit_not'),
                            'sell_price' => Request::input('sell_price'),
                            'order_id' => $prdct->product_replacement_id,
                            'amount' =>Request::input('amount'),
                            'grn_remarks' => Request::input('grn_remarks'),
                            'ex_number' =>Request::input('ex_number'),
                            'spare_part_no' =>Request::input('part_no'),
                            'seriel_no' =>Request::input('seriel_no'),
                            'is_ex_cn' => Request::input('approve'),
                            'dealer_address' => Request::input('dealer_address'),
                            'place_order' => $startdate3,
                            'delivery_date' => $startdate4,
                            'dealer_name' => Request::input('dealer_name'),
                            'dealer_acc' => Request::input('delaer_acc'),
                        ]);
						//$update1 = ProductReplacement::find(Request::input('prodct_rep_id'));
                        //$update1->delivery_date = $startdate5;
				        //$update1->save();
                        $updatejob = Job::find(Request::input('jobid'));
                        $updatejob->product_replacement =$prdct->product_replacement_id ;
                        $updatejob->symptom = Request::input('symptom') ;
                        $updatejob->resolution = Request::input('resolution') ;
                        $updatejob->faulty_code = Request::input('faulty') ;
                        $updatejob->status =64 ;
                        $updatejob->save();
                        $status=1;
                    } 
				}                    
            }
        return Redirect::route('Jobs');
    }
                













                        public function postFileShare(){
                        
                            if(isset( $_POST['submit'] )){
                                        
             
                               $file=$_FILES['files'];
                               $asp=$_POST['asp_admin'];
							
                               $file=$_FILES['files'];
                               $file_name = $file['name'];
                           
                               $file_tmp = $file['tmp_name'];	
                               $file_ext = explode('.',$file_name); 
                               $file_ext = strtolower(end($file_ext));
                               $allowed = array("pdf","doc","png","jpg");
                           if(in_array($file_ext,$allowed)){
                               $file_name_new = uniqid('',true).'.'.$file_ext;
                
                               $file_destination = 'data/files/' . time() . '-' .$file_name_new;
                                if(move_uploaded_file($file_tmp,$file_destination)){
                
                               $flag= 1 ;
                                        }                  }     
                          if($flag==1){  
                         
                            $data['admins']= User::leftjoin('asp_admin','users.id','=','asp_admin.asp_admin_id')
                            ->leftjoin('asp_list','asp_list.warehouse_id','=','asp_admin.asp_warehouse_id')
                            
                            ->where('user_role_id',2)
                             ->orderBy('users.id', 'desc')
                                ->count();
                            
                         $count = count($asp);
						
						  for($i = 0; $i < $count; $i++){
							  $rma = Files::create([
                                'file_title' =>$file_name,
                                'file_url' => time() . '-' .$file_name_new,
                                'file_ext' => $file_ext,
                                'permission' => $asp[$i],
                
                            ]);
						  }
                     
                             for($i = 0; $i < $count; $i++){ 
                            $create = AspFile::create([
							'file_id' =>$rma->file_id,
                             'asp_id' =>$asp[$i], 
							 
                            ]);
                           }
						   
						  }
                           $status=1;
                            
                              
                               return Redirect::route('FileShare')->with('message', 'Message sent!');
                                     }
                
                            
                        }
                        
        
                        public function updateFileShare(){

                              $file_id=Request::input('file_id');
                             
                            if(isset( $_POST['submit'] )){
                                        
                
                               $file=$_FILES['files'];
                           
                               $file=$_FILES['files'];
                               $file_name = $file['name'];
                               $file_tmp = $file['tmp_name'];	
                               $file_ext = explode('.',$file_name); 
                               $file_ext = strtolower(end($file_ext));
                               $allowed = array("pdf","doc","png","jpg");
                           if(in_array($file_ext,$allowed)){
                               $file_name_new = uniqid('',true).'.'.$file_ext;
                
                               $file_destination = 'data/files/' . time() . '-' .$file_name_new;
                                if(move_uploaded_file($file_tmp,$file_destination)){
                
                               $flag= 1 ;
                                        }                  }     
                          if($flag==1){  
                 
                //             $date=Request::input('asp_admin');
               
                // $startdate= $date[0];
                // $enddate=$date[1];
                // dd($startdate);

                $update = Files::find(Request::input('file_id'));

                $update->file_url =  time() . '-' .$file_name_new;
                $update->permission =  Request::input('asp_admin');
                $update->save();
                            // $rma = Files::create([
                            //     'file_title' => 'time() . '-' .$file_name_new',
                            //     'file_url' => time() . '-' .$file_name_new,
                            //     'permission' => Request::input('asp_admin'),
                
                            // ]);
                           
                           
                // $update11 = AspFile::find(Request::input('file_id'));

                // $update11->asp_id =  Request::input('asp_admin');
                // $update11->file_id =  $update->file_id;
                // $update11->save();
                            $asp = AspFile::create([
                                'asp_id' =>Request::input('asp_admin'),
                                'file_id' =>   $update->file_id
                    
                
                            ]);
                           }
                           $status=1;
                            
                              
                               return Redirect::route('FileShare')->with('message', 'Message sent!');
                                     }
                
                            
                        }   
                        
        

    public function postRemove(){
        $message = "";
        $status = 0;
        $html = "";
        $data = "";


        switch (Request::input('type')) {


            case 'removeUploads':

                DB::table('uploads')->where('upload_id', '=', Request::input('id'))->delete();
                $status=1;
            break;
			
           case 'Delete-Image-GRN':
		 
		   $update = GRN::find(Request::input('grn'));
                    $update->issue_image = NULL ;
                    
    
                    $update->save();
                       $status=1;

		   break;
		   case 'Delete-Image-Proof':
		 
		   $update = GRN::find(Request::input('grn'));
                    $update->attach_proof = NULL ;
                    
    
                    $update->save();
                       $status=1;

		   break;
		   case 'Delete-Image-Rma':
		 
		   $update = RMA::find(Request::input('gma'));
                    $update->issue_image = NULL ;
                    
    
                    $update->save();
                       $status=1;

		   break;
            case 'delete_uploads':

                $getattachment = Upload::where('upload_id', Request::input('delete_id'))->delete();
                $status=1;

            break;

            case 'delete_technician':

                $getattachment = User::where('id', Request::input('delete_id'))->delete();
                $status=1;

            break;

            case 'delete_file':


               $getattachment = AspFile::where('file_id', Request::input('delete_id'))->delete();
 
                $getattachment = Files::where('file_id', Request::input('delete_id'))->delete();
                
                $status=1;

            break;
            case 'delete_asp_admin':


                $getattachment = User::where('id', Request::input('delete_id'))->delete();
                $getattachment33 = AspAdmin::where('warehouse_code', Request::input('code'))->delete();

               $getattachment22 = WareHouse::where('code', Request::input('code'))->delete();


                $status=1;

            break;

            case 'delete_job':
            $getattachment = Appointment::where('job_id', Request::input('delete_id'))->delete();
            $getattachment = Claim::where('job_id', Request::input('delete_id'))->delete();
			
            $getattachment = Job::where('job_id', Request::input('delete_id'))->delete();
			
            $status=1;

        break;
        case 'delete_part':
        $getattachment = Parts::where('part_id', Request::input('delete_id'))->delete();
        $status=1;
        break;

        case 'delete_mileage':
        $getattachment = Mileage::where('mil_id', Request::input('delete_id'))->delete();
        $status=1;
        break;
        case 'delete_faulty':
        $getattachment =  DB::table('faultylist')->where('faulty_id', Request::input('delete_id'))->delete();
        $status=1;
        break;
        case 'delete_symptom':
        $getattachment = DB::table('symptoms')->where('symptom_id', Request::input('delete_id'))->delete();
        $status=1;
        break;
        case 'delete_resolution':
        $getattachment = DB::table('resolutions')->where('resolution_id', Request::input('delete_id'))->delete();
        $status=1;
        break;
        case 'delete_product':
       $prod = DB::table('product_repalcement_order')->where('product_id','=',Request::input('delete_id'))->count();
       if($prod == 0){
        $getattachment = DB::table('products')->where('product_no', Request::input('delete_id'))->delete();
        $status=1;

       }
       else{
        $status=2;
       }

       
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
