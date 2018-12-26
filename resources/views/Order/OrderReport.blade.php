<!DOCTYPE html>
<html dir="rtl">
    <head>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('messages.Pname') |  @lang("messages.$view_name") </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
     <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{url('/')}}/images/favicon.png">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="{{url('/')}}/images/icon180.png" sizes="180x180">
        <!-- END Icons -->


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/Template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    
            <link rel="stylesheet" href="{{url("/")}}/css/print.css">
            <style>
                div{
                    border-radius: 10% ;
                    border:1px solid  black;
                    padding: 10px 10px  45px 45px ;
                    margin: 10px;
                    display: inline-block;
                }
            </style>
    </head>
    <body>
    <table class="no-border">
        <tr>
            <td colspan="2">
            <h1> ايصال استلام المستندات </h1>
            </td>
        </tr>
        <tr>
            <td><img src="{{url('/')}}/images/icon180.png" alt=""></td>
            <td><h3> التاريخ : {{$Order->created_at}} </h3></td>
        </tr>
        
        </table>
       <br>
        <div  >
               
            <table >
                <caption>
                        <h2>  المستندات المطلوب التصديق عليها </h2>
                </caption>
                <thead>
                        <tr>
                                <th>  الاسم  </th>
                                <th>    نوع المستند  </th>
                                <th>   الخدمة   </th>
                                <th>    السعر  </th>
                         </tr>
                </thead>
                
                <?php $sum=0; ?>
                @foreach ($DocumentServes as $Serve)
                    <tr>
                        <td> {{$Serve->DOName}}</td>
                        <td> {{$Serve->DName}}</td>
                        <td> {{$Serve->Serves}}</td>
                        <td> {{$Serve->price}}</td>
                        <?php $sum=$sum+$Serve->price;   ?>
                    </tr>
                @endforeach
            </table>

        <br>
    <table class="no-border">
        @if(!empty($Order->address))

                <tr>
                            <th> خدمة توصيل المستندات</th>
                            <th>المكان :</th>
                            <td colspan="2"> {{$Order->address}}   </td>
                            <th> تكلفة التوصيل</th>
                            <td>
                                <?php
                                $sum=$sum+$Order->price;
                                echo $Order->price;
                                ?> 
                            </td>
                </tr>
        @endif        
        <tr>
            <th>اجمالى المطلوب</th>
            <td> {{$sum}} </td>
            <th> المدفوع</th>
            <td> {{$Order->paid}} </td>
            <th> الباقى</th>
            <td> {{$sum-$Order->paid}} </td>
        </tr>
        <tr>
            <th colspan="3">رقم موبايل العميل</th>
            <th colspan="3"> الموظف المستلم</th>
         </tr>
         <tr>
                <td colspan="3">{{$Order->phone}}</td>
                <td colspan="3"> {{$Order->name}}</td>
         </tr>
    
  </table>

</div>
<div>
    <table  class="no-border">
        <tr>
              
            <td colspan="3">
              <h2><i class="fa fa-map-marker"></i> {{$Order->Baddress}} </h2>  
            </td>
        </tr>
        <tr>
                <td><i class="fa fa-phone "></i> {{$Order->BPhones}}  </td>
                <td><i class="fa fa-whatsapp"></i> {{$Order->BWhats}}  </td>
                <td><i class="fa fa-fax"></i> {{$Order->BFax}}  </td>
                 
         </tr>
         <tr>
                <td>  {{$Order->BFB}}<i class="fa fa-facebook-square"></i></td>
                <td>  {{$Order->BMail}}<i class="fa fa-envelope"></i></td>
                <td>  {{$Order->BWebSite}}<i class="fa fa-globe"></i></td>
         </tr>

    </table>

</div>
    </body>
</html>