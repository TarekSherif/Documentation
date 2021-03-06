



    @extends('layouts.index') 
@section('CoreContent')
<div class="form-group row">
                <label class="control-label col-md-2">
                                @lang('messages.SOrderID')
                            </label>
                        
<div class="input-group  col-md-6">
        <input type="number" class="form-control ui-autocomplete-input" id="SOrderID" placeholder="   @lang('messages.SOrderID')..." ><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
        <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                      </button>
                  </span>
      </div>
</div>
{{-- <div class="form-group row">
        <label class="control-label col-md-2">
                            @lang('messages.OrderID')
                        </label>
        <div class="col-md-6 control-display-label">
                <input id='OrderID' type="text" class="form-control "  >
               
        </div>
        <button   class=" col-md-2 btn btn-primary fa fa-search"></button>
    </div> --}}

    <form action="{{ route('OnlinePayment.update',[$OnlinePayment->OnlinePaymentID]) }}" method="post" class="form-horizontal validate"  method="post">
            @csrf
            @method('PUT')
            @include('OnlinePayment.form')
            <div class="form-actions fluid right">
                    <div class="row">
                        <div class="col-md-12">
                        <a class="btn btn-default" href="{{url('/')}}/OnlinePayment/{{$OnlinePayment->OnlinePaymentID}}">
                              <i class=" fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
        </form>
    
@endsection
@section('ScriptContent')
 <script>
         $(function () {
            
                // $('#DName').autocomplete({
                //         source: '{{url("/")}}/api/ListOfACDocumentType?_token={{ csrf_token() }}',
                //         select: function (e, ui) {
                //         $('[name=DTypeID]').val(ui.item.DTypeID);
                //         }
                // });,k33333333333333333333333333333333333
                $('#SOrderID').autocomplete({
                        source: '{{url("/")}}/api/ListOfACOnlinePayment?_token={{ csrf_token() }}',
                        select: function (e, ui) {
                                window.open( "{{url('/')}}/OnlinePayment/"+ui.item.OnlinePaymentID+"/edit", '_self');
                                // window.open( "{{url('/')}}/OnlinePayment/"+ui.item.OnlinePaymentID, '_self');
                                // /OnlinePayment/1/edit
                        }
                });
         });
 </script>
@endsection

