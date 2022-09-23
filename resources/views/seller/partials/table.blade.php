<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($seller->name, 47) }}</td>
    <td>{{ $seller->email }}</td>
    <td>{{ Str::limit($seller->phone, 47) }}</td>
    <td>{{ Str::limit($seller->address, 47) }}</td>
    <td>
        <a href="{{route('seller.edit', $seller->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('seller.destroy', $seller->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

