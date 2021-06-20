@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container">
            <a class="btn btn-info" href="/book/create">ثبت کتاب</a>
            <a class="btn btn-info" href="/book/history">تاریخچه تغییرات</a>
            @can('admin')
                <a class="btn btn-warning" href="/book/validation">تایید نشده</a>
            @endcan
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
                    <th scope="col">امتیاز</th>
                    <th scope="col">ثبت امتیاز</th>
                    <th scope="col"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($books as $book)

                    @can('view', $book)
                        <tr style="text-align: right;">
                            <td>{{$book->author}}</td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{ Verta::instance($book->year)->format('Y')}}</td>
                            <td>{{$book->price}}</td>
                            <td>
                                @if($book->stock->number != null)
                                    {{$book->stock->number}}
                                @else {{0}}
                                @endif
                            </td>
                            <td>

                                <input type="range" class="form-range" min="0" max="5" step="1"
                                       value="{{round($book->ratings->avg('rate'), 1)}}" disabled>
                                <div class="row" style="transform: translateX(-38%);">
                                {{ round($book->ratings->avg('rate'), 1) }}</div></td>
                            <td>
                                <form method="POST" action="{{url("book/rating/" . $book->id)}}">
                                    @csrf
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rate" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rate" value="2">
                                        <label class="form-check-label" for="inlineRadio1">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rate" value="3">
                                        <label class="form-check-label" for="inlineRadio1">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rate" value="4" >
                                        <label class="form-check-label" for="inlineRadio1">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rate" value="5">
                                        <label class="form-check-label" for="inlineRadio1">5</label>
                                    </div>

                                    <button type="submit" class="btn btn-success" style="transform: translateX(0%);"> ثبت</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-info" href="/book/edit/{{$book->id}}">ویرایش</a>

                                @can('delete-button' , $book)
                                    <a class="btn btn-danger" href="/book/delete/{{$book->id}}">حذف</a>
                                @endcan
                            </td>
                        </tr>
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
