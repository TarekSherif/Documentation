
@extends('layouts.index')

@section('CoreContent')

               
<div class="container">
	<div class="row">

		<div class="col-xs-5">
			<div class="form-group ">
				<label>@lang("messages.Serves") </label>
				<select class=" form-control " id="selectServes" name="serves">
				
				</select>

			</div>
		</div>
		<div class="col-xs-5">
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
				</a>
			{{-- <a class="btn btn-primary" id="btnPrint">
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
			}
			,
	@include('layouts..inc.JtableToolbar'),
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
				},
				DOName: {
					title:'@lang("messages.DOName")' ,
					edit: false,
				},
				priority:{
					title:'@lang("messages.priority")',
					edit: false,
					type: 'radiobutton',
                    options: { '0': '@lang("messages.Normal")', '1': '@lang("messages.Expedited")' }
				},
				CID: {
						title:  '@lang("messages.Company")',
						options: '{{url("/")}}/api/CompanyListoptions?_token={{ csrf_token() }}'
							},

				INCode: {
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
				}
			}
			
			@include('layouts.inc.JtableEvent')
	
			});

		var $selectServes=$("#selectServes");
		
	
		$("#SDate").val( new Date().toJSON().slice(0,10).replace(/-/g,'-'));

		$.post('{{url("/")}}/api/ListOfServes?_token={{ csrf_token() }}',function (data) {
		// var index=0;+((index++==0)?"selected=selected ":"")+'
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
	
        //Load all records when page is first shown
		var $SID={{$SID}};
		@if ($SID!=-1)
			$('#jtableContainer').jtable('load', {
					SID: $SID,
					BID:$("#selectBranch").val()
				});
				$selectServes.val($SID);
		@endif
	
	
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
						DSID:DSIDS
					};
								// console.log();
									
					$.post('{{url("/")}}/api/UpdateDocumentsInService?_token={{ csrf_token() }}',DocumentsIn,function (data) {
					
						$selectServes.change();
						ReloadServesNotifications();
						console.log( data);
						
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
