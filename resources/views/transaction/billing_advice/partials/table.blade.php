<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($billingadvice->joborder->invoice, 47) }}</td>
    <td>{{ Str::limit($billingadvice->billing_advice_date, 47) }}</td>
    <td>
        {{-- <a href="{{route('billingadvice.edit', $billingadvice->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a> --}}

        <a href="{{route('billingadvice.print', $billingadvice->id)}}" class="btn btn-flat btn-sm" title="print">
            <i class="fa fa-print"></i>
        </a>
        @if($billingadvice->draftbill == null)
            <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('billingadvice.destroy', $billingadvice->id) }}">
                <i class="far fa-trash-alt"></i>
            </button>
        @endif

        @if(($billingadvice->is_accepted == "accepted"))
            @if($billingadvice->draftbill == null)
                <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                    Reject
                </button>
            @endif
        @elseif($billingadvice->is_accepted == "rejected")
            <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
        @else 
            <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
            <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                Reject
            </button>
        @endif
        

        
    </td>
</tr>

