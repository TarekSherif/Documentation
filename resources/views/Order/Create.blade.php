
@extends('layouts.index') 
@section('CoreContent')



<form action="{{ route('Order.store') }}"  method="post" >
@csrf
	<fieldset>
		<div class="container">
			<div class="row">

				<div class="col-xs-2">
					<div class="form-group ">
						<label>@lang("messages.phone")  </label>
						<input   id="phone" name="phone" placeholder="@lang('messages.phone')" type="text" required    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="{{old('phone')}}"  />
						@if ($errors->has('phone'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>
				</div>
				<div class="Delivery">
				<div class="col-xs-4">
						<div class="form-group ">
							<label>@lang("messages.address") </label>
							<input   id="address" name="address" placeholder="@lang('messages.address')" type="text"  class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"  value="{{old('address')}}"/>
							@if ($errors->has('address'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
				</div>
				<div class="col-xs-2">
						<div class="form-group ">
							<label>@lang("messages.Otherphone")  </label>
							<input   id="Otherphone" name="Otherphone" placeholder="@lang('messages.Otherphone')" type="text"  class="form-control{{ $errors->has('Otherphone') ? ' is-invalid' : '' }}"  value="{{old('Otherphone')}}" />
							@if ($errors->has('address'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
							@endif
						</div>
				</div>
				<div class="col-xs-2">
						<div class="form-group ">
							<label>@lang("messages.Dprice")  </label>
							<input   id="price" name="price" placeholder="@lang('messages.price')" type="number"  class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"  value="{{old('price')}}" />
							@if ($errors->has('price'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('price') }}</strong>
							</span>
							@endif
						</div>
				</div>

			</div>
				<div class="col-xs-1">
					<br>
					
					<button class="btn btn-primary" type="submit">
						<i class="fa fa-floppy-o"></i>
					</button>
					

				</div>
			</div>
		</div>

		
		
				
			

				


	</fieldset>
</form>


 
@endsection
 