@extends('layouts.admin3')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/admin/css/wickedpicker.min.css')}}">

<style>
.chcgrn{
    float: right;
    margin-top: -43px;
    margin-right: -11px;
}
#accordion .panel{
    border: 1px solid #bf6026;
    border-radius: 0;
    box-shadow: none;
    margin-left: 50px;
    margin-bottom: 12px;
}
 
#accordion .panel-heading{
    padding: 0;
    background: #fff;
    position: relative;
}
#accordion .panel-heading:before,
#accordion .panel-heading:after{
    content: "";
    border-right: 8px solid #bf6026;
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    position: absolute;
    top: 12px;
    left: -9px;
}
#accordion .panel-heading:after{
    border-right: 7px solid #fff;
    border-bottom: 7px solid transparent;
    border-top: 7px solid transparent;
    position: absolute;
    top: 13px;
    left: -6px;
}
#accordion .panel-title a{
    display: block;
    padding: 10px 20px;
    border: none;
    font-size: 20px;
    font-weight: 600;
    color: #bf6026;
    position: relative;
}
#accordion .panel-title a:before,
#accordion .panel-title a.collapsed:before{
    content: "\f068";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 15px;
    color: #bf6026;
    text-align: center;
    border: 1px solid #bf6026;
    position: absolute;
    top: 0;
    left: -50px;
    transition: all 0.5s ease 0s;
    font: normal normal normal 14px/1 FontAwesome;
}
#accordion .panel-title a.collapsed:before{ content: "\f067"; }
#accordion .panel-body{
    padding: 0 15px 15px;
    border: none;
    font-size: 14px;
    color: #807e7e;
    line-height: 28px;
}
#accordion .panel-body p{ margin-bottom: 0; }

.panel-title {
    border-bottom: solid 1px #eaebeb;
    font-size: 16px;
    padding: 0px;
    margin-bottom: 0px;
}
</style>
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
  
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Manage Jobs</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Manage Jobs</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped"style="        width: 1682px;">
                            <thead>
                            <tr>
                            <th>job date</th>
                            
                            <th>Action</th>
                         
                          
                                <th>Status</th>
                             
                               <th>ASP Name</th>
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
                            <tbody>
                            @foreach($jobs as $job)
                            <tr>
                            
                            <td>{{date('d-m-Y', strtotime($job->job_date))}}</td>
                           
                               
                            <td>
                                    <a class="btnview js-mytooltip" data-tooltip="View" href="{{URL::route('ViewTechJob',$job->job_id)}}"><i class="fa fa-eye pad"></i></a>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Edit" href="{{URL::route('EditTechJob',$job->job_id)}}" ><i class=" edi pad fa fa-edit"></i></a>
                                    <!-- @if($job->appjob_id != NULL)
                                    <a href="{{URL::route('Appointment',$job->job_id)}}" class="js-mytooltip  btnsecal confirm "
                                       data-tooltip="Appointment"><i class="fa fa-phone"></i></a>
                                       @endif -->
                                       <!-- @if($job->part_order_id != NULL)


                                      
                                    <a class="btnact js-mytooltip" data-tooltip="Parts Order Request" href="{{URL::route('WaitingParts',$job->job_id)}}" ><i class="fa fa-first-order"></i></a>
                                    @endif
                                    @if($job->claim_id != NULL)
                                    <a class="btnact js-mytooltip" data-tooltip=" Request For claim" href="{{URL::route('NewClaim',$job->job_id)}}" ><i class="fa fa-file"></i></a>
                                    @endif -->
                                   

                                </td>
                                @if($job->claim_approve ==1)
                                <td> <select class="sel_comp" disabled>
                                <option value="{{$job->status_id}}">{{$job->status_code}}-{{$job->status_description}}</option>

                                <option value="{{$job->status_id}}">{{$job->status_code}}-{{$job->status_description}}</option>
                                </select></td>
                                @else
                                <td> 
                                <select class="changestatus" data-id="{{$job->job_id}}"  data-sym="{{$job->symptom_id}}" data-fal="{{$job->faulty_id}}" data-res="{{$job->resolution_id}}" data-symptom="{{$job->symptom_description}}" data-resol="{{$job->resolution_description}}" data-faulty="{{$job->faulty_description}}" data-repair="{{$job->repaire_order_no}}"
                                data-fname="{{$job->firstname}}" data-lname="{{$job->lastname}}" data-addrs="{{$job->cu_address}}" data-phn="{{$job->phone_no}}" data-bus="{{$job->bussiness_number}}" data-partno="{{$job->part_no}}" data-partdesc="{{$job->parts_description}}" data-partqty="{{$job->quantity}}" data-partid="{{$job->part_id}}" data-partrem="{{$job->part_remark}}" 
                                data-grnspare="{{$job->grn_spare}}"  data-techprob="{{$job->tech_prob}}" data-dented="{{$job->dented}}" data-photogr="{{$job->photogr}}" data-returnacc="{{$job->return_acc}}" data-purdate="{{$job->grn_purchase}}" data-appldate="{{$job->grn_appl}}" data-compdate="{{$job->complaint_date}}" data-gooddate="{{$job->goods_date}}" data-mod="{{$job->product_id}}" data-grnres="{{$job->reason_for_retrun}}" data-grnseriel="{{$job->grn_seriel}}"
                                data-rmaspare="{{$job->gma_spare}}" data-rmaseriel="{{$job->gma_seriel}}" data-warcard="{{$job->warranty_card}}" data-panser="{{$job->panel_serial_no}}" data-panmod="{{$job->panel_model}}" data-accnt="{{$job->delear_Account_numner}}" data-compl="{{$job->complaints}}"  data-rmares="{{$job->reason_for_return}}" data-rmaappl="{{$job->gma_appl}}"  data-rmapurchase="{{$job->gma_purchase}}" data-daterec="{{$job->date_received}}" data-othe="{{$job->other}}"
                                data-mileage="{{$job->mileage}}" data-clamount="{{$job->claim_amount}}" data-labour="{{$job->labour}}" 
                                data-jobloc="{{$job->job_location}}"  data-jobremark="{{$job->remark}}"  data-fround="{{$job->turn_fround_time}}" data-jobdesc="{{$job->description}}"  data-asploc="{{$job->asp_location}}"
								data-grnid="{{$job->grn_id}}" data-rmaid="{{$job->gma_id}}"
								data-prdrepid="{{$job->	product_replacement_id}}">
                                <option value="{{$job->status_id}}">{{$job->status_code}}-{{$job->status_description}}</option>

                                @foreach($status as $tech)        
                                   <option data-name="{{$tech->status_code}}" value="{{$tech->status_id}}">{{$tech->status_code}}-{{$tech->status_description}}</option>
                                   @endforeach
                            </select>
                                </td>
                                @endif
                            <!-- @if($job->status_code == 'R1')
                                <td><span class="label label-success"> {{$job->status_code}} - {{$job->status_description}}</span></td>
                                @else
                                <td><span class="label label-warning"> {{$job->status_code}} - {{$job->status_description}}</span></td>
                                @endif -->
                                <td>{{$job->name}}</td>
                                 <td>{{$job->job_location}}</td>
                                <td>{{$job->repaire_order_no}}</td>
                              
                               
                                <td>{{str_limit($job->cu_address,25)}}</td>
                                
                                <td>{{$job->phone_no}}</td>
                                <td>{{$job->remark}}</td>
                                <td>{{$job->symptom_description}}</td>
                                <td>{{$job->resolution_description}}</td>
                                <td>{{$job->change_code}}</td>
                               @if($job->claim_create)
								   <?php $d1 = App\Models\Job::where('job_id',$job->job_id)->first();
							        $dat1 = $d1->created_at;
									    $vv = date('d-m-Y', strtotime($dat1));
										
									$d2 = App\Models\Claim::where('job_id',$job->job_id)->first();
									$dat2 = $d2->created_at;
									  $nn =  date('d-m-Y', strtotime($dat2));
									 $formatted_dt1=Carbon::parse($vv);

                                 $formatted_dt2=Carbon::parse($nn);

                          $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
									
									//echo round($diff / (60 * 60 * 24));

									
							   ?>@endif
                                @if($job->claim_approve)<td>{{$date_diff}} days<td>
								@else
									<td></td>@endif
                               
								  @if($job->appointment_time)
                                <td>{{date('d-m-Y', strtotime($job->appointment_time))}}</td>
							@else<td></td>
							@endif
                                <td>{{date('d-m-Y', strtotime($job->order_date))}}</td>
                               
                                <td>{{$job->product}}</td>
                                <td>{{$job->seriel_number}}</td>
                                <td>{{$job->servicetype}}</td>
                                @if($job->purchase_date)<td>{{date('d-m-Y', strtotime($job->purchase_date))}}</td>
								@else<td></td>@endif
                             <?php $var = App\Models\PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$job->job_id)
                ->get();?>
                                <td>@foreach($var as $va){{$va->part_no}},@endforeach</td>
								   <td>{{$job->description}}</td>
                                <td></td>
                                <td></td>
                              
                             
                               




                                

                            </tr>
                             @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$jobs->links()}}
        <!-- /.content -->
    </div>


