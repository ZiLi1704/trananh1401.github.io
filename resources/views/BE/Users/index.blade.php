@extends('Layout.BE')
@section('title', 'Người Dùng')
@section('content')
<div class="col-md-12 col-lg-12">
    <div class="card">
        <div class="card-header">Người Dùng</div>
        <div class="card-body">
            @if ($success = Session::get('success'))
            <div class="alert alert-success">
                <h5 class="alert-title"><i class="fas fa-check"></i>{{$success}}</h5>
            </div>
            @endif
            <a href="{{ route('user.create') }}" class="btn btn-success">
                <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('user.trast') }}" class="btn btn-success">
                <i class="fas fa-recycle"></i>
            </a>
            <table class="table table-hover" id="dataTables-example" width="100%">
                <thead>
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th>Tên đầy đủ</th>
                        <th>Ảnh đại diện</th>
                        <th>E-mail</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th style="width: 5%; text-align: right">Công Cụ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->admin != 1)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($user->avatar_image) }}" alt=""
                                        style="max-width: 100px; max-height: 100px;">
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
                            <td>
                                <ul style="display: flex; list-style-type: none;">
                                    <li style="margin-right: 10px">
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <div>
                                            <form action="{{ route('user.softdel', $user->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
