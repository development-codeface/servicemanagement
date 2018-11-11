@extends('layouts.admin1')

@section('header')
 
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/wickedpicker.min.css')}}">
<style>
.chcgrn{
    float: right;
    margin-top: -43px;
    margin-right: -11px;
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
        
        
        
<div class="row">

         
          <div class="col-lg-4">
		  <button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#createjob"><i class="fa fa-plus-circle"></i> Create Job</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadcsv"><i class="fa fa-upload"></i> Upload CSV</button>
		  </div>
      
       
        <div class="col-lg-2 no_pl">

<div class="">
<select name="example1_length"  aria-controls="example1" class="form-control input-sm filter">
<option value="0">Select Filter</option>
               <option value="1">Asp Admin</option>
               <option value="2">Technician</option>
               <option value="3">Date Range</option>
               <option value="4">Status</option>
               <option value="5">CESRO</option>
               <option value="6">SW</option>
            </select>  

</div>
 


 </div>
 <div class="col-lg-4 no_pl">
 <div class=" date hidden">
    <div class="input-group mb-3 ">
  <input type="text" class="form-control" placeholder="Select Date Range" id="daterange" name="daterange" value="" >
  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getbtn">Filter</button>
    
  </div>
     </div>   
     </div>    
     
     
<div class="m-t-0">

<div class="ware hidden">

<div class="input-group mb-3">





    

<select class="form-control aspadm" id="asp_location" name="asp_location">
                                            <option value="">Select WareHouse</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{$stat->code}}">{{$stat->name}} - {{$stat->code}}</option>
                                                @endforeach
                                            </select>  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getasp">Filter</button>
    

  </div>
  </div> 
  
  
  </div> 

<div class="techn hidden" >
<div class="input-group mb-3">

<select class="form-control aspadm" id="technician" name="technician">
                                            <option value="">Select Technician</option>
                                            @foreach($techs as $tech)        
                                   <option value="{{$tech->id}}">{{$tech->email}}</option>
                                   @endforeach
                                            </select>  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="gettech">Filter</button>
    

  </div>
</div> 
 </div> 


 <div class="stat hidden">


 
<div class="input-group mb-3 ">

<select class="form-control aspadm" id="status" name="status">
                                            <option value="">Select Status</option>
                                            @foreach($status as $tech)        
                                   <option data-name="{{$tech->status_code}}" value="{{$tech->status_id}}">{{$tech->status_code}}-{{$tech->status_description}}</option>
                                   @endforeach
                                            </select>  
                                            <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getstat">Filter</button>
    

  </div>
</div>  




</div> 
<div class="input-group-append cser hidden">
    <button class="getbtn btn btn-info" type="button" id="getcsv">Filter</button>
    

  </div>
  <div class="input-group-append sw hidden">
    <button class="getbtn btn btn-info" type="button" id="getsw">Filter</button>
    

  </div>
</div>
</div>
 <div class="col-lg-2 no_pl">
 <button id="export11" data-export="export"  class="btn btn-primary pull-right"><i class="fa fa-download" aria-hidden="true"></i> Export</button>
 </div>





<!-- createjob -->
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
								  <div class="col-lg-4 hidden ">
            <fieldset class="form-group">
            
            <label>Job Id</label>
              <input class="form-control" id="jobideditjob" name="jobid"  type="text" readonly>
             
            
            </fieldset>
          </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                      <select class="form-control" name="job_location" id="job_loc">
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
                                            <input class="form-control" name="phone"  id="cont_no"  type="text">
                                        </fieldset>
                                    </div>
                                    
                                </div>
                            <hr>
							<div class="row">
							 <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Appointment Date</label>
                                           
                                           
                                            <input class="form-control" name="datepicker" id="datepicker"   type="text">

                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Appointment Time</label>
                                            <input class="form-control" name="time" id="value_Date_Listed_1"  type="text">
                                        </fieldset>
                                    </div>
							</div>
							</hr>
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
                                            <select class="form-control aspadm" name="asp_location" id="asp_loc" required>
                                            <option value="">Select WareHouse</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{ $stat->code}}">{{$stat->code}} - {{$stat->name}}</option>
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
		  <div class="col-lg-4 hidden">
            <fieldset class="form-group">
            
            <label>Part Order</label>
              <input class="form-control" id="part_order" name="part_id"  type="text" readonly>
             
            
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
                                            <option value="0">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
												
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_code }} - {{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptom33">
                                            <option id="" value="">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_code }} - {{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolution33">
                                            <option value="">Select Resolution Code</option> 
                                           

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_code }} - {{ $resolution-> resolution_description }}</option>
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
              <select class="form-control parts_select" name="parts[]" id="partno1">
