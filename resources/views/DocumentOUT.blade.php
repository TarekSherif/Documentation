
@extends('layouts.index') 
@section('CoreContent')

<div class="container">
	<div class="row">

		<div class="col-xs-5">
			<div class="form-group ">
				<label>@lang("messages.LookupTables.Serves") </label>
				<select class=" form-control " id="selectServes" name="serves">
					<option  selected=selected value> @lang("messages.SelectServes") </option>
				</select>

			</div>
		</div>
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
				},
				DOName: {
					title:'@lang("messages.DOName")' ,
					edit: false,
				},
				SDate: {
					title: '@lang("messages.Sdate")',
					type:"date" ,
					edit: false,
					},
				Notes:{
					title:'@lang("messages.Notes")',
					type:'textarea'
				}
			}
	@include('layouts.inc.JtableEvent')
	
			});

			$("#EDate").val( new Date().toJSON().slice(0,10).replace(/-/g,'-'));

		var $selectServes=$("#selectServes");

$.post('{{url("/")}}/api/ListOfServes?_token={{ csrf_token() }}',function (data) {

	data.Records.forEach(Serves => {
		$selectServes.append(
			'<option '+(($SID==Serves.SID)?"selected=selected ":"")+' value='+Serves.SID+'>' + Serves.Serves +'</option>'
		);
	});
	
});

$selectServes.on('change', function(e) {
	e.preventDefault();
	$('#jtableContainer').jtable('load', {
		SID: this.value,
		BID:$("#selectBranch").val()
	});
	
});

		var $SID={{$SID}};
		@if ($SID!=-1)
			$('#jtableContainer').jtable('load', {
					SID: $SID,
					BID:$("#selectBranch").val()
				});
				$selectServes.val($SID);
		@endif
	
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
				$selectServes.change();
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