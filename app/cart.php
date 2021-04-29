<?php
	namespace App;
	class Cart{
		public $products = null;
		public $totalPrice = 0;
		public $totalSoluong = 0;

		//Đó chính là constructor trong PHP. Hàm khởi tạo cũng là một hàm bình thường nhưng có điểm đặc biệt là nó luôn luôn được gọi tới khi ta khởi tạo một đối tượng. Nghĩa là bạn có class A và có hàm khởi tạo __construct, thì tất cả các biến trong hàm khởi tạo sẽ được tạo ra khi bạn gọi đến nó. Bạn hãy dùng thử nó để biết tại sao lại dùng hàm này. Trên viblo có rất nhiều tài liệu về hàm tạo, hàm hủy. Mình có 1 số link cho bạn tham khảo.
		
		public function __construct($cart){
			if($cart){
				$this->products = $cart->products;
				$this->totalPrice = $cart->totalPrice;
				$this->totalSoluong = $cart->totalSoluong;
			}
		} 
		//them
		public function addCart($product, $id){
			$newProduct = ['soluong' => 0, 'gia' => $product->Gia ,'thongtin' => $product];
			if($this->products){
				if(array_key_exists($id, $this->products)){
					$newProduct = $this->products[$id];
				}
			}
			$newProduct['soluong']++;
			$newProduct['gia'] = $newProduct['soluong'] * $product->Gia;
			$this->products[$id] = $newProduct;
			$this->totalPrice += $product->Gia;
			$this->totalSoluong ++;

		}
			//tru
		public function minusCart($product, $id){
			$newProduct = ['soluong' => 0, 'gia' => $product->Gia ,'thongtin' => $product];
			if($this->products){
				if(array_key_exists($id, $this->products)){
					$newProduct = $this->products[$id];
				}
			}
			$newProduct['soluong']--;
			$newProduct['gia'] = $newProduct['soluong'] * $product->Gia;
			$this->products[$id] = $newProduct;
			$this->totalPrice -= $product->Gia;
			$this->totalSoluong --;

		}

		public function deleteItemCart($id){
			$this->totalSoluong -= $this->products[$id]['soluong']; //cap nhap so luong
			$this->totalPrice -=$this->products[$id]['gia'];	// cap nhat gia
			unset($this->products[$id]); //ham xoa
		}
	}
?>