<div class="modal fade" id="createjob" tabindex="-1" role="dialog" aria-labelledby="createjob" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Job</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
        
                               
                              

                                <div class="row">
<div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Job
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                      <select class="form-control" name="job_location">
                                            <option value="">Select Job Location</option>
                                               
                                                    <option value="Outdoor">Outdoor</option>
                                                    <option value="Indoor">Indoor</option>
                                            </select>                                        
                                            </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repair Order Number</label>

                                            <input class="form-control" name="rep_order_no" id="repjob"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product">
                   <option value="">Select Product</option>
                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                           @endforeach
                   </select>
                   </fieldset>
                </div>
                                </div>
                              

                                <div class="row">


                                    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Bill To Name</label>
                                            <textarea class="form-control" id="cu_address" name="address"></textarea>
                                        </fieldset>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Contact Number</label>
                                            <input class="form-control" name="phone" id="cont_no"  type="text">
                                        </fieldset>
                                    </div>
                                    
                                </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Complaints/Remarks</label>
                                            <textarea class="form-control" id="remar_job" name="remark"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Turn Around Time</label>
                                            <input class="form-control" name="turn_fround_time" id="fround"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="descr" name="description"></textarea>
                                        </fieldset>
                                    </div>

                                    </div>
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label> Assign Asp Admin</label>
                                            <select class="form-control asp" name="asp_location" id="asp_loc" required>
                                            <option value="">Select WareHouse</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{ $stat->code}}">{{$stat->code}} - {{$stat->name}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    </div>
                              
                              
                                <div class="mod_fot">
        <input type="hidden" name="type" value="newJob">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success"><i class=" fa fa-hdd-o"></i> Create</button>
        </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Create Parts Order
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                        <form id="partsform">
            <div class="row">
        
            <div class="col-lg-4 hidden">
            <fieldset class="form-group">
            
            <label>Job Id</label>
              <input class="form-control" id="jobidparts" name="jobid"  type="text" readonly>
             
            
            </fieldset>
          </div>
          </div>
		  <!-- <hr>
		
		   <div class="row">
         
          
        </div>
		 <hr> -->
		
			<div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultyparts">
                                            <option id="part_faulty" value="">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomparts">
                                            <option id="part_symptom" value="">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolparts">
                                            <option id="part_resol" value="">Select Resolution Code</option> 
                                            

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        </div>
                                        </div>
                                    <hr>  
                              <div class="row">
                              <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Remark</label>
              <textarea class="form-control" id="rem1" name="remark"  type="text"></textarea>

            </fieldset>
          </div>
                              </div>
          <div class="row">
          <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Parts</label>
              <select class="form-control" name="parts[]" id="partno1" >
                 
                        @if(isset($job))
                        <option value="{{ $job->part_id }}">{{ $job->part_no }}</option>
                   
                    @else
                  <option value="">Select Parts</option> 
                  @endif
                   @foreach($parts_list as $part)
                <option value="{{$part->part_id}}">{{$part->part_no}}</option>
                @endforeach
               
              </select>            
              </fieldset>
            </div>
            
           <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
                @if(isset($job))
                <input class="form-control" id="qty1" name="qnty[]" value="1"  id="placeholderInput"  type="number" readonly>
                @else
                <input class="form-control"  name="qnty[]" id="qty1" value="1"   id="placeholderInput"  type="number"  readonly>
@endif
                

              </fieldset>
            </div>
            
            
            <div class="col-lg-2">
              <fieldset class="form-group">
              <label>&nbsp;</label>
            <button type="button" class="btn btn-info pull-right answer_next"style="    margin-top: 34px;
