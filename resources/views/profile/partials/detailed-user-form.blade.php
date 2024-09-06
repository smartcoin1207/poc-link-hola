<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 bold">
            {{ __('Profile Detailed Information') }}
        </h2>
    </header>
    <form method="post" action="{{ route('profile.update.detailed') }}" class="mt-6 space-y-6">
        @csrf

        <!-- Project Implemented Type -->
        <div class="mt-4 form-group">
            <x-input-label for="project_implemented_type" :value="__('Project Implemented Type')" />
            
            <div class="flex">
                <div class="block mt-1 mr-4">
                    <label for="project_bike" class="inline-flex items-center">
                        <input type="checkbox" id="project_bike" name="project_implemented_type[]" value="project_bike" 
                        @if($exist_detailed_account && in_array('project_bike', json_decode($detailed_account->project_implemented_type ?: '', true) ?: [])) 
                            checked 
                        @endif
                            class="form-checkbox">
                        <span class="ml-2">{{ __('EV bike') }}</span>
                    </label>
                </div>
                
                <div class="block mt-1">
                    <label for="project_solar" class="inline-flex items-center">
                        <input type="checkbox" id="project_solar" name="project_implemented_type[]" value="project_solar" 
                        @if($exist_detailed_account && in_array('project_solar', json_decode($detailed_account->project_implemented_type ?: '', true) ?: [])) 
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
        <div class="mt-4 form-group ">
            <x-input-label for="coporate_type" :value="__('Corporate Type')" />
            <select id="coporate_type" name="coporate_type" class="block mt-1 w-full" required>
                <option value="application" @if($exist_detailed_account && $detailed_account->coporate_type == "application") selected  @endif >{{ __('Application Coporation') }}</option>
                <option value="credit" @if($exist_detailed_account && $detailed_account->coporate_type == "credit") selected @endif >{{ __('Credit Coporation') }}</option>
            </select>
            <x-input-error :messages="$errors->get('coporate_type')" class="mt-2" />
        </div>
        <div class="row">
            <!-- Corporate Number -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="corporate_number" :value="__('Corporate Number')" />
                <x-text-input id="corporate_number" class="block mt-1 w-full" type="text" name="corporate_number"
                    :value="old('corporate_number', $detailed_account->corporate_number ?? '')"
                    required />
                <x-input-error :messages="$errors->get('corporate_number')" class="mt-2" />
            </div>

            <!-- Corporate Name -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="corporate_name" :value="__('Corporate Name')" />
                <x-text-input id="corporate_name" class="block mt-1 w-full" type="text" name="corporate_name" :value="old('corporate_name', $detailed_account->corporate_name ?? '' )" required />
                <x-input-error :messages="$errors->get('corporate_name')" class="mt-2" />
            </div>
        </div>

        <div class="row">
            <!-- Representative Title -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="representative_title" :value="__('Representative Title')" />
                <x-text-input id="representative_title" class="block mt-1 w-full" type="text" name="representative_title" :value="old('representative_title', $detailed_account->representative_title ?? '')"  required />
                <x-input-error :messages="$errors->get('representative_title')" class="mt-2" />
            </div>

            <!-- Representative Name -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="representative_name" :value="__('Representative Name')" />
                <x-text-input id="representative_name" class="block mt-1 w-full" type="text" name="representative_name" :value="old('representative_name', $detailed_account->representative_name ?? '')" required />
                <x-input-error :messages="$errors->get('representative_name')" class="mt-2" />
            </div>
        </div>

        <!-- Main Phone Number -->
        <div class="mt-4">
            <x-input-label for="main_phone_number" :value="__('Main Phone Number')" />
            <x-text-input id="main_phone_number" class="block mt-1 w-full" type="text" name="main_phone_number" :value="old('main_phone_number', $detailed_account->main_phone_number ?? '')" required />
            <x-input-error :messages="$errors->get('main_phone_number')" class="mt-2" />
        </div>

        <!-- Postal Code -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $detailed_account->postal_code ?? '')" required />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <div class="row">
            <!-- Prefecture -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="prefecture" :value="__('Prefecture')" />
                <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture', $detailed_account->prefecture ?? '')" required />
                <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
            </div>

            <!-- City/Town -->
            <div class="mt-4 form-group col-md-6">
                <x-input-label for="city_town" :value="__('City/Town')" />
                <x-text-input id="city_town" class="block mt-1 w-full" type="text" name="city_town" :value="old('city_town', $detailed_account->city_town ?? '')" required />
                <x-input-error :messages="$errors->get('city_town')" class="mt-2" />
            </div>
        </div>
        
        <!-- Address Beyond City/Town -->
        <div class="mt-4">
            <x-input-label for="address_beyond_city_town" :value="__('Address Beyond City/Town')" />
            <x-text-input id="address_beyond_city_town" class="block mt-1 w-full" type="text" name="address_beyond_city_town" :value="old('address_beyond_city_town', $detailed_account->address_beyond_city_town ?? '')" required />
            <x-input-error :messages="$errors->get('address_beyond_city_town')" class="mt-2" />
        </div>

        <!-- Other Credit History -->
        <div class="mt-4">
            <x-input-label for="other_credit_history" :value="__('Other Credit History')" />
            <x-text-input id="other_credit_history" class="block mt-1 w-full" type="text" name="other_credit_history" :value="old('other_credit_history', $detailed_account->other_credit_history ?? '')" />
            <x-input-error :messages="$errors->get('other_credit_history')" class="mt-2" />
        </div>

        <!-- Corporate Account Registration Date -->
        <div class="mt-4">
            <x-input-label for="corporate_account_registration_date" :value="__('Corporate Account Registration Date')" />
            <x-text-input id="corporate_account_registration_date" class="block mt-1 w-full" type="date" name="corporate_account_registration_date" :value="old('corporate_account_registration_date', $detailed_account->corporate_account_registration_date ?? '')" required />
            <x-input-error :messages="$errors->get('corporate_account_registration_date')" class="mt-2" />
        </div>

        <div class="row">
            <!-- Department Name -->
            <div class="mt-4 form-group col-md-4">
                <x-input-label for="department_name" :value="__('Department Name')" />
                <x-text-input id="department_name" class="block mt-1 w-full" type="text" name="department_name" :value="old('department_name', $detailed_account->department_name ?? '')" required />
                <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
            </div>

            <!-- Personal Title -->
            <div class="mt-4 form-group col-md-4">
                <x-input-label for="personal_title" :value="__('Personal Title')" />
                <x-text-input id="personal_title" class="block mt-1 w-full" type="text" name="personal_title" :value="old('personal_title', $detailed_account->personal_title ?? '')" required />
                <x-input-error :messages="$errors->get('personal_title')" class="mt-2" />
            </div>

            <!-- Personal Name -->
            <div class="mt-4 form-group col-md-4">
                <x-input-label for="personal_name" :value="__('Personal Name')" />
                <x-text-input id="personal_name" class="block mt-1 w-full" type="text" name="personal_name" :value="old('personal_name', $detailed_account->personal_name ?? '')" required />
                <x-input-error :messages="$errors->get('personal_name')" class="mt-2" />
            </div>
        </div>

        <!-- Contact Phone Number -->
        <div class="mt-4">
            <x-input-label for="contact_phone_number" :value="__('Contact Phone Number')" />
            <x-text-input id="contact_phone_number" class="block mt-1 w-full" type="text" name="contact_phone_number" :value="old('contact_phone_number', $detailed_account->contact_phone_number ?? '')"  required />
            <x-input-error :messages="$errors->get('contact_phone_number')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email_address" :value="__('Email Address')" />
            <x-text-input id="email_address" class="block mt-1 w-full" type="email" name="email_address" :value="old('email_address', $detailed_account->email_address ?? '')" required />
            <x-input-error :messages="$errors->get('email_address')" class="mt-2" />
        </div>

        <!-- Project History -->
        <div class="mt-4">
            <x-input-label for="project_history" :value="__('Project History')" />
            <x-text-input id="project_history" class="block mt-1 w-full" type="text" name="project_history" :value="old('project_history', $detailed_account->project_history ?? '')" />
            <x-input-error :messages="$errors->get('project_history')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('detailed_status') === 'profile-detailed-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>