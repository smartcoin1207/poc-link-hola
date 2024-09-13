<x-app-layout :assets="['chart', 'animation']">
    <div class="row mt-4">
        <div class="col-md-12 col-lg-12">
        <div class="row row-cols-1">
            <div class="d-slider1 overflow-hidden ">
                <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2">
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-01" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">総ベースライン排出量</p>
                                <h4 class="counter" style="visibility: visible;">{{$total_baseline}}ｔ</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-02" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">総プロジェクト実施後排出量</p>
                                <h4 class="counter">{{$total_project}}ｔ</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-03" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">総CO2削減量</p>
                                <h4 class="counter">{{$total_co2_reduction}}ｔ</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-04" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">総CO2クレジット量</p>
                                <h4 class="counter">{{$total_co2_credit}}ｔ</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                    
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1200">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-06" class="circle-progress-01 circle-progress circle-progress-info text-center" data-min-value="0" data-max-value="100" data-value="40" data-type="percent">
                                <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">Today</p>
                                <h4 class="counter">4600</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                    <div class="card-body">
                        <div class="progress-widget">
                            <div id="circle-progress-07" class="circle-progress-01 circle-progress circle-progress-primary text-center" data-min-value="0" data-max-value="100" data-value="30" data-type="percent">
                                <svg class="card-slie-arrow " width="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                </svg>
                            </div>
                            <div class="progress-detail">
                                <p  class="mb-2">Members</p>
                                <h4 class="counter">11.2M</h4>
                            </div>
                        </div>
                    </div>
                    </li>
                </ul>
                <div class="swiper-button swiper-button-next"></div>
                <div class="swiper-button swiper-button-prev"></div>
            </div>
        </div>
        </div>
        <div class="col-md-12 col-lg-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title">855.8K</h4>
                        <p class="mb-0">総合グラフ</p>
                    </div>
                    <div class="d-flex align-items-center align-self-center">
                        <div class="d-flex align-items-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g id="Solid dot2">
                                <circle id="Ellipse 65" cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div class="ms-2">
                                <span class="text-gray">Sales</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ms-3 text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24" fill="currentColor">
                                <g id="Solid dot3">
                                <circle id="Ellipse 66" cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                            <div class="ms-2">
                                <span class="text-gray">Cost</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    </div>
                    <div class="card-body">
                    <div id="d-main" class="d-main"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card" data-aos="fade-up" data-aos-delay="1000">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title">Earnings</h4>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div id="myChart" class="col-md-8 col-lg-8 myChart"></div>
                        <div class="d-grid gap col-md-4 col-lg-4">
                            <div class="d-flex align-items-start">
                                <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#3a57e8">
                                <g id="Solid dot">
                                    <circle id="Ellipse 67" cx="12" cy="12" r="8" fill="#3a57e8"></circle>
                                </g>
                                </svg>
                                <div class="ms-3">
                                <span class="text-gray">Fashion</span>
                                <h6>251K</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <svg class="mt-2" xmlns="http://www.w3.org/2000/svg" width="14" viewBox="0 0 24 24" fill="#4bc7d2">
                                <g id="Solid dot1">
                                    <circle id="Ellipse 68" cx="12" cy="12" r="8" fill="#4bc7d2"></circle>
                                </g>
                                </svg>
                                <div class="ms-3">
                                <span class="text-gray">Accessories</span>
                                <h6>176K</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card" data-aos="fade-up" data-aos-delay="1200">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title">Conversions</h4>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                            This Week
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                    </div>
                    <div class="card-body">
                    <div id="d-activity" class="d-activity"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="card overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title mb-2">Enterprise Clients</h4>
                        <p class="mb-0">
                            <svg class ="me-2" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#3a57e8" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                            </svg>
                            15 new acquired this month
                        </p>
                    </div>
                    <div class="dropdown">
                        <span class="dropdown-toggle" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        </span>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton7">
                            <a class="dropdown-item " href="javascript:void(0);">Action</a>
                            <a class="dropdown-item " href="javascript:void(0);">Another action</a>
                            <a class="dropdown-item " href="javascript:void(0);">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body p-0">
                    <div class="table-responsive mt-4">
                        <table id="basic-table" class="table table-striped mb-0" role="grid">
                            <thead>
                                <tr>
                                <th>COMPANIES</th>
                                <th>CONTACTS</th>
                                <th>ORDER</th>
                                <th>COMPLETION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6>Addidis Sportwear</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                        </a>
                                    </div>
                                </td>
                                <td>$14,000</td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6>60%</h6>
                                    </div>
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6>Netflixer Platforms</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                        </a>
                                    </div>
                                </td>
                                <td>$30,000</td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6>25%</h6>
                                    </div>
                                    <div class="progress bg-soft-primary shadow-none w-100" style="height: 4px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6>Shopifi Stores</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                        </a>
                                    </div>
                                </td>
                                <td>$8,500</td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6>100%</h6>
                                    </div>
                                    <div class="progress bg-soft-success shadow-none w-100" style="height: 4px">
                                        <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6>Bootstrap Technologies</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                        </a>
                                    </div>
                                </td>
                                <td>$20,500</td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6>100%</h6>
                                    </div>
                                    <div class="progress bg-soft-success shadow-none w-100" style="height: 4px">
                                        <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <h6>Community First</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                            <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                        </a>
                                    </div>
                                </td>
                                <td>$9,800</td>
                                <td>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6>100%</h6>
                                    </div>
                                    <div class="progress bg-soft-success shadow-none w-100" style="height: 4px">
                                        <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-12 col-lg-4">
        <div class="row">
            <div class="col-md-6 col-lg-12">
                <div class="card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body d-flex justify-content-around text-center">
                    <div>
                        <h2 class="mb-2">750<small>K</small></h2>
                        <p class="mb-0 text-gray">ウェブサイト訪問者</p>
                    </div>
                    <hr class="hr-vertial">
                    <div>
                        <h2 class="mb-2">7,500</h2>
                        <p class="mb-0 text-gray">新しいお客様</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-header d-flex justify-content-between flex-wrap">
                    <div class="header-title">
                        <h4 class="card-title mb-2">活動概要</h4>
                        <p class="mb-0">
                            <svg class ="me-2" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#17904b" d="M13,20H11V8L5.5,13.5L4.08,12.08L12,4.16L19.92,12.08L18.5,13.5L13,8V20Z" />
                            </svg>
                            16% this month
                        </p>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-4">
                            <h6 class=" mb-1">$2400, Purchase</h6>
                            <span class="mb-0">11 JUL 8:10 PM</span>
                        </div>
                    </div>
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-4">
                            <h6 class=" mb-1">New order #8744152</h6>
                            <span class="mb-0">11 JUL 11 PM</span>
                        </div>
                    </div>
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-4">
                            <h6 class=" mb-1">Affiliate Payout</h6>
                            <span class="mb-0">11 JUL 7:64 PM</span>
                        </div>
                    </div>
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-4">
                            <h6 class=" mb-1">New user added</h6>
                            <span class="mb-0">11 JUL 1:21 AM</span>
                        </div>
                    </div>
                    <div class=" d-flex profile-media align-items-top mb-1">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-4">
                            <h6 class=" mb-1">Product added</h6>
                            <span class="mb-0">11 JUL 4:50 AM</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>