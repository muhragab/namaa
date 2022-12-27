<div class='btn-group'>
    <a href="{{ route('blogs.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('blogs.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <button type="button" class="btn btn-danger btn-xs destroyField"
            onclick="destroyId('{{$id}}')">
        <i class="fa fa-trash"></i>
    </button>
</div>