">Add More</button>
            </fieldset>
            </div>
            
            <span id="Rows" class="wid_Row"></span>
            <button class="removediv hidden" style=" width: 33px;height: 36px;margin-top: 28px;" type="button" id="removediv"> <span aria-hidden="true">&times;</span></button>

                   <!-- <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Resolution Code</label>
                 <select class="form-control" readonly>
           @if(isset($job))
                        <option value="{{ $job->resolution_id }}">{{ $job->resolution_description }}</option>
                    @endif
                        @foreach($resolutions as $menu)
                            <option value="{{ $menu->resolution_id }}">{{$menu->resolution_description }}</option>
                        @endforeach
            </select>
            </fieldset>
          </div>
		    -->
		  	
        </div>
        <hr>
		
        <div class="row">
          
           
          
       
          
          </div>
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="newParts">
             @if(isset($job))
             <input type="hidden" name="job_id" value="{{$job->job_id }}">
             <input type="hidden" name="tech_id" value="{{$job->technician }}">
             <input type="hidden" name="location" value="{{$job->asp_location }}">
             <input type="hidden" name="part_id" value="{{$job->part_order_id }}">

             @endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Make Order </button>
              
                 
                </div>
              </form>	
                        </div>
						
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Create GRN
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
						<form action="{{url('/post-grn')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
               <div class="row">
   
               <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Job Id </label>
                 <input class="form-control" id="jobid2" name="jobid" type="text"  readonly>
   
                </fieldset>
             </div>
			 <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>GRn Id </label>
                 <input class="form-control" id="grnid" name="grnid" type="text"  readonly>
   
                </fieldset>
             </div><div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Product Replacement Id </label>		

                 <input class="form-control" id="prdrepid" name="prodct_rep_id" type="text"  readonly>
   
                </fieldset>
             </div>
             <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair2"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>
   
   
            
                </div>
            <hr>
   <!-- <div class="row">
   <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultygrn">
                                            <option value="">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomgrn">
                                            <option id="" value="">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolgrn">
                                            <option value="">Select Resolution Code</option> 
                                           

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
</div>
   
   <hr> -->
           <div class="row" id="amntdiv">
           <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product" id="product">
                   <option value="">Select Product</option>
                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                           @endforeach
                   </select>
                   </fieldset>
            </div>
   
           
   
               <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Account No</label>
   
                 <input class="form-control"  name="dealer_accnt_no" id="dealer_accnt_no"  type="text">
   
               </fieldset>
               </div> -->
   
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Reason For Return</label>
   
                 <input class="form-control"  name="reason" id="reason"  type="text" >
   
               </fieldset>
               </div>
               <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Quantity</label>
   
                 <input class="form-control"  name="qnty" id="qnty"  type="number" required>
   
               </fieldset>
               </div> -->
               <div class="col-lg-4 ">
           <fieldset class="form-group ">
                 <label>Serial Number</label>
   
                 <input class="form-control" type="text" id="seriel" name="seriel_no"
                 />   
               </fieldset>
               </div>
   
             </div>
             
    <hr>
   <div class="row">
   
   <div class="col-lg-6">


           <fieldset class="form-group">
                 <label>Technical problem-Attach proof of purchase & Tech forum &nbsp;</label>
   
                 <input type="checkbox" class="" id="tech_prob" name="tech_proof"
               value="1" />
  
               </fieldset>
               
              
           <fieldset class="form-group">
                 <label>Dented /Damaged Transit&nbsp;</label>
   
                 <input type="checkbox" id="dented" name="dented"
               value="1"  />   
               </fieldset>
            
          
           <fieldset class="form-group">
                 <label>Photography Of Tss Do,or shipping label&nbsp; </label>
   
                 <input type="checkbox" class="" id="photogr" name="photo"
               value="1"  />   
               </fieldset>
             
               
           <fieldset class="form-group">
                 <label>Complete Return Of Acc/WTY card/Manual&nbsp;</label>
   
                 <input type="checkbox" id="returnacc" name="ret_acc"
               value="1"  />   
               </fieldset>
             
               </div>
          
             

               <div class="col-lg-4">
             

                <fieldset class="form-group">
                 <label>Spare Part No</label>
   
                 <input class="form-control"  name="part_no" id="grnspare"  type="text" >
   
               </fieldset>
      
               </div>
               
   </div>

   
   <hr>
   <div class="row">
  
               <div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credit note &nbsp;
                                             <input type="radio" name="approve" value="2"> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
               
               <div class="col-lg-4 ">
           <fieldset class="form-group amont hidden">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" id="credit_not" name="credit_not"
                 />   
               </fieldset>
               <fieldset class="form-group ex_number hidden">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" id="ex_number" name="ex_number"
                />   
               </fieldset>
               </div>
               <div class="col-lg-4 ">
               <fieldset class="form-group amont hidden">
                 <label>Amount(RM)</label>
   
                 <input class="form-control" type="text" id="amount" name="amount"
                 />   
               </fieldset>
               </div>
   </div>
   <hr>
   <div class="row">
   <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Application Date</label>
   
                 <input class="form-control"  name="appl_date" id="appl_date1"  type="text" >
   
               </fieldset>
               </div> -->
              
               <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Complaint Date</label>
   
                 <input class="form-control"  name="comp_date" id="comp_date"  type="text" >
   
               </fieldset>
               </div> -->
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Goods Receive Date</label>
   
                 <input class="form-control"  name="goods_date" id="goods_date"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                 <input class="form-control"  name="purchase_date" id="purchase_date"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
           <label for="exampleInputFile">Image</label>
                                                   <div class="col-sm-10">
                                                   <input id="Image"  type="file" name="files"/>
     
                                               </div>
   
               </fieldset>
               </div>
</div>
<hr>
         
   
   
   
           <div class="col-md-12 cenbut">
       <input type="hidden" name="type" value="newrma">
   
       @if(isset($job))
                    <input type="hidden" name="location" value="{{$job->location}}">
@endif
   
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">
   
   
                   </div>
                 </form>
                        </div>
                    </div>
                </div>
				<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingfor">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
                            Create RMA
                            </a>
                        </h4>
                    </div>
                    <div id="collapsefor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfor">
                        <div class="panel-body">
						<form action="{{url('/post-rma')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
            <div class="row">

            <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="jobid11"  name="jobid" type="text"  readonly>

             </fieldset>
          </div>
		   <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>RMA Id </label>
              <input class="form-control" id="rmaid"  name="rmaid" type="text"  readonly>

             </fieldset>
          </div>
		   <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="prod_rep_id"  name="prdrepid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Repair Order No </label>
              <input class="form-control" id="repair3" name="repaire_order_no" type="text"  readonly>
             </fieldset>
          </div>


          
             </div>
		

<!-- <div class="row">
<div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultyrma">
                                            <option value="0">Select Faulty Code</option>
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomrma">
                                            <option value="0">Select Symptom Code</option>
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolrma">
                                            <option value="0">Select Resolution Code</option>
                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
                                
</div>
<hr> -->

         <div class="row" id="amntdiv">
        <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                 <input class="form-control"  name="purchase_date" id="purchase_date1"  type="text" >
   
               </fieldset>
               </div>
        <!-- <div class="col-lg-4">
                <fieldset class="form-group">
                <label>Product</label>
                <select class="form-control" name="product">
                <option value="">Select Product</option>
                        @foreach($products as $menu)
                            <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                        @endforeach
                </select>
                </fieldset>
             </div>
             <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Serial Number</label>
   
                 <input class="form-control"  name="ser_num" id="rmaseriel"  type="text" >
   
               </fieldset>
               </div> -->
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Warranty Card Number</label>
   
                 <input class="form-control"  name="warr_num" id="warcard"  type="text" >
   
               </fieldset>
               </div>
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Panel Serial No</label>

              <input class="form-control"  name="panel_serial_no" id="panser"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Panel Model</label>
   
                 <input class="form-control"  name="panel_model" id="panmod"  type="text" >
   
               </fieldset>
               </div>
              

            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Main Dealer Account No</label>

              <input class="form-control"  name="dealer_accnt_no" id="accnt"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Complaints</label>

              <textarea class="form-control"  name="reason" id="compl"  type="text" ></textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Reason For Return</label>

               <textarea class="form-control"  name="reason" id="rmares"  type="text"  ></textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
        <label for="exampleInputFile">Picture Of Symptom</label>
                                                <div class="col-sm-10">
                                                <input id="Image"  type="file" name="files"/>
                                            </div>
            </fieldset>
            </div>

          </div>


 <hr>


            
               <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Application Date</label>
   
                 <input class="form-control"  name="appl_date" id="appl_date2"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label> Date Received</label>
   
                 <input class="form-control"  name="date_rece" id="date_rece2"  type="text" >
   
               </fieldset>
               </div> -->



