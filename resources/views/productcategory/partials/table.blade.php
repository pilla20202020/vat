<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($productcategory->name, 47) }}</td>
    <td>
        <a href="{{route('product-category.edit', $productcategory->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('product-category.destroy', $productcategory->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

