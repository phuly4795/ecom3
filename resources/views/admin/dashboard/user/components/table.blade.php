<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox">
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
                    <input type="checkbox">
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
                <td class="text-center">
                    <input type="checkbox" class="js-switch_2" checked />
                </td>
                <td class="text-center">
                    <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