<div class="row">
<div class="col-lg-4">
<fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credit note &nbsp;
                                             <input type="radio" name="approve" value="2"> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
               
               <div class="col-lg-4 ">
           <fieldset class="form-group amont hidden">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" id="credit_not" name="credit_not"
                 />   
               </fieldset>
               <fieldset class="form-group ex_number hidden">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" id="ex_number" name="ex_number"
                />   
               </fieldset>
               </div>
               <div class="col-lg-4 ">
               <fieldset class="form-group amont hidden">
                 <label>Amount(RM)</label>
   
                 <input class="form-control" type="text" id="amount" name="amount"
                 />   
               </fieldset>
               </div>
</div>
<hr>
<h4>Symptom/Defect</h4>
<div class="row">
<div class="col-lg-12">
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Line &nbsp;</label>
   
                 <input type="checkbox" id="vert_line" name="vert_line"
               value="1"  />   
               </fieldset>
               </div>
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Block&nbsp;</label>
   
                 <input type="checkbox" id="vert_block" name="vert_block"
               value="1"  />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Line&nbsp;</label>
   
                 <input type="checkbox" id="hori_line" name="hori_line"
               value="1"  />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Block&nbsp;</label>
   
                 <input type="checkbox" id="hori_block" name="hori_block"
               value="1"  />   
               </fieldset>
               </div>
           
               <div class="lft">
           <fieldset class="form-group">
                 <label>No Display&nbsp;</label>
   
                 <input type="checkbox" id="no_disp" name="no_disp"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Colour&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_colour" name="abnorm_colour"
               value="1"  />   
               </fieldset>
               </div>



<div class="lft">
           <fieldset class="form-group">
                 <label>Uniformity Defect&nbsp;</label>
   
                 <input type="checkbox" id="unif_defect" name="unif_defect"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Dot screen&nbsp;</label>
   
                 <input type="checkbox" id="dot_screen" name="dot_screen"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>White Screen&nbsp;</label>
   
                 <input type="checkbox" id="whit_screen" name="whit_screen"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Flicker&nbsp;</label>
   
                 <input type="checkbox" id="flicker" name="flicker"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Black Light Defect&nbsp;</label>
   
                 <input type="checkbox" id="blck_defct" name="blck_defct"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Picture&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_pic" name="abnorm_pic"
               value="1"  />   
               </fieldset>
               </div>
              
    




</div></div>


<hr>
           <div class="row">
               <div class="col-lg-2">
           <fieldset class="form-group">
                 <label>Others</label>
   
                 <textarea type="text" id="other" name="other"
               value="1"  /> </textarea  
               </fieldset>
               </div>
</div>


		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newrma">
    @if(isset($job))
                    <input type="hidden" name="location" value="{{$job->location}}">
@endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">


                </div>
              </form>
                        </div>
                    </div>
                </div>
				<div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingfive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                Claim
                            </a>
                        </h4>
                    </div>
                    <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                        <div class="panel-body">
                        <form id="claimform">
            <div class="row">
        
            <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="jobid1" name="jobid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Repair Order No </label>
              <input class="form-control" id="repair4"  name="repaire_order_no" type="text"  readonly>
             </fieldset>
          </div>
          </div>
		
		
		   
		 <!-- <hr>
		
         <div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultycc">
                                            <option value="">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomcc">
                                            <option value="">Select Symptom Code</option>
                                            
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolcc">
                                            <option value="">Select Resolution Code</option> 
                                            

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
                                
</div> 
<hr> -->
		
        <div class="row" id="amntdiv">

        <div class="col-lg-4">
                <fieldset class="form-group">
              <label>Mileage</label>
            
              <input class="form-control"  name="mileage" id="mileage" value=""  type="text">
                 
            </fieldset>
            </div>
         
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Claim Amount</label>
            
              <input class="form-control"  name="amount" id="claim_amount" value=""  type="text" readonly>
             
            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Labour</label>
            
              <input class="form-control"  name="labour" id="labour"  type="text">
             
            </fieldset>
            </div>
            
            
          
          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newClaim">
    @if(isset($job))
             <input type="hidden" name="claim_id" value="{{$job->claim_id }}">
             @endif
                    <input type="hidden" name="claim_id" value="">
              
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10"> Submit </button>
              
                 
                </div>
              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                                 
                                  
                                    </div> 
                                </div>
                            <hr>
                       
                               
                               
                              
                          
                          




        </div>
        
      </div>
    </div>
  </div>

    <!-- /.content-wrapper -->
    <div class="modal fade" id="apptModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Appointment </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        

              <form id="ajaxForm">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control"  id="job22id" name="job_idapp"  type="text" readonly>
            </fieldset>
          </div>
         
          </div>
		  <hr>
		
		   <div class="row">
         
          <!-- <div class="col-lg-4">
            <fieldset class="form-group">
              <label>First Name</label>
              
              <input class="form-control" id="firstname"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Last Name</label>
              <input class="form-control" id="lastname"   id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div> -->
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Address</label>
              <textarea class="form-control" id="address"  type="text" readonly></textarea>
            </fieldset>
          </div>
		   
		  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Phone No</label>
              <input class="form-control" id="phone22"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Bussiness Number</label>
              <input class="form-control" id="business"   type="text" readonly>
            </fieldset>
          </div>
         
        </div>
		 <hr>
		
			<div class="row">
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Faulty Code</label>
             
              <input class="form-control" id="faulty" name="faulty"  type="text" readonly>

            </fieldset>
          </div> 
         
        
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Symptom Code</label>
              <input class="form-control" id="symptom" name="symptom"  type="text" readonly>

            </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Resolution Code</label>
              <input class="form-control" id="resol" name="resolution"  type="text" readonly>

            </fieldset>
          </div>
		   
		  	
        </div>
        <hr>
		
        <div class="row">


          
        <div class="col-lg-4 select-pane">
        <fieldset class="form-group">
              <label>Appointment Date</label>
             
              <input class="form-control" name="datepicker" id="datepicker"  type="text">
              
            </fieldset>
            </div>
            <div class="col-lg-4 select-pane">
        <fieldset class="form-group">
              <label>Appointment Time</label>
           
                    <input class="form-control" name="time"  id="value_Date_Listed_1"  type="text" recquired >

            </fieldset>
            </div>
           

          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newAppointmentTech">
    @if(isset($job))
    <input type="hidden" name="job_id" value="{{$job->job_id}}">
    <input type="hidden" name="app_id" value="{{$job->appointment_id}}">

@endif
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Make Appointment </button>
              
                 
                </div>
              </form>
           
        </div>
        
      </div>
    </div>
  </div>





    <!-- <div class="modal fade" id="partsModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Parts Order </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="partsform">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
            
            <label>Job Id</label>
              <input class="form-control" id="jobidparts" name="jobid"  type="text" readonly>
             
            
            </fieldset>
          </div>
          </div>
		  <hr>
		
		   <div class="row">
         
          
        </div>
		 <hr>
		
			<div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultyparts">
                                            <option id="part_faulty" value="">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomparts">
                                            <option id="part_symptom" value="">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolparts">
                                            <option id="part_resol" value="">Select Resolution Code</option> 
                                            

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        </div>
                                        </div>
                                    <hr>  
                              <div class="row">
                              <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Remark</label>
              <textarea class="form-control" id="remark" name="remark"  type="text"></textarea>

            </fieldset>
          </div>
                              </div>
          <div class="row">
          <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Parts</label>
              <select class="form-control" name="parts[]" >
                 
                        @if(isset($job))
                        <option value="{{ $job->part_id }}">{{ $job->part_no }}</option>
                   
                    @else
                  <option value="">Select Parts</option> 
                  @endif
                   @foreach($parts_list as $part)
                <option value="{{$part->part_id}}">{{$part->part_no}}</option>
                @endforeach
               
              </select>            
              </fieldset>
            </div>
            
           <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
                @if(isset($job))
                <input class="form-control"  name="qnty[]" value="{{$job->parts_qty}}"  id="placeholderInput"  type="number">
                @else
                <input class="form-control"  name="qnty[]"   id="placeholderInput"  type="number" >
