<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GRN</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .pal tr td {
            font-size: 12px;
            padding: 0px;
        }
		.palp tr td {
    border: 1px solid black;    padding-left: 10px;
  
}
.palp strong{font-size: 10px;color:black}


    </style>
</head>

<body>
  

       

       <table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 80%;    border-bottom: 4px solid red;">
					<table class="pal" style="border:0px solid #dddddd;    padding: 9px 0 0 0px; width: 100%;" align="center">
					  <tbody>

                        <tr>
                            <td><h4 style="font-size: 14px;    margin: 0px;
    padding: 0px;">TOSHIBA SALES & SERVICES SDN BHD</h4><p style="    margin: 0px;
    padding: 0px;">(Company No.: 32538-D)</p></td>
                           

                        </tr>
                       

                    </tbody>
					</table>
					</td>
						  <td valign="top" style=" width: 20%;    border-bottom: 4px solid #9E9E9E;">
					<table class="pal" style="border:0px solid #dddddd;    padding: 9px 0 0 0px; width: 100%;" align="center">
					  <tbody>

                        <tr>
                            <td><img src="{{ asset('assets/admin/img/logopdf.png')}}"style="  margin: 0px;
    padding: 0px;     width: 166px;
    height: 42px;"></td>
                           

                        </tr>
                        
                    </tbody>
					</table>
					</td>
				    </tr>
       
                </tbody>
				 </table>
            <h4 style="padding:10px 0 10px 0px;margin:0px; font-size:18px; text-align:center; border-bottom:1px solid #ccc;">TOSHIBA SALES & SERVICES - GOODS RETURN FORM</h4>
            <table style="width: 100%;
    ">
                <tbody>
                    <tr>
                        

                        <td valign="top" style=" width: 50%;">

                            <table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 16px;
" align="center">
                                <tbody>

                                    <tr>
                                        <td width="50%"><strong>BRANCH / SVC CTR</strong></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td width="50%"><strong>COMPLAINT DATE</strong></td>
                                        @if($user->order_date)<td>{{date('d-m-Y', strtotime($user->order_date))}}</td>@endif

                                    </tr>

									 <tr>
                                        <td width="50%"><strong>APPLICATION DATE</strong></td>
                                        <td>{{date('d-m-Y', strtotime($user->order_date))}}</td>

                                    </tr>
									
									 <tr>
                                        <td  width="50%"><strong>DELIVERY ORDER DATE</strong></td>
                                        <td>{{date('d-m-Y', strtotime($user->delivery_date))}}</td>

                                    </tr>
									 <tr>
                                        <td width="50%"><strong>GOODS RECEIVE DATE</strong></td>
                                        <td></td>

                                    </tr>
									 <tr>
                                        <td width="50%"><strong>DEALER ACCOUNT NO</strong></td>
                                        <td>{{$user->dealer_acc}}</td>

                                    </tr>
									<tr>
                                        <td width="50%" ><strong>DEALER NAME</strong></td>
                                        <td>{{$user->dealer_name}}</td>

                                    </tr>
									
                                </tbody>

                            </table>
							 <h4 style="    padding: 6px 0 0px 0;
    margin: 0px;
    font-size: 12px;
    margin: 0px;
    ">ADDRESS</h4>

                <table class="pal" style="border: 0px solid #b9b5b5;     width: 100%;border-bottom: 1px solid;">
                    <tbody>
  <tr>
                            <td>{{$user->cu_address}}</td>
                           

                        </tr>
              					

                    </tbody>
                </table>
				

                <table class="pal" style="border: 0px solid #b9b5b5;     width: 100%;border-bottom: 1px solid;">
                    <tbody>
  <tr>
                            <td> PIC : </td>
                            <td>TEL/HHP No :{{$user->phone_no}} </td>

                        </tr>
              				 <tr>
                            <td> &nbsp;</td>
                            <td>&nbsp; </td>

                        </tr>		

                    </tbody>
                </table>
				 <table class="pal" style="border: 0px solid #b9b5b5;">
                    <tbody>
  <tr>
                            <td> MODEL : </td>
                            <td>{{$user->product_id}}</td>

                        </tr>
              				 <tr>
                            <td> SERIAL NUMBER :</td>
                              <td>{{$user->seriel_no}}</td>

                        </tr>		

                    </tbody>
                </table>
                            
       

        </td>

        <td valign="top" style=" width: 50%;    padding-left: 16px;">
<table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 16px;
" align="center">
                                <tbody>

                                    <tr>
                                        <td width="50%"><strong>JOBSHEET NO *</strong></td>
                                        <td></td>

                                    </tr>
                                  
									<tr>
                                        <td width="50%"><strong>CUSTOMER NAME *</strong></td>
                                        <td>{{$user->firstname}}</td>

                                    </tr>
									<tr>
                                        <td width="50%"><strong>PURCHASE DATE *</strong></td>
                                        <td>{{$user->purchase_date}}</td>

                                    </tr>
                                </tbody>

                            </table>
            


           

            <h4 style="       padding: 13px 0 8px 0px;
    margin: 0px;
    font-size: 9px;
    text-align: center;">SELECTION & CHECKLIST </h4>
           <table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 0px;
" align="center">
                                <tbody>

                                  
									<tr>
                                        <td width="50%" colspan="2"style="    border-bottom: 1px solid white;"><strong>TECHNICAL PROBLEM *</strong> - ATTACH  <input type="checkbox"  @if($user->tech_prob == 1) checked=checked @endif style=" float: right;
    margin-right: 33px;
