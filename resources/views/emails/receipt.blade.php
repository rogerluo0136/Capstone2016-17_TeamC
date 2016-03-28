
    <h1>Email Receipt</h1>
    <h3>Holland Bloorview Music & Arts</h3>
    
    
    <p> 
        <b>Transaction (Stripe) Number:</b>{{ $charge->id }} <br>
        <b>Enrolled Program:</b> {{ $program }} <br>
        <b>Amount Paid:</b> ${{ ($charge->amount)/100 }} <br>
        <b>Date Paid:</b> {{ date("F j, Y, g:i a") }}  <br>
        <b>Children: @foreach($children as $child) {{ $child->name.', '}} @endforeach
    </p>
    
    <p>
        {{ $user->name }} thank you for enrolling your child/chilren at Holland Bloorview. Below are the details of your transaction which serves as an e-receipt. 
        If you have not paid the program cost in full, please ensure to settle your balance as soon as possible. See you in the program.
        
    </p>
    
