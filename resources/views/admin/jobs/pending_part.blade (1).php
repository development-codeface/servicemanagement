@extends('layouts.admin1')

@section('header')

<link rel="stylesheet" href="{{ asset('assets/admin/css/wickedpicker.min.css')}}">
<style>
.btncl{      background: #ff5050;
    border: 1px solid #e22424;
    border-radius: 2px;
    color: white;
    width: 34px;
    height: 34px;
    }
</style>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Job Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Job Edit</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12"> <a href="{{ URL::route('Jobs') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="card ">
                   
                        <div class="card-header bg-blue">

<div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0 f_w">Repair Order No# {{$job->repaire_order_no}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">{{date('d-m-Y', strtotime($job->job_date))}}</span> </div>
                                </div>
                                <div class="st_div">
                                    <span class="label">Status : </span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    <span class="label label-warning" style="float: right;">{{$job->status_code}}-{{$job->status_description}}</span>
                                </div>
                            </div>
                        </div>



                             
                        </div>
                        <div class="card-body">
                        

                            <form id="ajaxForm">
                              
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
					@if($job->claim_id)
							<br>
							<a href="{{URL::route('GeneratePdfGrn',$jo_id)}}"  class="btn btn-success pull-right brz">Print Report</a>
						<br>
						@endif
                        <div class="panel-body">
                        <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
									
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                    <select class="form-control" name="job_location">
                                            <option value="{{$job->job_location}}">{{$job->job_location}}</option>
                                               
                                                    <option value="Outdoor">Outdoor</option>
                                                    <option value="Indoor">Indoor</option>
                                            </select>                           
                                            </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repair Order Number</label>

                                            <input class="form-control" id="placeholderInput" value="{{$job->repaire_order_no}}" name="repair_order_no" type="text" readonly>
                                        </fieldset>
                                    </div>
                                   <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product" id="product">
                  
				    @if($job->product))
                      <option value="{{ $job->product }}">{{ $job->product }}</option>
				  @elseif($job->product_id)
				                        <option value="{{ $job->product_id }}">{{ $job->product_no }}</option>

                      @endif
					         <option value="0">Select Model</option>

                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_no }}</option>
                           @endforeach
						   
                   </select>
                   </fieldset>
            </div>
                                </div>
                              

                                <div class="row">


                                    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Bill To Name</label>
                                            <textarea class="form-control" name="address" id="placeholderInput"   type="text">{{$job->cu_address}}</textarea>
                                        </fieldset>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Contact Number</label>
                                            <input class="form-control" name="phone_no"  id="placeholderInput" value="{{$job->phone_no}}"  type="text">
                                        </fieldset>
                                    </div>
                                    
                                </div>
                            <hr>
							<div class="row">
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Appointment Date</label>
                                            @if($job->appointment_time)
                                            <input class="form-control" name="datepicker" id="datepicker" value="{{date('d-m-Y', strtotime($job->appointment_time))}}"  type="text">
                                            @else
                                            <input class="form-control" name="datepicker" id="datepicker"   type="text">
                                            @endif

                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Appointment Time</label>
                                            @if($job->time) <input class="form-control" name="time" id="time" value="{{$job->time}}"  type="text">
											 @else
                                            <input class="form-control" name="time" id="value_Date_Listed_1"   type="text">
                                            @endif
                                        </fieldset>
                                    </div>
                                    </div>
                                    <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Complaints/Remarks</label>
                                            <textarea class="form-control" name="remark" id="placeholderInput"   type="text">{{$job->job_remark}}</textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Turn Around Time</label>
                                            <input class="form-control" name="turn_fround_time"  id="placeholderInput" value="{{$job->turn_fround_time}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="placeholderInput"   type="text">{{$job->description}}</textarea>
                                        </fieldset>
                                    </div>

                                    </div>
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label> Assign Asp Admin</label>
                                            <select class="form-control aspadm" name="asp_location" id="asp_loc" required>
                                          @if(isset($job))
                                                    <option value="{{ $job->code }}"> {{ $job->code}} - {{ $job->name}}</option>
                                                @endif
                                                @foreach($warehouse as $stat)
                                                    <option value="{{ $stat->code }}">{{$stat->code}}- {{$stat->name}} </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
									<div class="col-lg-4" >
                                   
                                     <fieldset class="form-group">
                                            <label> ASP Technician</label>
                                            <select class="form-control" name="technician" id="jo-tech">
                                            @foreach($techs as $stat)
                                                     
                                            <option value="">Please Select</option>

                                                    <option value="{{ $stat->id }}">{{$stat->username}}</option>
                                                @endforeach
                                                 
                                            </select>
                                        </fieldset>
                                       
    
                                    </div>
                                    </div>
                              
                              
                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editJob">
                                    <input type="hidden" name="job_id" value="{{$jo_id}}">
                                    <input type="hidden" name="cu_id" value="{{$job->cu_id}}">
                                    <input type="hidden" name="appointment_time" value="{{$job->appointment_time}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <p class="text-center">
                                  
                                    <a href="{{URL::route('Jobs')}}" class="btn btn-lg btn-danger waves-effect waves-light m-t-3">Cancel </a>
                                    <button type="submit" class="btn btn-lg btn-success waves-effect waves-light m-t-3">Save </button>
