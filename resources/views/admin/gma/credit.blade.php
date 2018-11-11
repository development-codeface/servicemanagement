<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Credit Note</title>

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
	.palpnew tr td {
      padding-left: 10px;
  
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
    padding: 0px;    font-weight: 500;"><b>TOSHIBA SALES AND SERVICES SDN. BHD </b></h4></td>
                           

                        </tr>
                       <tr>
                            <td><h4 style="font-size: 14px;    margin: 0px;
    padding: 0px;    font-weight: 500;">Co. Reg. No. 32538-D</h4></td>
                           

                        </tr>
						 <tr>
                            <td><h4 style="font-size: 14px;    margin: 0px;
    padding: 0px;    font-weight: 500;">Ground Floor & Level 5, Bangunan Palm Grove II, </h4></td>
                           

                        </tr>
						 <tr>
                            <td><h4 style="font-size: 14px;    margin: 0px;
    padding: 0px;    font-weight: 500;">12, JIn Giermarie (Persiaran Kerjaya), Section U140150 SHAH Malaysia</h4></td>
                           

                        </tr>
<tr>
                            <td><h4 style="font-size: 14px;    margin: 0px;
    padding: 0px;    font-weight: 500;">Tel No. +603-55658000, Fax No. +603-55692209.</h4></td>
                           

                        </tr>

                    </tbody>
					</table>
					</td>
						  <td valign="top" style=" width: 20%;    border-bottom: 4px solid #9E9E9E;">
					<table class="pal" style="border:0px solid #dddddd;    padding: 9px 0 0 0px; width: 100%;" align="center">
					  <tbody>

                        <tr>
                            <td><img src="{{ asset('assets/admin/img/logopdf.png')}}"style="  margin: 0px;
    padding: 0px; "></td>
                           

                        </tr>
                        
                    </tbody>
					</table>
					</td>
				    </tr>
       
                </tbody>
				 </table>
            <h4 style="padding:10px 0 10px 0px;margin:0px; font-size:18px; text-align:center; border-bottom:1px solid #ccc;">CREDIT NOTE</h4>
            <h4 style="padding:10px 0 10px 0px;margin:0px; font-size:18px; text-align:center; border-bottom:1px solid #ccc;">GST Reg No. : 001896153088</h4>
			<table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;">
					<table class="pal"  align="">
					  <tbody>

						
						<tr>
                            <td> <b> CREDIT NOTE No. :  </b></td>
                            @if($user->product_replacement_type)<td> {{$user->grn_credit}} </td>
                            @else <td> {{$user->gma_credit}} </td>
                            @endif

                        </tr>

						
                    </tbody>
					</table>
					</td>
					  <td valign="top" style=" width: 50%;">
					<table class="pal"  align="center">
					  <tbody>

						
						<tr>
                            <td><b>DATE : </b></td>
                            <td> {{$user->delivery_date}}</td>
                            

                        </tr>
					
                      <tr>
                            <td><b>PAGE : </b></td>
                            <td>  1</td>
                            

                        </tr>

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
		<hr>
		<table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;">
					<table class="pal"  align="">
					  <tbody>

						
						<tr>
                            <td> <b>ACCOUNTEE   </b></td>
                            <td></td>
                        </tr>
						<tr>
                            <td>DIGIMATE SDN. BHD. </td>
                            <td></td>
                        </tr>
						<tr>
                            <td>LOT G39 & 640, GROUND FLOOR,KARAMUNS[NG </td>
                            <td></td>
                        </tr>
						<tr>
                            <td>COMPLEX </td>
                            <td></td>
                        </tr>
						<tr>
                            <td>88830 KOTA KINABALU </td>
                            <td></td>
                        </tr>
						<tr>
                            <td>Malaysia </td>
                            <td></td>
                        </tr>
						

						
                    </tbody>
					</table>
					</td>
					  <td valign="top" style=" width: 50%;">
					<table class="pal"  align="center">
					  <tbody>

						
						<tr>
                            <td><b>ACCOUNTEE NO : </b></td>
                            <td>  031N0000006</td>
                            

                        </tr>
					
                      <tr>
                            <td><b>SALES CODE : </b></td>
                            <td> 878(CEFG-005-031)</td>
                            

                        </tr>
						   <tr>
                            <td><b>SALESMAN : </b></td>
                            <td>  MR.CHONG WAI FAH</td>
                            

                        </tr>
						   <tr>
                            <td><b>ISSUED BY : </b></td>
                            <td>  TSS\ TSSSVC12</td>
                            

                        </tr>
						   <tr>
                            <td><b>TERMS OF PAYMENT: </b></td>
                            <td>  </td>
                            

                        </tr>
						   <tr>
                            <td><p>Please refer attachment  </p></td>
                            <td>  </td>
                            

                        </tr>

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
		<hr>
		<table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;">
					<table class="pal"  align="">
					  <tbody>

						
						<tr>
                            <td> <b>SHIPPED TO :  </b></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>Central Warehouse</td>
                            <td></td>

                        </tr>
						  <tr>
                            <td>No. 15, Jalan TP5</td>
                            <td></td>

                        </tr>
						  <tr>
                            <td>Taman Perindustrian Sime UEP</td>
                            <td></td>

                        </tr>
						  <tr>
                            <td>47620 SUBANG JAYA</td>
                            <td></td>

                        </tr>
						 <tr>
                            <td>Selangor</td>
                            <td></td>

                        </tr>
						
                    </tbody>
					</table>
					</td>
					  <td valign="top" style=" width: 50%;">
					<table class="pal"  align="center">
					  <tbody>

						
						<tr>
                            <td><b>NOTE  : </b></td>
                            <td>  </td>
                            

                        </tr>
					
                      <tr>
                            <td><p>Please refer attachment  </p></td>
                            <td>  </td>
                            

                        </tr>

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
           <table cellpadding="0" cellspacing="0" width="100%" style="
    font-size: 13px;
">
        <tbody>
<tr class="tota">
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Line No.</td>
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">  Item No</td>
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Description of Goods</td>
          
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Location Code</td>
	<td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Cust Ord Date</td>
	<td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Order Qty</td>
	<td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Disc Amount</td>
	<td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Total Amount</td>

        </tr>

         
        <tr>
          <td>1</td>
          <td>1</td>
          <td>150W RMS Portable Sound System FOR S/PART CANNIBALISE</td>
          <td>20/5/2018</td>
          <td>31R</td>
          <td> 2,792.00</td>
          <td> </td>
          <td> 2,792.00</td>
          
         
        </tr>
		   <tr>
          <td>1</td>
          <td>1</td>
          <td>150W RMS Portable Sound System FOR S/PART CANNIBALISE</td>
          <td>20/5/2018</td>
          <td>31R</td>
          <td> 2,792.00</td>
          <td> </td>
          <td> 2,792.00</td>
          
         
        </tr>
       
	      <tr>
          <td>1</td>
          <td>1</td>
          <td>150W RMS Portable Sound System FOR S/PART CANNIBALISE</td>
          <td>20/5/2018</td>
          <td>31R</td>
          <td> 2,792.00</td>
          <td> </td>
          <td> 2,792.00</td>
          
         
        </tr>
       
       
       
  
      </tbody></table>
	  <hr>
		<table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;">
					<table class="pal"  align="">
					
					</table>
					</td>
					  <td valign="top" style=" width: 50%;">
					<table class="pal"  align="center">
					  <tbody>

						
						<tr>
                            <td>SUB TOTAL :</td>
                            <td> 2,792.00 </td>
                            

                        </tr>
						<tr>
                            <td>LESS INVOICE DISCOUNT :</td>
                            <td> 0.00 </td>
                            

                        </tr>
						<tr>
                            <td>GST AMOUNT (6%) :</td>
                            <td> 167.52 </td>
                            

                        </tr>
						
						<tr>
                            <td><b>TOTAL   : </b></td>
                            <td> 2,959.52 </td>
                            

                        </tr>
					

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
   <hr>
		<table style="width: 100%;">
                <tbody>
                    <tr>
                    <td valign="top" style=" width: 50%;">
					<table class="pal"  align="">
					<tr>
                            <td>STC CONTROL CATCH ALL DONE</td>
                           
                            

                        </tr>
					</table>
					</td>
					  <td valign="top" style=" width: 50%;">
					<table class="pal"  align="center">
					  <tbody>

						
						<tr>
                            <td>THIS IS COMPUTER GENERATED DOCUMENT. NO SIGNATURE IS REQUIRED</td>
                          
                            

                        </tr>
					

                    </tbody>
					</table>
					</td>
				    </tr>
					</tbody>
        </table>
      
		

</body>

</html>