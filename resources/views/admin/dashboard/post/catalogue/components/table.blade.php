<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAll">
            </th>
            <th class="text-center">Tên nhóm</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center" style="width: 10%">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listPostCatalogue as $PostCatalogue)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $PostCatalogue->id }}" data-field = 'is_active'
                        data-value = '{{ $PostCatalogue->is_active }}' class="checkboxItem">
                </td>
                <td class="">
                    {{ str_repeat('|----', $PostCatalogue->level > 0 ? $PostCatalogue->level - 1 : 0) . $PostCatalogue->postCatalogueLanguage[0]->name }}
                </td>
                <td class="text-center  js-switch-{{ $PostCatalogue->id }}">
                    <input type="checkbox" class="js-switch_2 status " data-status = '{{ $PostCatalogue->id }}'
                        {{ $PostCatalogue->is_active == 1 ? 'checked' : '' }} />
                </td>
                <td class="text-center d-flex">
                    <a href="{{ route('post-catalogue.edit', ['id' => $PostCatalogue->id]) }}" class="btn btn-success"
                        style="margin-right:10%">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('post-catalogue.delete', ['id' => $PostCatalogue->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
