<?php

namespace Klsandbox\BillplzMock\Http\Controllers;

use Input;
use Log;

class BillplzMockController extends \App\Http\Controllers\Controller
{
    public function collections()
    {
        Log::info('input', Input::all());
        $title = Input::get('title');
        return
            <<<JSON
        {
          "id": "inbmmepb",
          "title": "$title",
          "logo":
            {
                "thumb_url": "https://sample.net/assets/uploadPhoto.png",
              "avatar_url": "https://sample.net/assets/uploadPhoto.png"
            }
          }
JSON;
    }

    public function bills()
    {
        Log::info('input', Input::all());

        $collectionId = Input::get('collection_id');
        $email = Input::get('email');
        $name = Input::get('name');
        $mobile = Input::get('mobile');
        $amount = Input::get('amount');
        $metadata = json_encode(Input::get('metadata'));
        $order_id = Input::get('metadata')['order_id'];
        $user_id = Input::get('metadata')['user_id'];
        $site_id = Input::get('metadata')['site_id'];
        $redirect_url = Input::get('redirect_url');

        $url = url("/billplz-mock/view-bill/$collectionId/$email/$name/$mobile/$amount/$order_id/$user_id/$site_id/" . base64_encode($redirect_url));

//        $title = Input::get('title');
        return
            <<<JSON
{
          "id": "8X0Iyzaw",
          "collection_id": "$collectionId",
          "paid": false,
          "state": "pending",
          "amount": $amount ,
          "paid_amount": 0,
          "due_at": "2015-3-9",
          "email" :"$email",
          "mobile": $mobile,
          "name": "$name",
          "metadata": $metadata,
          "url": "$url"
        }
JSON;
    }

    public function viewBill($collectionId, $email, $name, $phone, $amount, $order_id, $user_id, $site_id, $redirect_url)
    {
        return view('billplz-mock::view-bill')
            ->with('collection_id', $collectionId)
            ->with('email', $email)
            ->with('name', $name)
            ->with('phone', $phone)
            ->with('amount', $amount)
            ->with('order_id', $order_id)
            ->with('user_id', $user_id)
            ->with('site_id', $site_id)
            ->with('redirect_url', base64_decode($redirect_url));
    }

    public function payAmount()
    {
        $order_id = Input::get('order_id');
        $user_id = Input::get('user_id');
        $site_id = Input::get('site_id');
        $redirect_url = Input::get('redirect_url');
        $collection_id = Input::get('collection_id');
        $amount = Input::get('amount');

        $data['id'] = 'W_79pJDk';
        $data['collection_id'] = $collection_id;
        $data['paid'] = true;
        $data['state'] = 'paid';
        $data['amount'] = $amount;
        $data['paid_amount'] = $amount;
        $data['metadata[order_id]'] = $order_id;
        $data['metadata[user_id]'] = $user_id;
        $data['metadata[site_id]'] = $site_id;
        $data['due_at'] = (new \Carbon\Carbon())->toDateTimeString();
        $data['paid_at'] = (new \Carbon\Carbon())->toDateTimeString();
        $curl = curl_init();

        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8000/billplz/webhook');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, config('billplz.auth'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        Log::info(curl_getinfo($curl));
        Log::info(curl_getinfo($curl, CURLINFO_HEADER_OUT));

        $result = curl_exec($curl);
        Log::info($result);

        curl_close($curl);

        return \Redirect::to($redirect_url);
    }


    public function declineAmount()
    {
        $order_id = Input::get('order_id');
        $user_id = Input::get('user_id');
        $site_id = Input::get('site_id');
        $redirect_url = Input::get('redirect_url');
        $collection_id = Input::get('collection_id');
        $amount = Input::get('amount');

        $data['id'] = 'W_79pJDk';
        $data['collection_id'] = $collection_id;
        $data['paid'] = false;
        $data['state'] = 'paid';
        $data['amount'] = $amount;
        $data['paid_amount'] = 0;
        $data['metadata[order_id]'] = $order_id;
        $data['metadata[user_id]'] = $user_id;
        $data['metadata[site_id]'] = $site_id;
        $data['due_at'] = (new \Carbon\Carbon())->toDateTimeString();
        $data['paid_at'] = (new \Carbon\Carbon())->toDateTimeString();
        $curl = curl_init();

        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8000/billplz/webhook');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, config('billplz.auth'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        Log::info(curl_getinfo($curl));
        Log::info(curl_getinfo($curl, CURLINFO_HEADER_OUT));

        $result = curl_exec($curl);
        Log::info($result);

        curl_close($curl);

        return \Redirect::to($redirect_url);
    }
}