<option value="">Select Parts</option> 

                       
                   @foreach($parts_list as $part)
                <option value="{{$part->part_id}}">  {{$part->part_no}} - {{$part->parts_description}}</option>
                @endforeach
               
              </select>            
              </fieldset>
            </div>
            
            <!-- <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Description</label>
            
               <input class="form-control" id="descr"  name="qnty[]">


              </fieldset>
            </div> -->


           <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
                @if(isset($job))
                <input class="form-control"  name="qnty[]" value="1"  id="placeholderInput"  type="text" readonly>
			 <input type="hidden" name="ml_id[]" id="mul_part_id" value="{{$job->mul_part_id}}">
              <input type="hidden" name="part_n[]" id="mul_parts" value="{{$job->parts}}">
                @else
                <input class="form-control"  name="qnty[]"  value="1"  id="qty1"  type="text" recquired readonly>
			
@endif
                
              </fieldset>
            </div>
            <div class="col-lg-2">
              <fieldset class="form-group">
              <label>&nbsp;</label>
            <button type="button" class="btn btn-info pull-right answer_next" style="    margin-top: 34px;
">Add More</button>
            </fieldset>
            </div>
            
            <span id="Rows" class="wid_Row"></span>
         
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
						<form action="{{url('/post-grn-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
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
           
   <!-- <div class="row">
   <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faulty22">
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
                                            <select class="form-control" name="symptom" id="symptom22">
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
                                            <select class="form-control" name="resolution" id="resolution22">
                                            <option value="">Select Resolution Code</option> 
                                           

                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
</div> -->
   

           <div class="row" id="amntdiv">
           <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product" id="product">
                   <option value="">Select Product</option>
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
                 <label>Technical problem - Attach proof of purchase and tech forum &nbsp;</label>
   
                 <input type="checkbox" class="" id="tech_prob" name="tech_proof"
               value="1" />
  
               </fieldset>
               
              <fieldset class="form-group pend_part">
                 <label>Parts Supply problem</label>
   
                 <input type="checkbox" id="pending_part" name="pending_part"
               value="1"  />   
               </fieldset>
           <fieldset class="form-group">
                 <label>Dented / Damaged Transit&nbsp;</label>
   
                 <input type="checkbox" id="dented" name="dented"
               value="1"  />   
               </fieldset>
            
          
           <fieldset class="form-group">
                 <label>Photocopy of TSS DO or Shipping Label on box&nbsp; </label>
   
                 <input type="checkbox" class="" id="photogr" name="photo"
               value="1"  />   
               </fieldset>
             
               
           <fieldset class="form-group">
                 <label>Complete return of ACC / WTY CARD / MANUAL / etc.&nbsp;</label>
   
                 <input type="checkbox" id="returnacc" name="ret_acc"
               value="1"  />   
               </fieldset>
              
               </div>
          
             

              
			     <div class="col-lg-4">
             

                <fieldset class="form-group date_place hidden">
                 <label>Date Place order</label>
   
                 <input class="form-control"  name="place_order" id="place_order"  type="text" >
   
               </fieldset>
       <fieldset class="form-group spare_part hidden">
                 <label>Spare Part No</label>
   
                 <input class="form-control"  name="part_no" id="grnspare"  type="text" >
   
               </fieldset>
               </div>
			   
			    
               
   </div>

   
   <hr>
   <div class="row">
    <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Name</label>
   
                 <input class="form-control"  name="dealer_name" id="reason"  type="text" >
   
               </fieldset>
               </div>
			     <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Address</label>
   
                 <textarea class="form-control"  name="dealer_address" id="reason"  type="text" ></textarea>
   
               </fieldset>
               </div>
			    <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Dealer Account Number</label>
                 <label></label>
   
                 <input class="form-control"  name="delaer_acc" id="reason"  type="text" >
   
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
						<form action="{{url('/post-rma-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
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
                 <input class="form-control" id="repair3"   name="repaire_order_no" type="text"  readonly>
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
   
                 <input class="form-control"  name="purchase_date" id="purchase_date1"  type="text" >
   
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
              <label> Dealer/Customer Name</label>

              <input class="form-control"  name="dealer_name"   id="accnt"  type="text">

            </fieldset>
            </div>
              <div class="col-lg-4">
        <fieldset class="form-group">
              <label> Dealer/Customer Address</label>

              <textarea class="form-control"  name="dealer_addr"   id="accnt"  type="text"></textarea>

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

              <textarea class="form-control"  name="complaints" id="compl"  type="text" ></textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Remarks</label>

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



