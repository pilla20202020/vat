<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($draftbill->billingadvice->joborder->invoice, 47) }}</td>
    <td>{{ Str::limit($draftbill->bill_to, 47) }}</td>
    <td>{{ Str::limit($draftbill->address, 47) }}</td>
    <td>{{ Str::limit($draftbill->draft_bill_date, 47) }}</td>
    <td>
        <a href="{{route('draftbill.print', $draftbill->id)}}" class="btn btn-flat btn-sm" title="print">
            <i class="fa fa-print"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('draftbill.destroy', $draftbill->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>

        {{-- @if($draftbill->is_accepted == "accepted")
            <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                Reject
            </button>
        @elseif($draftbill->is_accepted == "rejected")
            <button data-billing_id="{{$billingadvice->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
        @else 
            <button data-billing_id="{{$draftbill->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
            <button data-billing_id="{{$draftbill->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                Reject
            </button>
        @endif --}}
        

        
    </td>
</tr>

