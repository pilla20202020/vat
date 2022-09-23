<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($vendor->name, 47) }}</td>
    <td>{{ $vendor->email }}</td>
    <td>{{ Str::limit($vendor->phone, 47) }}</td>
    <td>{{ Str::limit($vendor->address, 47) }}</td>
    <td>
        <a href="{{route('vendors.edit', $vendor->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('vendors.destroy', $vendor->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

