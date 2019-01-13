
@extends('layouts.index') 
@section('CoreContent')



<form id="frmOrder" method="post" action="{{route('Order.update',[$OrderID]) }}
	"  >
	@csrf
	@method('PUT')


	<fieldset>
		<div class="container">
			<div class="row">
				<ul class="nav nav-tabs">
					<li   class="active"><a data-toggle="tab" href="#BasicInfo"> @lang('messages.BasicInfo')</a></li>
					<li  ><a data-toggle="tab" href="#ReceiptInfo">@lang('messages.ReceiptInfo')</a></li>
					<li id="li-DeliveryInfo"><a data-toggle="tab" href="#DeliveryInfo">@lang('messages.DeliveryInfo')</a></li>
				  </ul>
				  
				  <div class="tab-content">
					<div id="BasicInfo" class="tab-pane fade in active">
					  <h3>@lang('messages.BasicInfo')</h3>
							<div class="col-xs-1">
								<div class="form-group ">
									<label>@lang("messages.ID")  </label>
									<input  id="OrderID"  name="OrderID" type="text" class="readonly form-control " value="{{$OrderID}}" />
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.phone")  </label>
									<input  id="phone" name="phone" placeholder="@lang('messages.phone')" type="text"  required   class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="{{old('phone')}}"  />
									@if ($errors->has('phone'))
										<span class="invalid-feedback" role="alert">
											<strong>{{ $errors->first('phone') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.paid")  </label>
									<input class=" form-control " id="paid" name="paid" placeholder="@lang('messages.paid')" type="number" value=0 />
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.AmountRequired")  </label>
									<input  id="AmountRequired"    type="text" class="readonly form-control "   />
								</div>
							</div>
							<div class="col-xs-3">
								<br>
								<a href="#" class="btn btn-primary" data-toggle="popover" data-placement="bottom" data-popover-content="#delivery">
									<i class="fa fa-rocket "></i>
								</a>
								<a class="btn btn-primary" id="btnSave" >
									<i class="fa fa-floppy-o"></i>
								</a>
				
							</div>
					</div>
					<div id="ReceiptInfo" class="tab-pane fade">
					  <h3>@lang('messages.ReceiptInfo')</h3>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.LookupTables.Branchs")  </label>
									<h5 id="lblBranchs"></h5>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.Ocreateby")  </label>
									<h5 id="lblUsers"></h5>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.created_at")  </label>
									<h5 id="lblSdate"></h5>
								</div>
							</div>
						
					</div>
					<div id="DeliveryInfo" class="tab-pane fade">
						<h3>@lang('messages.DeliveryInfo')</h3>
						<div class="col-xs-2">
							<div class="form-group ">
								<label>@lang("messages.RecipientName")  </label>
								<input  id="RecipientName" disabled name="RecipientName" placeholder="@lang('messages.RecipientName')" type="text"  required   class="form-control{{ $errors->has('RecipientName') ? ' is-invalid' : '' }}"  value="{{old('RecipientName')}}"  />
								@if ($errors->has('RecipientName'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('RecipientName') }}</strong>
									</span>
								@endif
							</div>
						</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.Recipientby")  </label>
									<h5 id="lblRecipientby"></h5>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="form-group ">
									<label>@lang("messages.updated_at")  </label>
									<h5 id="lblupdated_at"></h5>
								</div>
							</div>
							<div class="col-xs-3">
								<br>
												 
								<a class="btn btn-primary  disabled " id="btnRecipient">
									<i class="fa fa-handshake-o"></i>
								</a>
			
							</div>
						
					</div>
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
							<label>@lang("messages.Dprice")  </label>
							<input class=" form-control " id="price" name="price" placeholder="@lang('messages.price')" type="number" value=0 />
						</div>
					</div>
					
				</div>
			</div>
		</div>


	</fieldset>
</form>





<div class="white-Background ">

	<div id="jtableContainer" class='@lang("messages.Clang")'></div>

</div>
@endsection
 
@section('ScriptContent')

<script type="text/javascript">
	var NextDOName="",IsNext=false;
	function OrderTotalPrice() {
			$.post("{{url('/')}}/api/OrderTotalPrice/{{$OrderID}}?_token={{ csrf_token() }}",function(data){
				$("#AmountRequired").val( data.price);
			});
			
		}
	$(function () {
		
		
	
		$('#btnSave').click(function(){
			document.getElementById('frmOrder').submit();
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
		$('#btnRecipient').click(function(data){
			var RecipientUrl="{{url('/')}}/api/Recipient/{{$OrderID}}?_token={{ csrf_token() }}";
			var RecipientData={RecipientName:$('#RecipientName').val()};
			$.post(RecipientUrl,RecipientData,function(data){
				if(data.Result=="OK"){
					$('#RecipientName').removeClass("is-invalid");
				}else{

					$('#RecipientName').addClass("is-invalid");
				}
				
				console.log(data);

			});
		});
		$.get("{{url('/')}}/api/GetOrderByOrderID/{{$OrderID}}?_token={{ csrf_token() }}",function(data){
			
			if (data.Record.length>0)
			{
				var Record=data.Record[0];
				// $('#btnRecipient').prop('disabled', true);
				// 
				LoadOrderDocuments(	{{$OrderID}});
				LoadOrder(Record) ;
				OrderTotalPrice();



				if (data.finishDocument && data.Documentcount >= 1) {
				 
					$('#btnRecipient').removeClass('disabled');
					$('#RecipientName').prop('disabled', false);
					 $("ul.nav-tabs li").removeClass("active");
					 $("#BasicInfo").removeClass("active in");
					 $('#li-DeliveryInfo').addClass("active");
					 $('a[href="#DeliveryInfo"]').attr("aria-expanded","true");
					 $('#DeliveryInfo').addClass("active in");
					
				} 

			
				
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

		
		$("#RecipientName").val(Record.RecipientName);
		$("#lblRecipientby").html(Record.Recipientby);
		$("#lblupdated_at").html(Record.updated_at);

		
		
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
				toolbar: {
    items: [
    @if ($Permission["DataToPrint"]) 
          {
              Tooltip: '@lang("messages.tipPrint")',
              icon: '{{url("/")}}/images/printer.png',
              text: '@lang("messages.Print")',
             
              click: function (e) {
                        var newWindow = window.open("{{url('/')}}/OrderReport/{{$OrderID}}");
					
                            
                  e.preventDefault();
              }
          },
    @endif
   
    ]
},
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
											title:'<i class="fa  fa-cogs  fa-fw  " style="color: #b90606;" aria-hidden="true"></i>-  @lang("messages.LookupTables.Serves")',
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
													title:  ' @lang("messages.LookupTables.Serves")',
											
													inputClass:"validate[required] form-control",
													 options: '{{url("/")}}/api/ServesListoptions?_token={{ csrf_token() }}'
												},
												
											@if( Auth::user()->role==1) 
												
												price: {
													title:  ' @lang("messages.price")',
													visibility: 'visible',
													input: function (data) {
															if (data.record) {
																return '<input type="number"  placeholder=" @lang("messages.price")"   class="validate[required] form-control"   autocomplete="off"   name="price"  min="'+data.record.Cost+'" value="' + data.record.price + '" />';
															} else {
																return '<input type="number"  placeholder=" @lang("messages.price")"     class="validate[required] form-control"  autocomplete="off"   name="price"   min="'+data.record.Cost+'"   />';
															}
														}  
												},
												Cost: {
													title:  ' @lang("messages.Cost")',
													visibility: 'hidden',
													edit: false,
													input: function (data) {
															if (data.record) {
																return '<input type="number"  placeholder=" @lang("messages.Cost")"   class="validate[required] form-control"   autocomplete="off"   name="Cost"   value="' + data.record.Cost + '" />';
															} else {
																return '<input type="number"  placeholder=" @lang("messages.Cost")"     class="validate[required] form-control"  autocomplete="off"   name="Cost"     />';
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
												 Notes:{
															title:'@lang("messages.Notes")',
															type:'textarea'
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
												//  data.form.find("[name='SID']").on('change',function(){

												// 	data.form.find("input[name='price']")
												// 	data.form.find("input[name='paid']")

												//  });
											
												data.form.validationEngine('attach'{!! $promptPosition !!});
											},
											//Validate form when it is being submitted
											formSubmitting: function (event, data) {
												
												
												return data.form.validationEngine('validate');
											},
											//Dispose validation logic when form is closed
											formClosed: function (event, data) {
												data.form.validationEngine('hide');
												data.form.validationEngine('detach');
												ReloadServesNotifications();
												OrderTotalPrice();
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
						title:  '@lang("messages.LookupTables.Serves")',
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
						NOCopies: {
							title:  ' @lang("messages.NOCopies")',
							edit:false,
							list:false,
						
							input: function (data) {
									if (data.record) {
										return '<input type="number"  placeholder=" @lang("messages.NOCopies")"   class=" form-control validate[required]"   autocomplete="off"   name="NOCopies"   value="' + data.record.NOCopies + '" />';
									} else {
										return '<input type="number"  placeholder=" @lang("messages.NOCopies")"     class="form-control validate[required]"  autocomplete="off"   name="NOCopies" value="1"    />';
									}
								}  
						},										
					
				},
				//Initialize validation logic when a form is created
				formCreated: function (event, data) {
					if(data.formType=='create' && NextDOName!=""){
						$('input[name=DOName]').val(NextDOName);
						NextDOName="";
					}
					data.form.find('select[name=Serves]')
					.attr('multiple','multiple')
					.multiselect({
						placeholder: '@lang("messages.LookupTables.Serves")',
						search: true,
						selectAll: true
					});
				
					$('input[name=DName]').autocomplete({
						source: '{{url("/")}}/api/ListOfACDocumentType?_token={{ csrf_token() }}',
						select: function (e, ui) {
						 data.form.find('[name=DTypeID]').val(ui.item.DTypeID);
						}
					});
				
					  data.form.validationEngine('attach'{!! $promptPosition !!});

				 
				},
				//Validate form when it is being submitted
				formSubmitting: function (event, data) { 
					data.form.find('[name=ServesH]').val(data.form.find('[name=Serves]').val());
					return data.form.validationEngine('validate');
				},
				//Dispose validation logic when form is closed
				formClosed: function (event, data) {
					if(data.formType=='create' && IsNext){
						NextDOName=data.form.find('[name=DOName]').val();;
						IsNext=false;
					}
					data.form.validationEngine('hide');
					data.form.validationEngine('detach');
					ReloadServesNotifications();
					OrderTotalPrice();
				}
			});

			//Load student list from server
			$('#jtableContainer').jtable('load', {}, function(data) {
				$('#AddRecordDialogSaveButton').after('<button type="button" id="ButNext">@lang("messages.Next")</button>');
				$(document).on('click', '#ButNext', function() {
					IsNext=true;
					$("#AddRecordDialogSaveButton").trigger('click');
					
							
				});
			});//end load form
			
			
	
}

</script>
@endsection