</p>

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
              <input class="form-control" id="jobidparts" name="jobid" value="{{$jo_id}}"  type="text" readonly>
             
            
            </fieldset>
          </div>
          <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair1"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>
          </div>
		
		
		  
		
			<div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faulty33">
                                            
                                            @if(isset($job->faulty_code))
                                                    <option value="{{ $job->faulty_id }}">{{ $job->faulty_code }} - {{ $job->faulty_description }}</option>'
											  @endif
											<option value="0">Please Select</option>

                                              
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_code }} - {{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom">
                                          
                                            @if(isset($job->symptom_id))
                                                    <option value="{{ $job->symptom_id }}">{{ $job->symptom_code }} - {{ $job->symptom_description }}</option>
													

                                                @endif
                                              <option value="0">Please Select</option>
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{$symptom->symptom_code }} - {{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolution33">
                                            
                                           
                                                @if(isset($job->resolution))
                                                    <option value="{{ $job->resolution_id }}">{{ $job->resolution_code }} - {{ $job->resolution_description }}</option>
                                              
                                                @endif
												<option value="0">Please Select</option>
                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution->resolution_code }} - {{ $resolution-> resolution_description }}</option>
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
			  @if(isset($part))
              <textarea class="form-control" id="rem1" name="remark"  type="text">{{$part->remark}}</textarea>
              @else           
				  <textarea class="form-control" id="rem1"  name="remark"  type="text"></textarea>
           @endif
            </fieldset>
          </div>
                              </div>
          <div class="row">
		@if(isset($part))
			 <?php $i=1;?>
                                   @foreach($mul_parts as $mul) 
                                   
                                        <div class="col-lg-4">

                                        <fieldset class="form-group">
                                            <label>Part &nbsp;</label>
                                            <select class="form-control partqty" name="parts[]">
                                            
                                                    <option value="{{$mul->part_id}}">{{ $mul->part_no }} - {{$mul->parts_description}}</option>
                                            
                                                @foreach($parts as $part)
                                                <option value="{{$part->part_id}}"> {{$part->part_no}} - {{$part->parts_description}}</option>
                                                @endforeach
                                              
                                            </select>            
                                            </fieldset>
                                            </div>
                                           
                                    
                                  
                                    <div class="col-lg-1">
                                        <fieldset class="form-group">
                                            <label>	Quantity</label>
                                            <input class="form-control" name="qty[]" value="{{$mul->quantity}}"  type="text" readonly>
                                            <input type="hidden" name="ml_id[]" value="{{$mul->mul_part_id}}">
                                            <input type="hidden" name="part_n[]" value="{{$mul->parts}}">

                                        </fieldset>
                                    </div>
									<div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <label>	Available Quantity</label>
                                            <input class="form-control" id="avl_part_qty" @if($mul->avl_qty >= 0)value="{{$mul->avl_qty}}" @else value="0" @endif  type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <?php $i++;?>
                                    @endforeach
@else
         <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Parts</label>
              <select class="form-control partqty" name="parts[]" id="partno1">
              
                   <option value="0">Please Select</option>

                   @foreach($parts_list as $part)
                <option value="{{$part->part_id}}"> {{$part->part_no}} - {{$part->parts_description}}</option>
                @endforeach
               
              </select>            
              </fieldset>
            </div>
            
           


           <div class="col-lg-2">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
              
                <input class="form-control"  name="qnty[]"  value="1"  id="qty1"  type="text" recquired readonly>

                
              </fieldset>
            </div>
			<div class="col-lg-2">
                                        <fieldset class="form-group">
                                            <label>	Available Quantity</label>
                                            <input class="form-control" id="avl_part_qty" type="text" readonly>
                                        </fieldset>
                                    </div>
			@endif
            <div class="col-lg-2">
              <fieldset class="form-group">
              <label>&nbsp;</label>
            <button type="button" class="btn btn-info pull-right answer_next" style="    margin-top: 34px; float: left;
">Add More</button>
            </fieldset>
            </div>
            
            <span id="Rows" class="wid_Row"></span>
         
                  
		  	
        </div>
        <hr>
		
        <div class="row">
         
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Approve/Reject</label><br>
											
                                            <input type="radio" name="reject" value="1" @if($job->part_appr==1)checked @endif> Approve &nbsp; 
											
                                             <input type="radio" name="reject" value="2" @if($job->part_appr==2)checked @endif> Reject<br> 											
                                             </fieldset>
                                    </div>
                                    <div class="col-lg-4 appr hidden">
                                        <fieldset class="form-group">
                                            <label>	Delivery Date</label>
                                            @if($job->delivery_date)
                                            <input class="form-control" id="datepicker1" value="{{date('d-m-Y', strtotime($job->delivery_date))}}" name="del_date"  type="text" required>
                                            @else
                                            <input class="form-control" id="datepicker1" value="" name="del_date"  type="text"required >
                                          @endif
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 rej hidden" >
                                        <fieldset class="form-group">
                                            <label> Remarks</label>
                                            <textarea class="form-control disable" name="note" ></textarea>                                      
                                             </fieldset>
                                    </div>
									
									
                            @if($job->delivery_date)<div class="col-lg-4 appr">
                                        <fieldset class="form-group">
                                            <label>	Delivery Date</label>
                                            @if($job->delivery_date)
                                            <input class="form-control" id="datepicker2" value="{{date('d-m-Y', strtotime($job->delivery_date))}}" name="del_date"  type="text" required>
                                            @else
                                            <input class="form-control" id="datepicker2" value="" name="del_date"  type="text"required >
                                          @endif
                                        </fieldset>
                                    </div>
									@endif
									@if($job->apprv_remarks)
                                    <div class="col-lg-4 rej " >
                                        <fieldset class="form-group">
                                            <label> Remarks</label>
                                            <textarea class="form-control disable" name="note" >{{$job->apprv_remarks}}</textarea>                                      
                                             </fieldset>
                                    </div>
									@endif
									
                              
          </div>
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="newParts">
             @if(isset($job))
             <input type="hidden" name="job_id" value="{{$jo_id }}">
             <input type="hidden" name="tech_id" value="{{$job->technician }}">
             <input type="hidden" name="location" value="{{$job->asp_location }}">
             <input type="hidden" name="part_id" value="{{$job->part_order_id }}">
             @endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" id="order_btn" class="btn btn-success waves-effect waves-light m-r-10">Make Order </button>
              
                 
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
					
					@if($job->grn_id)
							<br>
							<a href="{{URL::route('GenerateGrnReport',$jo_id)}}"  class="btn btn-success pull-right brz">Print Report</a>
						<br>
						@endif
                        <div class="panel-body">
						
						<form action="{{url('/post-grn-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
              
               <div class="row">
   
               <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Job Id </label>
                 <input class="form-control" id="jobid2" name="jobid" value="{{$jo_id}}" type="text"  readonly>
   
                </fieldset>
             </div>
             <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair2"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>
   
   <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Grn id </label>
                 <input class="form-control" id="repair2"   name="grnid" value="{{$job->grn_id}}" type="text"  readonly>
                </fieldset>
             </div>
             <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repl </label>
                 <input class="form-control" id="repair2"   name="prodct_rep_id" value="{{$job->product_replacement_id}}" type="text"  readonly>
                </fieldset>
             </div>
                </div>
           
   
   

           <div class="row" id="amntdiv">
          <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product" id="product">
                  
				    @if($job->product))
                      <option value="{{ $job->product }}">{{ $job->product }}</option>
				  @elseif($job->product_id)
				                        <option value="{{ $job->product_id }}">{{ $job->product_no }}</option>

                      @endif
					         <option value="0">Select Model</option>

                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_no }}</option>
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
   
                 <input class="form-control"  name="reason" value="{{$job->reason_for_retrun}}" id="reason"  type="text" >
   
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
   
                 <input class="form-control" type="text" value="{{$job->grn_seriel}}" id="seriel" name="seriel_no"
                 />   
               </fieldset>
               </div>
   
             </div>
             
    <hr>
   <div class="row">
   
   <div class="col-lg-6">


           <fieldset class="form-group">
                 <label>Technical problem - Attach proof of purchase and tech form &nbsp;</label>
   
                 <input type="checkbox" class="" id="tech_prob" name="tech_proof"
               value="1"   @if($job->tech_prob == 1) checked=checked @endif />
  
               </fieldset>
               <fieldset class="form-group pend_part">
                 <label>Parts Supply Problem</label>
   
                 <input type="checkbox" id="pending_part" name="pending_part"
               value="1" @if($job->pending_part == 1) checked=checked @endif  />   
               </fieldset>
              
           <fieldset class="form-group">
                 <label>Dented / Damaged Transit&nbsp;</label>
   
                 <input type="checkbox" id="dented" name="dented"
               value="1"    @if($job->dented == 1) checked=checked @endif/>   
               </fieldset>
            
          
           <fieldset class="form-group">
                 <label> Photocopy of TSS DO or Shipping Label on box&nbsp; </label>
   
                 <input type="checkbox" class="" id="photogr" name="photo"
               value="1"  @if($job->photogr == 1) checked=checked @endif />   
               </fieldset>
             
               
           <fieldset class="form-group">
                 <label>Complete return of ACC / WTY CARD / MANUAL / etc.&nbsp;</label>
   
                 <input type="checkbox" id="returnacc" name="ret_acc"
               value="1"  @if($job->return_acc == 1) checked=checked @endif />   
               </fieldset>
              
               </div>
          
             

              @if($job->pending_part == 1)
				   <div class="row pt_12">
				                  <div class="col-lg-4">
             
             

               <fieldset class="form-group date_place ">
                 <label>Date Place order</label>
   
                 <input class="form-control"  name="place_order" value="{{date('d-m-Y', strtotime($job->place_order))}}" id="place_order"  type="text" >
   
               </fieldset>
			   </div>
			   <div class="col-lg-4">
       <fieldset class="form-group spare_part ">
                 <label>Spare Part No</label>
   
                 <input class="form-control"  name="part_no" value="{{$job->grn_spare}}" id="grnspare"  type="text" >
   
               </fieldset>
               </div>
               </div>
			   @else
				  
				                  <div class="row pt_12">
				                  <div class="col-lg-4">
             

                <fieldset class="form-group date_place hidden">
                 <label>Date Place order</label>
   
                 <input class="form-control"  name="place_order"  id="place_order"  type="text" >
   
               </fieldset>
     
               </div>
			    <div class="col-lg-4">
			     <fieldset class="form-group spare_part hidden">
                 <label>Spare Part No</label>
   
                 <input class="form-control"  name="part_no"  id="grnspare"  type="text" >
   
               </fieldset>
			   </div>
			   </div>
			   @endif
               
   </div>

   
   <hr>
   <div class="row">
    <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Name</label>
   
                 <input class="form-control"  name="dealer_name" value="{{$job->dealer_name}}" id="reason"  type="text" >
   
               </fieldset>
               </div>
			     <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Address</label>
   
                 <textarea class="form-control"  name="dealer_address" value="" id="reason"  type="text" >{{$job->dealer_address}}</textarea>
   
               </fieldset>
               </div>
			    <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Account Number</label>
                 <label></label>
   
                 <input class="form-control"  name="delaer_acc" value="{{$job->dealer_acc}}" id="reason"  type="text" >
   
               </fieldset>
               </div>
   </div>
    <hr>
   <div class="row">
  
              
			   
               <div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" @if($job->is_ex_cn == 1) checked @endif> Credit note &nbsp;
                                             <input type="radio" name="approve" value="2" @if($job->is_ex_cn == 2) checked @endif> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
               
               <div class="col-lg-3 ">
           <fieldset class="@if($job->grn_credit)form-group amont @else amont hidden @endif">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" value="{{$job->grn_credit}}"  id="credit_not" name="credit_not"
                 />   
               </fieldset>
			   <fieldset class="@if($job->grn_amount)form-group amt @else amt hidden @endif">
                 <label>Amount</label>
   
                 <input class="form-control" type="text" value="{{$job->grn_amount}}" id="amount" name="amount"
                 />   
               </fieldset>
			    <fieldset class="@if($job->sell_price) form-group sel_pr @else sel_pr hidden @endif">
                 <label>Last Selling Price RM</label>
   
                 <input class="form-control" type="text" value="{{$job->sell_price}}" id="amount" name="sell_price"
                 />   
               </fieldset>
               <fieldset class="@if($job->grn_ex) form-group ex_number @else ex_number hidden @endif">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" value="{{$job->grn_ex}}" id="ex_number" name="ex_number"
                />   
               </fieldset>
			    <fieldset class="@if($job->remarks) form-group grn_rem @else grn_rem hidden @endif">
                 <label>Remarks</label>
   
                 <textarea class="form-control" type="text" value="{{$job->remarks}}" id="grn_remarks" name="grn_remarks"
                />  </textarea> 
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
               </div>
              
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Complaint Date</label>
   
                 <input class="form-control"  name="comp_date" id="comp_date"  type="text" >
   
               </fieldset>
               </div> -->
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                            @if($job->grn_purchase)
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->grn_purchase))}}" id="purchase_date"  name="purchase_date"  type="text" >
                                            @else
                                            <input class="form-control"  id="purchase_date"  name="purchase_date"  type="text" >
                                            @endif   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Goods Receive Date</label>
   
                                            @if($job->goods_date)
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->goods_date))}}" id="goods_date"  name="goods_date"  type="text" >
                                            @else
                                            <input class="form-control"  id="goods_date"  name="goods_date"  type="text" >
                                            @endif   
               </fieldset>
               </div>
              
               <div class="col-lg-4">
           <fieldset class="form-group">
           <label for="exampleInputFile">Image</label>
                                                   <div class="col-sm-10">
												   @if($job->grn_image)
													   <img src="{{ url('data/products/'.$job->grn_image) }}" style="width: 124px;
    height: 66px;"class="thumbnail img_rem"><a href="javascript:;" class="btn default btn-sm removeImage" data-id="{{$job->grn_id}}"  id="removeicon"><i class="fa fa-times"></i> Remove </a>
	                                                   <input id="Image"  type="file" name="files"/>

												   @else
                                                   <input id="Image"  type="file" name="files"/>
											   @endif
     
                                               </div>
   
               </fieldset>
               </div>
			     <div class="col-lg-4">
                                        <fieldset class="form-group appr">
                                            <label>	Delivery Date</label>
                                            @if($job->prod_deliver)
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->prod_deliver))}}" id="datepicker_grn" name="del_date"  type="text" >
                                            @else
                                            <input class="form-control"   id="datepicker_grn" name="del_date"  type="text" >
                                           @endif
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
						@if($job->gma_id)
							<br>
							<a href="{{URL::route('GenerateRmaReport',$jo_id)}}"  class="btn btn-success pull-right brz">Print Report</a>
						<br>
						<!--a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateRmaReport',$job->job_id)}}" ></a-->
						
						@endif
						<form action="{{url('/post-rma-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
            <div class="row">

            <div class="col-lg-4 hidden">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="jobid11" value="{{$jo_id}}"  name="jobid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair3"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>

 <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Rma </label>
                 <input class="form-control" id="repair3" value="{{$job->gma_id}}"   name="rmaid" type="text"  readonly>
                </fieldset>
             </div>
         
             </div>
		

