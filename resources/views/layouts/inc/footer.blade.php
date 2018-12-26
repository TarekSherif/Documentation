<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018 <a href="mailto:Eng.Tarek.Sherif@gmail.com">Tarek Sherif</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">

        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading"> @lang("messages.GeneralSettings") </h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
              @lang("messages.ShowAllBranchs") 
              <input type="checkbox" class="pull-right" id="ChkBranch" checked>
            </label>
                </div>
                <div class="form-group ">
                    <label>@lang("messages.Branchs") </label>
                    <select class=" form-control " disabled id="selectBranch" name="Branch">
                        
                        @foreach ($Branches as $Branch)
                             <option  value="{{$Branch->Value}}"> {{$Branch->DisplayText}}</option>
                        @endforeach

                </select>

                </div>

            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>



<!-- jQuery 3 -->
<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('js/jquery-ui-1.9.2.min.js')}}" type="text/javascript"></script>


<script src="{{url('/')}}/Template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/Template/AdminLTE/dist/js/adminlte.js"></script>
@if($jtable)
<script src="{{asset('js/validationEngine/jquery.validationEngine-en.js')}}"></script>
<script src="{{asset('js/validationEngine/jquery.validationEngine.js')}}"></script>
<script src="{{asset('js/datepicker-ar.js')}}"></script>
<script src="{{asset('js/MultiSelect/jquery.multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.table2excel.js')}}"></script>

<script type="text/javascript" src="{{asset('js/jtable/jquery.jtable.js')}}"></script>
@if(session("lang")=="ar")
<script type="text/javascript" src="{{asset('js/jtable/localization/jquery.jtable.AR.js')}}"></script>
@endif

<script>
    var promptPosition="";
              @if (session("lang")=="ar" )
                  promptPosition=',{promptPosition: "topLeft"}' ;
              @endif

</script>
@endif

<script type="text/javascript">
 

    $(function () {
      
      var BranchList=@json($Branches);
    function GetBranchName(params) {
        var BranchName="";
        BranchList.forEach(Branch => {
            if (Branch.Value==params) {
                BranchName= Branch.DisplayText ;
            }
        });
        return BranchName;
    }  

    $selectBranch=$(selectBranch);
    var ChkBranch = $('#ChkBranch');
  
    $('input').on('click',function () {
        if (ChkBranch.is(':checked')) {
            $selectBranch.val(0);
            $selectBranch.attr("disabled","true");
            
        } else {
            $selectBranch.removeAttr('disabled');
        }
    });
    
    $selectBranch.on('change', function(e) {
			e.preventDefault();
            ReloadServesNotifications()
            $('#top-search').autocomplete({
           source: '{{url("/")}}/api/ListOfACName?_token={{ csrf_token() }}&BID='+$selectBranch.val()
           });
        });
      
      $('[data-toggle="push-menu"]').on('click', function (e) {
          e.preventDefault();
         
          if ($("body").hasClass('sidebar-collapse')) {
              $(".content,.content-header>h1,.main-header>.navbar").removeClass('margin-50');
          } else {
              $(".content,.content-header>h1,.main-header>.navbar").addClass('margin-50');
          }
          
 
          });

   
ReloadServesNotifications();
    $('#top-search').autocomplete({
           source: '{{url("/")}}/api/ListOfACName?_token={{ csrf_token() }}&BID='+$selectBranch.val(),
           "position": { my: "center top", at: "center bottom"},
           select: function (e, ui) {
              window.open( "{{url("/")}}/Order/"+ui.item.OrderID+"/edit", '_self');
              
           }
       }).data("autocomplete")._renderItem = function (ul, item) {
      
            var EDateClass="fa fa-calendar-check-o" ,redStyle="style='color:rgb(60, 118, 61);'", EDate=item.EDate;
           if(!item.EDate)
           {
              EDateClass="fa fa-calendar-o";
              redStyle=" style='color:rgb(221, 75, 57);' ";  
              EDate="";
          }
                  var Sdate = new Date(item.created_at).toLocaleDateString("en-US")
                  return $( "<li></li>" )
                      .append(
                        `<a ` +redStyle+`>
                          <div class="row" > 
                            <div class="col-xs-6"> 
                                  <strong> <i class="fa fa-address-card-o"></i>:</strong>`+item.OrderID+`
                              </div>
                              <div class="col-xs-6"> 
                                    <strong><i class="fa fa-address-card-o"></i> :</strong>`+item.DOName+`
                              </div>
                            <div class="col-xs-6"> 
                                  <strong> <i class="fa fa-address-card-o"></i>:</strong>`+GetBranchName(item.BID)+`
                              </div>
                              <div class="col-xs-6"> 
                                    <strong><i class="fa fa-phone"></i> :</strong>`+item.phone+`
                              </div>
                              <div class="col-xs-6"> 
                                  <strong><i class="fa fa-calendar-check-o"></i>:</strong>`+Sdate+`
                              </div>
                              <div class="col-xs-6" > 
                                  <strong><i class="`+EDateClass+`"></i>:</strong>`+EDate+`
                              </div>
                            </div>
                          </a>
                              ` )
                      .appendTo( ul );
                  };
       
   
       
   });



 function ReloadServesNotifications() {
      
      $("#TblCurrentServesState tbody").empty();
      var url="{{url('/')}}/api/ListOfCurrentDocumentServes?_token={{ csrf_token() }}";
      var Prameter={BID:$("#selectBranch").val()};
            $.get(url,Prameter,function(data){
              if (data.Records)
              {
                var NCount=0;
                  $.each( data.Records, function( key, value ) {
                    NCount+=value.ServesInCount+value.ServesOutCount;
                      $("#TblCurrentServesState tbody").append(
                       `<tr>
                            <th>
                                <strong>`+  value.Serves+` </strong> 
                            </th>
                            <td>
                                <a href="{{url("/")}}/DocumentIN/`+ value.SID+`">
                                    <div>`+  value.ServesInCount+` </div> 
                                </a>
                            </td>
                            <td>
                                <a href="{{url("/")}}/DocumentOUT/`+ value.SID+`">
                                    <div>`+  value.ServesOutCount+` </div> 
                                </a>
                            </td>
                        </tr>`
                          );

                      });
                      
                      if(NCount>0){
                        $('#notificationsCount').show().html(NCount);
                      }
                      else{
                        $('#notificationsCount').hide();
                      }
              
              }
           });

    }

</script>