<div class="row">
<div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credint note &nbsp;
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
<h4 class="sympd">Symptom/Defect</h4>


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
              <input class="form-control"  name="mileage" id="mileage" value=""  type="text">

              <!-- <select class="form-control mileage" name="mileage" id="mileage">
            
              <option value="">Select Mileage </option> 

                        @foreach($milaeges as $mil)
                    <option value="{{$mil->mil_id}}">{{$mil->min_mil}}- {{$mil->max_mil}}</option>
                    @endforeach
                  </select>                      -->
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
             <input type="hidden" name="job_id" value="{{$job->job_id }}">
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

                                 
                                    <!-- <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Pin Code</label>
                                            <input class="form-control" name="pin_code" id="placeholderInput" type="text">
                                        </fieldset>
                                    </div> -->
                                    <!-- <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	</label>
                                            <input class="form-control" name="bus_num" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div> -->
                                   
                                    <!-- <div class="col-lg-4 techn hidden" id="techn">
                                    <fieldset class="form-group">
                                            <label> Assign Asp Technician</label>
                                            <select class="form-control asp" name="technician">
                                            <option value="">Select technician</option>
                                                @foreach($techs as $stat)
                                                    <option value="{{ $stat->id}}">{{$stat->email}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> -->
                                </div>
                            <hr>
                       
                               
                                <!-- <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty">
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
                                            <select class="form-control" name="symptom">
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
                                            <select class="form-control" name="resolution">
                                            <option value="">Select Resolution Code</option>
                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> 
                                

                                </div>-->
                              
                          
                          




        </div>
        
      </div>
    </div>
  </div>
  

<!-- Upload Job From CSV -->
<div class="modal fade" id="uploadcsv" tabindex="-1" role="dialog" aria-labelledby="uploadcsv" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Upload Job From CSV</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
     
     
        <form action="{{url('/post-csv')}}" method="post" id="ajaxForm" enctype="multipart/form-data">
     
     <div class="col-lg-6">
         <div class="form-group">
      
           <input type="file" name="upload-file" id="exampleInputFile">
         </div>
       </div>
       <div class="mod_fot">
          
       <input type="hidden" name="page_token" value="{{ md5(uniqid(rand(), true)) }}">
                                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <button type="submit" class="btn btn-lg btn-success m-t-1 "><i class="fa fa-upload"></i> Upload </button>
        </div>
     
   </div>
 </form>



        
        
        </div>
       
      </div>
    </div>
  
  




 
      <!-- <div class="col-lg-4">
     
      
     <input type="text"   id="daterange" name="daterange" value="" />

      <button id="getbtn" class="getbtn">Filter</button>

           <select name="example1_length" aria-controls="example1" class="form-control input-sm">
               <option value="10">10</option>
               <option value="25">25</option>
               <option value="50">50</option>
               <option value="100">100</option>
            </select> 
      </div>
      
    </div> -->



            <div class="card m-t-3 wid_100">

                <div class="card-body">


                    
                    
<div class="no_f hidden" id="err">
   
<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Results  Found 
    </div>



                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped" style="">
                            <thead>
                            <tr>
                            <th>Job date</th>
                            <!-- <th>Job Id</th> -->
                            <th>Action</th>
                           
                                <th>Status</th>
                               
                                <th>ASP Name</th>
                                <th>ASP Technician</th>
                                <th>Job Location</th>
                                <th>Repair Order No</th>
                                <th> Delivery Date</th>
                                <!-- <th>First Name</th>
                                <th>Last Name</th> -->
                                <th> Bill To Name</th>
                               
                                <th> Contact Number</th>
                               
                                
                               
                                <th> Turn Around Time</th>
                                <th> Appointment Date</th>
                                <th> Serial No</th>
                                <th> Purchase Date</th>
                                <th> Item No</th>
                                <th> Description</th>
                                <th> Location</th>
                                <th> Quantity</th>
                                
                                <!-- <th> item</th>

                                <th>item purchase date</th>
                                <th>item serial number</th> -->
                               
                               
                                <!-- <th>product replacement</th> -->
                               
                               
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($jobs))
                                
                            @foreach($jobs as $job)
                            <tr>
                            <td>{{date('d-m-Y', strtotime($job->job_date))}}</td>
                            <!-- <td>{{$job->job_id}}</td> -->
                            <td>
                     
                                <a class="btnsedit"  data-tooltip="View" href="{{URL::route('ViewJob',$job->job_id)}}" ><i class="fa fa-eye pad"></i></a>

                                    <a class="btnsedit"  data-tooltip="Edit" href="{{URL::route('EditJob',$job->job_id)}}" ><i class=" edi pad fa fa-edit"></i></a>
                                    <!-- <a class="btnact"  data-tooltip="block" href="#" ><i class=" edi pad fa fa-ban"></i></a> -->

                                  <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id="{{$job->job_id }}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>

                                    <!-- <a class="btnview js-mytooltip"  href="{{URL::route('NewAssignJobs',$job->job_id)}}"> <span class="label label-info"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Assign</span></a> -->
                                    
                                    @if($job->status!= 68)
                                  
                                       @if($job->part_order_id != NULL)
                                      
                                    <a class="btnact js-mytooltip" data-tooltip="Parts Order Request" href="{{URL::route('EditPartsOrder',$job->job_id)}}" ><i class="fa fa-first-order"></i></a>
                                    @endif
                                    @if($job->claim_id != NULL)
                                    <a class="btnact js-mytooltip" data-tooltip=" Request For claim" href="{{URL::route('EditAdminClaim',$job->job_id)}}" ><i class="fa fa-file"></i></a>
                                    @endif
                                    @endif

                                </td>
                                @if($job->claim_approve ==1)
                                <td> <select class="sel_comp" disabled>
                                <option value="{{$job->status_id}}">{{$job->status_code}}-{{$job->status_description}}</option>
                                </select></td>
                                @else <td>
                                <select class="changestatus" data-id="{{$job->job_id}}" data-sym="{{$job->symptom_id}}" data-fal="{{$job->faulty_id}}"data-res="{{$job->resolution_id}}" data-symptom="{{$job->symptom_description}}" data-resol="{{$job->resolution_description}}" data-faulty="{{$job->faulty_description}}" data-repair="{{$job->repaire_order_no}}"
                                data-fname="{{$job->firstname}}" data-lname="{{$job->lastname}}" data-addrs="{{$job->cu_address}}" data-phn="{{$job->phone_no}}" data-bus="{{$job->bussiness_number}}" data-partorder="{{$job->	part_order_id}}" 
                                data-grnspare="{{$job->grn_spare}}"  data-techprob="{{$job->tech_prob}}" data-dented="{{$job->dented}}" data-photogr="{{$job->photogr}}" data-returnacc="{{$job->return_acc}}" data-purdate="{{$job->grn_purchase}}" data-appldate="{{$job->grn_appl}}" data-compdate="{{$job->complaint_date}}" data-gooddate="{{$job->goods_date}}" data-mod="{{$job->product_id}}" data-grnres="{{$job->reason_for_retrun}}" data-grnseriel="{{$job->grn_seriel}}"
                                data-rmaspare="{{$job->gma_spare}}" data-rmaseriel="{{$job->gma_seriel}}" data-warcard="{{$job->warranty_card}}" data-panser="{{$job->panel_serial_no}}" data-panmod="{{$job->panel_model}}" data-accnt="{{$job->delear_Account_numner}}" data-compl="{{$job->complaints}}"  data-rmares="{{$job->reason_for_return}}" data-rmaappl="{{$job->gma_appl}}"  data-rmapurchase="{{$job->gma_purchase}}" data-daterec="{{$job->date_received}}" data-othe="{{$job->other}}"
                                data-mileage="{{$job->mileage}}" data-clamount="{{$job->claim_amount}}" data-labour="{{$job->labour}}" 
                                data-jobloc="{{$job->job_location}}"  data-jobremark="{{$job->remark}}"  data-fround="{{$job->turn_fround_time}}" data-jobdesc="{{$job->description}}"  data-asploc="{{$job->asp_location}}" data-grnid="{{$job->grn_id}}" data-rmaid="{{$job->gma_id}}"
								data-prdrepid="{{$job->	product_replacement_id}}">
                                <option value="{{$job->status_id}}">{{$job->status_code}}-{{$job->status_description}}</option>
                                @foreach($status as $tech)        
                                   <option data-name="{{$tech->status_code}}" value="{{$tech->status_id}}">{{$tech->status_code}}-{{$tech->status_description}}</option>
                                   @endforeach
                            </select>
                                </td> @endif
                          
                               

                                 <td> <select class="sel_ware" data-id="{{$job->job_id}}">
                                 @if(isset($job->asp_location))
                                                    <option value="{{ $job->code }}">{{ $job->code}} - {{ $job->name}} </option>
                                                @endif
                                 <option value="">Please Select</option>
                                 @foreach($warehouses as $tech)
                                <option value="{{$tech->code}}">{{$tech->code}} - {{$tech->name}}  </option>
                                @endforeach
                                </select></td>

                               <td> <?php  $query = App\Models\User::leftjoin('asp_tech','asp_tech.asp_technician','=','users.id')
                ->leftjoin('asp_admin','asp_tech.warehouse_code','=','asp_admin.warehouse_code')
                ->where('asp_tech.warehouse_code','=',$job->asp_location)
                ->where('users.user_role_id','=',3)
              
               ->get();
			   ?>
                               <select class="assigntech" style="width: 110px;" id="jo-tech_{{$job->job_id}}" data-id="{{$job->job_id}}">
                                
                               
                                            @if(isset($job->ass_tech))
                                                    <option value="{{ $job->id }}">{{ $job->username}}</option>
												 @endif
                                            @if($job->asp_location)
												@foreach($query as $qr)
											     <option value="{{ $qr->id }}">{{ $qr->email}}</option>
											@endforeach
											 @endif
                                            <option value="0">Please Select</option>
                                               


                                </select>
                                </td>
                                <td>{{$job->job_location}}</td>
                                <td>{{$job->repaire_order_no}}</td>
                                <td></td>
                              
                                <td>{{str_limit($job->cu_address,25)}}</td>
                                
                                <td>{{$job->phone_no}}</td>
                               
                                <td>{{$job->turn_fround_time}}</td>

								  @if($job->appointment_time)
                                <td>{{date('d-m-Y', strtotime($job->appointment_time))}}</td>
							@else<td></td>
							@endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$job->description}}</td>
                                <td></td>
                                <td></td>
                                
                                <!-- <td>{{$job->item}}</td> -->
                                <!-- <td>{{$job->item_purchase_date}}</td>
                                <td>{{$job->item_serial_number}}</td> -->
                            
                                <!-- <td>{{$job->product_replacement}}</td> -->
                                <!-- <td>{{$job->name}}</td> -->




                                
                            </tr>
                             @endforeach
                             @endif
                            </tfoot>
                        </table>
                    </div>
                  
                </div>
                 
                
                </div>
              
        </div>
        {{$jobs->links()}}
        <!-- /.content -->
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
        

              <form id="apptform" autocomplete="off">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control"  id="job22id" name="job_id"  type="text" readonly>
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
              <label>	Bill To Name</label>
              <textarea class="form-control" id="address"  type="text" readonly></textarea>
            </fieldset>
          </div>
		   
		  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Contact Number</label>
              <input class="form-control" id="phone22"  type="text" readonly>
            </fieldset>
          </div>
		  
         
        </div>
		 <hr>
		
			<!-- <div class="row">
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
		 -->
        <div class="row">


          
        <div class="col-lg-4 select-pane">
        <fieldset class="form-group">
              <label>Appointment Date</label>
            
                    <input class="form-control datepicker" name="datepicker" id="datepicker_appt"  type="text" recquired >
                    <!-- <input class="form-control" name="datepicker" type="text" id="tbDate" /> -->
                    
            </fieldset>
            </div>
            
            <div class="col-lg-4 select-pane">
        <fieldset class="form-group">
              <label>Appointment Time</label>
              @if(isset($job))
              <input type="hidden" name="app_id" value="{{$job->appointment_id}}">
              @endif
                    <input class="form-control" name="time"  id="value_Date_Listed_2"  type="text" recquired >

            </fieldset>
            </div>

          
          </div>
		<div class="col-md-12 cenbut">
        
    <input type="hidden" name="type" value="newAppointment">
  
