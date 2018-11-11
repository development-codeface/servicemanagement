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
		 tr td {
            font-size: 10px;
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
            <h4 style="padding:10px 0 10px 0px;margin:0px; font-size:18px;border-bottom:1px solid #ccc;">FPD RMA REPORT</h4>
         
   
       <table style="width: 100%;">
                <tbody>
                    <tr>
                   <td valign="top" style=" width: 50%;">

    <table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 16px;
" align="center">
        <tbody>

            <tr>
                <td>SERVICE BRANCH</td>
				  <td></td>
                <td>APPLICATION DATE</td>
                <td>{{date('d-m-Y', strtotime($user->order_date))}}</td>

            </tr>
            <tr>
                <td>MODEL</td>
				  <td>{{$user->product_id}}</td>
                <td>DATE OF PURCHASE</td>
				  <td>{{date('d-m-Y', strtotime($user->purchase_date))}}</td>

            </tr>

            <tr>
                <td >SET SERIAL NO.</td>
				  <td>{{$user->seriel_no}}</td>
                <td>DATE RECEIVED</td>
				  <td>ereere</td>

            </tr>

            <tr>
                <td>WARRANTY CARD NO.</td>
				  <td>{{$user->warranty_card}}</td>
                <td>JOB SHEET NO.</td>
				  <td>{{$user->job_id}}</td>

            </tr>
            <tr>
                <td>PANEL SERIAL NO.</td>
				  <td>{{$user->panel_serial_no}}</td>
                <td>PANEL MODEL</td>
				  <td>{{$user->panel_model}}</td>

            </tr>
            <tr>
                <td colspan="2">MAIN DEALER ACC. NO.</td>
                <td colspan="2">{{$user->delear_Account_numner}}</td>

            </tr>
            <tr>
                <td colspan="2"><strong>DEALER/CUST. NAME</td>
                <td colspan="2">{{$user->dealer_nam}}</td>
            </tr>
            <!-- <tr>
                <td >DEALER/CUSTOMER ADDRESS </td>
                <td>{{$user->cu_address}}</td>
            </tr> -->

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

    <table class="pal" style="border: 0px solid #b9b5b5;     width: 100%;">
        <tbody>
            <tr>
                <td> COMPLAINTS </td>

            </tr>
            <tr>
                <td>{{$user->complaints}}</td>
            

            </tr>

        </tbody>
    </table>
	<table class="pal palp" style="     border-collapse: collapse;
    padding: 0px 0 0 0px;
    width: 100%;    margin-top: 16px;
" align="center">
                                <tbody>

                                  
									<tr>
                                        <td width="50%" ><strong>REMARKS</strong></td>
                                        <td>{{$user->reason_for_return}}</td>
                                    </tr>
									<tr>
                                        <td width="50%" colspan="2"style="    padding-left: 0px;">   
		<!-- <img src="{{ url('data/products/'.$user->issue_image) }}" style="width: 300px;  height: 200px;" /> -->
		<img src="{{ url('data/products/'.$user->issue_image) }}" style="    width: 400px;
    height: 200px;
" />
		</td>
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
                                        <td width="50%" colspan="2"><strong>SYMPTOM / DEFECT</strong></td>
                                        

                                    </tr>
									
                                </tbody>

                            </table>
		<table  style=" width: 100%;" >
					<tbody>
 
						<tr>
                        <td width="42%"> Vertical Line </td>
                            <td width="8%"> <input type="checkbox" @if($user->vertical_line == 1) checked=checked @endif></td>
                            <td width="42%"> Uniformity Defect</td>
                            <td width="8%"><input type="checkbox" @if($user->uniformity_defect == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td> Vertical Block </td>
                            <td> <input type="checkbox" @if($user->vertical_block == 1) checked=checked @endif></td>
                            <td> Dot Screen</td>
                            <td> <input type="checkbox" @if($user->dot_screen == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td> Horizontal Line </td>
                            <td> <input type="checkbox" @if($user->hori_line == 1) checked=checked @endif></td>
                            <td> White Screen</td>
                            <td> <input type="checkbox" @if($user->white_screen == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td> Horizontal Block </td>
                            <td> <input type="checkbox" @if($user->horil_block == 1) checked=checked @endif></td>
                            <td> Flicker</td>
                            <td> <input type="checkbox" @if($user->flicker == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td> No Display </td>
                            <td> <input type="checkbox" @if($user->no_display == 1) checked=checked @endif></td>
                            <td> Back Light Defect</td>
                            <td> <input type="checkbox" @if($user->back_light == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td>Abnormal Colour </td>
                            <td> <input type="checkbox" @if($user->abnormal_color == 1) checked=checked @endif></td>
                            <td> Abnormal Picture</td>
                            <td> <input type="checkbox" @if($user->abnormal_pic == 1) checked=checked @endif></td>
                        </tr>
						<tr>
                            <td>
Others (Describe Symptom) </td>
                            <td> <input type="checkbox"></td>
                            
                        </tr>
					

                    </tbody>
					</table>
					 <table width="100%">
                                <tbody>
<tr>
                                        <td >{{$user->other}}</td>
                                        

                                    </tr>
								
									
                                </tbody>

                            </table>
							<table class="pal" style="border:1px solid; width: 100%;" align="">
		
					  <tbody>

                        <tr>
                            <td width="50%" colspan="2" style="border-bottom: 1px solid;
    text-align: center;
    font-size: 12px;"> <strong>CHECKED BY</strong></td>
                         <td width="50%" colspan="2" style="border-bottom: 1px solid;
    text-align: center;
    font-size: 12px;"> <strong>CONFIRMED BY</strong></td>

                        </tr> 
						<tr>
                            <td> Name:</td>
                            <td style=""> </td>
							   <td> Name:</td>
                            <td> </td>

                        </tr>
						<tr>
                            <td>  Date:</td>
                            <td> </td>
							 <td>  Date:</td>
                            <td> </td>

                        </tr>
						<tr>
                            <td>  Signature::</td>
                            <td> </td>
							 <td>  Signature::</td>
                            <td> </td>

                        </tr>
						<tr>
                            <td> </td>
                            <td> ...................................................... </td>
							 <td> </td>
                            <td> ...................................................... </td>

                        </tr>
                       <tr>
                            <td> </td>
                            <td>Technician </td>
							  <td> </td>
                            <td>Branch Manager </td>

                        </tr>

                    </tbody>
					</table>
					
					<h4 style="padding: 5px 0 5px 0px;
    margin: 0px;
    font-size: 11px;
    text-align: center;
    border-bottom: 1px solid #ccc;">FOR ENGINEERING & SERVICE DEPT. USE</h4>
				<table class="" style="border-top: 1px solid;
       width: 100%;    border: 1px solid;" >
		
					  <tbody>

						<tr>
                            <td>  Date:</td>
                            <td> </td>
							<td> Set Return To HQ </td>
                            <td> <input type="checkbox"style="    margin-right: 16px;"></td>
                            

                        </tr>
						<tr>
                            <td>  Signature::</td>
                            <td> </td>
							<td> 
Exchange Se </td>
<td> <input type="checkbox"></td>
                           


                        </tr>
						<tr>
                            <td> </td>
                            <td>  </td>
							<td> Parts Replacemen</td>
                            <td> <input type="checkbox"></td>
                            

                        </tr>
                       <tr>
                            <td> </td>
                            <td></td>
							 <td> Rejected </td>
                             <td> <input type="checkbox"></td>

                        </tr>
						  <tr>
                            <td> </td>
                            <td>......................................................  </td>
							 <td>......................................................</td>
                            

                        </tr>
						<tr>
                            <td> </td>
                            <td>E&S Head Of Dept. </td>
							 <td>......................................................</td>
                            

                        </tr>

                    </tbody>
					</table>
					
        </td>
		
				    </tr>
        </table>
</body>

</html>