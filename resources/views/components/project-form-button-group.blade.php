@props(['step'])

<div class="flex items-center justify-center mt-6 w-full col-md-12">
    <x-primary-button :submit="'button'" class="w-full text-center flex justify-center col-md-6" name="action" value="temporary_save">
        {{ __('一時保存') }}
    </x-primary-button>
</div>

<div class="flex items-center justify-center mt-6 w-full col-md-12">
    <x-primary-button :submit="'button'" :disabled="$step === 1" class="w-full text-center flex justify-center" name="action" value="prev_step">
        {{ __('Prev') }}
    </x-primary-button>

    <x-primary-button class="w-full text-center flex justify-center">
        {{ $step == 5 ? __('Submit') : __('Next') }}
    </x-primary-button>
</div>