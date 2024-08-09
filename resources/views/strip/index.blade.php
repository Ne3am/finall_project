<form action="{{url('/checkout')}}" method="post">
    @csrf 
    <button type="submit">Checkout</button>
</form>