<x-app-layout>
    @include('partials.dashboard._custom_head')
<div class="page-content custom">
            <div class="wizard-v1-content">
                <div class="wizard-form">
                    <form class="form-register" id="form-register" action="{{route('bike.action')}}" method="post">
                        @csrf
                        <div id="form-total">
                            <!-- SECTION 1 -->
                            <h2 style="display: none;">
                                <span class="step-icon"><i class="zmdi zmdi-account"></i></span>
                                <span class="step-number">ステップ１</span>
                                <span class="step-text"> 申請入力フォーム</span>
                            </h2>
                            <section>
                                <!-- project start -->
                                <div class="inner">
                                    <div class="row">
                                        <div class=" col-md-12">
                                            <h4 class="title-label fs-4" for="project">プロジェクト情報入力</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="project_name">プロジェクト名*</label>
                                                <input type="text" placeholder="プロジェクト名" class="form-control" id="project_name" name="project_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="company_name">会社名*</label>
                                                <input type="text" placeholder="会社名" class="form-control" id="company_name" name="company_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_name">担当者名*</label>
                                                <input type="text" placeholder="担当者名" class="form-control" id="user_name" name="user_name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact">連絡先*</label>
                                                <input type="text" placeholder="連絡先" class="form-control" id="contact" name="contact" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- project end  -->
                                     <hr>
                                    <!-- bike start -->
                                    <div class="row" style="margin-top: 10px;">
                                        <div class=" col-md-6">
                                            <h4 class="title-label fs-4" for="bike">バイク情報入力</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="bike_kind">電動バイクの種類*</label>
                                                <select class="form-control" id="bike_kind" name="bike_kind" required>
                                                    <option value="" disabled selected>電動バイクの種類</option>
                                                    <option value="Evo 200 Lite">エボ200Lite</option>
                                                    <option value="Evo 200">エボ200</option>
                                                    <option value="Feliz S">フェリスS</option>
                                                    <option value="Klara S">クララS</option>
                                                    <option value="Vento S">ベントS</option>
                                                    <option value="Theon S">テオンS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bike_count">導入台数*</label>
                                                <input type="number" placeholder="導入台数" class="form-control" id="bike_count" name="bike_count" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="distance_year">年間走行距離（km/年）*</label>
                                                <input type="text" placeholder="年間走行距離（km/年）" class="form-control" id="distance_year" name="distance_year" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- bike end -->
                                     <hr>
                                    <!-- base line info start -->
                                    <div class="row" style="margin-top: 10px;">
                                        <div class=" col-md-6">
                                            <h4 class="title-label fs-4" for="base_line">ベースライン情報入力</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="base_line_bike_kind">ベースラインのガソリンバイクの種類*</label>
                                                <select class="form-control" id="base_line_bike_kind" name="base_line_bike_kind" required>
                                                    <option value="" disabled selected>ベースラインのガソリンバイクの種類</option>
                                                    <option value="YAMAHA EXCITER">YAMAHAのEXCITER</option>
                                                    <option value="YAMAHA NVX">YAMAHAのNVX</option>
                                                    <option value="HONDA AirBrade">HONDAのAirBrade</option>
                                                    <option value="YAMAHA EXCITER">イタリアのブランドVESPAのPRIMAVERA</option>
                                                    <option value="YAMHA GRANDE">YAMHAのGRANDE</option>
                                                    <option value="YAMAHA JANUS">YAMAHAのJANUS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fuel_efficiency">燃料消費効率（km/L）*</label>
                                                <input type="text" placeholder="燃料消費効率（km/L）" class="form-control" id="fuel_efficiency" name="fuel_efficiency" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emission_factor">使用燃料の排出係数（tCO2/L）*</label>
                                                <input type="text" placeholder="使用燃料の排出係数（tCO2/L）" class="form-control" id="emission_factor" name="emission_factor" required>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- base line info end  -->
                                      <hr>
                                     <!-- post implementation info start -->
                                     <div class="row" style="margin-top: 10px;">
                                        <div class=" col-md-6">
                                            <h4 class="title-label fs-4" for="post_implementation_info">実施後情報入力</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ele_consum_efficiency">電力消費効率（km/kWh）*</label>
                                                <input type="text" placeholder="電力消費効率（km/kWh）" class="form-control" id="ele_consum_efficiency" name="ele_consum_efficiency" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="co2_count">電力のCO2排出係数（tCO2/kWh）*</label>
                                                <input type="text" placeholder="電力のCO2排出係数（tCO2/kWh）" class="form-control" id="co2_count" name="co2_count" required>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- post implementation info end -->
                                </div>
                            </section>
                            <!-- SECTION 2 -->
                            <h2 style="display: none;">
                                <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                                <span class="step-number">ステップ２</span>
                                <span class="step-text">申請入力確認</span>
                            </h2>
                            <section>
                                <div class="inner">
                                    <h3>詳細を確認</h3>
                                        <div class="row table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="space-row">
                                                        <th>プロジェクト名:</th>
                                                        <td id="project_name-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>会社名:</th>
                                                        <td id="company_name-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>担当者名:</th>
                                                        <td id="user_name-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>連絡先</th>
                                                        <td id="contact-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>電動バイクの種類:</th>
                                                        <td id="bike_kind-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>導入台数:</th>
                                                        <td id="bike_count-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>年間走行距離（km/年）:</th>
                                                        <td id="distance_year-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>ベースラインのガソリンバイクの種類:</th>
                                                        <td id="base_line_bike_kind-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>燃料消費効率（km/L）:</th>
                                                        <td id="fuel_efficiency-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>使用燃料の排出係数（tCO2/L）:</th>
                                                        <td id="emission_factor-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>電力消費効率（km/kWh）:</th>
                                                        <td id="ele_consum_efficiency-val"></td>
                                                    </tr>
                                                    <tr class="space-row">
                                                        <th>電力のCO2排出係数（tCO2/kWh）:</th>
                                                        <td id="co2_count-val"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@include('partials.dashboard._custom_footer')
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ja.min.js"></script>
<script src="{{asset('assets/js/jquery.steps.js')}}"></script>
<script src="{{asset('assets/vendor/bootrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