@endif
                

              </fieldset>
            </div>
            
            
            <div class="col-lg-2">
              <fieldset class="form-group">
              <label>&nbsp;</label>
            <button type="button" class="btn btn-info pull-right answer_next"style="    margin-top: 30px;
">Add More</button>
            </fieldset>
            </div>
            
            <span id="Rows" class="wid_Row"></span>
            <button class="removediv hidden" style=" width: 33px;height: 36px;margin-top: 28px;" type="button" id="removediv"> <span aria-hidden="true">&times;</span></button>

		  	
        </div>
        <hr>
		
        <div class="row">
          
           
          
       
          
          </div>
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="newParts">
             @if(isset($job))
             <input type="hidden" name="job_id" value="{{$job->job_id }}">
             <input type="hidden" name="tech_id" value="{{$job->technician }}">
             <input type="hidden" name="location" value="{{$job->asp_location }}">
             <input type="hidden" name="part_id" value="{{$job->part_order_id }}">

             @endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Make Order </button>
              
                 
                </div>
              </form>
        </div>
        
      </div>
    </div>
  </div>




<div class="modal fade" id="claimModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Claim Requests </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        

               <form id="claimform">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="jobid1"  name="jobid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Repair Order No </label>
              <input class="form-control" id="repair"  name="repaire_order_no" type="text"  readonly>
             </fieldset>
          </div>
          </div>
		
		
		   
		 <hr>
		
         <div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="falcc">
                                            <option value="">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symcc">
                                            <option value="">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolcc">
                                            <option value="">Select Resolution Code</option> 
                                            

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
                                
</div> 
<hr>
		
        <div class="row" id="amntdiv">

        <div class="col-lg-4">
                <fieldset class="form-group">
              <label>Mileage</label>
            
              <input class="form-control"  name="mileage" id="mileage" value=""  type="text">
                    
            </fieldset>
            </div>
         
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Claim Amount</label>
            
              <input class="form-control"  name="amount" id="claim_amount" value=""  type="text" readonly>
             
            </fieldset>
            </div>
            
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Labour</label>
            
              <input class="form-control"  name="labour" id="labour"  type="text">
             
            </fieldset>
            </div>
            
            
          
          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newClaim">
    @if(isset($job))
             <input type="hidden" name="claim_id" value="{{$job->claim_id }}">
             @endif
                    <input type="hidden" name="claim_id" value="">
              
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10"> Submit </button>
              
                 
                </div>
              </form>
           
        </div>
        
      </div>
    </div>
  </div>


    
<div class="modal fade" id="rmaModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create RMA </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

 <form action="{{url('/post-rma')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
            <div class="row">

            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="jobid11"  name="jobid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Repair Order No </label>
              <input class="form-control" id="repair11" name="repaire_order_no" type="text"  readonly>
             </fieldset>
          </div>


         
             </div>
		 <hr>

<div class="row">
<div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultyrma">
                                            <option value="0">Select Faulty Code</option>
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomrma">
                                            <option value="0">Select Symptom Code</option>
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolrma">
                                            <option value="0">Select Resolution Code</option>
                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
                                
</div>
<hr>


          <div class="row" id="amntdiv">
        <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                 <input class="form-control"  name="purchase_date" id="purchase_date1"  type="text" >
   
               </fieldset>
               </div>
        <div class="col-lg-4">
                <fieldset class="form-group">
                <label>Product</label>
                <select class="form-control" name="product">
                <option value="">Select Product</option>
                        @foreach($products as $menu)
                            <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                        @endforeach
                </select>
                </fieldset>
             </div>
             <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Serial Number</label>
   
                 <input class="form-control"  name="ser_num" id="ser_num"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Warranty Card Number</label>
   
                 <input class="form-control"  name="warr_num" id="warr_num"  type="text" >
   
               </fieldset>
               </div>
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Panel Serial No</label>

              <input class="form-control"  name="panel_serial_no" id="panel_serial_no"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Panel Model</label>
   
                 <input class="form-control"  name="panel_model" id="panel_model"  type="text" >
   
               </fieldset>
               </div>
              

            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Main Dealer Account No</label>

              <input class="form-control"  name="dealer_accnt_no" id="dealer_accnt_no"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Complaints</label>

              <textarea class="form-control"  name="reason" id="reason"  type="text" ></textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Reason For Return</label>

               <textarea class="form-control"  name="reason" id="reason"  type="text"  ></textarea>

            </fieldset>
            </div>


          </div>


 <hr>
<div class="row">
<div class="col-lg-4">
        <fieldset class="form-group">
        <label for="exampleInputFile">Picture Of Symptom</label>
                                                <div class="col-sm-10">
                                                <input id="Image"  type="file" name="files"/>
                                            </div>
            </fieldset>
            </div>
            <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Application Date</label>
   
                 <input class="form-control"  name="appl_date" id="appl_date11"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label> Date Received</label>
   
                 <input class="form-control"  name="date_rece" id="date_rece11"  type="text" >
   
               </fieldset>
               </div>
</div>

<hr>
<div class="row">
<div class="col-lg-4">
<fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credit note &nbsp;
                                             <input type="radio" name="approve" value="2"> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
               
               <div class="col-lg-4 ">
           <fieldset class="form-group amont hidden">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" id="credit_not" name="credit_not"
                 />   
               </fieldset>
               <fieldset class="form-group ex_number hidden">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" id="ex_number" name="ex_number"
                />   
               </fieldset>
               </div>
               <div class="col-lg-4 ">
               <fieldset class="form-group amont hidden">
                 <label>Amount(RM)</label>
                 
                 <input class="form-control" type="text" id="amount" name="amount"
                 />   
               </fieldset>
               </div>
</div>
<hr>
<h4>Symptom/Defect</h4>
<div class="row">
<div class="col-lg-12">
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Line &nbsp;</label>
   
                 <input type="checkbox" id="vert_line" name="vert_line"
               value="1"  />   
               </fieldset>
               </div>
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Block&nbsp;</label>
   
                 <input type="checkbox" id="vert_block" name="vert_block"
               value="1"  />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Line&nbsp;</label>
   
                 <input type="checkbox" id="hori_line" name="hori_line"
               value="1"  />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Block&nbsp;</label>
   
                 <input type="checkbox" id="hori_block" name="hori_block"
               value="1"  />   
               </fieldset>
               </div>
           
               <div class="lft">
           <fieldset class="form-group">
                 <label>No Display&nbsp;</label>
   
                 <input type="checkbox" id="no_disp" name="no_disp"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Colour&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_colour" name="abnorm_colour"
               value="1"  />   
               </fieldset>
               </div>



