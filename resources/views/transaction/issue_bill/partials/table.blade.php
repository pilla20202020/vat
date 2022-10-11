<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($issuebill->draftbill->billingadvice->joborder->invoice, 47) }}</td>
    <td>{{ Str::limit($issuebill->bill_to, 47) }}</td>
    <td>{{ Str::limit($issuebill->address, 47) }}</td>
    <td>{{ Str::limit($issuebill->issue_bill_date, 47) }}</td>
    <td>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('issuebill.destroy', $issuebill->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>

        @if($issuebill->is_printed != 1)
            <a href="{{route('issuebill.print', $issuebill->id)}}" class="btn btn-flat btn-sm" title="print">
                <i class="fa fa-print"></i>
            </a>
        @else 
            <a href="{{route('issuebill.print', $issuebill->id)}}" class="btn btn-info btn-sm btn-reprint" title="print">
                Re-Print</i>
            </a>
        @endif
        

        {{-- @if($issuebill->is_accepted == "accepted")
            <button data-issuebill_id="{{$issuebill->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                Reject
            </button>
        @elseif($issuebill->is_accepted == "rejected")
            <button data-issuebill_id="{{$issuebill->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
        @else 
            <button data-issuebill_id="{{$issuebill->id}}"  class="btn btn-warning btn-sm btn-approve" title="Approve">
                Approve
            </button>
            <button data-issuebill_id="{{$issuebill->id}}"  class="btn btn-danger btn-sm btn-reject" title="Reject">
                Reject
            </button>
        @endif --}}
        

        
    </td>
</tr>

