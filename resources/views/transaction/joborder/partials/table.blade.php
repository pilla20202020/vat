<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($joborder->customer->name, 47) }}</td>
    <td>{{ $joborder->invoice }}</td>
    <td>{{ Str::limit($joborder->order_date, 47) }}</td>

    <td>
        
        @if(isset($joborder->billingadvice))

        @else
        <a href="{{route('joborder.edit', $joborder->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a> 
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('joborder.destroy', $joborder->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
        @endif
    </td>
</tr>

