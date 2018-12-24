@extends('layouts.index') 
@section('CoreContent')
<div class="form-group row">
        <label class="control-label col-md-2">
                            @lang('messages.OrderID')
                        </label>
        <div class="col-md-6 control-display-label">
                <input id='OrderID' type="text" class="form-control "  >
               
        </div>
        <button   class=" col-md-2 btn btn-primary fa fa-search">
                @lang('messages.Search')  
        </button>
    </div>

<form action="{{ route('OnlinePayment.store') }}" method="post" class="form-horizontal validate"  method="post">
    @csrf
    @include('OnlinePayment.form')
</form>
@endsection
@section('ScriptContent')
 <script>
         $(function () {
            
                $('#DName').autocomplete({
                        source: '{{url("/")}}/api/ListOfACDocumentType?_token={{ csrf_token() }}',
                        select: function (e, ui) {
                        $('[name=DTypeID]').val(ui.item.DTypeID);
                        }
                });
                $('#OrderID').autocomplete({
                        source: '{{url("/")}}/api/ListOfACOnlinePayment?_token={{ csrf_token() }}',
                        select: function (e, ui) {
                                // $('[name=DTypeID]').val(ui.item.DTypeID);
                        }
                });
         });
 </script>
@endsection

