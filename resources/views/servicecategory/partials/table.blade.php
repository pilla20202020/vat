<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($servicecategory->name, 47) }}</td>
    <td>
        <a href="{{route('service-category.edit', $servicecategory->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('service-category.destroy', $servicecategory->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

