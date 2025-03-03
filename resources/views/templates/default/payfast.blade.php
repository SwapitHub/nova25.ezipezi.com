@extends($templatePath.'.shop_layout')


@section('center')
<style>
  .blockUI.blockMsg.blockPage {
    border: none !important;
    border-radius: 5px;
}

#domMessage {
    border: 5px solid #3c8dbc;
    border-radius: 5px;
    padding: 20px 0;
}
</style>
<div id="domMessage" style="display:none;">
    <img src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" />
    <br/> Processing your request.
</div>

<?php $payf = sc_store('payfast');
if($payf==0) $testingMode = true;
else $testingMode = false;

$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post" id="payfastform">';
foreach($datasign as $name=> $value)
{
    $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
}
$htmlForm .= '<input type="submit" value="Pay Now" style="display:none" /></form>';
echo $htmlForm;  ?>

@endsection



@push('styles')
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
<script>
  //$('#payfastform').submit();
  $(document).ready(function() {
    $('#payfastform').submit();
    $.blockUI({
        message: $('#domMessage')
    });
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
});
</script>

@endpush