<!-- <div class="row">
<div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faulty44">
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
                                            <select class="form-control" name="symptom" id="symptom44">
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
                                            <select class="form-control" name="resolution" id="resolution44">
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
                 <label>Purchase Date</label>
   
                                   @if($job->gma_purchase)
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->gma_purchase))}}" id="purchase_date1"  name="purchase_date"  type="text" >
                                            @else
                                            <input class="form-control"  id="purchase_date1"  name="purchase_date"  type="text" >
                                            @endif      
               </fieldset>
               </div>
        <!-- <div class="col-lg-4">
                <fieldset class="form-group">
                <label>Model</label>
                <select class="form-control" name="product" id="product">
                <option value="">Select Product</option>
                        @foreach($products as $menu)
                            <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                        @endforeach
                </select>
                </fieldset>
             </div> -->
             <!-- <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Serial Number</label>
   
                 <input class="form-control"  name="ser_num" id="rmaseriel"  type="text" >
   
               </fieldset>
               </div> -->
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Warranty Card Number</label>
   
                 <input class="form-control"  name="warr_num" value="{{$job->warranty_card}}" id="warcard"  type="text" >
   
               </fieldset>
               </div>
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Panel Serial No</label>

              <input class="form-control"  name="panel_serial_no" value="{{$job->panel_serial_no}}" id="panser"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Panel Model</label>
   
                 <input class="form-control"  name="panel_model" value="{{$job->panel_model}}"  id="panmod"  type="text" >
   
               </fieldset>
               </div>
              <div class="col-lg-4">
        <fieldset class="form-group">
              <label> Dealer/Customer Name</label>

              <input class="form-control"  name="dealer_name" value="{{$job->dealer_nam}}"  id="accnt"  type="text">

            </fieldset>
            </div>
              <div class="col-lg-4">
        <fieldset class="form-group">
              <label> Dealer/Customer Address</label>

              <textarea class="form-control"  name="dealer_addr" value=""  id="accnt"  type="text">{{$job->dealer_addr}}</textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Main Dealer Account No</label>

              <input class="form-control"  name="dealer_accnt_no" value="{{$job->delear_Account_numner}}"  id="accnt"  type="text">

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Complaints</label>

              <textarea class="form-control"  name="complaints" id="compl"  type="text" >{{$job->complaints}}</textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Remarks</label>

               <textarea class="form-control"  name="reason" id="rmares" value="" type="text"  >{{$job->reason_for_return}}</textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
        <label for="exampleInputFile">Picture Of Symptom</label>
                                                <div class="col-sm-10">
