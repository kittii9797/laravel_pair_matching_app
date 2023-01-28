@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="form-group text-center">
                       
                            <label
                                class="imagePreview mx-auto col-md-6 p-0 d-block @error('image') is-invalid-label @enderror"
                                for="profiel">
                                <img class="h-100 w-100 object-fit:cover;" src="" alt="profile_img" id="profiel_img">
                            </label>

                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif

                            <div class="input-group offset-md-4 col-md-6 mt-3 text-left">
                                <div class="custom-file">
                            {{-- :file--}}
                                    <input type="file" id="img_url" class="profiel_img" name="image"
                                        accept=".png,.jpg,.jpeg" />
                                        
                                    <label class="custom-file-label @error('image') is-invalid-label @enderror"
                                        for="img_url">profiel_img</label>
                                </div>
                        
                                <!-- <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary reset">Cancel</button>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="width:100%">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
        <script>
        $(document).on('change', ':file', function() {

            var files = this.files ? this.files : [];


            if (!files.length || !window.FileReader) return;

        //lavel
            $(this).next('.custom-file-label').text(files[0].name);


        //image
            if (/^image/.test(files[0].type)) {


        // FileReader
                var reader = new FileReader();
                reader.readAsDataURL(files[0]);

                reader.onloadend = function() {

                    $('#profiel_img').attr('src', this.result);
                }
            }
        });


        $('.reset').click(function() {
            $('.custom-file-label').html('File selection...');
            $('#profiel_img').attr('src', '');
            $(':file').val(null);
        })
        </script>
    @endpush
