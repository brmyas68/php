<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>

<script>
    $("#searchSec").bind("keypress", {}, keypressInBox);

    function keypressInBox(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) { //Enter keycode
            e.preventDefault();

            $("#searchFormSec").submit();
        }
    };

    // $('#provinceSec option').each(function() {
    //     if ($(this).is(':selected')){
    //         var url=$(location).attr("origin");
    //         fetch(url+'/cities/by/province/'+$(this).val(),{
    //             method:"get"
    //         }).then(function(data){
    //             data.json().then(function (json) {
    //                $("#citySec").append("<option value='"+data.id+"'>") ;
    //             });
    //         });
    //     }
    // });

</script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
