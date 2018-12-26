
@extends('layouts.index') 
@section('CoreContent')



<form action='{{url("/ ")}}/api/SaveOrder' id="frmOrder" method="post" novalidate >


	<fieldset>
		<div class="container">
			<div class="row">

				
				<div class="col-xs-1">
						<div class="form-group ">
							<label>@lang("messages.ID")  </label>
							<input  id="OrderID"  name="OrderID" type="text" class="readonly form-control " value="{{$OrderID}}" />
						</div>
					</div>
				<div class="col-xs-2">
					<div class="form-group ">
						<label>@lang("messages.phone")  </label>
						<input class=" form-control " id="phone" name="phone" placeholder="@lang('messages.phone')" type="text" value="" required />
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group ">
						<label>@lang("messages.Branchs")  </label>
						<h5 id="lblBranchs"></h5>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group ">
						<label>@lang("messages.Addedby")  </label>
						<h5 id="lblUsers"></h5>
					</div>
				</div>
				<div class="col-xs-2">
					<div class="form-group ">
						<label>@lang("messages.created_at")  </label>
						<h5 id="lblSdate"></h5>
					</div>
				</div>
				<div class="col-xs-2">
					<br>
					<a href="#" class="btn btn-primary" data-toggle="popover" data-placement="bottom" data-popover-content="#delivery">
						<i class="fa fa-paper-plane"></i>
					</a>
					<a class="btn btn-primary" id="btnSave">
						<i class="fa fa-floppy-o"></i>
					</a>
				<a class="btn btn-primary" id="btnPrint" href="{{url('/')}}/OrderReport/{{$OrderID}}">
						<i class="fa fa-print"></i>
					</a>

				</div>
			</div>
		</div>

		{{--
		<div id="a1" class="hidden">
			<div class="popover-heading">This is the heading for #1</div>

			<div class="popover-body">This is the body for #1</div>
		</div>
		--}}
		<div id="delivery" class="hidden">
			<div class="popover-heading">@lang("messages.delivery")</div>

			<div class="popover-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group ">
							<label>@lang("messages.address") </label>
							<input class=" form-control " id="address" name="address" placeholder="@lang('messages.address')" type="text" value=""
							/>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group ">
							<label>@lang("messages.Otherphone")  </label>
							<input class=" form-control " id="Otherphone" name="Otherphone" placeholder="@lang('messages.Otherphone')" type="text"
							 value="" />
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group ">
							<label>@lang("messages.price")  </label>
							<input class=" form-control " id="price" name="price" placeholder="@lang('messages.price')" type="number" value=0 />
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group ">
							<label>@lang("messages.paid")  </label>
							<input class=" form-control " id="paid" name="paid" placeholder="@lang('messages.paid')" type="number" value=0 />
						</div>
					</div>

				</div>
			</div>
		</div>


	</fieldset>
</form>





<div id="collapseDocuments" class="white-Background collapse">

	<div id="jtableContainer" class='@lang("messages.Clang")'></div>

</div>
@endsection
 
@section('ScriptContent')

<script type="text/javascript">
	$(function () {
		
		
		
	
		$('#collapseDocuments').collapse({
					toggle:false
		});

		$("[data-toggle=popover]").popover({
		html : true,
		content: function() {
			var content = $(this).attr("data-popover-content");
			return  $(".popover-body").detach().appendTo(content);
		},
		title: function() {
			var title = $(this).attr("data-popover-content");
			return  $(title).children(".popover-heading").html();
		}
		
		}).on('hide.bs.popover', function () {
 			// $(content).children(".popover-body").html();
			$(".popover-body").detach().appendTo("#delivery");
		});
		
		$('#frmOrder').trigger("reset");

		$.get("{{url('/')}}/api/GetOrderByOrderID/{{$OrderID}}?_token={{ csrf_token() }}",function(data){
			
			if (data.Record.length>0)
			{
				var Record=data.Record[0];
		
				$('#collapseDocuments').collapse("toggle");

				LoadOrderDocuments(		{{$OrderID}});
			
				LoadOrder(Record) ;
				
			}
		
		});
	
		$('#btnSave').click(function() {
			$phone=$("#phone");
		if($phone.val()=="")
		{
			$phone.addClass(" is-invalid ");
		}
		else
		{
			$phone.removeClass(" is-invalid ");
			var apiPath="{{url("/")}}/api/SaveOrder?_token={{ csrf_token() }}";
			var formdata=$("#frmOrder").serialize();
				
			$.post(apiPath,formdata,function(data) {
				$('#collapseDocuments').collapse('show');
				LoadOrderDocuments(data.Record.OrderID);
				$("#OrderID").val(data.Record.OrderID);
				LoadOrder(data.Record) ;
			});	
		}
		});
	
	
		
		});

