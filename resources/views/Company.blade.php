@extends('layouts.index')

@section('ScriptContent')
    @if ($Permission["ShowData"])       
               


<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-file-text  " style="color: orange;" aria-hidden="true"></i>	 @lang("messages.Company")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'SOrder DESC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
				listAction:   '{{url("/")}}/api/ListOfCompanys?_token={{ csrf_token() }}',
                @if ($Permission["InsertData"])
                createAction: '{{url("/")}}/api/CreateCompany?_token={{ csrf_token() }}',
                @endif
                @if ($Permission["UpdateData"])
                updateAction: '{{url("/")}}/api/UpdateCompany?_token={{ csrf_token() }}',
                @endif
                @if ($Permission["DeleteData"])
                deleteAction: '{{url("/")}}/api/DeleteCompany?_token={{ csrf_token() }}'
                @endif
            }
            ,@include('layouts.inc.JtableToolbar'),
            fields: {
                
                CID:  {
						title:'@lang("messages.CID")',
							visibility: 'visible',
							width: '10%',
						input: function (data) {
								if (data.record) {
									return '<input type="number"  placeholder=" @lang("messages.CID")"   class=" form-control validate[required]"   autocomplete="off"   name="CID"   value="' + data.record.CID + '" />';
								} else {
									return '<input type="number"  placeholder=" @lang("messages.CID")"     class="form-control validate[required]"  autocomplete="off"   name="CID"     />';
								}
							}  
					},

				SOrder: {
						title:'@lang("messages.SOrder")',
							visibility: 'visible',
							width: '10%',
						input: function (data) {
								if (data.record) {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"   class=" form-control validate[required]"   autocomplete="off"   name="SOrder"   value="' + data.record.SOrder + '" />';
								} else {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"     class="form-control validate[required]"  autocomplete="off"   name="SOrder"     />';
								}
							}  
					},

                CName: {
                    title: '@lang("messages.Company")',
					inputClass:"form-control validate[required]"
					
				},
				
            }
            @include('layouts.inc.JtableEvent')
        });
 
        //Load student list from server
        $('#jtableContainer').jtable('load');
 
    });
 


</script>


@endif
@endsection