@if(isset($job))
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
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty" id="faulty11">
                                            <option id="part_faulty" value="0">Select Faulty Code</option>
                                           
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom" id="symptom11">
                                            <option id="part_symptom" value="0">Select Symptom Code</option>
                                           
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution" id="resolution11">
                                            <option id="part_resol" value="0">Select Resolution Code</option> 
                                            

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
         
          


           <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
                @if(isset($job))
                <input class="form-control"  name="qnty[]" value="{{$job->parts_qty}}"  id="placeholderInput"  type="text">
                @else
                <input class="form-control"  name="qnty[]"   id="placeholderInput"  type="text" recquired>
@endif
                

              </fieldset>
            </div>
            <div class="col-lg-2">
              <fieldset class="form-group">
              <label>&nbsp;</label>
            <button type="button" class="btn btn-info pull-right answer_next" style="margin-top: 30px;
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
  </div> -->




<!-- <div class="modal fade" id="claimModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
              <input class="form-control" id="jobid1" name="jobid" type="text"  readonly>

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
                                            <select class="form-control" name="faulty" id="faulty55">
                                            <option value="">Select Faulty Code</option>
                                            <option id="faulty_op"></option>

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
                                            <select class="form-control" name="resolution" id="resolution55">
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
             <input type="hidden" name="job_id" value="{{$job->job_id }}">
             @endif
              
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10"> Submit </button>
              
                 
                </div>
              </form>
           
        </div>
        
      </div>
    </div>
  </div> -->


    
