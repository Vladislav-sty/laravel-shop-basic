@extends('admin.admin')

@section('page-title','Список користувачів сайту')

@section('content')
    @include('layouts.admin-nav')
    <div style="padding-top: 40px">
        <div class="container">
            <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Користувачі сайту</h3>

            <table class="table">
                <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID аккаунту</th>
                    <th scope="col">Ім'я</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Дата реєстрації</th>
                    <th scope="col">Статус аккаунту</th>
                    <th scope="col">Керування</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td>{{ $user->id }}</td>
                            <td><b>{{ $user->name }}</b></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @if($user->is_blocked)
                                    <b style="color: #EB1D36">Аккаунт заблоковано</b>
                                @else
                                    <b>Активний</b>
                                @endif
                            </td>
                            <td class="d-flex justify-content-between">
                               @if($user->is_blocked)
                                    <form action="{{ route('block.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-success">
                                            Розблокувати
                                        </button>
                                    </form>
                               @else
                                    <a href="{{ route('block.create', ['id' => $user->id]) }}" class="btn btn-danger">
                                        Заблокувати
                                    </a>
                               @endif
                                    <a href="{{ route('block.show', $user->id) }}" class="btn btn-primary">
                                        Деталі
                                    </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
