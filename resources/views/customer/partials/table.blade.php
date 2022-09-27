<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($customer->name, 47) }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ Str::limit($customer->phone, 47) }}</td>
    <td>{{ Str::limit($customer->address, 47) }}</td>
    <td>
        <a href="{{route('customer.edit', $customer->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('customer.destroy', $customer->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

