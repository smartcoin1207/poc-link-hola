<x-app-layout>
   <section class="login-content">
      <div class="row m-0 mt-4 d-flex align-items-center bg-white vh-100 ">
         <div class="col-md-12 p-0">
            <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
               <div class="card-body">
                  <h2 class="mb-2">{{ __('Change Password') }}</h2>
                  <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        <input type="hidden" name="first_login" value="{{$first_login ?? ''}}">

                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-0 d-flex justify-content-end">
                            <a href="{{route('auth.signup')}}" class="btn btn-light mx-2">{{__('Skip')}}</a>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Change Password') }}
                            </button>
                        </div>
                        
                    </form>
               </div>
            </div>               
         </div>
      </div>
   </section>
</x-app-layout>
