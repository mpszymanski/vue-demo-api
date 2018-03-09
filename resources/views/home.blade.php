@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Receipts list</strong>
                    <div class="pull-right">
                        <strong class="d-inline p-2 is-danger text-success">Codes sended: {{ $confirmed_number }}</strong>
                        <strong class="d-inline p-2 is-danger text-danger">Receipts to check: {{ $unconfirmed_number }}</strong>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Shop zip</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>
                        </tr>
                        @foreach($receipts as $receipt)
                            <tr>
                                <td>
                                    {{ $receipt->id }}
                                </td>
                                <td>
                                    {{ $receipt->customer->fullname }}
                                </td>
                                <td>
                                    {!! $receipt->customer->email_link !!}<br>
                                    {!! $receipt->customer->phone_link !!}
                                </td>
                                <td>
                                    {{ $receipt->shop_zip }}
                                </td>
                                <td>
                                    <span 
                                        data-toggle="tooltip"
                                        data-html="true"
                                        data-placement="right"
                                        title="<img src='{{ asset($receipt->image) }}' alt='{{ $receipt->code }}' style='width:300px;'>"
                                    >
                                        {{ $receipt->code }}
                                    </span>
                                </td>
                                <td>
                                    {!! $receipt->status_label !!}
                                </td>
                                <td>
                                    {{ $receipt->updated_at }}
                                </td>
                                <td>
                                    {{ $receipt->created_at }}
                                </td>
                                <td>
                                    <form action="{{ route('receipt.status', $receipt) }}">
                                        <button class="btn btn-link" name="status" value="{{ !$receipt->status }}">
                                            <i class="material-icons">{{ $receipt->status ? 'clear' : 'check' }}</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $receipts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
