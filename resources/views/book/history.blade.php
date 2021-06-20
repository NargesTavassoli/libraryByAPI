@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container">
            <a class="btn btn-info" href="/home">بازگشت</a>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">عملیات</th>
                    <th scope="col">توسط کاربر</th>
                    <th scope="col">نام کتاب</th>
                    <th scope="col">زمان</th>

                </tr>
                </thead>

                <tbody>
                @foreach($logs as $log)
                    <tr style="text-align: right;">
                        <td>
                            @switch($log->event)
                                @case('deleted')
                                {{'حذف'}}
                                @break
                                @case('updated')
                                {{'ویرایش'}}
                                @break
                                @case('created')
                                {{'ثبت'}}
                                @break
                            @endswitch
                        </td>
                        <td>{{ \App\Models\User::find($log->causer_id)->name }}</td>
                        <td>{{ \App\Models\Book::withTrashed()->find($log->subject_id)->title }}</td>
                        <td>{{ Verta::instance($log->created_at)->format('h:m y/m/d')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