<!-- <div class="modal fade" id="rmaModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create RMA </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

 <form action="{{url('/post-rma-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
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
                                            <select class="form-control" name="faulty" id="faulty44">
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
                                            <select class="form-control" name="symptom" id="symptom44">
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
                                            <select class="form-control" name="resolution" id="resolution44">
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
                <label>Model</label>
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

              <textarea class="form-control"  name="complaints" id="reason"  type="text" ></textarea>

            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Remarks</label>

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
   
                 <input class="form-control"  name="appl_date" id="appl_date"  type="text" >
   
               </fieldset>
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label> Date Received</label>
   
                 <input class="form-control"  name="date_rece" id="date_rece"  type="text" >
   
               </fieldset>
               </div>
</div>

<hr>
<div class="row">
<div class="col-lg-4">
               <fieldset class="form-group">
                                            <label>Select EX/CN</label><br>
                                            <input type="radio" name="approve" value="1" > Credint note &nbsp;
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
<h4 class="sympd">Symptom/Defect</h4>


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


             <form action="{{url('/post-grn-tss')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
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
                                            <select class="form-control" name="faulty" id="faulty33">
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
                                            <select class="form-control" name="symptom" id="symptom33">
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
                                            <select class="form-control" name="resolution" id="resolution33">
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
                   <label>Model</label>
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
   
                 <input class="form-control"  name="reason" id="reason"  type="text" >
   
               </fieldset>
               </div>
              
               <div class="col-lg-4 ">
           <fieldset class="form-group ">
                 <label>Serial Number</label>
   
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
   <div class="row">
   <div class="col-lg-4">
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
               </div>
               <div class="col-lg-4">
           <fieldset class="form-group">
                 <label>Purchase Date</label>
   
                 <input class="form-control"  name="purchase_date" id="purchase_date"  type="text" >
   
               </fieldset>
               </div>
