@foreach ($inviteMembers as $member)
    <tr>
        <th scope="row">{{ $member->first_name }}</th>
        <td>{{ $member->last_name }}</td>
        <td>{{ $member->email }}</td>
        <td>{{ $member->invite_by }}</td>
        <td>{{ $member->last_updated }}</td>
        <td>{{ $member->status }}</td>
    </tr>
@endforeach