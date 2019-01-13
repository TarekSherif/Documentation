
@extends('layouts.index') 
@section('CoreContent')

<div class="container">
	<div class="row">
		<div class="col-xs-2"></div>
		<div class="col-xs-3">
			<h3>{{$Serves}}</h3>
		</div >
		
		<div class="col-xs-5">
			<form action="post" id="frmDocumentOut">
				<fieldset>
					<label>@lang("messages.Edate") </label>
					<input class=" form-control " type="date" id="EDate" name="EDate" />
				</fieldset>

			</form>
		</div>
		<div class="col-xs-2">
			{{-- <br>
			<a class="btn btn-primary" id="btnPrint">
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
				title: `
						<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
								<span  >
										@lang('messages.DocumentOUT')
								</span>
				`,
				paging: true,
				pageSize: 10,
				selecting: true, //Enable selecting
				multiselect: true, //Allow multiple selecting
				selectingCheckboxes: true, //Show checkboxes on first column
            //selectOnRowClick: false, //Enable this to only select using checkboxes
				
				columnResizable: true,
				columnSelectable: true,
				saveUserPreferences: true,
				toolbar: {
					items: [{
						icon: '{{asset("images/Accepted.png")}}',
						text: '@lang("messages.Accepted")',
						click: function () {
							//perform your custom job...
							DocumentOUTService(true);
						}
					},{
						icon: '{{asset("images/Refuse.png")}}',
						text: '@lang("messages.Refuse")',
						click: function () {
							DocumentOUTService(false);
						}
					}]
				},
			actions: {
			@if ($Permission["ShowData"])  
				listAction:   '{{url("/")}}/api/ListOfDocumentsNeedout?_token={{ csrf_token() }}',
			@endif
			@if ($Permission["UpdateData"])
				updateAction: '{{url("/")}}/api/UpdateDocumentsOut?_token={{ csrf_token() }}',
			@endif	
				// createAction: '{{url("/")}}/api/CreateDocumentServes',
				// updateAction: '{{url("/")}}/api/UpdateDocumentServes',
				// deleteAction: '{{url("/")}}/api/DeleteDocumentServes'
			
			},
		
			fields: {
			
				DSID: {
					key: true,
					create: false,
					edit: false,
					list: false
				},
				DID: {
					title:'DID' ,
					list: false,	
					edit: false,				
				},
				phone: {
					title:'@lang("messages.phone")' ,
					edit: false,
					visibility: 'fixed',
				},
				DOName: {
					title:'@lang("messages.DOName")' ,
					edit: false,
					visibility: 'fixed',
				},
				SDate: {
					title: '@lang("messages.Sdate")',
					type:"date" ,
					edit: false,
					},
				BID:{
					title:  '@lang("messages.LookupTables.Branchs")',
                    options: '{{url("/")}}/api/BranchListoptions?_token={{ csrf_token() }}',
					edit: false,	
					visibility: 'visible',
				},
				Notes:{
					title:'@lang("messages.Notes")',
					type:'textarea'
				}
			}
	@include('layouts.inc.JtableEvent')
	
			});

			$("#EDate").val( new Date().toJSON().slice(0,10).replace(/-/g,'-'));

	



	function LoadListOfDocumentsNeedout() {
			$('#jtableContainer').jtable('load', {
				SID:{{$SID}},
				BID:$("#selectBranch").val()
			});
		}
		LoadListOfDocumentsNeedout() ;
			
	//Load student list from server
	// $('#jtableContainer').jtable('load');
	function DocumentOUTService(ServesResponse) {
		var $selectedRows = $('#jtableContainer').jtable('selectedRows');
		if ($selectedRows.length > 0) {
			//Show selected rows
			var DSIDS = []; 
			$selectedRows.each(function () {
				var record = $(this).data('record');
				DSIDS.push(record.DSID);
			});
			var DocumentsOUT={
				EDate:$("#EDate").val(),
				DSID:DSIDS,
				Successfully:ServesResponse
			};
						// console.log();
							
			$.post('{{url("/")}}/api/UpdateDocumentOUTService?_token={{ csrf_token() }}',DocumentsOUT,function (data) {
				if(data.Result!=="OK")
				{
					alert(data.Result);
				}
				LoadListOfDocumentsNeedout() ;
				ReloadServesNotifications();
			}).fail(function() {
					alert("fail")
				});
		} else {
			//No rows selected
			alert('@lang("message.NoRowSelected")');
		}
	}
});

</script>
@endsection