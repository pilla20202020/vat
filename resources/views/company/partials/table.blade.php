<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($company->name, 47) }}</td>
    <td>{{ Str::limit($company->email, 47) }}</td>
    <td>{{ Str::limit($company->address, 47) }}</td>
    <td>{{ Str::limit($company->vat, 47) }}</td>
    <td>
        <a href="{{route('company.edit', $company->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('company.destroy', $company->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>

        <button data-company_id="{{$company->id}}"  class="btn btn-warning btn-sm addbranch" title="Add Branch">
            Add Branches
        </button>

        <button data-company_id="{{$company->id}}"  class="btn btn-success btn-sm viewbranch" title="View Branch">
            View Branches
        </button>
    </td>
</tr>