@if($job->gma_image)
													   <img src="{{ url('data/products/'.$job->gma_image) }}" style="width: 124px;
    height: 66px;"class="thumbnail img_rem"><a href="javascript:;" class="btn default btn-sm removeImagerma" data-id="{{$job->gma_id}}"  id="removeicon"><i class="fa fa-times"></i> Remove </a>
	                                                   <input id="Image"  type="file" name="files"/>

												   @else
                                                   <input id="Image"  type="file" name="files"/>
											   @endif                                              </div>
            </fieldset>
            </div>

          </div>


 <hr>



<div class="row">
               <div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" @if($job->is_cn_ex == 1) checked @endif> Credit note &nbsp;
                                             <input type="radio" name="approve" value="2" @if($job->is_cn_ex == 2) checked @endif> Exchange<br>  
                                                                                 
                                             </fieldset>
               </div>
			     <div class="col-lg-4 ">
           <fieldset class="@if($job->gma_credit) form-group amont @else hidden amont @endif">
                 <label>Credit Note</label>
   
                 <input class="form-control" type="text" value="{{$job->gma_credit}}" id="credit_not" name="credit_not"
                 />   
               </fieldset>
			   <fieldset class="@if($job->gma_amount)form-group amt @else amt hidden @endif">
                 <label>Amount</label>
   
                 <input class="form-control" type="text" value="{{$job->gma_amount}}"  id="amount" name="amount"
                 />   
               </fieldset>
               <fieldset class="@if($job->gma_ex)form-group ex_number @else ex_number hidden @endif">
                 <label>Exchange Number</label>
   
                 <input class="form-control" type="text" value="{{$job->gma_ex}}"  id="ex_number" name="ex_number"
                />   
               </fieldset>
			    <fieldset class="@if($job->remarks)form-group grn_rem @else grn_rem hidden @endif">
                 <label>Remarks</label>
   
                 <textarea class="form-control" type="text" value="{{$job->remarks}}" id="rma_remarks" name="grn_remarks"
                />  </textarea> 
               </fieldset>
               </div>
             
              
