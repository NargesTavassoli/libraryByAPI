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
                    <th scope="col">نام کتاب</th>
                    <th scope="col">نویسنده</th>
                    <th scope="col">ناشر</th>
                    <th scope="col">سال نشر</th>
                    <th scope="col">قیمت (تومان)</th>
                    <th scope="col">موجودی</th>
                    <th scope="col"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($books as $book)
                    @can('validation', $book)
                        <form method="POST" action="{{url("book/stock/" . $book->id)}}">
                            @csrf
                            <tr style="text-align: right;">
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->publisher}}</td>
                                <td>{{ Verta::instance($book->year)->format('Y')}}</td>
                                <td>{{$book->price}}</td>
                                <td>
                                    <input id="stock" type="number" name="stock"
                                           class="form-control @error('stock') is-invalid @enderror" name="stock"
                                           required
                                           autocomplete="stock" style="width: auto">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-info">ثبت</button>
                                    <a class="btn btn-danger" href="/book/delete/{{$book->id}}">عدم تایید</a>
                                </td>
                            </tr>
                        </form>
                    @endcan
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div>
        {{ $books->links() }}
    </div>
@endsection
