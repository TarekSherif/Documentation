
@extends('layouts.index')

@section('CoreContent')

               
<div class="container">
	<div class="row">

		<div class="col-xs-1"></div >
		<div class="col-xs-2">
			<h3>{{$Serves->Serves}}</h3>
		</div >
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
		<div class="col-xs-3">
				<label> @lang('messages.chkShowDate') </label><br>
				<input   type="checkbox" id="chkShowDate"  />
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
				listAction:   '{{url("/")}}/api/CompanyDocumentsReport?_token={{ csrf_token() }}',
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
							 <style>
									.main-table{
										font-size: 2em;
									}
							</style>
                     </head>
                     <body>
						<table class="no-border">
                         	<tr>
								<td colspan="2">
								<h1> شركة `+$('#selectCompany option:selected').text()+`</h1>
								</td>
							</tr>
							`
							if ($('#chkShowDate').prop('checked')) {

								html=html+	`	<tr>
													<td><h3> ترخيص رقم /`+CDocument.CID+`</h3></td>
													<td><h3> تاريخ الدخول `+CDocument.SDate+`</h3></td>
												</tr>`
							}
							else{
								html=html+		`<tr>
													<td  colspan="2"><h3> ترخيص رقم /`+CDocument.CID+`</h3></td>
												</tr>`
							}
							
							html=html+	`	<tr>
									<td colspan="2">
										
									</td>
							</tr>    
                         </table>
						 <table class"main-table">`
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

		
		CDocument={'CID':'','SDate': ''};
		function Search () {
			$('#jtableContainer').jtable('load', {
				SID:{{$Serves->SID}},
                CID: CDocument.CID,
				SDate:CDocument.SDate	
             });
		}
		function change () {
			CDocument.CID=$('#selectCompany').val();
			CDocument.SDate=$('#SDate').val();
			console.log(CDocument);
			Search () ;
		}

		$('#SDate,#selectCompany').on('change', function(e) {
			e.preventDefault();
			change ();
			
        });
	
	
		change ();
	
		 
		});

</script>
@endsection
