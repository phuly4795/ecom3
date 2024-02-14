<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center" style="width: 100px">Image</th>
            <th class="text-center">Canonical</th>
            <th class="text-center">Status</th>
            <th class="text-center" style="width: 10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listPostCatalogue as $PostCatalogue)
            <tr>
                <td class="text-center">
                    {{ $PostCatalogue->name }}
                </td>
                <td class="text-center">
                    <span class="image img-cover">
                        <img src="{{ asset($PostCatalogue->image) }}" alt="image">
                    </span>
                </td>
                <td class="text-center">
                    {{ $PostCatalogue->canonical }}
                </td>
                <td class="text-center  js-switch-{{ $PostCatalogue->id }}">
                    <input type="checkbox" class="js-switch_2 status " data-status = '{{ $PostCatalogue->id }}'
                        {{ $PostCatalogue->is_active == 1 ? 'checked' : '' }} />
                </td>
                <td class="text-center d-flex">
                    <a href="{{ route('PostCatalogue.edit', ['id' => $PostCatalogue->id]) }}" class="btn btn-success"
                        style="margin-right:10%">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('PostCatalogue.delete', ['id' => $PostCatalogue->id]) }}" method="post">
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