</div>
<hr>
           <div class="row" id="amntdiv">
   
           
              
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

    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="delete_id" type="hidden" name="delete_id" value="" />
                        <input type="hidden" name="type"   value="delete_job" />

                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Delete Job</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <p>Are you sure to Delete Job?</p>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
 
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
                        <h6><i class="fa fa-check-circle" aria-hidden="true"></i> Are you Confirm?</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 cl_no" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success">Yes</button>

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

                        <button type="submit" class="btn btn-success" >Yes</button>

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
    <div id="AssignModal" class="modal fade">
        <div class="modal-dialog">
            <form id="technmodal">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="job_id" type="hidden" name="job_id" value="" />
                        <input id="user_id" type="hidden" name="user_id" value="" />
                        <input type="hidden" name="type"   value="JobAssignTech" />
                     
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Assign Asp Technician</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6> Are you sure</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 " data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
	
	  <div id="AssignAspModal" class="modal fade aspware">
        <div class="modal-dialog">
            <form id="aspwaremodal">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="job_id_ware" type="hidden" name="job_id" value="" />
                        <input id="code" type="hidden" name="code" value="" />
                        <input type="hidden" name="type"   value="JobAssignWare" />
                     
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
              <h5 class="modal-title">Assign Asp</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    <div class="modal-body">
                        <h6> Are you sure</h6>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                       
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1 " data-dismiss="modal">No</button>

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
                        <button type="button" class="btn btn-danger m-r-1" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success " >Yes</button>

                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
@endsection

@section('footer')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
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
    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
    <!-- <script src="{{ asset('assets/admin/plugins/table-expo/filesaver.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/xls.core.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/tableexport.js')}}"></script> -->
<script src="{{ asset('assets/admin/js/jquery.tabletoCSV.js')}}"></script>
<script src="{{ asset('assets/admin/js/wickedpicker.min.js')}}"></script>
<!-- <script src="{{ asset('assets/admin/js/listjob.js')}}"></script> -->

    <!-- <script>$(function() {
$("input[rel='date']").datepicker({dateFormat: "dd-M-yy"});
}); -->
</script>
<script>

// $(window).on("load",function(){
//     $( "#mod" ).removeClass( "hidden");
    
//     setTimeout( function() { $("#mod").addClass( "hidden"); }, 3000 );
  
// });
jQuery('#datepicker_appt').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
jQuery('#datepicker').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});
  jQuery('#purchase_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
 jQuery('#place_order').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});

