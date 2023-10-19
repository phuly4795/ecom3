<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Tên nhóm thành viên</th>
            <th class="text-center">Số thành viên</th>
            <th class="text-center">Mô tả</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listUser as $user)
            <tr>
                <td class="text-center">
                    {{ $user->name }}
                </td>
                <td class="text-center">
                    {{ $user->user_count }}
                </td>        
                <td class="text-center">
                    {{ $user->description }}
                </td>
                <td class="text-center  js-switch-{{ $user->id }}">
                    <input type="checkbox" class="js-switch_2 status " data-status = '{{ $user->id }}'
                        {{ $user->is_active == 1 ? 'checked' : '' }} />
                </td>
                <td class="text-center d-flex">
                    <a href="{{ route('user.catalogue.edit', ['id' => $user->id]) }}" class="btn btn-success"><i
                            class="fa fa-edit"></i></a>
                    <form action="{{ route('user.catalogue.delete', ['id' => $user->id]) }}" method="post">
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
