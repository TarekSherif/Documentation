
@extends('layouts.index')

@section('ScriptContent')
    @if ($Permission["ShowData"])       
               

<script type="text/javascript">
$(function () {

        $('#jtableContainer').jtable({
            title: '<i class="fa fa-group  " style="color: orange;" aria-hidden="true"></i> @lang("messages.LookupTables.Serves")',
            paging: true,
            pageSize: 10,
            sorting: true,
            defaultSorting: 'SID DESC',
            columnResizable: true,
            columnSelectable: true,
            saveUserPreferences: true,
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
            actions: {
                listAction:   '{{url("/")}}/api/ListOfServes?_token={{ csrf_token() }}',
				@if ($Permission["InsertData"])
                createAction: '{{url("/")}}/api/CreateServes?_token={{ csrf_token() }}',
				@endif
				@if ($Permission["UpdateData"])
                updateAction: '{{url("/")}}/api/UpdateServes?_token={{ csrf_token() }}',
				@endif
				@if ($Permission["DeleteData"])
                deleteAction: '{{url("/")}}/api/DeleteServes?_token={{ csrf_token() }}'
				@endif
            }
            ,@include('layouts.inc.JtableToolbar'),
           
            fields: {
                SID: {
                    key: true,
                    list: false
                },
                Serves: {
                    title: '@lang("messages.LookupTables.Serves")',
                    inputClass:"form-control validate[required]"
                },
                Nprice: {
                    title: '@lang("messages.Nprice")',
					visibility: 'visible',
                    
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.Nprice")"   class=" form-control validate[required]"   autocomplete="off"   name="Nprice"   value="' + data.record.Nprice + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.Nprice")"     class="form-control validate[required]"  autocomplete="off"   name="Nprice"     />';
							}
						} 
                },
                Qprice : {
                    title: '@lang("messages.Qprice")',
					visibility: 'visible',
                    
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.Qprice")"   class=" form-control validate[required]"   autocomplete="off"   name="Qprice"   value="' + data.record.Qprice + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.Qprice")"     class="form-control validate[required]"  autocomplete="off"   name="Qprice"     />';
							}
						} 
                },
                NCost: {
                    title: '@lang("messages.NCost")',
					visibility: 'visible',
                    
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.NCost")"   class=" form-control validate[required]"   autocomplete="off"   name="NCost"   value="' + data.record.NCost + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.NCost")"     class="form-control validate[required]"  autocomplete="off"   name="NCost"     />';
							}
						} 
                },
                QCost : {
                    title: '@lang("messages.QCost")',
					visibility: 'visible',
                    
					input: function (data) {
							if (data.record) {
								return '<input type="number"  placeholder=" @lang("messages.QCost")"   class=" form-control validate[required]"   autocomplete="off"   name="QCost"   value="' + data.record.QCost + '" />';
							} else {
								return '<input type="number"  placeholder=" @lang("messages.QCost")"     class="form-control validate[required]"  autocomplete="off"   name="QCost"     />';
							}
						} 
				},
				SOrder: {
						title:  ' @lang("messages.SOrder")',
						visibility: 'visible',

						input: function (data) {
								if (data.record) {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"   class=" form-control validate[required]"   autocomplete="off"   name="SOrder"   value="' + data.record.SOrder + '" />';
								} else {
									return '<input type="number"  placeholder=" @lang("messages.SOrder")"     class="form-control validate[required]"  autocomplete="off"   name="SOrder"     />';
								}
							}  
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


