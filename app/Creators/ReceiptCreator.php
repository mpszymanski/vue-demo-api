<?php 

namespace App\Creators;

use App\Customer;
use App\DiscountCode;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
* 
*/
class ReceiptCreator
{
	private $customer_data, $receipt_data, $file;

	function __construct(Request $request)
	{
		$this->customer_data = $request->only(['first_name', 'last_name', 'email', 'phone']);
		$this->receipt_data = $request->only(['shop_zip', 'code']);
		$this->file = $request->file('image');
	}

	public function store()
	{
		$this->fileUpload();

		DB::beginTransaction();

		$customer = $this->storeCustomer();
		$receipt = $this->storeReceipt($customer);
		$discount = $this->storeDiscountCode($receipt);

		DB::commit();

		return $receipt;
	}

	private function storeCustomer()
	{
		return Customer::updateOrCreate(
			['email' => $this->customer_data['email']],
			$this->customer_data
		);
	}

	private function storeReceipt(Customer $customer)
	{
		$receipt = $customer->receipts()->create($this->receipt_data);

		return $receipt;
	}

	private function storeDiscountCode(Receipt $receipt)
	{
		$code = '';
		do {
			$code = rand(100000000,999999999);
			$code_exists = DiscountCode::whereCode($code)->isAvailable()->exists();
		} while($code_exists);

		$discount = $receipt->discount()->create(compact('code'));

		return $discount;
	}

	private function fileUpload()
	{
		$file_name = str_random(64) . '.' . $this->file->extension();
		$this->file->storeAs('public/images', $file_name);
		$this->receipt_data['image'] = 'storage/images/' . $file_name;
	}
}