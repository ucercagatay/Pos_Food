
<table style="width:100%;">
	<thead>
		<tr>
			<td>

			<p class="text-right color-555">
				@lang('lang_v1.packing_slip')
			</p>

			</td>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>

<!-- business information here -->
<div class="row invoice-info">

	<div class="col-md-6 invoice-col width-50 color-555">
		
		<!-- Logo -->
		@if(!empty($receipts[0]->logo))
			<img style="max-height: 120px; width: auto;" src="{{$receipts[0]->logo}}" class="img">
			<br/>
		@endif

		<!-- Shop & Location Name  -->
		@if(!empty($receipts[0]->display_name))
			<p>
				{{$receipts[0]->display_name}}
				@if(!empty($receipts[0]->address))
					<br/>{!! $receipts[0]->address !!}
				@endif

				@if(!empty($receipts[0]->contact))
					<br/>{!! $receipts[0]->contact !!}
				@endif

				@if(!empty($receipts[0]->website))
					<br/>{{ $receipts[0]->website }}
				@endif

				@if(!empty($receipts[0]->tax_info1))
					<br/>{{ $receipts[0]->tax_label1 }} {{ $receipts[0]->tax_info1 }}
				@endif

				@if(!empty($receipts[0]->tax_info2))
					<br/>{{ $receipts[0]->tax_label2 }} {{ $receipts[0]->tax_info2 }}
				@endif

				@if(!empty($receipts[0]->location_custom_fields))
					<br/>{{ $receipts[0]->location_custom_fields }}
				@endif
			</p>
		@endif
	</div>

	<div class="col-md-6 invoice-col width-50">

		<p class="text-right font-30">
			@if(!empty($receipts[0]->invoice_no_prefix))
				<span class="pull-left">{!! $receipts[0]->invoice_no_prefix !!}</span>
			@endif
			@foreach($receipts as $receipt_details)

				{{$receipt_details->invoice_no}},
			@endforeach
		</p>
		<!-- Date-->
		@if(!empty($receipts[0]->date_label))
			<p class="text-right font-23 color-555">
				<span class="pull-left">
					{{$receipts[0]->date_label}}
				</span>

				{{collect($receipts)->sortBy('invoice_date')->reverse()->toArray()[0]->invoice_date}}-{{collect($receipts)->sortBy('invoice_date')->reverse()->toArray()[count($receipts)-1]->invoice_date}}
			</p>
		@endif
	</div>
</div>

<div class="row invoice-info color-555">
	<br/>
	<div class="col-md-6 invoice-col width-50 word-wrap">
		@if(!empty($receipts[0]->customer_label))
			<b>{{ $receipts[0]->customer_label }}</b><br/>
		@endif

		<!-- customer info -->
		@if(!empty($receipts[0]->customer_name))
			{{ $receipts[0]->customer_name }}<br>
		@endif
		@if(!empty($receipts[0]->customer_info))
			{!! $receipts[0]->customer_info !!}
		@endif
		@if(!empty($receipts[0]->client_id_label))
			<br/>
			<strong>{{ $receipts[0]->client_id_label }}</strong> {{ $receipts[0]->client_id }}
		@endif
		@if(!empty($receipts[0]->customer_tax_label))
			<br/>
			<strong>{{ $receipts[0]->customer_tax_label }}</strong> {{ $receipts[0]->customer_tax_number }}
		@endif
		@if(!empty($receipts[0]->customer_custom_fields))
			<br/>{!! $receipts[0]->customer_custom_fields !!}
		@endif
		@if(!empty($receipts[0]->sales_person_label))
			<br/>
			<strong>{{ $receipts[0]->sales_person_label }}</strong> {{ $receipts[0]->sales_person }}
		@endif
	</div>
	<div class="col-md-6 invoice-col width-50 word-wrap">
		<strong>@lang('lang_v1.shipping_address'):</strong><br>
		{!! $receipts[0]->shipping_address !!}
		@if(!empty($receipts[0]->shipping_custom_field_1_label))
			<br><strong>{!!$receipts[0]->shipping_custom_field_1_label!!} :</strong> {!!$receipts[0]->shipping_custom_field_1_value ?? ''!!}
		@endif

		@if(!empty($receipts[0]->shipping_custom_field_2_label))
			<br><strong>{!!$receipts[0]->shipping_custom_field_2_label!!}:</strong> {!!$receipts[0]->shipping_custom_field_2_value ?? ''!!}
		@endif

		@if(!empty($receipts[0]->shipping_custom_field_3_label))
			<br><strong>{!!$receipts[0]->shipping_custom_field_3_label!!}:</strong> {!!$receipts[0]->shipping_custom_field_3_value ?? ''!!}
		@endif

		@if(!empty($receipts[0]->shipping_custom_field_4_label))
			<br><strong>{!!$receipts[0]->shipping_custom_field_4_label!!}:</strong> {!!$receipts[0]->shipping_custom_field_4_value ?? ''!!}
		@endif

		@if(!empty($receipts[0]->shipping_custom_field_5_label))
			<br><strong>{!!$receipts[0]->shipping_custom_field_2_label!!}:</strong> {!!$receipts[0]->shipping_custom_field_5_value ?? ''!!}
		@endif
	</div>
</div>

<div class="row color-555">
	<div class="col-xs-12">
		<br/>
		<table class="table table-bordered table-no-top-cell-border">
			<thead>
				<tr style="background-color: #357ca5 !important; color: white !important; font-size: 20px !important" class="table-no-side-cell-border table-no-top-cell-border text-center">
					<td style="background-color: #357ca5 !important; color: white !important; width: 5% !important">#</td>
					
					<td style="background-color: #357ca5 !important; color: white !important; width: 65% !important">
						{{$receipts[0]->table_product_label}}
					</td>
					
					<td style="background-color: #357ca5 !important; color: white !important; width: 30% !important;">
						{{$receipts[0]->table_qty_label}}
					</td>
				</tr>
			</thead>
			<tbody>
			@foreach($receipts as $receipt_details)
				@foreach($receipt_details->lines as $line)
					<tr>
						<td class="text-center">
							{{$loop->iteration}}
						</td>
						<td style="word-break: break-all;">
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['sell_line_note']))({!!$line['sell_line_note']!!}) @endif
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif 
                        </td>
						<td class="text-right">
							{{$line['quantity']}} {{$line['units']}}
						</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td class="text-center">
									&nbsp;
								</td>
								<td>
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
		                            @if(!empty($modifier['sell_line_note']))({!!$modifier['sell_line_note']!!}) @endif 
		                        </td>
								<td class="text-right">
									{{$modifier['quantity']}} {{$modifier['units']}}
								</td>
							</tr>
						@endforeach
					@endif
				@endforeach
			@endforeach

				@php
				$lines = count($receipts[0]->lines);
				@endphp

				@for ($i = $lines; $i < 7; $i++)
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    				</tr>
				@endfor

			</tbody>
		</table>
	</div>
</div>

<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<b class="pull-left">@lang('lang_v1.authorized_signatory')</b>
	</div>
</div>

{{-- Barcode --}}
@if($receipts[0]->show_barcode)
<br>
<div class="row">
		<div class="col-xs-12">
			<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
		</div>
</div>
@endif

@if(!empty($receipts[0]->footer_text))
	<div class="row color-555">
		<div class="col-xs-12">
			{!! $receipts[0]->footer_text !!}
		</div>
	</div>
@endif

			</td>
		</tr>
	</tbody>
</table>
<style type="text/css">
	body {
		color: #000000;
	}
</style>