<nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
   <div class="container-fluid">
      <div class="offcanvas-header">
         <div class="navbar-brand">
            <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
               <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
               <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
               <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
               <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
            </svg>
            <h4 class="logo-title">{{env('APP_NAME')}}</h4>
         </div>
         <button class="btn-close float-end"></button>
      </div>
      <ul class="navbar-nav">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }} 
         </x-nav-link>
        <x-nav-link :href="route('bike.form')" :active="request()->routeIs('bike.*')">
            {{ __('E Bike') }}
         </x-nav-link>
         <x-nav-link :href="route('solar.calculate.index')" :active="request()->routeIs('solar.calculate.*')">
            {{ __('Solar Light') }}
         </x-nav-link>
         <x-nav-link :href="route('project.detail.index')" :active="request()->routeIs('project.detail.*')">
            {{ __('プロジェクト') }} 
         </x-nav-link>

         <x-nav-link :href="route('project.verification.index')" :active="request()->routeIs('project.verification.*')">
            {{ __('Verification Status') }} 
         </x-nav-link>
      </ul>
   </div> <!-- container-fluid.// -->
</nav>
