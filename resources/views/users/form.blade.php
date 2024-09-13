<x-app-layout :assets="$assets ?? []">
   <div class="mt-4">
      <?php
      $id = $id ?? null;
      ?>
      @if(isset($id))
      {!! Form::model($data, ['route' => ['users.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data']) !!}
      @else
      {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      @endif
      <div class="row">
         <div class="col-xl-9 col-lg-8 m-md-auto">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{__('Update User information')}}</h4>
                  </div>
                  <div class="card-action">
                     <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <div class="mt-2 form-group">
                        <x-input-label for="project_implemented_type" :value="__('Project Implemented Type')" />

                        <div class="d-flex">
                           <div class="block mx-2">
                              <label for="project_bike" class="inline-flex items-center">
                                 <input type="checkbox" id="project_bike" name="project_implemented_type[]" value="project_bike" 
                                 @if(in_array('project_bike', json_decode($data->userProfile->project_implemented_type ?? '', true) ?: [])) 
                                    checked 
                                 @endif
                                 class="form-checkbox">
                                 <span class="ml-2">{{ __('EV bike') }}</span>
                              </label>
                           </div>

                           <div class="block mx-2">
                              <label for="project_solar" class="inline-flex items-center">
                                 <input type="checkbox" id="project_solar" name="project_implemented_type[]" value="project_solar" 
                                 @if(in_array('project_solar', json_decode($data->userProfile->project_implemented_type ?? '', true) ?: [])) 
                                    checked 
                                 @endif
                                 class="form-checkbox">
                                 <span class="ml-2">{{ __('Solar Power') }}</span>
                              </label>
                           </div>
                           <x-input-error :messages="$errors->get('project_implemented_type')" class="mt-2" />
                        </div>
                     </div>

                     <!-- Corporate Type -->
                     <div class="mt-2 form-group ">
                        <x-input-label for="coporate_type" :value="__('Corporate Type')" />
                        <x-select id="coporate_type" name="coporate_type" class="block mt-1 w-full" required>
                           <option value="application" @if(($data->userProfile->coporate_type ?? "") == "application") selected  @endif>{{ __('Application Coporation') }}</option>
                           <option value="credit" @if(($data->userProfile->coporate_type ?? "") == "credit") selected @endif>{{ __('Credit Coporation') }}</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('coporate_type')" class="mt-2" />
                     </div>
                     <div class="row">
                        <!-- Corporate Number -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="corporate_number" :value="__('Corporate Number')" />
                           <x-text-input id="corporate_number" class="block mt-1 w-full" type="text" name="corporate_number" :value="old('corporate_number', $data->userProfile->corporate_number ?? '' )" required />
                           <x-input-error :messages="$errors->get('corporate_number')" class="mt-2" />
                        </div>

                        <!-- Corporate Name -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="corporate_name" :value="__('Corporate Name')" />
                           <x-text-input id="corporate_name" class="block mt-1 w-full" type="text" name="corporate_name" :value="old('corporate_name', $data->userProfile->corporate_name ?? '')" required />
                           <x-input-error :messages="$errors->get('corporate_name')" class="mt-2" />
                        </div>
                     </div>

                     <div class="row">
                        <!-- Representative Title -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="representative_title" :value="__('Representative Title')" />
                           <x-text-input id="representative_title" class="block mt-1 w-full" type="text" name="representative_title" :value="old('representative_title', $data->userProfile->representative_title ?? '')" required />
                           <x-input-error :messages="$errors->get('representative_title')" class="mt-2" />
                        </div>

                        <!-- Representative Name -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="representative_name" :value="__('Representative Name')" />
                           <x-text-input id="representative_name" class="block mt-1 w-full" type="text" name="representative_name" :value="old('representative_name', $data->userProfile->representative_name ?? '')" required />
                           <x-input-error :messages="$errors->get('representative_name')" class="mt-2" />
                        </div>
                     </div>

                     <!-- Main Phone Number -->
                     <div class="mt-2">
                        <x-input-label for="main_phone_number" :value="__('Main Phone Number')" />
                        <x-text-input id="main_phone_number" class="block mt-1 w-full" type="text" name="main_phone_number" :value="old('main_phone_number', $data->userProfile->main_phone_number ?? '')" required />
                        <x-input-error :messages="$errors->get('main_phone_number')" class="mt-2" />
                     </div>

                     <!-- Postal Code -->
                     <div class="mt-2">
                        <x-input-label for="postal_code" :value="__('Postal Code')" />
                        <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $data->userProfile->postal_code ?? '')" required />
                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                     </div>

                     <div class="row">
                        <!-- Prefecture -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="prefecture" :value="__('Prefecture')" />
                           <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture', $data->userProfile->prefecture ?? '')" required />
                           <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
                        </div>

                        <!-- City/Town -->
                        <div class="mt-2 form-group col-md-6">
                           <x-input-label for="city_town" :value="__('City/Town')" />
                           <x-text-input id="city_town" class="block mt-1 w-full" type="text" name="city_town" :value="old('city_town', $data->userProfile->city_town ?? '')" required />
                           <x-input-error :messages="$errors->get('city_town')" class="mt-2" />
                        </div>
                     </div>

                     <!-- Address Beyond City/Town -->
                     <div class="mt-2">
                        <x-input-label for="address_beyond_city_town" :value="__('Address Beyond City/Town')" />
                        <x-text-input id="address_beyond_city_town" class="block mt-1 w-full" type="text" name="address_beyond_city_town" :value="old('address_beyond_city_town', $data->userProfile->address_beyond_city_town ?? '')" required />
                        <x-input-error :messages="$errors->get('address_beyond_city_town')" class="mt-2" />
                     </div>

                     <!-- Other Credit History -->
                     <div class="mt-4">
                        <x-input-label for="other_credit_history" :value="__('Other Credit History')" />
                        <x-text-input id="other_credit_history" class="block mt-1 w-full" type="text" name="other_credit_history" :value="old('other_credit_history', $data->userProfile->other_credit_history ?? '')" />
                        <x-input-error :messages="$errors->get('other_credit_history')" class="mt-2" />
                     </div>

                     <!-- Corporate Account Registration Date -->
                     <div class="mt-4">
                        <x-input-label for="corporate_account_registration_date" :value="__('Corporate Account Registration Date')" />
                        <x-text-input id="corporate_account_registration_date" class="block mt-1 w-full" type="date" name="corporate_account_registration_date" :value="old('corporate_account_registration_date', $data->userProfile->corporate_account_registration_date ?? '')" required />
                        <x-input-error :messages="$errors->get('corporate_account_registration_date')" class="mt-2" />
                     </div>

                     <div class="row mt-2">
                        <!-- Department Name -->
                        <div class="mt-2 form-group col-md-4">
                           <x-input-label for="department_name" :value="__('Department Name')" />
                           <x-text-input id="department_name" class="block mt-1 w-full" type="text" name="department_name" :value="old('department_name', $data->userProfile->department_name ?? '')" required />
                           <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                        </div>

                        <!-- Personal Title -->
                        <div class="mt-2 form-group col-md-4">
                           <x-input-label for="personal_title" :value="__('Personal Title')" />
                           <x-text-input id="personal_title" class="block mt-1 w-full" type="text" name="personal_title" :value="old('personal_title', $data->userProfile->personal_title ?? '')" required />
                           <x-input-error :messages="$errors->get('personal_title')" class="mt-2" />
                        </div>

                        <!-- Personal Name -->
                        <div class="mt-2 form-group col-md-4">
                           <x-input-label for="personal_name" :value="__('Personal Name')" />
                           <x-text-input id="personal_name" class="block mt-1 w-full" type="text" name="personal_name" :value="old('personal_name', $data->userProfile->personal_name ?? '')" required />
                           <x-input-error :messages="$errors->get('personal_name')" class="mt-2" />
                        </div>
                     </div>

                     <!-- Contact Phone Number -->
                     <div class="mt-2">
                        <x-input-label for="contact_phone_number" :value="__('Contact Phone Number')" />
                        <x-text-input id="contact_phone_number" class="block mt-1 w-full" type="text" name="contact_phone_number" :value="old('contact_phone_number',  $data->userProfile->contact_phone_number ?? '')" required />
                        <x-input-error :messages="$errors->get('contact_phone_number')" class="mt-2" />
                     </div>

                     <!-- Email Address -->
                     <div class="mt-2">
                        <x-input-label for="email_address" :value="__('Email Address')" />
                        <x-text-input id="email_address" class="block mt-1 w-full" type="email" name="email_address" :value="old('email_address', $data->userProfile->email_address ?? '')" required />
                        <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
                     </div>

                     <!-- Project History -->
                     <div class="mt-2">
                        <x-input-label for="project_history" :value="__('Project History')" />
                        <x-text-input id="project_history" class="block mt-1 w-full" type="text" name="project_history" :value="old('project_history', $data->userProfile->project_history ?? '')" />
                        <x-input-error :messages="$errors->get('project_history')" class="mt-2" />
                     </div>

                     <!-- Other fields for Step 2... -->
                     <hr>
                     <h5 class="mb-3">{{__('User Account')}}</h5>
                     <div class="row">
                        <div class="form-group col-md-12">
                           <label class="form-label" for="uname">{{__('User Name')}}: <span class="text-danger">*</span></label>
                           {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => __('Enter Username')]) }}
                        </div>
                        <div class="row mt-2">
                           <div class="form-group col-md-6">
                              <label class="form-label" for="uname">{{__('First Name')}}: <span class="text-danger">*</span></label>
                              {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required', 'placeholder' => __('')]) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="uname">{{__('Last Name')}}: <span class="text-danger">*</span></label>
                              {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required', 'placeholder' => __('')]) }}
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="form-label">User Role: <span class="text-danger">*</span></label>
                           {{Form::select('user_role', $roles , old('user_role') ? old('user_role') : $data->user_type ?? 'user', ['class' => 'form-control', 'placeholder' => 'Select User Role'])}}
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="pass">{{__('Password')}}:</label>
                           {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Password')]) }}
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="rpass">{{__('Repeat Password')}}:</label>
                           {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('Repeat Password')]) }}
                        </div>
                     </div>
                     <div class="flex items-center justify-end mt-2">
                        <x-primary-button class="btn btn-dark">
                        {{__('Update User information')}}
                        </x-primary-button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {!! Form::close() !!}
   </div>
</x-app-layout>