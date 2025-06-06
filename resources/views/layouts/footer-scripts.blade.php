<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript"> var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    function CheckAll(className , elem){
        var elements = document.getElementsByClassName(className);
        var l=elements.length;
        if(elem.checked){
            for(var i=0; i<l; i++){
                elements[i].checked = true;
            }
        }else{
            for(var i=0; i<l; i++){
                elements[i].checked = false;
            }
        }
    }
</script>

<script type='text/javascript'>
$(function() {
    $('#delete_all').click(function() {
        var selected =new Array();
        $('#datatable input[type=checkbox]:checked').each(function(){
            selected.push(this.value);
        });
        if(selected.length>0){
            $('#delete_all').modal('show')
            $('input[id="delete_all_id"]').val(selected);
        }
    });
});
</script>
