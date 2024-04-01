<script src="{{asset('js/boostrap.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
 <!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{--
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script> --}}


{{-- carousel --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{asset('js/carousel/owl.carousel.js')}}"></script>

<script>
    var arrCart = [];
            var itemLocal = localStorage.getItem('product');
            if (itemLocal) {
                arrCart = JSON.parse(itemLocal);
            }
            $('#numberCart').text(arrCart.length);
</script>