<div class="lft">
           <fieldset class="form-group">
                 <label>Uniformity Defect&nbsp;</label>
   
                 <input type="checkbox" id="unif_defect" name="unif_defect"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Dot screen&nbsp;</label>
   
                 <input type="checkbox" id="dot_screen" name="dot_screen"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>White Screen&nbsp;</label>
   
                 <input type="checkbox" id="whit_screen" name="whit_screen"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Flicker&nbsp;</label>
   
                 <input type="checkbox" id="flicker" name="flicker"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Black Light Defect&nbsp;</label>
   
                 <input type="checkbox" id="blck_defct" name="blck_defct"
               value="1"  />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Picture&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_pic" name="abnorm_pic"
               value="1"  />   
               </fieldset>
               </div>
              
    


</div></div>


<hr>
           <div class="row">
               <div class="col-lg-2">
           <fieldset class="form-group">
                 <label>Others</label>
   
                 <textarea type="text" id="other" name="other"
               value="1"  /> </textarea  
               </fieldset>
               </div>
</div>



		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newrma">
    @if(isset($job))
                    <input type="hidden" name="location" value="{{$job->location}}">
@endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">


                </div>
              </form>

        </div>

      </div>
    </div>
  </div>     
  
  <div class="modal fade" id="grnModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create GRN </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


             <form action="{{url('/post-grn')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
               <div class="row">
   
               <div class="col-lg-4">
               <fieldset class="form-group">
                 <label>Job Id </label>
                 <input class="form-control" id="jobid2" name="jobid" type="text"  readonly>
   
                </fieldset>
             </div>
             <div class="col-lg-4">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair2"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>
   
   
            
                </div>
            <hr>
   
            <div class="row">
   <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faultygrn">
                                            <option value="0">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptomgrn">
                                            <option value="0">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolgrn">
                                            <option value="0">Select Resolution Code</option> 
                                             

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
</div>
<hr>
   
           <div class="row" id="amntdiv">
           <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Product</label>
                   <select class="form-control" name="product">
                   <option value="">Select Product</option>
                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                           @endforeach
                   </select>
                   </fieldset>
                </div>
   
           
   
              
   
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Reason For Return</label>
   
                 <input class="form-control"  name="reason" id="reason"  type="text">
   
               </fieldset>
               </div>
               
               <div class="col-lg-4 ">
           <fieldset class="form-group ">
                 <label>Seriel Number</label>
   
                 <input class="form-control" type="text" id="seriel_no" name="seriel_no"
                 />   
               </fieldset>
               </div>
   
             </div>
             
    <hr>
   
    <div class="row">
   
   <div class="col-lg-6">


           <fieldset class="form-group">
                 <label>Technical problem-Attach proof of purchase & Tech forum &nbsp;</label>
   
                 <input type="checkbox" class="" id="scales1" name="tech_proof"
               value="1"  />   
               </fieldset>
               
              
           <fieldset class="form-group">
                 <label>Dented /Damaged Transit&nbsp;</label>
   
                 <input type="checkbox" id="scales2" name="dented"
               value="1"  />   
               </fieldset>
            
          
           <fieldset class="form-group">
                 <label>Photography Of Tss Do,or shipping label&nbsp; </label>
   
                 <input type="checkbox" class="" id="scales3" name="photo"
               value="1"  />   
               </fieldset>
             
               
           <fieldset class="form-group">
                 <label>Complete Return Of Acc/WTY card/Manual&nbsp;</label>
   
                 <input type="checkbox" id="scales4" name="ret_acc"
               value="1"  />   
               </fieldset>
             
               </div>
          
             

               <div class="col-lg-4">
             

                <fieldset class="form-group">
                 <label>Spare Part No</label>
   
                 <input class="form-control"  name="part_no" id="part_no"  type="text" >
   
               </fieldset>
      
               </div>
               
   </div>
   <hr>
   <div class="row">
  
               <div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credit note &nbsp;
                                             <input type="radio" name="approve" value="2"> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
               
               <div class="col-lg-4 ">
           <fieldset class="form-group amont hidden">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" id="credit_not" name="credit_not"
                 />   
               </fieldset>
               <fieldset class="form-group ex_number hidden">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" id="ex_number" name="ex_number"
                />   
               </fieldset>
               </div>
               <div class="col-lg-4 ">
               <fieldset class="form-group amont hidden">
                 <label>Amount(RM)</label>
   
                 <input class="form-control" type="text" id="amount" name="amount"
                 />   
               </fieldset>
               </div>
   </div>
   <hr>
           <div class="row" id="amntdiv">
           <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Application Date</label>
   
                 <input class="form-control"  name="appl_date" id="appl_date1"  type="text" >
   
               </fieldset>
               </div>
              
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Complaint Date</label>
   
                 <input class="form-control"  name="compl_date" id="compl_date1"  type="text" >
   
               </fieldset>
               </div>
           <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                 <input class="form-control"  name="purchase_date" id="purchase_date"  type="text" >
   
               </fieldset>
               </div>
              
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Goods Receive Date</label>
   
                 <input class="form-control"  name="goods_date" id="goods_date"  type="text" >
   
               </fieldset>
               </div>
   
               <div class="col-lg-4">
           <fieldset class="form-group">
           <label for="exampleInputFile">Image</label>
                                                   <div class="col-sm-10">
                                                   <input id="Image"  type="file" name="files"/>
     
                                               </div>
   
               </fieldset>
               </div>
   
   
   
   
             </div>
   
   
   
           <div class="col-md-12 cenbut">
       <input type="hidden" name="type" value="newrma">
       @if(isset($job))
                       <input type="hidden" name="location" value="{{$job->location}}">
   @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">
   
   
                   </div>
                 </form>

        </div>

      </div>
    </div>
  </div> -->
  <div id="CustomerNotModal" class="modal fade">
        <div class="modal-dialog">
            <form id="CustomerNotInForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jobidcus" type="hidden" name="jobidcus" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="customer_not_in" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm??</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div id="WaitServiceModal" class="modal fade">
        <div class="modal-dialog">
            <form id="WaitService">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jobidser" type="hidden" name="jobidser" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="wait_serv_mat" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm??</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>


     <div id="WaitTechModal" class="modal fade">
        <div class="modal-dialog">
            <form id="WaitTech">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jobsup" type="hidden" name="jobsup" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="tech_suport" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm??</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="AspSpoil" class="modal fade">
        <div class="modal-dialog">
            <form id="asp_spoil">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_spoil" type="hidden" name="jo_id_spoil" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="asp_spoil" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="Estimate" class="modal fade">
        <div class="modal-dialog">
            <form id="estimate">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_est" type="hidden" name="jo_id_est" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="estimate" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="EmailUpdate" class="modal fade">
        <div class="modal-dialog">
            <form id="email_update">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_email" type="hidden" name="jo_id_email" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="email_update" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="RequestCn" class="modal fade">
        <div class="modal-dialog">
            <form id="req_cn">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_cn" type="hidden" name="jo_id_cn" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="request_cn" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="RequestEx" class="modal fade">
        <div class="modal-dialog">
            <form id="req_ex">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_ex" type="hidden" name="jo_id_ex" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="request_ex" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="HardCopy" class="modal fade">
        <div class="modal-dialog">
            <form id="hard_copy">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_cpy" type="hidden" name="jo_id_cpy" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="hard_copy" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="TechSup" class="modal fade">
        <div class="modal-dialog">
            <form id="tech_support">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_suport" type="hidden" name="jo_id_suport" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="tech_support" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="ExhangeComp" class="modal fade">
        <div class="modal-dialog">
            <form id="exchange_comp">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_ex_com" type="hidden" name="jo_id_ex_com" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="exchange_comp" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="PendPart" class="modal fade">
        <div class="modal-dialog">
            <form id="pend_part">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_part" type="hidden" name="jo_id_part" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="pend_part" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="DelGrn" class="modal fade">
        <div class="modal-dialog">
            <form id="del_grn">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_grn" type="hidden" name="jo_id_grn" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="del_grn" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="DelRma" class="modal fade">
        <div class="modal-dialog">
            <form id="del_rma">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="jo_id_rma" type="hidden" name="jo_id_rma" value="" />
                        <input id="status" type="hidden" name="status" value="" />
                        <input type="hidden" name="type"   value="del_rma" />                    
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Change Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title">Request Successfully Created</h4> 

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
    
   
     </div>
    
   </div>
 </div>
