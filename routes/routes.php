<?php
Route::group(['prefix' => 'billplz-mock'], function () {
    Route::any('collections', 'BillplzMockController@collections');
    Route::any('bills', 'BillplzMockController@bills');
    Route::any('view-bill/{collectionId}/{email}/{name}/{phone}/{amount}/{order_id}', 'BillplzMockController@viewBill');
    Route::post('pay-amount', 'BillplzMockController@payAmount');
    Route::post('decline-amount', 'BillplzMockController@declineAmount');
});