jQuery('#appl_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
jQuery('#date_rece').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
jQuery('#appl_date1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
jQuery('#comp_date').datetimepicker({
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
$('#value_Date_Listed_1').wickedpicker({
    useCurrent: false,
});
$('#value_Date_Listed_2').wickedpicker({
    showInputs: false,
});
$("#daterange").daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
        $(document).ready(function(){
       
            $(".close").click(function(){
    location.reload(true);

});
$(document).ready(function(){
    
$(".cl_no").click(function(){
    location.reload(true);

});

            
$('#getbtn').on('click', function() {

var dateRange = $('#daterange').val();
var token = "{{ csrf_token() }}";
var type = 'filter_list_all';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,dateRange:dateRange,_token:token},
               success: function(data){
                   if(data.status==1){
                        $("#example2").removeClass('hidden');
                       $("#example2").html(data.html);
                         $(".no_f").addClass('hidden');

                   }else{
                    $(".no_f").removeClass('hidden');

                         $("#example2").addClass('hidden');
                     }

               }
           });
});


$(document).on('click', '.removediv', function(e) {
   $(this).parent().parent().parent().remove();
});
$('#getasp').on('click', function() {

var asp = $('#asp_location').val();
var token = "{{ csrf_token() }}";
var type = 'filter_asp_all';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,asp:asp,_token:token},
             success: function(data){
                 if(data.status==1){

                 $("#example2").removeClass('hidden');
                     $("#example2").html(data.html);
                        $(".no_f").addClass('hidden');
                 }else{
					 
                    $(".no_f").removeClass('hidden');
                   
                         $("#example2").addClass('hidden');
                     }

             }
         });
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
$('#gettech').on('click', function() {

var technician = $('#technician').val();
var token = "{{ csrf_token() }}";
var type = 'filter_tech_all';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: {type:type,technician:technician,_token:token},
             success: function(data){
                 if(data.status==1){
$("#example2").removeClass('hidden');
                     $("#example2").html(data.html);
                           $(".no_f").addClass('hidden');
                 }else{
                    $(".no_f").removeClass('hidden');
                         $("#example2").addClass('hidden');
                     }

             }
         });
});

       $("#export11").click(function(){

$("#example2").tableToCSV();

});

$('#getstat').on('click', function() {

var status = $('#status').val();

var token = "{{ csrf_token() }}";
var type = 'filter_stat';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                 if(data.status==1){
$("#example2").removeClass('hidden');
                     $("#example2").html(data.html);
                      $(".no_f").addClass('hidden');
                 }else{
                    $(".no_f").removeClass('hidden');
                   $("#example2").addClass('hidden');
                     }

             }
         });
});

$('#getcsv').on('click', function() {

var status = $('#status').val();

var token = "{{ csrf_token() }}";
var type = 'filter_csvs';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                 if(data.status==1){
$("#example2").removeClass('hidden');
                     $("#example2").html(data.html);
                     $(".no_f").addClass('hidden');
                 }else{
                    $(".no_f").removeClass('hidden');
                         $("#example2").addClass('hidden');
                     }

             }
         });
});

$('#getsw').on('click', function() {

var status = $('#status').val();

var token = "{{ csrf_token() }}";
var type = 'filter_sws';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                 if(data.status==1){
$("#example2").removeClass('hidden');
                     $("#example2").html(data.html);
                    $(".no_f").addClass('hidden');
                 }
				 else{
                    $(".no_f").removeClass('hidden');
                    $("#example2").addClass('hidden');
                     }

             }
         });
});
$('.assigntech').on('change', function() {
    
           var user_id=this.value;
           $('#user_id').val(user_id);
         var job_id = $(this).attr("data-id");
         $('#job_id').val(job_id);
         $('#AssignModal').modal('show');
        }); 
          
        $("#technmodal").validate({
    
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },

    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#technmodal").serialize();

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



$('.sel_ware').on('change', function() {
    
              var user_id=this.value;
			  
           $('#code').val(user_id);
		   
         var job_id = $(this).attr("data-id");
         $('#job_id_ware').val(job_id);

         $('#AssignAspModal').modal('show');
      
          
        $("#aspwaremodal").validate({
    
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },

    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#aspwaremodal").serialize();
             $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                 if(data.status==1){
                              
                    $('#modalFooter').addClass('hidden');          
                 $("#jo-tech_"+data.url).html(data.html);
				 $('.modal-body').html('Successfully Assigned');
				// $('.aspware').addClass('hidden');
				          $('#AssignAspModal').modal('hide');

                                        }
            }
        });
       
        return false;
    }

});
  }); 