"></td>
										
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" > <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  PROOF OF PURCHASE & TECH. FORM </p> </td>
                                    </tr>
									<tr>
                                        <td width="50%" colspan="2"style="    border-bottom: 1px solid white;"><strong>TECHNICAL PROBLEM *</strong> PENDING / NO PARTS * <input type="checkbox" @if($user->pending_part == 1) checked=checked @endif style=" float: right;
    margin-right: 33px;
"></td>
										
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" style=" border-bottom: 1px solid white;"> <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  DATE PLACE ORDER : {{$user->place_order}} </p> </td>
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2"> <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  SPARE PART NUM : {{$user->spare_part_no}} </p> </td>
                                    </tr>
									
									<tr>
                                        <td width="50%" colspan="2"><strong> DENTED / DAMAGED TRANSIT</strong>  <input type="checkbox" @if($user->dented == 1) checked=checked @endif style=" float: right;
    padding-top: 0px;
    margin-right: 33px;
"></td>
                                    </tr>
								
								<tr>
                                        <td width="50%" colspan="2"style="    border-bottom: 1px solid white;">PHOTOCOPY OF TSS DO. OR W'TY <input type="checkbox"  @if($user->photogr == 1) checked=checked @endif style=" float: right;
    margin-right: 33px;
"></td>
										
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" > <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">   SHIPPING LABEL ON BOX </p> </td>
                                    </tr>
								
								
								
<tr>
                                        <td width="50%" colspan="2"style="    border-bottom: 1px solid white;"> COMPLETE RETURN OF ACC / W'TY <input type="checkbox" @if($user->return_acc == 1) checked=checked @endif style=" float: right;
    margin-right: 33px;
"></td>
										
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" > <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  CARD / MANUAL, etc,.. </p> </td>
                                    </tr>
									
									
									
									
										<tr>
                                        <td width="50%" colspan="2"style="      text-align: center;
    font-size: 10px;  border-bottom: 1px solid white;">SALES PIC TO SELECT BELOW :-</td>
										
                                    </tr>
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" style="border-bottom: 1px solid white;"> <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  EXCHANGE : &nbsp;<input type="checkbox"  @if($user->ex_number != NULL) checked=checked @endif>  CREDIT NOTE : &nbsp;<input type="checkbox" @if($user->ex_number == NULL) checked=checked @endif> </p> </td>
                                    </tr>
									
									<tr style="    border-left: 1px solid;
    border-right: 1px solid;">
                                        <td width="50%" colspan="2" > <p style="    padding: 0px;
       margin-top: -5px;
    margin-bottom: 5px;
    font-size: 9px;    border: none;">  <b>IF CN </b> LAST SELLING PRICE RM :   @if($user->sell_price){{$user->sell_price}} @endif</p> </td>
                                    </tr>
									
									
									
									
									
										
                                </tbody>

                            </table>
               
        </td>

        </tr>

        </tbody>
        </table>
   
<table style="width: 100%;">

                <tbody>
				
                    <tr>
                  
						  <td valign="top" style=" width: 100%;">
					<table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 16px;
" align="center">
                                <tbody>

                                  
									<tr>
                                        <td width="50%" ><strong>REASON FOR RETURN</strong></td>
                                        <td>{{$user->reason_for_retrun}}</td>
                                    </tr>
									<tr>
                                        <td width="50%" colspan="2"style="    padding-left: 0px;">   
		<!-- <img src="{{ url('data/products/'.$user->issue_image) }}" style="width: 300px;  height: 200px;" /> -->
		<img src="{{ url('data/products/'.$user->issue_image) }}" style="    width: 400px;
    height: 300px;
" />
		</td>
                                    </tr>
                                </tbody>

                            </table>
					</td>
				    </tr>
					  </tbody>
        </table>
		  <table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;    border: 1px solid;">
					<table class="pal" style="border:0px solid #dddddd;    padding: 0px 0 0 0px; width: 100%;" align="center">
					  <tbody>

                        <tr>
                            <td width="50%" colspan="2"style="border-bottom: 1px solid;
    text-align: center;
    font-size: 12px;"> <strong>TSS / SERVICE CENTRE USE</strong></td>
                         

                        </tr> 
						<tr>
                            <td> APPLY BY</td>
                            <td>CHECKED BY </td>

                        </tr>
						<tr>
                            <td> ......................................................</td>
                            <td> ...................................................... </td>

                        </tr>
                       <tr>
                            <td> NAME:</td>
                            <td>Branch Head / Engr'ng </td>

                        </tr>

                    </tbody>
					</table>
					</td>
						<td valign="top" style=" width: 50%;    border: 1px solid;">
					<table class="pal" style="border:0px solid #dddddd;    padding: 0px 0 0 0px; width: 100%;" align="center">
					  <tbody>

                        <tr>
                            <td width="50%" colspan="2"style="border-bottom: 1px solid;
    text-align: center;
    font-size: 12px;    padding-left: 16px;"> <strong>SERVICE DEPARTMENT USE</strong></td>
  
                         

                        </tr> 
						<tr>
                            <td> APPROVED BY</td>
                            <td> </td>

                        </tr>
						<tr>
                            <td> ......................................................</td>
                            <td> ...................................................... </td>

                        </tr>
                       <tr>
                            <td> HOD - Sales & Service</td>
                            <td>DATE </td>

                        </tr>

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
       

</body>

</html>