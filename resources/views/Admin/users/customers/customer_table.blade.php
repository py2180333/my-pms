@foreach ($customers as $key => $customer)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>
        @if($customer->profile_picture)
            <img src="{{ asset('uploads/customers/' . $customer->profile_picture) }}" width="50">
        @else
            <img src="{{ asset('uploads/customers/default.png') }}" width="50">
        @endif
    </td>
    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->phone_number }}</td>
    <td>{{ ucfirst($customer->status) }}</td>
    <td class="text-center">
        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.customers.delete', $customer->id) }}" class="btn btn-danger">Delete</a>
    </td>
</tr>
@endforeach
