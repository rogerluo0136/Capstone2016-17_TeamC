@extends('layouts.app')

@section('css')
<style type="text/css">
.no-color{
	background-color:inherit;
	color: black;
	border-left: 2px solid #4989bd;
}

.panel-table {
    display:table;
}
.panel-table > .panel-heading {
    display: table-header-group;
    background: transparent;
}
.panel-table > .panel-body {
    display: table-row-group;
}
.panel-table > .panel-body:before,
.panel-table > .panel-body:after {
    content:none;
}
.panel-table > .panel-footer {
    display: table-footer-group;
    background: transparent;
}
.panel-table > div > .tr {
    display: table-row;
}
.panel-table > div:last-child > .tr:last-child > .td {
    border-bottom: none;
}
.panel-table .td {
    display: table-cell;
    padding: 15px;
    border: 1px solid #ddd;
    border-top: none;
    border-left: none;
}
.panel-table .td:last-child {
    border-right: none;
}
.panel-table > .panel-heading > .tr > .td,
.panel-table > .panel-footer > .tr > .td {
    background-color: #f5f5f5;
}
.panel-table > .panel-heading > .tr > .td:first-child {
    border-radius: 4px 0 0 0;
}
.panel-table > .panel-heading > .tr > .td:last-child {
    border-radius: 0 4px 0 0;
}
.panel-table > .panel-footer > .tr > .td:first-child {
    border-radius: 0 0 0 4px;
}
.panel-table > .panel-footer > .tr > .td:last-child {
    border-radius: 0 0 4px 0;
}
</style>
@endsection

@section('content')
<center>
    <h1>Music Therapy Assessment - Payment</h1>
    <p class="lead" style="width:80%; color: white;">
        Select a payment method in order for your registration form to be processed. Payment may be made by cash, cheque, credit card or funding/financial assistance. Please tell us below if you would like to pay in smaller payments. For any questions please contact John Taylor at: email/phone number 
    </p>
</center>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="progress">
			  <div class="progress-bar progress-bar-active" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (active)</span>
			    Registrant Selection
			  </div>
			  <div class="progress-bar progress-bar-active" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Further Registrant Info
			  </div>
			  <div class="progress-bar progress-bar-active" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Payment
			  </div>
			  <div class="progress-bar no-color" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Confirmation
			  </div>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default panel-table">
				<div class="panel-body">
					<div class="tr">
			            <div class="td">
			            	<h3 style="color: green">
			            		Option 1: Credit Card 
			            	</h3>
			            	<p>Please click the button to pay online via credit card. You 
								may choose to pay all of or a portion of the outstanding 
								balance. Please note, you will be redirected to a 3rd party 
								payment service. 
							</p>
							<a href="#" class="btn btn-primary">Pay Online</a>
			            </div>
			        </div>
			        <div class="tr">
			        	<div class="td">
			        		<h3 style="color: green">
			            		Option 2: Cheque or Cash 
			            	</h3>
			            	<p>Payments must be delivered to the office located at: 
								<b>150 Kilgour Rd, Toronto, Ontario, Canada, M4G 1R8.</b> 

								</br>If pay by cheque, cheque must be payable to:
								</b><b>Holland Bloorview Kids Rehabilitation Hospital</b>. 
								</br>Do <b>not</b> send cash in the mail – please hand deliver to the office.

							</p>
							<form class="form-horizontal" role="form" method="POST" action="#">
								{!! csrf_field() !!}
								<div class="row">
									<div class="form-group">
	                            		<label class="control-label col-md-3">Please specify amount: </label>
	                            		<div class="col-md-4">
	                            			<input type="text" class="form-control" name="cheque_cash_amount" required>
	                                	</div>
	                                	<div class="form-group">
						                    <button type="submit" class="btn btn-primary center-block">
						                        Choose
						                    </button>
						            	</div>
	                                </div>
	                            </div>    	
							</form>
			        	</div>
			        </div>
			        <div class="tr">
			        	<div class="td">
			        		<h3 style="color: green">
			            		  Option 3: Funding/Financial assistance
			            	</h3>
			            	<h4>
			            		I have applied for funding from Holland Bloorview.
							</h4>
							<a href="#" class="btn btn-primary">Choose</a>
							</br>
							</br>
							<h4>
								I have applied for other funding.
							</h4>
							<a href="#" class="btn btn-primary">Choose</a>
							</br>
							
							<div style="background-color: white; border: 1px solid; padding: 25px; margin: 25px;">
								<h4>Where to get funding?</h4>
								<p>Learn about Ontario funding for recreation and respite. For more information, please contact the Holland Bloorview Warmline:1-877-463-0365 resourcecentre@hollandbloorview.ca</p>
							</div>
			        	</div>
			        </div>
				</div>
			</div>
		</div>	
	</div>
</div>
@endsection