$('.filter').on('change', function() {
  var att =this.value;
  if(att==3){
      $( ".date" ).show();
      $( ".ware" ).hide();
      $( ".techn" ).hide();
      $( ".stat" ).hide();
	  $( ".sw" ).hide();
    $( ".cser" ).hide();
  }
  if(att==1){
      $( ".ware" ).show();
      $( ".date" ).hide();
    
      $( ".techn" ).hide();
      $( ".stat" ).hide();
	  $( ".sw" ).hide();
    $( ".cser" ).hide();
  }
  if(att==2){
      $( ".techn" ).show();
      $( ".stat" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
	  $( ".sw" ).hide();
    $( ".cser" ).hide();
    
  }
  if(att==4){
      $( ".stat" ).show();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
    $( ".sw" ).hide();
    $( ".cser" ).hide();
  }
  if(att==5){
    $( ".cser" ).show();
    $( ".stat" ).hide();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
  }
  if(att==6){
    $( ".sw" ).show();
    $( ".cser" ).hide();
    $( ".stat" ).hide();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
  }
});

            $("#ajaxForm").validate({
                rules: {
                    job_location: {
                        required: true,
                    },rep_order_no: {
                        required: true,
                    },first_name: {
                        required: true,
                    },last_name: {
                        required: true,
                    },address: {
                        required: true,
                    },pincode: {
                        required: true,
                        digits:true,
                    },phone: {
                        required: true,
                        digits:true,
                    },bus_num: {
                        required: true,
                        digits:true,
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
                    $( "#mod" ).removeClass( "hidden" )
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body").html("Job created");
                                $('#myModal').modal('show');
                              window.location.href="{{URL::route('Jobs')}}";
                            }, 1000);

                        }
                    });
                    return false;
                }
            });
            
            $("#partsform").validate({
    rules: {
        email: {
            required: true,
        },
        qnty: {
            required: true,
            digits:true,
        },
        password: {
            required: true,
        },parts: {
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
        $( "#mod" ).removeClass( "hidden" )
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body").html("Ordered parts successfully");
                                        $('#myModal').modal('show');
                  window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
// $("#AssingWare").validate({
//                 errorPlacement: function(error, element) {
//                     console.log(element.attr('name'));
//                     $( error ).insertAfter( element);
//                 },

//                 submitHandler: function(form) {

//                     // do other things for a valid form
//                     var formData = $("#AssingWare").serialize();

//                     $.ajax({
//                         type: 'post',
//                         url: "{{ URL::route('postData') }}",
//                         data:formData,
//                         success: function(data){
//                             if(data.status == 1){
//                                 $("#jo-tech").html(data.html);
//                                 $('.modal-body').html('Successfully Assigned');
//                                 $('#modalFooter').addClass('hidden');
//                                 $('#AssignModal').addClass('hidden');

                              

//                             }
//                         }
//                     });
//                     return false;
//                 }

//             });

//  $('#mileage').on('change', function() {
//     var mil =this.value;
//     if(mil == 1){
//         $( "#amount" ).val( "200" );
//     }
//     if(mil == 2){
//         $( "#amount" ).val( "400" );
//     }
//     if(mil == 3){
//         $( "#amount" ).val( "600" );
//     }
    
// })
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

}) ;
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
        $( "#mod" ).removeClass( "hidden");
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body").html("Claim Submitted");
                    $('#myModal').modal('show');
                  window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});

 
$("#apptform").validate({
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
        var formData = $("#apptform").serialize();
        $("#modal-body lodgif").html("Your formhas been successfully submitting...");
        $( "#mod" ).removeClass( "hidden");
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body").html("Appointment Created");
                    $('#myModal').modal('show');
                window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
$('.parts_select').on('change', function() {
    var desc =this.value;
  
        var token = "{{ csrf_token() }}";
     var type = 'part_descrip';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,desc:desc,_token:token},
             success: function(data){
                 if(data.status==1){
                   
                     $("#descr").html(data.html);
                    
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
		
 $('.changestatus').on('change', function() {
           var status =this.value;
         var job_id = $(this).attr("data-id");
     var sympt_id = $(this).attr("data-sym");
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
var mul_part_id =$(this).attr("data-mulpartid");

var mul_part =$(this).attr("data-mulparts");


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
	    var partorder =$(this).attr("data-partorder");
	    var grnid =$(this).attr("data-grnid");

			    var rmaid =$(this).attr("data-rmaid");
				
			    var prdrepid =$(this).attr("data-prdrepid");

	
//Claim

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
        
      

         window.location = "{{ URL::route("Pendingpart") }}/"+job_id; 
    }
    if(status == 63){

       window.location = "{{ URL::route("Pendingpart") }}/"+job_id; 

    }

          if(status == 64){
                      window.location = "{{ URL::route("Pendingpart") }}/"+job_id; 
        }
        if(status == 67){
           
           window.location = "{{ URL::route("Pendingpart") }}/"+job_id; 
       
        }
		
		
		
		
		
		
		
        if(status == 80){
            $('#jobidcus').val(job_id);
            $('#CustomerNotModal').modal('show');

        }
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
                    return false;63
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
        //                                     //     location.reload();
        //                                 }

        //                             }

        //                         });
})


 
            $('.deleteButton').click(function(){

                var user_id = $(this).attr('data-id');
                $('#delete_id').val(user_id);
            });
            
            $("#deleteModalForm").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#deleteModalForm").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('PostRemove') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html(' Successfully Deleted');
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

        });
     
var max_fields      = 5; //maximum input boxes allowed
            var Rows         = $("#Rows"); //Fields wrapper
            var answer_next      = $(".answer_next"); //Add button ID
             $(answer_next).click(function(e){ e.preventDefault()
                
$(Rows).append('<div class="container remdiv">'+'<div class="row row_hide">'+' <div class="col-lg-6">'+
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
                        ' <input class="form-control" name="qnty[]" value="1"  id="placeholderInput"  type="text" readonly><button class="removediv" style=" width: 33px;height: 36px;margin-top: 28px;" type="button" id="removediv"> <span aria-hidden="true">&times;</span></button>'+
                        ' </fieldset>'+
                        '</div>'+
						'</div>'+
                        '</div>'
                       
                       
                        
                        
                    
                );
            });

   });
   </script>
    <!-- <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script> -->
    
@endsection
