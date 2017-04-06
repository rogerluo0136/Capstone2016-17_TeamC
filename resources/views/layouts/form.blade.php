@extends('layouts.app')

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
    });

    $(function phone(id1, id2, id3){
        var phone1 = document.getElementById(id1).value;
        var phone2 = document.getElementById(id2).value;
        var phone3 = document.getElementById(id3).value;

        return phone1*10000000+phone2*10000+phone3;
    });
</script>
@yield('form-js')
@endsection

@section('css')
<style type="text/css">
    .clickable{
        cursor: pointer;   
    }

    .panel-heading span {
        margin-top: -20px;
        font-size: 15px;
    }

    .hidden {
     display:none;
    }

    p.lead {
        color:white;
    }

</style>
@yield('form-css')
@endsection
