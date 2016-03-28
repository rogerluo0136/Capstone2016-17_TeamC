
    <h1>Email Receipt</h1>
    <h3>Holland Bloorview Music & Arts</h3>
    
    
    <p> 
        <b>Transaction (Stripe) Number:</b>{{ $charge->id }} <br>
        <b>Enrolled Program:</b> {{ $cps->program }} <br>
        <b>Amount Paid:</b> ${{ ($charge->amount)/100 }} <br>
        <b>Date Paid:</b> {{ date("F j, Y, g:i a") }}  <br>
        <b>Balance:</b> {{$balance}}
    </p>
    
   <p>
       Thank you for your payment to Holland Bloorview.
       @if($balance>0)
       There is still a balance of {{ $balance }}. Please ensure to settle this amount as soon as possible.
       @else
       You have successfully paid off all amounts owed to holland bloorview.
       @endif
   </p>
    
