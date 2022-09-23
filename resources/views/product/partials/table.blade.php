<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($product->name, 47) }}</td>
    <td>
        <a href="{{route('product.edit', $product->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('product.destroy', $product->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

