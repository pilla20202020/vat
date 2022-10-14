<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($purchase->vendor->name, 47) }}</td>
    <td>{{ $purchase->invoice }}</td>
    <td>{{ Str::limit($purchase->order_date, 47) }}</td>

    <td>
        
        @if($purchase->is_receivedbill == null)
            <a href="{{route('purchase.edit', $purchase->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
                <i class="mdi mdi-pencil"></i>
            </a> 
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('purchase.destroy', $purchase->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        @else
            
        @endif
    </td>
</tr>

