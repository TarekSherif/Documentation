{{--
<li class="active">
	<div class="timeline-icon ">
		<i class="fa fa-file-text"></i>
	</div>
	<div class="timeline-time"><small>5 min ago</small></div>
	<div class="timeline-content">
		<p class="push-bit"><a href="page_ready_user_profile.html"><strong>Administrator</strong></a></p>
		<strong>Free courses</strong> for all our customers at A1 Conference Room - 9:00 <strong>am</strong> tomorrow!
	</div>
</li>
<li class="active">
	<div class="timeline-icon themed-background-spring themed-border-spring ">
		<i class="fa fa-file-text"></i>
	</div>
	<div class="timeline-time"><small>5 min ago</small></div>
	<div class="timeline-content">
		<p class="push-bit"><a href="page_ready_user_profile.html"><strong>Administrator</strong></a></p>
		<strong>Free courses</strong> for all our customers at A1 Conference Room - 9:00 <strong>am</strong> tomorrow!
	</div>
</li>

<li class="active">
	<div class="timeline-icon themed-background-fire themed-border-fire">
		<i class="fa fa-file-text"></i></div>
	<div class="timeline-time"><small>5 min ago</small></div>
	<div class="timeline-content">
		<p class="push-bit"><a href="page_ready_user_profile.html"><strong>Administrator</strong></a></p>
		<strong>Free courses</strong> for all our customers at A1 Conference Room - 9:00 <strong>am</strong> tomorrow!
	</div>
</li>
<li class="active">
	<div class="timeline-icon themed-background-autumn themed-border-autumn">
		<i class="fa fa-file-text"></i></div>
	<div class="timeline-time"><small>5 min ago</small></div>
	<div class="timeline-content">
		<p class="push-bit"><a href="page_ready_user_profile.html"><strong>Administrator</strong></a></p>
		<strong>Free courses</strong> for all our customers at A1 Conference Room - 9:00 <strong>am</strong> tomorrow!
	</div>
</li> --}} 
@extends('layouts.index')
@section('CoreContent')

<div class="row">
	<div class="col-md-10">
		<!-- Timeline Widget -->
		<div class="widget">
			<div class="widget-extra themed-background-dark">

				<h4 class="widget-content-light">
					تفاصيل <strong>اكثر</strong>
					<small><a id="OrderLink" href="#"><strong>View all</strong></a></small>
				</h4>
			</div>
			<div class="widget-extra">

				<div class="container">
					<div class="row">
						<div class="col-xs-3">
							<h4>
								<strong>اسم صاحب الشهادة</strong><br>

								<span id="lblDOName"></span>
							</h4>
						</div>
						<div class="col-xs-3">
							<h4>
								<strong>التليفون</strong><br>
								<span id="lblphone"></span>
							</h4>
						</div>
						<div class="col-xs-3">
							<h4>
								<strong>نوع الطلب</strong><br>
								<span id="lblorderType"></span>
							</h4>
						</div>
						
					</div>
				</div>
				
				<!-- Timeline Content -->
				<div class="timeline">
					<ul class="timeline-list">


					</ul>
				</div>
				<!-- END Timeline Content -->


			</div>
		</div>
		<!-- END Timeline Widget -->

	</div>

</div>
@endsection
 
@section('ScriptContent') {{--     
	`Document`.`priority`,  
	`Serves`.`Serves`,
	`TOrder`.`OrderID`,
	`TOrder`.`phone`,
	`Document`.`DOName` --}} 
@section('ScriptContent')
<script type="text/javascript">
	$(function () {
		
		$("#diviframe").hide();
        $.get("{{url('/')}}/api/DocumentServesTimeLine/{{$DID}}",function(data){

                        if (data.Records)
                        {
							var OrderUrl="#",phone,orderType ,DOName;
                            $.each( data.Records, function( key, value ) {
								OrderUrl="{{url("/")}}/DocumentSearch/"+value.OrderID;
								phone=value.phone;
								orderType=(value.priority)?"مستعجل":"عادي";
								DOName=value.DOName;

								var diffDays=0;
							    if(value.EDate){
									var date1 = new Date(value.SDate);
									var date2 = new Date(value.EDate);
									var timeDiff = Math.abs(date2.getTime() - date1.getTime());
									 diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
									if(value.Successfully){
										timelineicon=" themed-background-spring themed-border-spring ";
									}
									else{
										timelineicon=" themed-background-fire themed-border-fire ";
									}
								}else{
									
									value.EDate="  لم تخرج بعد  ";
									if(value.SDate){
										timelineicon=" themed-background-autumn themed-border-autumn ";
									}
									else{
										timelineicon=" ";
										value.SDate="لم تدخل بعد  ";
									}
									
								}
								
                                $(".timeline-list").append(
									` <li class="active">
											<div class="timeline-icon `+timelineicon+`">
												<i class="fa fa-file-text"></i>
											</div>
											<div class="timeline-time"><small>`+diffDays+` Days ago</small></div>
											<div class="timeline-content">
												<p class="push-bit"><a href="DocumentSearch?OrderID=`+ value.OrderID + `"><strong>`+ value.Serves + `</strong></a></p>
												<strong>Start Date : </strong>`+value.SDate+`<strong>End Date:</strong> `+value.EDate+`
											</div>
										</li>`
                                    );
                                  
                                });
								$("#OrderLink").attr("href", OrderUrl);
								$("#lblorderType").html(orderType);
								$("#lblphone").html(phone);
								$("#lblDOName").html(DOName);
							
								
						}
					});
				
			

    });

</script>
@endsection