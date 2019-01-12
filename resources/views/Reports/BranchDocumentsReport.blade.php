
@extends('layouts.index')

@section('CoreContent')

               
<div class="container">
	<div class="row">
		<div class="col-xs-1"></div >
			<div class="col-xs-3">
					<label> @lang('messages.From') </label>
					<input class=" form-control " type="date" id="From"  />
			</div>
			<div class="col-xs-3">
						<label> @lang('messages.To') </label>
						<input class=" form-control " type="date" id="To"  />
			</div>

	</div>
</div>
<table>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
			<td colspan="2">

			</td>
	</tr>
</table>
@endsection
@section('ScriptContent')
    
<script type="text/javascript">
	$(function () {
	 
		$('#jtableContainer').jtable({
				title: `<i class="fa fa-arrow-circle-up " aria-hidden="true"></i>
						<span >
							
						</span> `,
			 
				// selecting: true, //Enable selecting
				// multiselect: true, //Allow multiple selecting
				// selectingCheckboxes: true, //Show checkboxes on first column
            //selectOnRowClick: false, //Enable this to only select using checkboxes
				
				 
				saveUserPreferences: true,
				
			actions: {
			@if ($Permission["ShowData"])   
				listAction:   '{{url("/")}}/api/BranchDocumentsReport?_token={{ csrf_token() }}',
			@endif
			}
			,
			toolbar: {
    items: [
    @if ($Permission["DataToPrint"]) 
          {
              Tooltip: '@lang("messages.tipPrint")',
              icon: '{{url("/")}}/images/printer.png',
              text: '@lang("messages.Print")',
             
              click: function (e) {
                var jtable=$('.jtable'); 
                var newWindow = window.open();
                var html=`<!DOCTYPE html>
                  <html dir="rtl">
                     <head>
                             <title>{{$view_name}}-Report</title>
                             <link rel="stylesheet" href="{{url("/")}}/css/print.css">
                     </head>
                     <body>
						<table class="no-border">
                         	<tr>
								<td colspan="2">
								<h1> تقرير انتاج فرع </h1>
								</td>
							</tr>
							<tr>
								<td><h3> @lang("messages.From") /`+BDocument.SDate+`</h3></td>
								<td><h3> @lang("messages.To") /`+BDocument.EDate+`</h3></td>
							</tr>
							<tr>
									<td colspan="2">
										
									</td>
							</tr>    
                         </table>
						 <table>`
							+ $(jtable).html() +
						`</table>
						<table class="no-border">
                         	<tr>
								<td colspan="2">
								<h1>  العدد/ `+$('.jtable tbody tr').length;+`</h1>
								</td>
							</tr>
						
                         </table>
                     </body>
                 `;
                  newWindow.document.write(html);
                  
                  e.preventDefault();
					
			 
			
              }
          },
    @endif
    @if ($Permission["DataToExcel"]) 
        {
        tooltip: '@lang("messages.tipExcel")',
        icon: '{{url("/")}}/images/excel.png',
        text: '@lang("messages.Excel")',
        click: function (e) {
                 $(".jtable").table2excel({
                 exclude: ".noExl",
                 name: "Excel Document Name",
                 filename: "{{$view_name}}",
                 fileext: ".xls",
                 exclude_img: true,
                 exclude_links: true,
                 exclude_inputs: true
             });
             e.preventDefault();
         
        }
    }
    @endif
    ]
},
			fields: {
			
				DCID: {
					key: true,
					edit: false,
					list: false
				},
				OID:{
					title:'<b>@lang("messages.Oindex")</b>' ,
					width: '2%',
				},
				DOName: {
					title:'<b>@lang("messages.DOName")</b>' ,
					width: '40%',
				},
				DName:{
						title: '<b>@lang("messages.DName")</b>',
						width: '30%',
						}
			@if($Serves->SID=='4')		
				,INCode: {
						title:'<b>@lang("messages.INCode")</b>',
						width: '20%',
				},
			@endif
			}
			
			@include('layouts.inc.JtableEvent')
	
			});

		var $selectCompany=$("#selectCompany");
		
	
		$("#SDate").val( new Date().toJSON().slice(0,10).replace(/-/g,'-'));

		var Companys=@json($Company);
	
		
		Companys.forEach(Company => {
				$selectCompany.append(
					'<option  value='+Company.CID+'>' + Company.CName +'</option>'
				);
		});

		
		BDocument={'CID':'','SDate': ''};

		$('#SDate,#selectCompany').on('change', function(e) {
			e.preventDefault();
			BDocument.CID=$('#selectCompany').val();
			BDocument.SDate=$('#SDate').val();
			Search () ;
        });
	
	
		 function Search () {
			$('#jtableContainer').jtable('load', {
				SID:{{$Serves->SID}},
                CID: BDocument.CID,
				SDate:BDocument.SDate				
             });
		}
	

	
	
		});

</script>
@endsection