</div>
<hr>
<h4 class="sympd">Symptom/Defect</h4>


<div class="row">
<div class="col-lg-12">
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Line &nbsp;</label>
   
                 <input type="checkbox" id="vert_line" name="vert_line"
               value="1"  @if($job->vertical_line == 1) checked=checked @endif />   
               </fieldset>
               </div>
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Block&nbsp;</label>
   
                 <input type="checkbox" id="vert_block" name="vert_block"
               value="1"  @if($job->vertical_block == 1) checked=checked @endif />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Line&nbsp;</label>
   
                 <input type="checkbox" id="hori_line" name="hori_line"
               value="1"  @if($job->hori_line == 1) checked=checked @endif />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Block&nbsp;</label>
   
                 <input type="checkbox" id="hori_block" name="hori_block"
               value="1"   @if($job->horil_block == 1) checked=checked @endif/>   
               </fieldset>
               </div>
           
               <div class="lft">
           <fieldset class="form-group">
                 <label>No Display&nbsp;</label>
   
                 <input type="checkbox" id="no_disp" name="no_disp"
               value="1"  @if($job->no_display == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Colour&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_colour" name="abnorm_colour"
               value="1"  @if($job->abnormal_color == 1) checked=checked @endif />   
               </fieldset>
               </div>



<div class="lft">
           <fieldset class="form-group">
                 <label>Uniformity Defect&nbsp;</label>
   
                 <input type="checkbox" id="unif_defect" name="unif_defect"
               value="1"  @if($job->uniformity_defect == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Dot screen&nbsp;</label>
   
                 <input type="checkbox" id="dot_screen" name="dot_screen"
               value="1"  @if($job->dot_screen == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>White Screen&nbsp;</label>
   
                 <input type="checkbox" id="whit_screen" name="whit_screen"
               value="1"  @if($job->white_screen == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Flicker&nbsp;</label>
   
                 <input type="checkbox" id="flicker" name="flicker"
               value="1"  @if($job->flicker == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Black Light Defect&nbsp;</label>
   
                 <input type="checkbox" id="blck_defct" name="blck_defct"
               value="1"  @if($job->back_light == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Picture&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_pic" name="abnorm_pic"
               value="1"   @if($job->abnormal_pic == 1) checked=checked @endif/>   
               </fieldset>
               </div>
              
    

</div></div>


<hr>
           <div class="row">
               <div class="col-lg-2">
           <fieldset class="form-group">
                 <label>Others</label>
   
                 <textarea class="form-control"type="text" id="other" name="other"
               value="1"  />{{$job->other}}</textarea  >
               </fieldset>
               </div>
			   <div class="col-lg-4">
			                           
									   <fieldset class="form-group appr">
                                            <label>	Delivery Date</label>
                                            @if($job->prod_deliver)
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->prod_deliver))}}" id="datepicker3" name="del_date"  type="text">
                                            @else
                                            <input class="form-control"   id="datepicker3" name="del_date"  type="text"  >
                                           @endif
                                        </fieldset>
										</div>
</div>








		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newrma">
    @if(isset($job))
                    <input type="hidden" name="location" value="{{$job->location}}">
                    <input type="hidden" name="prodct_rep_id" value="{{$job->product_replacement}}">
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
              <input class="form-control" id="jobid1" value="{{$jo_id}}" name="jobid" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4 hidden">
               <fieldset class="form-group">
                 <label>Repair Order No </label>
                 <input class="form-control" id="repair4"   name="repaire_order_no" type="text"  readonly>
                </fieldset>
             </div>
          </div>
		
		
		   
		 
		
			<!-- <div class="row">
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faulty55">
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
                                            <select class="form-control" name="symptom" id="symptom55">
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
                                            <select class="form-control" name="resolution" id="resolution55">
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

              <!--<select class="form-control mileage" name="mileage" id="mileage">
            
             
                   @if(isset($claim))
					<option value="{{$claim->mil_id}}">{{$claim->min_mil}}- {{$claim->max_mil}}</option>

					   @endif
					    <option value="">Select Mileage </option> 
                        @foreach($milaeges as $mil)
                    <option value="{{$mil->mil_id}}">{{$mil->min_mil}}- {{$mil->max_mil}}</option>
                    @endforeach
                  </select>  --> 
              <input class="form-control"  name="mileage" id="mileage" value="{{$job->mileage}}"  type="text">
			  
            </fieldset>
            </div>
         
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Claim Amount</label>
            
              <input class="form-control"   name="amount" id="claim_amount" value="{{$job->claim_amount}}"  type="text" readonly>
              
            </fieldset>
            </div>
            
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Labour</label>
             
              <input class="form-control"  name="labour" id="labour" value="{{$job->labour}}"  type="text">
            
            </fieldset>
            </div>
            
              <div class="col-lg-4">
                                         <fieldset class="form-group">
                                            <label>Approve/Reject</label><br>
                                            @if($job->isapprove==1)<input type="radio" name="reject" value="1" checked> Approve &nbsp;
@else											<input type="radio" name="reject" value="1" > Approve &nbsp;
											@endif
                                            @if($job->isapprove==2) <input type="radio" name="reject" value="2" checked>  Reject<br>  
											@else<input type="radio" name="reject" value="2" >  Reject<br> 
@endif											
                                             </fieldset>
                                             
                                    </div>      
                                    <div class="col-lg-4">
                                      
                                        <fieldset class="form-group rej hidden">
                                            <label>Remarks</label>
                                            <textarea class="form-control disable" name="remark" ></textarea>                                      
                                             </fieldset>
                                    </div>
									@if($job->claim_remarks)
										<div class="col-lg-4">
                                      
                                        <fieldset class="form-group rej ">
                                            <label>Remarks</label>
                                            <textarea class="form-control disable" name="remark" >{{$job->claim_remarks}}</textarea>                                      
                                             </fieldset>
                                    </div>
										@endif
          
          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newClaim">
    @if(isset($job))
             <input type="hidden" name="job_id" value="{{$job->job_id}} ">
		              <input type="hidden" name="claim_id" value="{{$job->claim_id }}">

             @endif
              
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
        <!-- /.content -->
    </div>
    <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
@endsection

@section('footer')
<script src="{{ asset('assets/admin/js/wickedpicker.min.js')}}"></script>
</script>

    <script>
        $(document).ready(function(){
            jQuery('#datepicker').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});

    jQuery('#place_order').datetimepicker({
    format: 'd-m-Y',
    minDate:new Date()
   });
   jQuery('#datepicker1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
 jQuery('#datepicker_grn').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
  jQuery('#datepicker2').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#datepicker3').datetimepicker({
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
jQuery('#appl_date2').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#compl_date1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#date_rece2').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});

jQuery('#purchase_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
   jQuery('#goods_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
   jQuery('#purchase_date1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
// jQuery('#value_Date_Listed_1').timepicker({
//     showInputs: false        
 
// });
$('#value_Date_Listed_1').wickedpicker({
    showInputs: false,
});
$('#pending_part').click(function() {
	
 var crd11 = $(this).val(); 
 if(crd11 == 1){
	 $(".date_place").show();
        $(".spare_part").show();
 }
 else{
	 $(".date_place").hide();
        $(".spare_part").hide();
 }
	 
});
       $( ".reject" ).change(function() {
             var rej= this.value;
             if(rej == 0){
                $(".select-pane").show();
             }
             if(rej == 2){
               
               $( ".rej" ).show();
               $( ".appr" ).hide();
            }
            if(rej == 1){
               
              
               $( ".rej" ).show();
            }
});
 $( ".parts_select" ).change(function() {
            
			
});
     $('input:radio').change(function() {      
        var rej = $("input[name='reject']:checked").val();   
        if(rej == 2){
                
            $( ".rej" ).removeClass('hidden')
            $( ".appr" ).addClass('hidden')
            }
            if(rej == 1){
            
            $( ".appr" ).removeClass('hidden')
            $( ".rej" ).removeClass('hidden')

            }

    });
	 $('input:radio').change(function() {      
        var rej = $("input[name='appr_cl']:checked").val(); 

        if(rej == 'appr'){
                
            $( ".rej" ).removeClass('hidden')
            
            }
            if(rej == 'rej'){
            
            
            $( ".rej" ).removeClass('hidden')

            }

    });
$('input:radio').change(function() {      
        var crd = $("input[name='approve_grn']:checked").val(); 

     if(crd==1)
    {
        $(".amont").show();
        $(".grn_rem").show();
        $(".amt").show();
        $(".credit_not").show();
        $(".ex_number").hide();
    }else{
        $(".ex_number").show();
        $(".grn_rem").show();
        $(".amont").hide();     
		$(".amt").hide();
        $(".credit_not").hide();
    }

})

$('input:radio').change(function() {      
        var crd = $("input[name='approve']:checked").val(); 



    if(crd==1)
    {
        $(".amont").show();
        $(".sel_pr").show();
        $(".grn_rem").show();
        $(".amt").show();
        $(".credit_not").show();
        $(".ex_number").hide();
    }else{
        $(".ex_number").show();
        $(".grn_rem").show();
        $(".amont").hide();     
        $(".sel_pr").hide();     
		$(".amt").hide();
        $(".credit_not").hide();
    }

})

                                       
                                            
                                            
                                        
                                    
var max_fields      = 3; //maximum input boxes allowed
            var Rows         = $("#Rows"); //Fields wrapper
            var answer_next      = $(".answer_next"); //Add button ID

            $(answer_next).click(function(e){ e.preventDefault()
               
$(Rows).append('<div class="container ">'+'<div class="row remdiv">'+' <div class="col-lg-4">'+
                        '<fieldset class="form-group">'+
                        ' <label>Parts</label>'+
                        ' <select class="form-control partqty" name="parts[]">'+
                        '<option value="">Select Parts</option> '+
                        @foreach($parts_list as $part)
                        ' <option value="{{$part->part_id}}">{{$part->parts_description}} - {{$part->part_no}}</option>'
                +                @endforeach
                        ' </select>'+
                        ' </fieldset>'+
                        ' </div>'+
                        '<div class="col-lg-4">'+
                        '<fieldset class="form-group">'+
                        ' <label> Parts Quantity</label>'+
                        ' <input class="form-control" name="qnty[]" value="1"   id="placeholderInput"  type="text" readonly>'+
                        ' </fieldset>'+
                        '</div>'+
                        '<div class="col-lg-3">'+
                        ' <fieldset class="form-group">'+
                        '<label> Available Quantity</label>'+
                        '<input class="form-control" id="avl_part_qty" type="text" readonly>'+
                        '</fieldset>'+
                        '</div>'+
						'<div class="col-lg-1">'+
						' <fieldset class="form-group">'+
                        '<label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>'+
						'<button class="removediv btncl"  type="button" id="removediv"> <span aria-hidden="true">&times;</span></button>'+
						' </fieldset>'+
						'</div>'+
						'</div>'+
                        '</div>'
                        
                    
                );


   });

$(document).on('click', '.removediv', function(e) {
   $(this).parent().parent().parent().remove();
});

      $('.aspadm').on('change', function() {
        var att =this.value;
        var token = "{{ csrf_token() }}";
     var type = 'job_tech';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,att:att,_token:token},
             success: function(data){
                 if(data.status==1){
                 
                     $("#jo-tech").html(data.html);
                    
                 }

             }
         });
    });
	
	 $('.partqty').on('change', function() {
		var status =this.value;
       
        var token = "{{ csrf_token() }}";
     var type = 'avl_part_qty';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                 if(data.status==1){
                    if(data.aval_qty < 0){
						 $("#avl_part_qty").val(0);
					}
					else{
						 $("#avl_part_qty").val(data.aval_qty);
					}
                    
                 }
                 else if(data.status==3){
                     alert('Data Not Found');
                 }
                
             }
         });
		   });
	
            $("#ajaxForm").validate({
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
                    var formData = $("#ajaxForm").serialize();
                    $( "#mod" ).removeClass("hidden");
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                      window.location.href="{{URL::route('Jobs')}}";
                            }, 3500);

                        }
                    });
                    return false;
                }
            });
        });
      $("#partsform").validate({
    rules: {
      qnty: {
           
      require_from_group: [1, ".phone-group"]
  
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
        var avl_qty = $("#avl_part_qty").val();
	
		/*if(avl_qty == 0){
			alert('Cant Approve Order due to insufficient quantity');
			$("#order_btn").attr("disabled", true);
			$('#submit').attr('disabled','disabled');
			location.reload();
		}*/
		 
        if(true){
			$.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                  window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
		}
        
    }
});
$('body').on('click', '.removeImage', function () {

              
 var grn = $(this).attr("data-id");
 
var token = "{{ csrf_token() }}";
var type = 'Delete-Image-GRN';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("PostRemove") }}',
             data: { type:type,grn:grn,_token:token},
             success: function(data){
                 if(data.status==1){
$( ".img_rem" ).remove();
$( "#removeicon" ).remove();
                 }
				 
             }
         });
            });
			$('body').on('click', '.removeImagerma', function () {

              
 var gma = $(this).attr("data-id");
 
var token = "{{ csrf_token() }}";
var type = 'Delete-Image-Rma';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("PostRemove") }}',
             data: { type:type,gma:gma,_token:token},
             success: function(data){
                 if(data.status==1){
$( ".img_rem" ).remove();
$( "#removeicon" ).remove();
                 }
				 
             }
         });
            });
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
                  window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
        function removeImage(id){

            var type = 'removeBanner';
            var id = id;


            $.ajax({

                type:'post',
                url:"{{ URL::route('PostRemove') }}",
                data:{id:id,_token: '{{ csrf_token() }}',type:type},
                success:function(data){
                    if(data.status==1){

                        $("#ImagePrevs").addClass('hidden');

                    }

                }

            });

        }
    </script>

@endsection
