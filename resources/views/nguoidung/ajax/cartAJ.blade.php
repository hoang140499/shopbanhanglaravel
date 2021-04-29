@if(Session::has("cart") != null)
	@foreach(Session::get('cart')->products as $item)
			<tr>
				<td rowspan="2"><img src="{{ asset('public/upload/AnhSanPham/')}}/{{ $item['thongtin']->Hinh }}" alt=""></td>
				<td>{{  $item['thongtin']->TenHH }}</td>
				<td rowspan="2" class="delete-item">
					<a href="javascript:" onclick="del({{  $item['thongtin']->id }})" data-id="{{  $item['thongtin']->id }}">
						{{-- <i class="far fa-trash-alt" data-id="{{  $item['thongtin']->MSHH }}" ></i> --}}
						Xóa
					</a>
					{{-- <input type="button" data-id="{{  $item['thongtin']->MSHH }}" value="Xóa" class="far"> --}}
				</td>
			</tr>
			<tr>
				<td style="color: red; ">{{  number_format($item['thongtin']->Gia) }} x {{ $item['soluong'] }}</td>
			</tr>
			{{-- Sản phẩm 2 --}}
	@endforeach
	{{-- <tr><td><p style="border: 2px solid black">Tổng tiền: {{ number_format(Session::get('cart')->totalPrice) }}</p></td></tr> --}}
	<tr><td><input hidden="" id="total-quanty-cart" type="text" value="{{ Session::get('cart')->totalSoluong }}"></td></tr>
@endif