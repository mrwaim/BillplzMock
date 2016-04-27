@extends('app')

@section('page-header')
    @include('elements.page-header', ['section_title' => 'Billplz Mock', 'page_title' => 'View Bill'])
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">View Bill</h2>
                </header>
                <div class="panel-body">
                    <div class="row orders">
                        <div class="col-xs-6 col-md-6">Name</div>
                        <div class="col-xs-6 col-md-6">{{$name}}</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row orders">
                        <div class="col-xs-6 col-md-6">Amount</div>
                        <div class="col-xs-6 col-md-6">{{$amount}}</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row orders">
                        <div class="col-xs-6 col-md-6">Proof Of Transfer</div>
                        <div class="col-xs-6 col-md-6">{{$proof_of_transfer_id}}</div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row orders">
                        <div class="col-xs-6 col-md-6">Action</div>
                        <div class="col-xs-6 col-md-6">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('/billplz-mock/pay-amount') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="proof_of_transfer_id" value="{{ $proof_of_transfer_id }}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="site_id" value="{{ $site_id }}">
                                <input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
                                <input type="hidden" name="collection_id" value="{{ $collection_id }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">

                                <button class="button">Pay Amount</button>
                            </form>
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('/billplz-mock/decline-amount') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="proof_of_transfer_id" value="{{ $proof_of_transfer_id }}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="site_id" value="{{ $site_id }}">
                                <input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
                                <input type="hidden" name="collection_id" value="{{ $collection_id }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">

                                <button class="button">Decline Amount</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection