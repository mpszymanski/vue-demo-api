<?php

use App\Creators\ReceiptCreator;
use App\Events\ReceiptWasCreated;
use App\Http\Requests\ReceiptRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create', function (ReceiptRequest $request) {
	$creator = new ReceiptCreator($request);
	
	try {
		$receipt = $creator->store();

		event(new ReceiptWasCreated($receipt));

		return response('Receipt Created!', 201);
	} catch(\Exception $e) {
		return response('Whoops! Something went wrong! ' . $e->getMessage(), 500);
	}
});
