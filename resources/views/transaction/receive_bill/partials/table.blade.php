<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($receivebill->vendor->name, 47) }}</td>
    <td>{{ $receivebill->invoice }}</td>
    <td>{{ Str::limit($receivebill->date, 47) }}</td>
    <td>
        {{-- <a href="{{route('billingadvice.edit', $billingadvice->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a> --}}

        <a href="{{route('receivebill.print', $receivebill->id)}}" class="btn btn-flat btn-sm" title="print">
            <i class="fa fa-print"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('receivebill.destroy', $receivebill->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
        
    </td>
</tr>

