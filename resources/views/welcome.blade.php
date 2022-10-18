@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Live Status') }}</div>

                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <th>Live Visitor</th>
                            <th>Live User</th>
                        </tr>
                        <tr>
                            <th id="visitor_live"></th>
                            <th id="user_live"></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
