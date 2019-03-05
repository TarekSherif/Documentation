<input type="hidden" class="form-control  " id="OnlinePaymentID" name="OnlinePaymentID" value="{{old('OnlinePaymentID',$OnlinePayment->OnlinePaymentID)}}">
<div class="portlet box  mofa-green">

    <div class="portlet-body form">
        <div class="form-body form-horizontal">


            <div class="form-group row">
                <label for='OCode' class="col-md-2 control-label"> @lang('messages.OCode') </label>
                <div class="col-md-6">
                    <input id='OCode' type="number" class="form-control{{ $errors->has('OCode') ? ' is-invalid' : '' }}" name='OCode' value="{{old('OCode',$OnlinePayment->OCode)}}"
                        autofocus required> @if ($errors->has('OCode'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('OCode') }}</strong>
                                </span> @endif
                </div>
            </div>
            <div class="form-group row">
                <label for='ODate' class="col-md-2 control-label"> @lang('messages.ODate') </label>
                <div class="col-md-6">
                    <input id='ODate' type="date" class="form-control{{ $errors->has('ODate') ? ' is-invalid' : '' }}" name='ODate' value="{{old('ODate',$OnlinePayment->ODate)}}">                    @if ($errors->has('ODate'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ODate') }}</strong>
                            </span> @endif
                </div>
            </div>



            <div class="form-group row">
                <label for='TCode' class="col-md-2 control-label"> @lang('messages.TCode') </label>
                <div class="col-md-6">
                    <input id='TCode' type="number" class="form-control{{ $errors->has('TCode') ? ' is-invalid' : '' }}" name='TCode' value="{{old('TCode',$OnlinePayment->TCode)}}">                    @if ($errors->has('TCode'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('TCode') }}</strong>
                                </span> @endif
                </div>
            </div>


            <div class="form-group row">
                <label for='address' class="col-md-2 control-label"> @lang('messages.Onlineaddress') </label>
                <div class="col-md-6">
                    <input id='address' type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name='address' value="{{old('address',$OnlinePayment->address)}}">                    @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span> @endif
                </div>
            </div>


            <div class="form-group row">
                <label for='passportID' class="col-md-2 control-label"> @lang('messages.passportID') </label>
                <div class="col-md-6">
                    <input id='passportID' type="text" class="form-control{{ $errors->has('passportID') ? ' is-invalid' : '' }}" name='passportID'
                        value="{{old('passportID',$OnlinePayment->passportID)}}"> @if ($errors->has('passportID'))
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passportID') }}</strong>
                                        </span> @endif
                </div>
            </div>


            <div class="form-group row">
                <label for='OName' class="col-md-2 control-label"> @lang('messages.OName') </label>
                <div class="col-md-6">
                    <input id='OName' type="text" class="form-control{{ $errors->has('OName') ? ' is-invalid' : '' }}" name='OName' value="{{old('OName',$OnlinePayment->OName)}}">                    @if ($errors->has('OName'))
                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('OName') }}</strong>
                                        </span> @endif
                </div>
            </div>




            <div class="form-group row">
                <label class="control-label col-md-2">
                                    @lang('messages.DTypeID')
                                </label>
                <div class="col-md-6 control-display-label">
                    <input id='DType' type="text" class="form-control{{ $errors->has('DType') ? ' is-invalid' : '' }}" name="DType" value="{{old('DType',$OnlinePayment->DType)}}">                    @if ($errors->has('DType'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('DType') }}</strong>
                            </span> @endif

                </div>
            </div>

            <div class="form-group row">
                <label for='ActionType' class="col-md-2 control-label"> @lang('messages.ActionType') </label>
                <div class="col-md-6 control-display-label">
                    <input id='ActionType' type="text" class="form-control{{ $errors->has('ActionType') ? ' is-invalid' : '' }}" name="ActionType"
                        value="{{old('ActionType',$OnlinePayment->ActionType)}}"> @if ($errors->has('ActionType'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ActionType') }}</strong>
                                </span> @endif

                </div>
            </div>



            <div class="form-group row">
                <label for='Cost' class="col-md-2 control-label"> @lang('messages.OnlineCost') </label>
                <div class="col-md-6">
                    <input id='Cost' type="number" class="form-control{{ $errors->has('Cost') ? ' is-invalid' : '' }}" name='Cost' value="{{old('Cost',$OnlinePayment->Cost)}}">                    @if ($errors->has('Cost'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Cost') }}</strong>
                                </span> @endif
                </div>
            </div>

            <div class="form-group row">
                <label for='ReceiptCode' class="col-md-2 control-label"> @lang('messages.ReceiptCode') </label>
                <div class="col-md-6">
                    <input id='ReceiptCode' type="number" class="form-control{{ $errors->has('ReceiptCode') ? ' is-invalid' : '' }}" name='ReceiptCode'
                        value="{{old('ReceiptCode',$OnlinePayment->ReceiptCode)}}"> @if ($errors->has('ReceiptCode'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ReceiptCode') }}</strong>
                                    </span> @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-5  "></div>
                <div class="col-md-6  ">
                    <button type="submit" class="btn btn-primary">
                                        @lang('messages.Save')  
                                    </button>
                </div>
            </div>




        </div>
    </div>
</div>