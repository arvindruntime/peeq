{{-- {{ dd($sessions) }} --}}
<table class="table table-sm table-striped">
    <thead>
        <tr>
        <th scope="col">Session name</th>
        <th scope="col">Session date</th>
        <th scope="col">Session duration</th>
        <th scope="col">Session Price</th>
        <th scope="col">Payment status</th>
        </tr>
    </thead>
    <tbody>
        @if(Auth::user()->id!=1)
        @if(!empty($sessions) && isset($sessions))
            @foreach ($sessions as $key => $purchased)
                @php
                    $payment_status = '';
                    if(@$purchased['payment_status']=='Success')
                    {
                        $payment_status = 'done_color';
                    }
                    if(@$purchased['payment_status']=='Failure')
                    {
                        $payment_status = 'failed_color';
                    }
                @endphp
            <tr>
                <td>{{ $purchased['session_name'] ?? ''; }}</td>
                <td>{{ $purchased['session_date']  ?? ''; }}</td>
                <td>{{ $purchased['session_duration'] ?? '';  }}</td>
                <td>${{ $purchased['session_price']  ?? '';  }}</td>
                <td><span class="{{ $payment_status }}">{{ $purchased['payment_status'] ?? '';  }}</span></td>
            </tr>
            @endforeach
        @endif
        @else
        <tr>
            <td colspan="5">Transactions for user only</td>
        </tr>
        @endif
    </tbody>
</table>