function LoadOrder(Record) {
		 $("#lblBranchs").html( Record.BName);
		$("#lblUsers").html(Record.name);
		$("#lblSdate").html(Record.created_at);
		$("#phone").val(Record.phone);
		$("#address").val(Record.address);
		$("#Otherphone").val(Record.Otherphone);
		$("#price").val(Record.price);
		$("#paid").val(Record.paid);
}

function LoadOrderDocuments(OrderID) {
	$('#jtableContainer').jtable({
				title: '<i class="fa  fa-file-text  " style="color: orange;" aria-hidden="true"></i>  @lang("messages.Documents")',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'DID DESC',
				columnResizable: true,
				columnSelectable: true,
				saveUserPreferences: true,
				//openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
				actions: {
					listAction:   '{{url("/")}}/api/ListOfDocuments?_token={{ csrf_token() }}&OrderID='+OrderID,
					createAction: '{{url("/")}}/api/CreateDocument?_token={{ csrf_token() }}',
					updateAction: '{{url("/")}}/api/UpdateDocument?_token={{ csrf_token() }}',
					deleteAction: '{{url("/")}}/api/DeleteDocument?_token={{ csrf_token() }}'
											
				}
				,
	@include('layouts.inc.JtableToolbar'),
				fields: {
					DID: {
						key: true,
						list: false
					},
					//CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
					DocumentServes: {
						title:"",
						width: '5%',
						sorting: false,
						edit: false,
						create: false,
						display: function (DocumentData) {
							//Create an image that will be used to open child table
							var $img = $('<i class="fa  fa-cogs  fa-fw  fa-2x" style="color: #b90606;" aria-hidden="true"></i>');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#jtableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title:'<i class="fa  fa-cogs  fa-fw  " style="color: #b90606;" aria-hidden="true"></i>-  @lang("messages.Serves")',
											defaultSorting:"SOrder ASC",
											actions: {
												listAction:   '{{url("/")}}/api/ListOfDocumentServes/'+DocumentData.record.DID+'?_token={{ csrf_token() }}',
												createAction: '{{url("/")}}/api/CreateDocumentServes?_token={{ csrf_token() }}',
												updateAction: '{{url("/")}}/api/UpdateDocumentServes?_token={{ csrf_token() }}',
												deleteAction: '{{url("/")}}/api/DeleteDocumentServes?_token={{ csrf_token() }}'
											
											},
											fields: {
												DID: {
													type:"hidden",
													defaultValue: DocumentData.record.DID,
													
												},
												DSID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												SOrder: {
													title:  ' @lang("messages.SOrder")',
                   									visibility: 'visible',
													   edit: false,
													input: function (data) {
															if (data.record) {
																return '<input type="number"  placeholder=" @lang("messages.SOrder")"   class=" form-control validate[required]"   autocomplete="off"   name="SOrder"   value="' + data.record.SOrder + '" />';
															} else {
																return '<input type="number"  placeholder=" @lang("messages.SOrder")"     class="form-control validate[required]"  autocomplete="off"   name="SOrder"     />';
															}
														}  
												},
												SID:{
													title:  ' @lang("messages.Serves")',
											
													inputClass:"validate[required] form-control",
													 options: '{{url("/")}}/api/ServesListoptions?_token={{ csrf_token() }}'
												},
												
											@if( Auth::user()->role==1) 
												
												price: {
													title:  ' @lang("messages.price")',
													visibility: 'visible',
													input: function (data) {
															if (data.record) {
																return '<input type="number"  placeholder=" @lang("messages.price")"   class="validate[required] form-control"   autocomplete="off"   name="price"   value="' + data.record.price + '" />';
															} else {
																return '<input type="number"  placeholder=" @lang("messages.price")"     class="validate[required] form-control"  autocomplete="off"   name="price"     />';
															}
														}  
												},
												paid: {
													title:  ' @lang("messages.paid")',
													visibility: 'visible',
													input: function (data) {
															if (data.record) {
																return '<input type="number"  placeholder=" @lang("messages.paid")"   class="validate[required] form-control"   autocomplete="off"   name="paid"   value="' + data.record.paid + '" />';
															} else {
																return '<input type="number"  placeholder=" @lang("messages.paid")"     class="validate[required] form-control"  autocomplete="off"   name="paid"     />';
															}
														}  
												},
												@endif
										
												SDate: {
													title: ' @lang("messages.Sdate")',
													type:"date" ,
													create: false,
                    								edit: false,
														},
												EDate: {
													title: ' @lang("messages.Edate")',
													type:"date" ,
													create: false,
                    								edit: false,
														},
											
												Successfully: {
													title: ' @lang("messages.Successfully")',
													type: 'radiobutton',
													create: false,
                    								edit: false,
                    								options: { 'null': '@lang("messages.StateW")',
																'0': '@lang("messages.StateF")',
																 '1': '@lang("messages.StateT")' }								
																 },
												upColumn: {
												
													create: false,
													edit :false,
													display: function(DocumentServesData) {
														var $link = $('<button  class="jtable-command-button fa fa-arrow-circle-up"  ></button>');
														$link.click(function(){
															url='{{url("/")}}/api/UpdateSOrderUp/' + DocumentServesData.record.DSID + '/' + DocumentServesData.record.DID + '/' + DocumentServesData.record.SOrder;
															$.get(url,null,function (data) {
																if(data.refresh){
																	$img.click();
																}
															});
															
															
																														//  $link.closest('tr').find('.jtable-child-table-container').jtable('reload');
														});
														return $link;
													}
													},
													DownColumn: {
												
													create: false,
													edit :false,
													display: function(DocumentServesData) {
														var $link = $('<button  class="jtable-command-button fa fa-arrow-circle-down"  ></button>');
														$link.click(function(){
															url='{{url("/")}}/api/UpdateSOrderDown/' + DocumentServesData.record.DSID + '/' + DocumentServesData.record.DID + '/' + DocumentServesData.record.SOrder;
															$.get(url,null,function (data) {
																if(data.refresh){
																	$img.click();
																}
															});
															
															
																														//  $link.closest('tr').find('.jtable-child-table-container').jtable('reload');
														});
														return $link;
													}
												}
											
												},
											//Initialize validation logic when a form is created
											formCreated: function (event, data) {
												
												// console.log(data.row);
												 data.form.find("[name='SID']").on('change',function(){


													// data.form.find("input[name='price']")
													// data.form.find("input[name='paid']")

												 });
												data.form.validationEngine('attach'+promptPosition);
											},
											//Validate form when it is being submitted
											formSubmitting: function (event, data) {
												
												
												return data.form.validationEngine('validate');
											},
											//Dispose validation logic when form is closed
											formClosed: function (event, data) {
												data.form.validationEngine('hide');
												data.form.validationEngine('detach');
												ReloadServesNotifications()
											}
										
										   }, function (data) { //opened handler
												data.childTable.jtable('load');
											});
								});
								//Return image to show on the person row
								return $img;
							}
						},
						OrderID: {
						    type: 'hidden',
							defaultValue: OrderID,
						 },
					DOName: {
						title: '@lang("messages.DOName")',
						inputClass:"validate[required] form-control",
						
					},
					Serves: {
						title:  '@lang("messages.Serves")',
						list:false,
						edit:false,
						options: '{{url("/")}}/api/ServesListoptions?_token={{ csrf_token() }}'
							},
					DTypeID: {
						title:  'DTypeID',
						type:"hidden"
					},
					DName:{
						title: '@lang("messages.DName")',
						inputClass:"form-control",
						visibility: 'visible'
						},
					priority: {
						title: '@lang("messages.priority")',
						type: 'radiobutton',
						defaultValue: '0',
                    	options: { '0': '@lang("messages.Normal")', '1': '@lang("messages.Expedited")' }
						},
						ServesH:{
							title:  'ServesH',
							type:"hidden"
						},										
					TimeLineColumn: {
						title: 'Edit',
						width: '3%',
						create: false,
						edit :false,
						display: function (data) {
							return '<a   class="jtable-command-button fa fa-sitemap" href="{{url("/")}}/DocumentServesTimeLine/' + data.record.DID + '" > &nbsp;  &nbsp;  &nbsp; </a>';
							}
						}
				},
				//Initialize validation logic when a form is created
				formCreated: function (event, data) {
					data.form.find('select[name=Serves]')
					.attr('multiple','multiple')
					.multiselect({
						placeholder: '@lang("messages.Serves")',
						search: true,
						selectAll: true
					});
				
					$('input[name=DName]').autocomplete({
						source: '{{url("/")}}/api/ListOfACDocumentType?_token={{ csrf_token() }}',
						select: function (e, ui) {
						 data.form.find('[name=DTypeID]').val(ui.item.DTypeID);
						}
					});
					data.form.validationEngine('attach'+promptPosition);
				  //  data.form.validationEngine();
				},
				//Validate form when it is being submitted
				formSubmitting: function (event, data) { 
					 data.form.find('[name=ServesH]').val(data.form.find('[name=Serves]').val());
				
					return data.form.validationEngine('validate');
					
				},
				//Dispose validation logic when form is closed
				formClosed: function (event, data) {
					data.form.validationEngine('hide');
					data.form.validationEngine('detach');
					ReloadServesNotifications()
				},recordAdded: function (event, data){
					console.log(data);
					
				}
				// ,rowUpdated: function (event, data){
				// 	window.location.reload();
				// }
				// recordsLoaded: function(event, data) {
				// 	$('.jtable-data-row').on('click',function() {
				// 		var row_id = $(this).attr('data-record-key');
				// 		window.open( "{{url("/")}}/DocumentServesTimeLine?DID="+ row_id);
				// 	});
				// }
	
			});
	 
			//Load student list from server
			$('#jtableContainer').jtable('load');
	 
			
			
	
}

</script>
@endsection