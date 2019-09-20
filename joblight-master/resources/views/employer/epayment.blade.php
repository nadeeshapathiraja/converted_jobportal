@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')		
	<div id="features-wrapper">
		<div class="container">		
            <div class="row">     	         
                <div class="6u 12u(medium)">
                <!-- Box -->
                    <section class="box feature">                    
                        <FORM method="post" name="ePayment" action="https://www.mobile88.com/ePayment/entry.asp">  
                            <INPUT type="text" name="MerchantCode"  value="M10619"> 
                            <INPUT type="text" name="PaymentId" value=""> 
                            <INPUT type="text" name="RefNo"  value="A00000001"> 
                            <INPUT type="text" name="Amount"  value="1.00"> 
                            <INPUT type="text" name="Currency"  value="MYR"> 
                            <INPUT type="text" name="ProdDesc"  value="Photo Print"> 
                            <INPUT type="text" name="UserName"  value="John Tan"> 
                            <INPUT type="text" name="UserEmail"  value="john@hotmail.com"> 
                            <INPUT type="text" name="UserContact"  value="0126500100"> 
                            <INPUT type="text" name="Remark"  value=""> 
                            <INPUT type="text" name="Lang"   value="UTF-8"> 
                            <INPUT type="text" name="SignatureType"  value="SHA256"> 
                            <INPUT type="text" name="Signature" value="b81af9c4048b0f6c447129f0f5c0eec8d67cbe19eec26f2cdaba5df4f4dc5a28">  
                            <INPUT type="text" name="ResponseURL" value="http://www.YourResponseURL.com/payment/response.asp">  
                            <INPUT type="text" name="BackendURL" value="http://www.YourBackendURL.com/payment/backend_response.asp">  
                            <INPUT type="submit" value="Proceed with Payment" name="Submit"> 
                        </FORM> 
                    </section>
                </div>                       
             </div>                                                                      
		</div>
	</div>

@stop