</div>
</div>
@endsection

@section('footer')
<script src="{{ asset('assets/admin/js/wickedpicker.min.js')}}"></script>

<!-- <script src="{{ asset('assets/admin/js/jquery.fileupload.js')}}"></script>
<script src="{{ asset('assets/admin/fileupload/jquery.ui.widget.js')}}"></script>

<script src="{{ asset('assets/admin/fileupload/jquery.iframe-transport.js')}}"></script> -->
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
    <!-- <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script> -->
    <script>
        $(document).ready(function(){
            jQuery('#datepicker').datetimepicker({
                format: 'd-m-y',
                minDate:new Date()
 
});
jQuery('#purchase_date').datetimepicker({
                format: 'd-m-y',
                minDate:new Date()
});
jQuery('#appl_date11').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#date_rece11').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
$('#value_Date_Listed_1').wickedpicker({
    showInputs: false,
});
jQuery('#appl_date1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#compl_date1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
   jQuery('#goods_date').datetimepicker({
                format: 'd-m-y',
                minDate:new Date()
});
   jQuery('#purchase_date1').datetimepicker({
                format: 'd-m-y',
                minDate:new Date()
});
  $(".close").click(function(){
    location.reload(true);
});
$(".cl_no").click(function(){
    location.reload(true);

});
var max_fields      = 3; //maximum input boxes allowed
            var Rows         = $("#Rows"); //Fields wrapper
            var answer_next      = $(".answer_next"); //Add button ID

            $(answer_next).click(function(e){ e.preventDefault()
                $( "#removediv" ).removeClass("hidden");
$(Rows).append('<div class="container">'+'<div class="row">'+' <div class="col-lg-6">'+
                        '<fieldset class="form-group">'+
                        ' <label>Parts</label>'+
                        ' <select class="form-control" name="parts[]">'+
                        '<option value="">Select Parts</option> '+
                        @foreach($parts_list as $part)
                        ' <option value="{{$part->part_id}}">{{$part->part_no}}</option>'
                +                @endforeach
                        ' </select>'+
                        ' </fieldset>'+
                        ' </div>'+
                        '<div class="col-lg-6">'+
                        '<fieldset class="form-group">'+
                        ' <label> Parts Quantity</label>'+
                        ' <input class="form-control" name="qnty[]" value="1"   id="placeholderInput"  type="text" readonly> '+
                        ' </fieldset>'+
                        '</div>'+
						'</div>'+
                        '</div>'
                        
                    
                );


   });
   $('#removediv').on('click', function() {
    $(".remdiv").addClass('hidden');
    $(".removediv").addClass('hidden');

});
 $("#ajaxForm").validate({
    rules: {
        email: {
            required: true,
        },password: {
            required: true,
        },qnty: {
            required: true,
        }
    },
    messages: {
        name: {
            required: "Please enter  name ",
        }
    },
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },
    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#ajaxForm").serialize();

        $("#modal-body lodgif").html("Your formhas been successfully submitting...");
        $('#myModal').modal('show');
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                  window.location.href="{{URL::route('TechJobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});

$("#partsform").validate({
    rules: {
        email: {
            required: true,
        },password: {
            required: true,
        },files: {
            required: true,
        }
    },
    messages: {
        name: {
            required: "Please enter  name ",
        }
    },
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },
    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#partsform").serialize();

        $("#modal-body lodgif").html("Your formhas been successfully submitting...");
        $('#myModal').modal('show');
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                   window.location.href="{{URL::route('TechJobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});


$("#claimform").validate({
    rules: {
        email: {
            required: true,
        },password: {
            required: true,
        },files: {
            required: true,
        }
    },
    messages: {
        name: {
            required: "Please enter  name ",
        }
    },
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },
    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#claimform").serialize();
        $("#modal-body lodgif").html("Your formhas been successfully submitting...");
        $('#myModal').modal('show');
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                  window.location.href="{{URL::route('TechJobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});

//  var token = '{{ csrf_token() }}';

// var url = '{{ URL::route("PostImageUpload") }}';
// $('#Image').fileupload();
//        'use strict';
//     // Change this to the location of your server-side upload handler:
//     var url = url;
//     $('#Image').fileupload({
//     drop: function (e, data) {
//         $.each(data.files, function (index, file) {
//             alert('Dropped file: ' + file.name);
//         });
//     },
//     change: function (e, data) {
//         $.each(data.files, function (index, file) {
//             alert('Selected file: ' + file.name);
//         });
//     }
// });

// $("#rmaform").validate({
//     rules: {
//         email: {
//             required: true,
//         },password: {
//             required: true,
//         },files: {
//             required: true,
//         }
//     },
//     messages: {
//         name: {
//             required: "Please enter  name ",
//         }
//     },
//     errorPlacement: function(error, element) {
//         console.log(element.attr('name'));
//         $( error ).insertAfter( element);
//     },
//     submitHandler: function(form) {

//         // do other things for a valid form
//         var formData = $("#rmaform").serialize();
//       alert(formData);
//         $("#modal-body lodgif").html("Your formhas been successfully submitting...");
//         $('#myModal').modal('show');
//         $.ajax({
//             type: 'post',
//             url: "{{ URL::route('postData') }}",
//             data:formData,
//             success: function(data){
//                 setInterval(function(){
//                     $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
//                     $('#myModal').modal('show');
//                   // window.location.href="{{URL::route('TechJobs')}}";
//                 }, 1500);

//             }
//         });
//         return false;
//     }
// });
$('#mileage').change(function() {
        var status =this.value;
        var token = "{{ csrf_token() }}";
     var type = 'claim_amount';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                if(data.status==1){
                     
                     $("#claim_amount").val(data.amount);
                    
                 }
                 else if(data.status==3){
                     alert('Data Not Found');
                 }

             }
         });
    });
    $('input:radio').change(function() {      
        var crd = $("input[name='approve']:checked").val(); 
    
    if(crd==1)
    {
        $(".amont").show();
        $(".credit_not").show();
        $(".ex_number").hide();
    }else{
        $(".ex_number").show();
        $(".amont").hide();
        $(".credit_not").show();
    }

})  
            $('.changestatus').on('change', function() {
            
                var status =this.value;
              
         //var job_id = $(this).attr("data-id");
        // if(status == 15){
            
        //     $('#apptModal').modal('show');
        // }
        
        var job_id = $(this).attr("data-id");
       
     var sympt = $(this).attr("data-sym");
     var fal_id = $(this).attr("data-fal");

     var res_id = $(this).attr("data-res");

     var symptom = $(this).attr("data-symptom");
     var faulty = $(this).attr("data-faulty");
     var resol = $(this).attr("data-resol");
     var repair = $(this).attr("data-repair");
     var fname = $(this).attr("data-fname");
     var lname = $(this).attr("data-lname");
     var addrs = $(this).attr("data-addrs");
     var phn = $(this).attr("data-phn");
    
     var bus = $(this).attr("data-bus");

      var part_no =$(this).attr("data-partno");
     var part_desc =$(this).attr("data-partdesc");
     var part_qty =$(this).attr("data-partqty");
     var part_id =$(this).attr("data-partid");
     var part_rem =$(this).attr("data-partrem");

     var grn_spare =$(this).attr("data-grnspare");
     
     var tech_prob =$(this).attr("data-techprob");
 //GRN  
     var dented =$(this).attr("data-dented");
     var photogr =$(this).attr("data-photogr");
     var returnacc =$(this).attr("data-returnacc");
     var pur_date =$(this).attr("data-purdate");
     var appl_date =$(this).attr("data-appldate");
     var comp_date =$(this).attr("data-compdate");
     var goods_date =$(this).attr("data-gooddate");
     var model =$(this).attr("data-mod");
     var grn_res =$(this).attr("data-grnres");
     var grn_seriel =$(this).attr("data-grnseriel");
//RMA
    var rma_spare =$(this).attr("data-rmaspare");
    var rma_seriel =$(this).attr("data-rmaseriel");
    var warcard =$(this).attr("data-warcard");
    var panser =$(this).attr("data-panser");
    var panmod =$(this).attr("data-panmod");
    var accnt =$(this).attr("data-accnt");
    var compl =$(this).attr("data-compl");
    var rmares =$(this).attr("data-rmares");
    var rmaappl =$(this).attr("data-rmaappl");
    var rma_pur =$(this).attr("data-rmapurchase");
    var date_rec =$(this).attr("data-daterec");
    var other =$(this).attr("data-othe");
//Claim
  var grnid =$(this).attr("data-grnid");

			    var rmaid =$(this).attr("data-rmaid");
				
			    var prdrepid =$(this).attr("data-prdrepid");
 var mileage =$(this).attr("data-mileage");
    var cl_amount =$(this).attr("data-clamount");
    var labour =$(this).attr("data-labour");
//JOB
var job_loc =$(this).attr("data-jobloc");

var remar_job =$(this).attr("data-jobremark");
    var fround =$(this).attr("data-fround");
   
    var descr =$(this).attr("data-jobdesc");
   
    var asp_loc =$(this).attr("data-asploc");
     if(status == 71){
            
                $('#apptModal').modal('show');
                $('#job22id').val(job_id);
        $('#resol').val(resol);
        $('#faulty').val(faulty);
        $('#symptom').val(symptom);
        $('#firstname').val(fname);
        $('#lastname').val(lname);
       
        $('#address').val(addrs);
        $('#phone22').val(phn);
        $('#business').val(bus);

             }
     
    if(status == 76){
       window.location = "{{ URL::route("PendingTech") }}/"+job_id;

    }
    if(status == 63){
      window.location = "{{ URL::route("PendingTech") }}/"+job_id;

    }

          if(status == 64){
          window.location = "{{ URL::route("PendingTech") }}/"+job_id;

        }
        if(status == 67){
          window.location = "{{ URL::route("PendingTech") }}/"+job_id;

        }
        if(status == 80){
            $('#jobidcus').val(job_id);
            $('#CustomerNotModal').modal('show');

        }
        // if(status == 23){
        //     $('#jobidcus').val(job_id);
        //     $('#CustomerNotModal').modal('show');

        // }
        if(status == 75){
            $('#jo_id_spoil').val(job_id);
            $('#AspSpoil').modal('show');

        }
        if(status == 83){
            $('#jo_id_est').val(job_id);
            $('#Estimate').modal('show');

        }
        if(status == 84){
            $('#jo_id_email').val(job_id);
            $('#EmailUpdate').modal('show');

        }
        if(status == 87){
            $('#jo_id_cn').val(job_id);
            $('#RequestCn').modal('show');

        }
        if(status == 88){
            $('#jo_id_ex').val(job_id);
            $('#RequestEx').modal('show');

        }
        if(status == 92){
            $('#jo_id_cpy').val(job_id);
            $('#HardCopy').modal('show');

        }
        if(status == 95){
            $('#jo_id_suport').val(job_id);
            $('#TechSup').modal('show');

        }
        if(status == 96){
            $('#jo_id_ex_com').val(job_id);
            $('#ExhangeComp').modal('show');

        }
        if(status == 101){
            $('#jo_id_part').val(job_id);
            $('#PendPart').modal('show');

        }
        if(status == 102){
            $('#jo_id_grn').val(job_id);
            $('#DelGrn').modal('show');

        }
        if(status == 103){
            $('#jo_id_rma').val(job_id);
            $('#DelRma').modal('show');

        }
        $("#del_rma").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#del_rma").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#del_grn").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#del_grn").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#pend_part").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#pend_part").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#tech_support").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#tech_support").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
       $("#exchange_comp").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#exchange_comp").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#hard_copy").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#hard_copy").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#req_ex").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#req_ex").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#req_cn").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#req_cn").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#email_update").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#email_update").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#estimate").validate({
           
           errorPlacement: function(error, element) {
               console.log(element.attr('name'));
               $( error ).insertAfter( element);
           },

           submitHandler: function(form) {

               // do other things for a valid form
               var formData = $("#estimate").serialize();

               $.ajax({
                   type: 'post',
                   url: "{{ URL::route('postData') }}",
                   data:formData,
                   success: function(data){
                       if(data.status == 1){

                           $('.modal-body').html('Successfully Assigned');
                           $('#modalFooter').addClass('hidden');
                           setTimeout(function(){
                               location.reload();
                           },1000);

                       }
                   }
               });
               return false;
           }

       });
        $("#asp_spoil").validate({
           
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#asp_spoil").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html('Successfully Assigned');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });
$("#CustomerNotInForm").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#CustomerNotInForm").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html('Successfully Assigned');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });


             if(status == 79){
            $('#jobidser').val(job_id);
            $('#WaitServiceModal').modal('show');

        }
        $("#WaitService").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#WaitService").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html('Successfully Assigned');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });






             if(status == 91){
            $('#jobsup').val(job_id);
            $('#WaitTechModal').modal('show');

        }
        $("#WaitTech").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#WaitTech").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html('Successfully Assigned');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });

        //    var type = 'ChangeStatus';

        //                         $.ajax({

        //                             type:'post',

        //                             url:"{{ URL::route('postData') }}",

        //                             data:{status:status,job_id:job_id,_token: '{{ csrf_token() }}',type:type},

        //                             success:function(data){

        //                                 if(data.status==1){

        //                                     // $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
        //                                     //     $('#myModal').modal('show');
        //                                         //location.reload();
        //                                 }

        //                             }

        //                         });
})
 
        });
    </script>
@endsection
