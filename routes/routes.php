<?php
Route::group(['prefix' => 'billplz-mock'], function () {
    Route::any('collections', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@collections');
    Route::any('bills/{bill_id}', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@getBill');
    Route::any('bills', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@bills');
    Route::any('view-bill/{collectionId}/{email}/{name}/{phone}/{amount}/{proof_of_transfer_id}/{user_id}/{site_id}/{redirect_url}', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@viewBill');
    Route::post('pay-amount', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@payAmount');
    Route::post('decline-amount', '\Klsandbox\BillplzMock\Http\Controllers\BillplzMockController@declineAmount');
});
