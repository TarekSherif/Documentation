<!DOCTYPE html>
<!-- saved from url=(0067)https://enjazit.com.sa/Enjaz/GetServiceDataForPayment?AppNo=6745723 -->
<html lang="en" class="no-js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>منصة خدمات التأشيرات الإلكترونية (إنجاز)</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="format-detection" content="telephone=no">
    <meta content="" name="description">
    <meta content="" name="author">

    <script type="text/javascript">
        var direction = 'rtl';
    </script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    

    <link href="{{url('/')}}/enjaz/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/enjaz/simple-line-icons.min.css" rel="stylesheet" type="text/css">

    
    

    <link href="{{url('/')}}/enjaz/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/enjaz/select2.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

    <link href="{{url('/')}}/enjaz/jtable_basic.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{url('/')}}/enjaz/jquery.calendars.picker.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/enjaz/smoothness.calendars.picker.css" rel="stylesheet" type="text/css">
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{url('/')}}/enjaz/components-rounded.css" id="style_components" rel="stylesheet"
        type="text/css">
    <link href="{{url('/')}}/enjaz/plugins.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/enjaz/layout.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/enjaz/mofa.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="{{url('/')}}/enjaz/custom.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/enjaz/print.css" rel="stylesheet" type="text/css" media="print">

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="https://enjazit.com.sa/assets_rtl/img/favicon.ico">






    <!-- START FAVICON -->
  
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../assets_rtl/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- END FAVICON -->


    <script src="{{asset('js/JsBarcode.all.js')}}"></script>

</head>

<body class="enjaz-system" >


  
    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container" style="margin-top:-5px;margin-right:-5px;">
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content" id="content" data-sort="true">
            <div class="container">
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE LOGIN CONTENT -->


                <div class="row page-user-container">
                    <div class="col-md-12 page-user-main-content">
                        <!-- BEGIN PAGE CONTENT INNER -->


                        <div class="portlet box  mofa-green">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <div class="">
                                        <span class="bold">طلب خدمات الكترونية</span>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body form-horizontal">
                                    <form action="https://enjazit.com.sa/Enjaz/GetServiceDataForPayment" class="form-horizontal validate" id="myform" method="post"
                                        novalidate="novalidate">
                                        <div class="alert alert-danger" style="display: none">

                                        </div>
                                        <div class="alert alert-danger" style="display: none">

                                        </div>
                                        <div class="alert alert-success">
                                            عملية الدفع ناجحة
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                @lang('messages.OCode')
                            </label>
                                                <div class="col-md-6 control-display-label">
                                                    <label>{{$OnlinePayment->OCode}}</label>

                                                </div>
                                                <div class="col-md-3">

                                                    <p style="width:60%;display:ruby;">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{-- <img id="image" width="150px"  > --}}
                                                        <svg id="image"></svg>
                                                        <script>
                                                            JsBarcode("#image",'{{$OnlinePayment->OCode}}', 
                                                            {format: "CODE128B", 
                                                             displayValue: false, 
                                                             margin:0,
                                                              height:24,
                                                              width:1.4});
                                                        </script>
                                                    </p>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.ODate')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->ODate}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.TCode')
                                </label>
                                                <div class="col-md-6  control-display-label">
                                                    {{$OnlinePayment->TCode}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.Onlineaddress')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->address}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.passportID')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->passportID}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.OName')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->OName}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.DTypeID')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    @foreach ($Serves as $item)
                                                    @if ($OnlinePayment->SID==$item->SID)
                                                       {{$item->Serves}}
                                                    @endif 
                                                 @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                                    @lang('messages.SID')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    @foreach ($Serves as $item)
                                                    @if ($OnlinePayment->SID==$item->SID)
                                                       {{$item->Serves}}
                                                    @endif 
                                                 @endforeach    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                    @lang('messages.Cost')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->Cost}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-md-2">
                                    @lang('messages.ReceiptCode')
                                </label>
                                                <div class="col-md-6 control-display-label">
                                                    {{$OnlinePayment->ReceiptCode}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions fluid right">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a class="btn btn-default" href="{{url('/')}}/OnlinePayment/{{$OnlinePayment->OnlinePaymentID}}/edit">
                                            عودة
                                        </a>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>

                <!-- END PAGE LOGIN CONTENT -->

            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->
 

<script>
    window.print();
</script>

</body>

</html>