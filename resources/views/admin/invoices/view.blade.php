<!doctype html>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Bill</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<style>body{  font-family: 'Open Sans', sans-serif !important;}
.pal tr td{font-size: 12px;
    padding: 0px;}

</style>
</head>

<body>
<div class="cont-main">
 
    <div class="top-dv">
      <table style="
    border-bottom: 1px solid #8c8989;    width: 100%;
">
        <tbody>
          <tr>
            <td style="width:60%;" align="center">
                   <h4 style="   
    font-size: 18px;"> {{$warehouse->name}}</h4>
  <h5>{{$warehouse->address}}<br>
  {{$warehouse->tel_number1}} ,
  {{$warehouse->tel_number2}}<br>
 </h5>
                    
               
              </td>
            
          </tr>
        </tbody>
      </table>
    </div>
    
    
    
    <div class="down-div">
    
    
    <table style="width: 100%;">
    <tbody>
    <tr>
    <td valign="top">
    
    
     
    
    </td>
    
    
    
    <td valign="top">
     <h4 style="padding:0 0 1px 0px; font-size:12px;">TOSHIBA SALES AND SERVICE AND BHD</h4>
        
     <h5 style="font-size:12px;padding:0px;
  
     "> GROUND FLOOR & LEVEL 5,<br>
BANGUNAN PALM GROVE 11, 12 ,JLN
GLENMARIE,<br>SEC U1,40150 SHAH ALAM</h5>
                
     <table class="pal" align="left" width="40%;" style="
    font-size: 13px;
">
     <tbody>
     <tr>
     <td>
               
           
              
              </td>
              
              
              
              
     
     </tr>
     
      <tr>
    <td width="40%">ATTN  :</td>
    <td width="40%">-----------------</td>
    
  </tr>
      <tr>
    <td   width="40%">TEL  :</td>
    <td  width="40%">{{$tss->telphone_no}}</td>
    
  </tr>
   <tr>
    <td  width="40%">FAX  :</td>
    <td width="40%">03-5565809</td>
    
  </tr>
   <tr>
    <td  width="40%">GST NO  :</td>
    <td width="40%">{{$tss->gst_no}}</td>
    
  </tr>
   <tr>
    <td width="40%" >A/C NO  :</td>
    <td width="40%">{{$tss->acc_no}}</td>
    
  </tr>
     </tbody>
     
     </table>
     
     
     
      
    
    </td>
    
    
    
    
    <td>
    
     <h4 style="padding:0 0 1px 0;font-size:14px;">TAX INVOICE</h4>
     
     <div class="offer-list1">
    <table class="pal" style="border: 0px solid #b9b5b5;     width: 100%;">
  <tbody>
  
  
  
  <tr>
    <td  >NO </td>
    <td  > :</td>
    <td>00000344</td>
    
  </tr>
  <tr>
    <td>DATE </td> <td  > :</td>
    <td>{{$date}}</td>
    
  </tr>
  
  <tr>
    <td>TERM </td> <td  > :</td>
    <td>--------------------------</td>
    
  </tr>
   <tr>
    <td>GENT </td> <td  > :</td>
    <td>--------------------------</td>
    
  </tr>
  <tr>
    <td>PAGE </td> <td  > :</td>
    <td>1</td>
    
  </tr>
  <tr>
    <td>PRINTED ON   </td> <td  > :</td>
    <td>25/04/2018</td>
    
  </tr>
  <tr>
    <td>PRINTED By  </td> <td  > :</td>
    <td>{{$tss->username}}</td>
    
  </tr>
</tbody></table>
    
    </div>
    
    </td>
    
    
    
    </tr>
    
    
    </tbody>
    </table>
    
    
     
    
     
    
      
    </div>
    @if(!empty($rma))
    <div class="clearfix"></div>
    <br><br><br>
    <div class="offer-list">
      
      <table cellpadding="0" cellspacing="0" width="100%"  style="
    font-size: 13px;
">
        <tbody>
<tr class="tota">
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">ITEM NO</td>
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">  DESCRIPTION</td>
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Quantity</td>
          
          <td style="font-weight: 600;
    text-align: left;
    border-bottom: 1px solid #756161!important;
    border-top: 1px solid #756161!important;
    padding-bottom: 8px!important;
    padding-top: 8px!important;font-size:14px;">Sub Total</td>




        </tr>

         
       
       
        <tr>
          <td>1</td>
          <td>Transport</td>
          <td></td>
          <td>{{$rma->claim_amount}}</td>
          
         
        </tr>
       
        <tr>
          <td>2</td>
          <td>Labour</td>
          <td></td>
          <td>{{$rma->labour}}</td>
          
         
        </tr>
        <tr>
          <td>3</td>
          <td>Parts Charge</td>
          <td>{{$rma->parts_qty}}</td>
          <td>{{$rma->customer_price * $rma->parts_qty}}</td>
          
        </tr>
        @if($rma->product_replacement_id)
        <tr>
          <td>4</td>
          @if($rma->product_replacement_type == 'grn')<td>GRN</td>
          @else<td>RMA</td>
          @endif

          <td>{{$rma->qty}}</td>
          <td>{{$rma->amount}}</td>
          
         
        </tr>
       @endif
      </tbody></table>
    </div>
    
     
    
    <div class="clearfix"></div>
    <br><br>
    <div class="fot-div">
    
    
    
    <table style="width: 100%;">
    <tbody>
    <tr>
    <td valign="top">
    
    
     
    
    </td>
    
    
    
    <td valign="top">
     <h4 style="font-size:12px; padding-top:10px;"></h4>
     
     <table style="border:0px solid #dddddd;    padding: 0px 0 0 5px; width: 90%;" align="center">
     
     
     </table>
     
     
     
      
    
    </td>
    
    
    
    
    <td>
    
     
     <div class="offer-list1">
   
<table cellpadding="0" cellspacing="0" border="1" style="width: 100%;">
        <tbody>
            <tr>
 
          <td  colspan="2" align="right" style="padding: 5px;" ><strong>MYR</strong></td>
        </tr>
        <tr>
          <td style="padding: 5px;font-size:13px;">SUB TOTAL </td>
          
           
         
          <td  align="left" style="padding: 5px;">

            {{$rma->amount  + $rma->claim_amount + $rma->labour + $rma->customer_price * $rma->parts_qty}}</td>
         
          </tr>
      </tbody>
</table>
    
    </div>
    @endif
    </td>
    
    
    
    </tr>
    
    
    </tbody>
    </table>
  <table align="left" style="    border: 0px solid #b9b5b5; ;padding: 5px 0px;width: 53%;">
          <tbody>
              <tr>
                  <td valign="top" align="left"><table style=" border: 0px solid #dddddd;
    padding: 5px 8px;">
                <tbody>
                 
                  <tr>
                    <td align="center" style="    border-right: 0px solid #000;
    height: 120px;
    background-color: #FFF;
    text-align: left;
    padding-right: 10px;
    font-weight: 600;
    margin-right: 10px;
    font-size: 12px;
    width: 200px;">AUTHORISED<br>
SIGNATURES(S)</td>
                           <td align="center" style=" border-right: 0px solid #000; height:28px;background-color: #FFF; text-align:right; padding-right:10px;font-weight:600;font-size: 12px;">RECEVIED BY

</td>
<td></td>
                  </tr>
                  
                  <tr>
           
                 
                  </tr>
                 
                </tbody>
              </table></td>
                </tr>
            </tbody>  
        </table>
    </div>
    <div class="clearfix"></div>
    
    
  
</div>




</body>
</html>