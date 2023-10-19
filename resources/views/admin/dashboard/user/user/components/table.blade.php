<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="checkAll">
            </th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listUser as $user)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $user->id }}" data-field = 'is_active'
                        data-value = '{{ $user->is_active }}' class="checkboxItem"> 
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->phone }}
                </td>
                <td>
                    {{ $user->address }}
                </td>
                <td class="text-center  js-switch-{{$user->id}}">
                    <input type="checkbox" class="js-switch_2 status " data-status = '{{ $user->id }}'
                        {{ $user->is_active == 1 ? 'checked' : '' }} />
                </td>
                <td class="text-center d-flex">
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success"><i
                            class="fa fa-edit"></i></a>
                    <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="post">
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
