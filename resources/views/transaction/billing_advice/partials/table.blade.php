<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($billingadvice->joborder->invoices, 47) }}</td>
    <td>{{ Str::limit($billingadvice->billing_advice_date, 47) }}</td>
    <td>
        <a href="{{route('billingadvice.edit', $billingadvice->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('billingadvice.destroy', $billingadvice->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

