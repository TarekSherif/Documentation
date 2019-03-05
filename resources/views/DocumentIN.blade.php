@extends('layouts.index') {{-- 
@section('CSSContent') @if($SID=='4')
<style>
	.jtable-edit-form {
		-webkit-column-count: 2;
		/* Chrome, Safari, Opera */
		-moz-column-count: 2;
		/* Firefox */
		column-count: 2
	}
</style>
@endif
@endsection
 --}} 
@section('CoreContent')


<div class="container">
	<div class="row">
		<div class="col-xs-2"></div>
		<div class="col-xs-3">
			<h3>{{$Serves}}</h3>
		</div>
		<div class="col-xs-3">
			<form action="post" id="frmDocumentIN">
				<fieldset>
					<label> @lang('messages.Sdate') </label>
					<input class=" form-control " type="date" id="SDate" name="SDate" />
				</fieldset>

			</form>
		</div>
		<div class="col-xs-2">
			<br>
			<a class="btn btn-primary" id="btnSave">
					<i class="fa fa-floppy-o"></i>
				</a> {{-- <a class="btn btn-primary" id="btnPrint">
					<i class="fa fa-print"></i>
				</a> --}}

		</div>
	</div>
</div>
@endsection
 
@section('ScriptContent')

<script type="text/javascript">
	$(function () {
	 
		$('#jtableContainer').jtable({
				title: `<i class="fa fa-arrow-circle-up " aria-hidden="true"></i>
						<span >
								@lang('messages.DocumentIN')
						</span> `,
			 
            	sorting: true,
				defaultSorting: 'priority DESC',
				paging: true,
				pageSize: 10,
				selecting: true, //Enable selecting
				multiselect: true, //Allow multiple selecting
				selectingCheckboxes: true, //Show checkboxes on first column
            //selectOnRowClick: false, //Enable this to only select using checkboxes
				
				columnResizable: true,
				columnSelectable: true,
				saveUserPreferences: true,
				
			actions: {
			@if ($Permission["ShowData"])   
				listAction:   '{{url("/")}}/api/ListOfDocumentsNeedin?_token={{ csrf_token() }}',
			@endif
			@if ($Permission["UpdateData"])
				updateAction: '{{url("/")}}/api/UpdateDocumentsInEnjazID?_token={{ csrf_token() }}',
			@endif	
			},
			toolbar: {
    items: [
    @if ($Permission["DataToPrint"]) 
          {
              Tooltip: '@lang("messages.tipPrint")',
              icon: '{{url("/")}}/images/printer.png',
              text: '@lang("messages.Print")',
             
              click: function (e) {
				var CompanyReportList=[3,4];
                if( CompanyReportList.includes({{$SID}}) ){
					var newWindow = window.open("{{url('/')}}/CompanyReport/{{$SID}}","_self");
				}else{
					var newWindow = window.open("{{url('/')}}/DocumentINReport/{{$SID}}","_self");
				}
               
               
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
}
	,
			fields: {
			
				DSID: {
					key: true,
					edit: false,
					list: false
				},
				DID: {
					title:'DID' ,
					list: false,
					edit: false,					
				},
				phone: {
					title:' @lang("messages.phone")' ,
					edit: false,
					visibility: 'fixed'
				},
				created_at: {
					title: '@lang("messages.created_at")',
					type:"date" ,
					edit: false,
					visibility: 'visible',
				},
				DOName: {
					title:'@lang("messages.DOName")' ,
					edit: false,
					visibility: 'fixed'
				},
				BID:{
					title:  '@lang("messages.LookupTables.Branchs")',
                    options: '{{url("/")}}/api/BranchListoptions?_token={{ csrf_token() }}',
					edit: false,	
					visibility: 'visible',
				},
				priority:{
					title:'@lang("messages.priority")',
					edit: false,
					visibility: 'visible',
					type: 'radiobutton',
                    options: { '0': '@lang("messages.Normal")', '1': '@lang("messages.Expedited")' }
				},
				CID: {
						title:  '@lang("messages.LookupTables.Company")',
						options: '{{url("/")}}/api/CompanyListoptions?_token={{ csrf_token() }}'
							}
			@if($SID=='4')

				,INCode: {
						title:'@lang("messages.INCode")',
						visibility: 'visible',
						width: '10%',
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.INCode")"   class=" form-control "   autocomplete="off"   name="INCode"   value="' + data.record.INCode + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.INCode")"     class="form-control "  autocomplete="off"   name="INCode"     />';
							}
						}  
				},
				// ODate: {
				// 		title:'@lang("messages.ODate")',
				// 		visibility: 'hidden',
				// 		width: '10%',
						
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="text"  placeholder=" @lang("messages.ODate")"   class=" form-control "   autocomplete="off"   name="ODate"   value="' + data.record.ODate + '" />';
				// 			} else {
				// 				return '<input type="text"  placeholder=" @lang("messages.ODate")"     class="form-control "  autocomplete="off"   name="ODate"     />';
				// 			}
				// 		}  
				// },
				// TCode: {
				// 		title:'@lang("messages.TCode")',
				// 	visibility: 'hidden',
				// 		width: '10%',
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="number"  placeholder=" @lang("messages.TCode")"   class=" form-control "   autocomplete="off"   name="TCode"   value="' + data.record.TCode + '" />';
				// 			} else {
				// 				return '<input type="number"  placeholder=" @lang("messages.TCode")"     class="form-control "  autocomplete="off"   name="TCode"     />';
				// 			}
				// 		}  
				// },
				// 	Onlineaddress: {
				// 		title:'@lang("messages.Onlineaddress")',
				// 		visibility: 'hidden',
				// 		width: '10%',
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="text"  placeholder=" @lang("messages.INCode")"   class=" form-control "   autocomplete="off"   name="Onlineaddress"   value="' + data.record.Onlineaddress + '" />';
				// 			} else {
				// 				return '<input type="text"  placeholder=" @lang("messages.INCode")"     class="form-control "  autocomplete="off"   name="Onlineaddress"     />';
				// 			}
				// 		}  
				// },
				// 	passportID: {
				// 		title:'@lang("messages.passportID")',
				// 		visibility: 'hidden',
				// 		width: '10%',
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="text"  placeholder=" @lang("messages.INCode")"   class=" form-control "   autocomplete="off"   name="passportID"   value="' + data.record.passportID + '" />';
				// 			} else {
				// 				return '<input type="text"  placeholder=" @lang("messages.INCode")"     class="form-control "  autocomplete="off"   name="passportID"     />';
				// 			}
				// 		}  
				// },
				// 	Cost: {
				// 		title:'@lang("messages.OnlineCost")',
				// 		visibility: 'hidden',
				// 		width: '10%',
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="text"  placeholder=" @lang("messages.OnlineCost")"   class=" form-control "   autocomplete="off"   name="Cost"   value="' + data.record.Cost + '" />';
				// 			} else {
				// 				return '<input type="text"  placeholder=" @lang("messages.OnlineCost")"     class="form-control "  autocomplete="off"   name="Cost"     />';
				// 			}
				// 		}  
				// },
				// 	ReceiptCode: {
				// 		title:'@lang("messages.ReceiptCode")',
				// 		visibility: 'hidden',
				// 		width: '10%',
				// 	input: function (data) {
				// 			if (data.record) {
				// 				return '<input type="text"  placeholder=" @lang("messages.ReceiptCode")"   class=" form-control "   autocomplete="off"   name="ReceiptCode"   value="' + data.record.ReceiptCode + '" />';
				// 			} else {
				// 				return '<input type="text"  placeholder=" @lang("messages.ReceiptCode")"     class="form-control "  autocomplete="off"   name="ReceiptCode"     />';
				// 			}
				// 		}  
				// },
			@endif
			}
	@include('layouts.inc.JtableEvent')
	
			});


		
	
		$("#SDate").val( new Date().toJSON().slice(0,10).replace(/-/g,'-'));

	


	
        //Load all records when page is first shown

	
		function LoadListOfDocumentsNeedin() {
			$('#jtableContainer').jtable('load', {
						SID: {{$SID}},
						BID:$("#selectBranch").val()
					});
		}
			
		LoadListOfDocumentsNeedin();
	
	
	
		$("#btnSave").click(function () {
			var $selectedRows = $('#jtableContainer').jtable('selectedRows');
				if ($selectedRows.length > 0) {
					//Show selected rows
					var DSIDS = []; 
					$selectedRows.each(function () {
						var record = $(this).data('record');
						DSIDS.push(record.DSID);
					});
					var DocumentsIn={
						SDate:$("#SDate").val(),
						DSID:DSIDS,
						SID:{{$SID}}
					};
								// console.log();
									
					$.post('{{url("/")}}/api/UpdateDocumentsInService?_token={{ csrf_token() }}',DocumentsIn,function (data) {
					
						LoadListOfDocumentsNeedin();
						ReloadServesNotifications();
						if( data.Result!=="OK"){
							alert(data.Result);
						}
						
					}).fail(function() {
						
							console.log( DocumentsIn);
							
						});
				} else {
					//No rows selected
					alert('@lang("message.NoRowSelected")');
				}
		});
			
	 
	
	
		});

</script>
@endsection