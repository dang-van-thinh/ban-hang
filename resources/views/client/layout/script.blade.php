<script src="{{ asset('js/boostrap.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{--
<!-- Bootstrap JS -->
{{-- <script src="{{asset('js/custom.js')}}"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  --}}


{{-- carousel --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('js/carousel/owl.carousel.js') }}"></script>
@isset($script)
    @foreach ($script as $item)
        <script src="{{ asset($item) }}"></script>
    @endforeach
@endisset

<script>
    var arrCart = [];
    var itemLocal = localStorage.getItem('product');
    if (itemLocal) {
        arrCart = JSON.parse(itemLocal);
    }
    $('#numberCart').text(arrCart.length);
</script>
