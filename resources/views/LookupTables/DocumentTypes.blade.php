
@extends('layouts.index')

@section('ScriptContent')
    @if ($Permission["ShowData"])       
               


<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-file-text  " style="color: orange;" aria-hidden="true"></i>	 @lang("messages.DocumentTypes")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'DTypeID DESC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
				listAction:   '{{url("/")}}/api/ListOfDocumentTypes?_token={{ csrf_token() }}',
                createAction: '{{url("/")}}/api/CreateDocumentType?_token={{ csrf_token() }}',
                updateAction: '{{url("/")}}/api/UpdateDocumentType?_token={{ csrf_token() }}',
                deleteAction: '{{url("/")}}/api/DeleteDocumentType?_token={{ csrf_token() }}'
            }
            ,@include('layouts.inc.JtableToolbar'),
            fields: {
                
                DTypeID: {
                    key: true,
                    list: false
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

                DName: {
                    title: '@lang("messages.DName")',
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
