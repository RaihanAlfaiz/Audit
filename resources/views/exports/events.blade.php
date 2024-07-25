<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tenant Name</th>
            <th>Phone</th>
            <th>Event Date</th>
            <th>Package</th>
            <th>Vendor</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $ev)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ev->tenant_name }}</td>
            <td>{{ $ev->phone }}</td>
            <td>{{ date('d F Y', strtotime($ev->event_date)) }}</td>
            <td>{{ $ev->package->Name }}</td>
            <td>{{ $type_mapping[$ev->package->type] ?? $ev->package->type }}</td>
            <td>{{ $ev->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
