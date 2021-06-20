@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container">
            <a class="btn btn-info" href="/home"> بازگشت </a>
        </div>
    </div>

    @if(session('successCreate'))
            <script>alert('اطلاعات با موفقیت ثبت شد')</script>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: right">{{ __('ثبت کتاب جدید') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/book/create">
                            @csrf
                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-right">{{ __('عنوان کتاب') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="author"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نویسنده') }}</label>

                                <div class="col-md-6">
                                    <input id="author" type="text"
                                           class="form-control @error('author') is-invalid @enderror" name="author"
                                           required autocomplete="author">

                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publisher"
                                       class="col-md-4 col-form-label text-md-right">{{ __('ناشر') }}</label>

                                <div class="col-md-6">
                                    <input id="" type="text"
                                           class="form-control @error('publisher') is-invalid @enderror"
                                           name="publisher" required autocomplete="publisher">

                                    @error('publisher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('سال نشر') }}</label>

                                <div class="col-md-6">
                                    <input id="year" type="date"
                                           class="form-control @error('year') is-invalid @enderror" name="year" required
                                           autocomplete="year">

                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price"
                                       class="col-md-4 col-form-label text-md-right">{{ __('قیمت (تومان)') }}</label>
                                <div class="col-md-6">
                                    <input id="price" type="number"
                                           class="form-control @error('price') is-invalid @enderror" name="price"
                                           required autocomplete="price">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('ثبت') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
