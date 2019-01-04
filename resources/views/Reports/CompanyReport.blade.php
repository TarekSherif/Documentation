
@extends('layouts.index')

@section('CoreContent')

               
<div class="container">
	<div class="row">

		<div class="col-xs-1"></div >
		{{-- <div class="col-xs-2">
			<h3>{{$Serves->Serves}}</h3>
		</div > --}}
		<div class="col-xs-3">
			<div class="form-group ">
				<label>@lang("messages.LookupTables.Company") </label>
				<select class=" form-control " id="selectCompany"  >
						
				</select>

			</div>
		</div>

		<div class="col-xs-3">
					<label> @lang('messages.Sdate') </label>
					<input class=" form-control " type="date" id="SDate"  />
		</div>
	
		<div class="col-xs-2">
			<br>
			{{-- <a class="btn btn-primary" id="btnSearch">
					<i class="fa fa-search"></i>
				</a> --}}
			<a class="btn btn-primary" id="btnPrint">
					<i class="fa fa-print"></i>
				</a>

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
				listAction:   '{{url("/")}}/api/CompanyDocuments?_token={{ csrf_token() }}',
			@endif
			}
			,
	@include('layouts.inc.JtableToolbar'),
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
						},

				INCode: {
						title:'<b>@lang("messages.INCode")</b>',
						width: '20%',
					
				},
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

		
		CDocument={'CID':'','SDate': ''};

		$('#SDate,#selectCompany').on('change', function(e) {
			e.preventDefault();
			CDocument.CID=$('#selectCompany').val();
			CDocument.SDate=$('#SDate').val();
			Search () ;
        });
	
	
		 function Search () {
			$('#jtableContainer').jtable('load', {
				SID:{{$SID}},
                CID: CDocument.CID,
				SDate:CDocument.SDate				
             });
		}
	
		$("#btnPrint").click(function () {
		
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
								<h1> شركة `+$('#selectCompany').text()+`</h1>
								</td>
							</tr>
							<tr>
								<td><h3> ترخيص رقم /`+CDocument.CID+`</h3></td>
								<td><h3> تاريخ الدخول `+CDocument.SDate+`</h3></td>
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
								<h1>  العدد/ `+$('.jtable tbody tr').length();+`</h1>
								</td>
							</tr>
						
                         </table>
                     </body>
                 `;
                  newWindow.document.write(html);
                  
                  e.preventDefault();
					
			 
			
				
		 
		});
			
	 
	
	
		});

</script>
@endsection
