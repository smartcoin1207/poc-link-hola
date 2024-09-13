<x-app-layout :assets="$assets ?? []">
   <div>
      <?php
         $id = $id ?? null;
      ?>
      {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      <div class="row mt-4">
         
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title mx-auto text-center">
                     <h4 class="card-title">{{ __('Account Register') }}</h4>
                  </div>
                  <div class="card-action">
                        <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">{{__('Back')}}</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label class="form-label" for="uname">{{__('User Name')}}: <span class="text-danger">*</span></label>
                              {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => __('Enter Username')]) }}
                           </div>

                           <div class="form-group col-md-12">
                              <label class="form-label" for="email">{{__('Email')}}: <span class="text-danger">*</span></label>
                              {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'email@example.com', 'required']) }}
                           </div>
                           
                           <!-- <div class="form-group col-md-12">
                              <label class="form-label" for="pass">{{__('Password')}}: <span class="text-danger">*</span></label>
                              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Password'), 'required' ]) }}
                           </div>
                           <div class="form-group col-md-12">
                              <label class="form-label" for="rpass">{{__('Repeat Password')}}: <span class="text-danger">*</span></label>
                              {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('Repeat Password'), 'required' ]) }}
                           </div> -->
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">{{__('Account Register')}}</button>
                  </div>
               </div>
            </div>
         </div>
        </div>
        {!! Form::close() !!}
   </div>
</x-app-layout>
