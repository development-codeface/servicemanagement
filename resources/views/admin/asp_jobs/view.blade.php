@extends('layouts.admin2')

@section('header')

@endsection

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1 style="margin-left: 36px;">Job View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Job View</li>
            </ol>
        </div>


        <div class="content row">

  <div class="col-md-12">
          <a href="{{ URL::route('AspJobs') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
 <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0 f_w">Repair Order No# {{$job->repaire_order_no}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">{{date('d-m-Y', strtotime($job->job_date))}}  </span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label">Status : </span>
                             
                                    <span class="label label-warning">{{$job->status_code}}-{{$job->status_description}}</span>
                                </div>
                                
                                @if($job->status_id==41)
                                <div class="ml-auto mgtap">
                                    <span class="label">Invoice : </span>
                                
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GeneratePdfGrn',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>
                                </div>
                                
                                @endif
                                @if(!empty($user1))
                                
                              
                                <div class="ml-auto mgtap">
                                    <span class="label">Spare Part Delivery Order : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateDeliveryParts',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>                               
                                    </div>
                                    @endif
									<!-- isue -->
                                    @if(!empty($user))
                                    @if($user->product_replacement_type=='grn')
                                <div class="ml-auto mgtap">
                                    <span class="label">GRN Report : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateGrnReport',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>                               
                                    </div>
                                    @if($user->grn_credit!=NULL)
                                    <div class="ml-auto mgtap">
                                    <span class="label">Credit Note : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateCreditNote',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>                               
                                    </div>
                                    @else
                                    <div class="ml-auto mgtap">
                                    <span class="label">Transfer Order : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateTransfer',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>                               
                                    </div>
                                    @endif
                                    <div class="ml-auto mgtap">
                                    <span class="label">GRN Delivery Order : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateDeliveryReport',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>                               
                                    </div>
                                   
                                    @else
                                    <div class="ml-auto mgtap">
                                    <span class="label">RMA Report : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateRmaReport',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>      
                                       </div>
                                       <div class="ml-auto mgtap">
                                    <span class="label">RMA Delivery Order : </span>
                                    <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateDeliveryReport',$jo_id)}}" ><i class="fa fa-file-pdf-o pdf_i"></i></a>      
                                       </div>
                                       @endif
                                       @endif
                                   
									
									<!-- isue -->
                              

                               
                            </div>
                        </div>

                    </div>
               
             
                </div>
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
                              
                <div class="box box-primary">

                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Job Location</h2>
                                <p> {{$job->job_location}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Repair Order No</h2>
                                <p > {{$job->repaire_order_no}}  </p>

                            </div>
                           
                        </div>
                        <hr>


                        <div class="row tx_hd">
                       
                            <div class="col-lg-4">
                                <h2> Bill To Name</h2>
                                <p > {{$job->cu_address}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                Contact Number</h2>
                                <p >{{$job->phone_no}}</p>

                            </div>
                        </div> <hr>
                        <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Faulty Code</h2>
                                <p> {{$job->faulty_description}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Symptom Code</h2>
                                <p > {{$job->symptom_description}}  </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Resolution Code</h2>
                                <p > {{$job->resolution_description}}  </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Model</h2>
                                <p> {{$job->product}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Serial Number</h2>
                                <p > {{$job->seriel_number}}  </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Service Item Group</h2>
                                <p > {{$job->servicetype}}  </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row tx_hd">
                       
                           
                          
                            <div class="col-lg-4">
                                <h2>
                                    Turn Around Time</h2>
                                @if($job->turn_fround_time)
                                <p>{{$job->turn_fround_time}} days</p>
                                @endif

                            </div>
							 <div class="col-lg-4">
                                <h2>
                                   Appointment Date</h2>
                               @if($job->appointment_time) <p >{{date('d-m-Y', strtotime($job->appointment_time))}}</p>
                               @else<p></p>
                               @endif

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                   Appointment Time</h2>
                               @if($job->appointment_time) <p >{{$job->time}}</p>
                               @else<p></p>
                               @endif

                            </div>
                        </div>
                        <hr>
                        <div class="row tx_hd">
						 
							 <div class="col-lg-4">
                                <h2>
                                   Complaints/Remark</h2>
                                <p > {{$job->job_remark}}</p>

                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                   Description</h2>
                                <p > {{$job->description}}</p>

                            </div>
                            </div>
						 <hr>
						
						
                            
                            <div class="row tx_hd">
                           

                        
                           
                            
                            <div class="col-lg-4">
                                <h2>
                                    ASP Name</h2>
                                <p> {{$job->code}} - {{$job->name}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                ASP Technician</h2>
                                <p > {{$job->username}}</p>

                            </div>
                            </div>
                            
                    </div>
             
                </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               Parts Order
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div class="box box-primary">

                    <div class="edc">
                        <div class="row tx_hd hidden">
                            <div class="col-lg-4">
                                <h2> Faulty Code</h2>
                                <p> {{$job->faulty_description}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Symptom Code</h2>
                                <p > {{$job->symptom_description}}  </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Resolution Code</h2>
                                <p > {{$job->resolution_description}}  </p>

                            </div>
                        </div>
                        <!--<hr> -->


                        <div class="row tx_hd">
                        <div class="col-lg-4">
                                <h2> Remark</h2>
@if(!empty($part))<p > {{$part->remark}} </p>@endif
                            </div>
                            
                           
                        </div> <hr>
						 <?php $i=1;?>
                                   @foreach($mul_parts as $mul) 
                        <div class="row tx_hd">
                       
                            <div class="col-lg-4">
                                <h2>
                                    Part</h2>
                                <p >{{$mul->part_no}}</p>

                            </div>
                          
                            <div class="col-lg-4">
                                <h2>
                                    Description</h2>
                                <p > {{$mul->parts_description}}</p>

                            </div>
							<div class="col-lg-4">
                                <h2>
                                    Quantity</h2>
                                <p > {{$mul->quantity}}</p>

                            </div>
                        </div><hr>
						 <?php $i++;?>
                                    @endforeach
                       
                        <div class="row tx_hd">
                        @if($job->isapprove !=0)
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Approve/Reject</label><br>
                                        @if($job->isapprove==1)<input type="radio" name="rejectval" value="1" checked disabled> Approve &nbsp; @endif
                                        @if($job->isapprove==2) <input type="radio" name="rejectval" value="2" checked disabled>  Reject<br>  @endif											
                                            </fieldset>
                                </div>
                            @endif					
                                        
                            @if($job->isapprove==1 || $job->isapprove==2)
                                        <div class="col-lg-4 @if($job->isapprove==2) hidden @endif ">
                                            
                                            <h2>Delivery Date</h2>
                                                @if($job->delivery_date)
                                                <p> {{date('d-m-Y', strtotime($job->delivery_date))}} </p>
                                                @else
                                                <p></p>
                                                @endif   
                                        </div>
                                
                            
                                        <div class="col-lg-4" >
                                            
                                                <label> Remarks</label>
                                                <p >{{$job->apprv_remarks}}</p>                                      
                                                
                                        </div>
                            @endif
                            </div>
                           
                          

                           
                </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                GRN
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
                           <div class="box box-primary">

                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4 hidden">
                                <h2> Model</h2>
                                <p> {{$job->product_description}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Reason For Return</h2>
                                <p > {{$job->reason_for_retrun}}  </p>

                            </div>
                             <div class="col-lg-4 hidden">
                            <h2> Serial Number</h2>
                                <p > {{$job->grn_seriel}}  </p>

                            </div>
                        </div>
                        <hr>


                        <div class="row tx_hd">
                        <div class="col-lg-4">
                                <h2> Technical problem-Attach proof of purchase & Tech forum</h2>
                               <input type="checkbox" class="" id="tech_prob" name="tech_proof"
               value="1"   @if($job->tech_prob == 1) checked=checked @endif />

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Dented /Damaged Transit&nbsp;</h2>
 <input type="checkbox" id="dented" name="dented"
               value="1"    @if($job->dented == 1) checked=checked @endif/>   
            
                            </div>
                            <div class="col-lg-4">
                                <h2> Photography Of Tss Do,or shipping label&nbsp;</h2>
<input type="checkbox" class="" id="photogr" name="photo"
               value="1"  @if($job->photogr == 1) checked=checked @endif />
                            </div> 
                            <div class="col-lg-4">
                                <h2> Complete Return Of Acc/WTY card/Manual&nbsp;</h2>
 <input type="checkbox" id="returnacc" name="ret_acc"
               value="1"  @if($job->return_acc == 1) checked=checked @endif />  
                            </div>
                           <div class="col-lg-4">
                                <h2> Parts Supply problem:PENDING/NO PARTS&nbsp;</h2>
 <input type="checkbox" id="returnacc" name="ret_acc"
               value="1"  @if($job->pending_part == 1) checked=checked @endif />  
                            </div>
                             @if($job->tech_prob == 1)<div class="col-lg-4">
                                <h2> Date Place Order&nbsp;</h2>
                       @if($job->place_order)<p >{{date('d-m-Y', strtotime($job->place_order))}}</p> @endif
                            </div>@endif
                            
                        </div> 
                        <div class="row tx_hd">
                       
                            @if($job->tech_prob == 1)<div class="col-lg-4">
                                <h2>
                                    Spare Part No</h2>
                                <p >{{$job->grn_spare}}</p>

                            </div>@endif
                            
                            @if($job->tech_prob == 1)
                                <div class="col-lg-4">
                                <h2>
                                   Attach Proof</h2>
                                @if($job->attach_proof)
                                <p>
                                @if($is_proof_image)
                                    <a href="#img{{$i}}">
                                        <img src="{{ url('data/products/'.$job->attach_proof) }}" style="width: 124px;height: 66px;"class="thumbnail">
                                    </a>
                                    <!-- lightbox container hidden with CSS -->
                                    <a href="#_" class="lightbox" id="img{{$i}}">
                                        <img src="{{ url('data/products/'.$job->attach_proof) }}">
                                    </a>
                                @else
                                <a href="{{ url('data/products/'.$job->attach_proof) }}">{{$job->attach_proof}}</a>
                                @endif
                                </p>
                                @endif

                            </div>
                            @endif
                            @if($job->is_ex_cn != NULL)
                            <div class="col-lg-4">
                                <h2>
                                    Select EX/CN</h2>
<input type="radio" name="approve" value="1" @if($job->is_ex_cn == 1) checked @endif disabled> Credit note &nbsp;
                                             <input type="radio" name="approve" value="2" @if($job->is_ex_cn == 2) checked @endif disabled> Exchange<br>  
                            </div>
							@endif
							@if($job->is_ex_cn == 2)
                                <div class="col-lg-4">
                                    <h2>Exchange Number</h2>
                                    <p >{{$job->grn_ex}}</p>
                                </div>
                                <div class="col-lg-4">
                                    <h2>Remarks</h2>
                                    <p >{{$job->grn_remarks}}</p>
                                </div>
							@endif
							
                        </div>
                       
                        @if($job->is_ex_cn == 1)
							 <div class="row tx_hd">
							 
						 <div class="col-lg-4">
                                <h2>
                                    Credit Note</h2>
                                <p >{{$job->grn_credit}}</p>

                            </div>
							<div class="col-lg-4">
                                <h2>
                                    Amount</h2>
                                <p >{{$job->grn_amount}}</p>

                            </div>
							<div class="col-lg-4">
                                <h2>
                                    Last Selling Price</h2>
                                <p >{{$job->sell_price}}</p>

                            </div>

                            <div class="col-lg-4">
                                <h2>Remarks</h2>
                                <p >{{$job->grn_remarks}}</p>

                            </div>
							

							
						 </div>
						 @endif
						 <hr>
                         <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>Dealer Name</h2>
                                @if($job->dealer_name)<p > {{$job->dealer_name}}</p>@endif
                            </div>
                            <div class="col-lg-4">
                                <h2>Dealer Address</h2>
                                @if($job->dealer_address)<p > {{$job->dealer_address}}</p>@endif
                            </div>
                            <div class="col-lg-4">
                                <h2>Dealer Account Number </h2>
                                @if($job->dealer_acc)<p > {{$job->dealer_acc}}</p>@endif
                            </div>
                        </div>
                        <hr>
                                
                            <div class="row tx_hd">
                          
                            <div class="col-lg-4">
                                <h2>
                                   Purchase Date</h2>
                                @if($job->grn_purchase)<p > {{date('d-m-Y', strtotime($job->grn_purchase))}}</p>@endif

                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                   Goods Receive Date</h2>
                                @if($job->goods_date)<p > {{date('d-m-Y', strtotime($job->goods_date))}}</p>@endif

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                   Picture Of Symptom</h2>
                                   @if($job->grn_image)
                                <p>
                                @if($is_symptom_image)
                                    
                                        <a href="#img{{$i}}">
                                        <img src="{{ url('data/products/'.$job->grn_image) }}" style="width: 124px; height: 66px;"class="thumbnail"></a>
                                        <!-- lightbox container hidden with CSS -->
                                        <a href="#_" class="lightbox" id="img{{$i}}">
                                        <img src="{{ url('data/products/'.$job->grn_image) }}">
                                        </a>
                                    
                                @else 
                                <a href="{{ url('data/products/'.$job->grn_image) }}">{{$job->grn_image}} </a>
                                @endif
                                </p>
                                @endif
                            </div>
                            </div>
                           
                            <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                   Delivery Date</h2>
                                @if($job->prod_del)<p > {{date('d-m-Y', strtotime($job->prod_del))}}</p>@endif

                            </div>
                            </div>
                            
                    </div>
             
                </div>
                        </div>
                    </div>
                </div>
				  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingfor">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsfor" aria-expanded="false" aria-controls="collapsfor">
                                RMA
                            </a>
                        </h4>
                    </div>
                    <div id="collapsfor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfor">
					@if($job->gma_id)
							<br>
							<a href="{{URL::route('GenerateRmaReport',$jo_id)}}"  class="btn btn-success pull-right brz">Print Report</a>
						<br>
						<!--a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateRmaReport',$job->job_id)}}" ></a-->
						
						@endif
                        <div class="panel-body">
                         <div class="box box-primary">

                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Purchase Date</h2>
                                @if($job->gma_purchase)<p> {{date('d-m-Y', strtotime($job->gma_purchase))}} </p>@endif

                            </div>
                            <div class="col-lg-4">
                            <h2>Warranty Card Number</h2>
                                <p > {{$job->warranty_card}}  </p>

                            </div> 
							<div class="col-lg-4">
                            <h2>Panel Serial No</h2>
                                <p > {{$job->panel_serial_no}}  </p>

                            </div>
                           
                        </div>
                        <hr>


                        <div class="row tx_hd">
                        <div class="col-lg-4">
                                <h2> Panel Model</h2>
                                <p > {{$job->panel_model}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Main Dealer Account No</h2>
                                <p > {{$job->delear_Account_numner}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2> Complaints</h2>
                                <p > {{$job->complaints}} </p>

                            </div>
                           
                        </div> <hr>
                        <div class="row tx_hd">
                       
                            <div class="col-lg-4">
                                <h2>
                                    Remarks</h2>
                                <p >{{$job->reason_for_return}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                   Picture Of Symptom</h2>
     @if($job->gma_image)<p > <a href="#img">
      <img src="{{ url('data/products/'.$job->gma_image) }}" style="width: 124px;
    height: 66px;"class="thumbnail">
    </a>
    
    <!-- lightbox container hidden with CSS -->
    <a href="#_" class="lightbox" id="img">
      <img src="{{ url('data/products/'.$job->gma_image) }}">
    </a></p>
	@else<p></p>
	@endif

                            </div>
							@if($job->is_cn_ex != NULL)
                            <div class="col-lg-4">
                                <h2>
                                  Select EX/CN</h2>
                              <input type="radio" name="approve" value="1" @if($job->is_cn_ex==1) checked @endif disabled> Credit note &nbsp;
                             <input type="radio" name="approve" value="2" @if($job->is_cn_ex==2) checked @endif disabled> Exchange<br>  

                            </div>
							@endif
                           
                        </div>
                        <div class="row tx_hd">
                        
						@if($job->is_cn_ex==1) 
                            <div class="col-lg-4">
                                <h2>Credit Note</h2>
                                <p >{{$job->gma_credit}}</p>
                            </div>
                            <div class="col-lg-4">
                                <h2>Amount</h2>
                                <p >{{$job->gma_amount}}</p>
                            </div>
						@endif
						@if($job->is_cn_ex==2)
							<div class="col-lg-4">
                                <h2>Exchange Number</h2>
                                <p>{{$job->rma_ex_number}}</p>
                            </div>
						@endif
                        @if($job->is_cn_ex) 
                            <div class="col-lg-4">
                                <h2>Remarks</h2>
                                <p >{{$job->rma_remarks}}</p>
                            </div>  
                            @endif
                        </div>
						<hr>
						
					
                            <div class="row tx_hd">
                          
                            <div class="col-lg-4">
                                <h2>
                                  Vertical Line &nbsp;</h2>
<input type="checkbox" id="vert_line" name="vert_line"
               value="1"  @if($job->vertical_line == 1) checked=checked @endif />   
                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                   Vertical Block&nbsp;</h2>
<input type="checkbox" id="vert_block" name="vert_block"
               value="1"  @if($job->vertical_block == 1) checked=checked @endif /> 
                            </div>
                            <div class="col-lg-4">
                                <h2>
                                   Horizontal Line&nbsp;</h2>
<input type="checkbox" id="hori_line" name="hori_line"
               value="1"  @if($job->hori_line == 1) checked=checked @endif />   
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                   Horizontal Block&nbsp;</h2>
 <input type="checkbox" id="hori_block" name="hori_block"
               value="1"   @if($job->horil_block == 1) checked=checked @endif/>  
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                  No Display&nbsp;</h2>                      
   <input type="checkbox" id="no_disp" name="no_disp"
               value="1"  @if($job->no_display == 1) checked=checked @endif /> 
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                   Abnormal Colour&nbsp;</h2>
<input type="checkbox" id="abnorm_colour" name="abnorm_colour"
               value="1"  @if($job->abnormal_color == 1) checked=checked @endif />  
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                   Uniformity Defect&nbsp;</h2>

                 <input type="checkbox" id="unif_defect" name="unif_defect"
               value="1"  @if($job->uniformity_defect == 1) checked=checked @endif />  
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                  Dot screen&nbsp;</h2>
 <input type="checkbox" id="dot_screen" name="dot_screen"
               value="1"  @if($job->dot_screen == 1) checked=checked @endif />   
                            </div>
							 <div class="col-lg-4">
                                <h2>
                                   White Screen&nbsp;</h2>

                 <input type="checkbox" id="flicker" name="flicker"
               value="1"  @if($job->flicker == 1) checked=checked @endif />   
                            </div>
							<div class="col-lg-4">
                                <h2>
                                  Flicker&nbsp;</h2>

                 <input type="checkbox" id="whit_screen" name="whit_screen"
               value="1"  @if($job->white_screen == 1) checked=checked @endif />  
                            </div>
							<div class="col-lg-4">
                                <h2>
                                  Black Light Defect&nbsp;</h2>

                <input type="checkbox" id="blck_defct" name="blck_defct"
               value="1"  @if($job->back_light == 1) checked=checked @endif />    
                            </div>
							<div class="col-lg-4">
                                <h2>
                                  Abnormal Picture&nbsp;</h2>

                <input type="checkbox" id="abnorm_pic" name="abnorm_pic"
               value="1"   @if($job->abnormal_pic == 1) checked=checked @endif/>     
                            </div>
                            </div>
                            <hr>

                            <div class="row tx_hd">
                           

                       
							<div class="col-lg-4">
                                <h2>
                                   Delivery Date</h2>
                                @if($job->prod_del)<p > {{date('d-m-Y', strtotime($job->prod_del))}}</p>@endif

                            </div>
							
                            
                          
                            <div class="col-lg-4">
                                <h2>
                                    Others</h2>
                                <p> {{$job->other}} </p>

                            </div>
                         
                            </div>
                            
                    </div>
             
                </div>
                        </div>
                    </div>
                </div>
				  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingfive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsfive" aria-expanded="false" aria-controls="collapsfive">
                                Claim
                            </a>
                        </h4>
                    </div>
                    <div id="collapsfive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                        <div class="panel-body">
                             <div class="box box-primary">

                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Mileage</h2>
                                <p> {{$claim->mileage}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2>Claim Amount</h2>
                                <p > {{$job->claim_amount}}  </p>

                            </div> 
							<div class="col-lg-4">
                            <h2>Labour</h2>
                                <p > {{$job->labour}}  </p>

                            </div>
                            @if($job->claim_approve!=0)
                                <div class="col-lg-4">
                                      
                                            <h2>Approve/Reject</h2>
                                            @if($job->claim_approve==1)
                                                <input type="radio" name="reject" value="1" checked disabled> Approve &nbsp;
                                            @else											
                                                <input type="radio" name="reject" value="1" disabled> Approve &nbsp;
											@endif

                                            @if($job->claim_approve==2) 
                                                <input type="radio" name="reject" value="2" checked disabled>  Reject<br>  
											@else
                                                <input type="radio" name="reject" value="2" disabled>  Reject<br> 
                                            @endif											
                                             
                                    </div>
                            @endif        



								@if($job->claim_remarks)<div class="col-lg-4">
                            <h2>Remarks</h2>
                                <p > {{$job->claim_remarks}}  </p>

                            </div>@endif
                           
                        </div>
                        <hr>


                       
                       
                        
                            
                            
                    </div>
             
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-12">
                
        

            
            </div>

        </div>
   
    </div>
@endsection
@section('footer')

@endsection