<form method="POST" action="{{ $form_submit_url }}" id="projectDetailForm" method="POST" enctype="multipart/form-data">
    @csrf

    @if(isset($is_update) && $is_update)
        @method('PUT')
    @endif

    <div class="sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md m-auto">
            <div class="mt-4  font-bold text-2xl text-center">
                @if($step == 1)
                    {{ __('Project Overview') }}{{ $is_update ? __('の編集') : __('の登録') }}
                @elseif($step == 2)
                    {{__('プロジェクト計画書 (PDD-1)')}}{{ $is_update ? __('の編集') : __('の登録') }}
                @elseif($step == 3)
                    {{__('プロジェクト計画書 (PDD-2)')}}{{ $is_update ? __('の編集') : __('の登録') }}
                @elseif($step == 4)
                    {{__('プロジェクト計画書 (PDD-3)')}}{{ $is_update ? __('の編集') : __('の登録') }}
                @elseif($step == 5)
                    {{__('ESG+E評価')}}{{ $is_update ? __('の編集') : __('の登録') }}
                @endif
            </div>
            <!-- start step indicators -->
            <div class="form-header d-flex gap-3 mb-4 mt-4 text-xs text-center " style="width: 100%;">
                <span class="stepIndicator flex-1 pb-8 position-relative"></span>
                <span class="stepIndicator flex-1 pb-8 position-relative"></span>
                <span class="stepIndicator flex-1 pb-8 position-relative"></span>
                <span class="stepIndicator flex-1 pb-8 position-relative"></span>
                <span class="stepIndicator flex-1 pb-8 position-relative"></span>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="step" value="{{ $step }}">
    <input type="hidden" name="isEvaluator" value="{{ $isEvaluator ?? '' }}">
    <!-- end step indicators -->

    @if($step == 1)
    <!-- Step 1 -->
    <div id="step-1" class="step">
        <div class="d-flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 mb-2 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <!-- メイン設定 -->
                <div class="row">
                    <!-- <div class="mt-4 mb-4 m-auto font-xl font-bold">
                        {{__('Project Overview')}}
                    </div> -->
                    <input type="text" name="id" value= "{{$projectDetail->id ?? ''}}" hidden>

                    <div class="mt-4  col-md-12">
                        <x-input-label class="mbs-input-required" for="project_id" :value="__('Project Id')" :title="__('')"  />

                        <x-select name="project_id" id="project_id" class="block mt-1 w-full">
                            <option value="">{{__('選択してください')}}</option>
                            @foreach($projects as $project)
                            <option value="{{ $project['id'] }}">{{ $project['name'] }}</option>
                            @endforeach
                        </x-select>

                        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_number" class="mbs-input-required" :value="__('Project Number')" :title="__('')" />
                        <x-text-input id="project_number" class="block mt-1 w-full" type="text" name="project_number" :value="old('project_number', $projectDetail->project_number ?? '')" />
                        <x-input-error :messages="$errors->get('project_number')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_name" class="mbs-input-required" :value="__('Project Name')" :title="__('')" />
                        <x-text-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" :value="old('project_name', $projectDetail->project_name ?? '')" :placeholder="__('Linkhola太陽光発電設備の導入によるCO2削減プロジェクト')" />
                        <x-input-error :messages="$errors->get('project_name')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_type" class="mbs-input-required" :value="__('Project Type')" :title="__('')" :placeholder="__('選択してください')" />

                        <x-select name="project_type" id="project_type" class="block mt-1 w-full">
                            <option value="">{{__('選択してください')}}</option>
                            <option value="project_type1" {{ ($projectDetail->project_type ?? '') == 'project_type1' ? 'selected' : '' }}>タイプ 1</option>
                            <option value="project_type2" {{ ($projectDetail->project_type ?? '') == 'project_type2' ? 'selected' : '' }}>タイプ 2</option>
                            <option value="project_type3" {{ ($projectDetail->project_type ?? '') == 'project_type3' ? 'selected' : '' }}>タイプ 3</option>
                        </x-select>

                        <x-input-error :messages="$errors->get('project_type')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="application_methodology" class="mbs-input-required" :value="__('Application methodology')" :title="__('')" />
                        <x-select name="application_methodology" id="application_methodology" class="border-gray-300 rounded-md block mt-1 w-full">
                            <option value="">{{__('選択してください')}}</option>
                            <option value="application_methodology1" {{ ($projectDetail->application_methodology ?? '') == 'application_methodology1' ? 'selected' : '' }}>1</option>
                            <option value="application_methodology2" {{ ($projectDetail->application_methodology ?? '') == 'application_methodology2' ? 'selected' : '' }}>2</option>
                            <option value="application_methodology3" {{ ($projectDetail->application_methodology ?? '') == 'application_methodology3' ? 'selected' : '' }}>3</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('application_methodology')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="implementation_location" class="mbs-input-required" :value="__('Implementation Location')" :title="__('日本国内全域を対象とする場合は「全国」、地域を限定している場合は「●●県」や「〇〇市」等とご記載ください。')"  />
                        <x-text-input id="implementation_location" class="block mt-1 w-full" type="text" name="implementation_location" :value="old('implementation_location', $projectDetail->implementation_location ?? '')" :placeholder="__('東京都港区浜松町')" required />
                        <x-input-error :messages="$errors->get('implementation_location')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="base_start_date" class="mbs-input-required" :value="__('base start date')" :title="__('認証期間の開始日か、それ以前のプロジェクト稼働日を指定できます。')" />
                        <x-text-input id="base_start_date" class="block mt-1 w-full" type="date" name="base_start_date" :value="old('base_start_date', $projectDetail->base_start_date ?? '')" required />
                        <x-input-error :messages="$errors->get('base_start_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="certification_period_start_date" class="mbs-input-required" :value="__('certification period start date')" :title="__('認証対象期間の開始日は現在（申請日）から3年前までの期間内で指定することが可能です。また、認証対象期間については現在（申請日）から最大8年間とします。

例）申請日が2024年8月1日の場合・・・
開始日：2021年8月1日以降で指定可能
終了日：2032年7月31日以前で指定可能')" />
                        <x-text-input id="certification_period_start_date" class="block mt-1 w-full" type="date" name="certification_period_start_date" :value="old('certification_period_start_date', $projectDetail->certification_period_start_date ?? '')" required />
                        <x-input-error :messages="$errors->get('certification_period_start_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="certification_period_end_date" class="mbs-input-required" :value="__('certification period end date')" :title="__('')" />
                        <x-text-input id="certification_period_end_date" class="block mt-1 w-full" type="date" name="certification_period_end_date" :value="old('certification_period_end_date', $projectDetail->certification_period_end_date ?? '')" required />
                        <x-input-error :messages="$errors->get('certification_period_end_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="initial_certification_start_date" class="mbs-input-required" :value="__('initial certification start date')" :title="__('認証対象期間のうち、既に実績データの集計が完了している期間がある場合には、クレジット化の検証対象となりますので、その開始日と終了日を入力ください。')" />
                        <x-text-input id="initial_certification_start_date" class="block mt-1 w-full" type="date" name="initial_certification_start_date" :value="old('initial_certification_start_date', $projectDetail->initial_certification_start_date ?? '')" required />
                        <x-input-error :messages="$errors->get('initial_certification_start_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="initial_certification_end_date" class="mbs-input-required" :value="__('initial certification end date')" :title="__('')" />
                        <x-text-input id="initial_certification_end_date" class="block mt-1 w-full" type="date" name="initial_certification_end_date" :value="old('initial_certification_end_date', $projectDetail->initial_certification_end_date ?? '')" required />
                        <x-input-error :messages="$errors->get('initial_certification_end_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_application_date" class="mbs-input-required" :value="__('project application date')" :title="__('')" />
                        <x-text-input id="project_application_date" class="block mt-1 w-full" type="date" name="project_application_date" :value="old('project_application_date', $projectDetail->project_application_date ?? '')" required />
                        <x-input-error :messages="$errors->get('project_application_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_registration_date" class="mbs-input-required" :value="__('project registration date')" :title="__('事務局による書類審査が通過した日付です。')" />
                        <x-text-input id="project_registration_date" class="block mt-1 w-full" type="date" name="project_registration_date" :value="old('project_registration_date', $projectDetail->project_registration_date ?? '')" required />
                        <x-input-error :messages="$errors->get('project_registration_date')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_before_implementation" :value="__('project before implementation')" :title="__('ご不明な場合は事務局にお問い合わせください。')" />
                        <x-textarea id="project_before_implementation" class="block mt-1 w-full" type="text" name="project_before_implementation" rows="3" required>
                            {{old('project_before_implementation', $projectDetail->project_before_implementation ?? '')}}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('project_before_implementation')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_during_implementation" :value="__('project during implementation')" :title="__('ご不明な場合は事務局にお問い合わせください。')" />
                        <x-textarea id="project_during_implementation" class="block mt-1 w-full" type="text" name="project_during_implementation" rows="3" required>
                            {{old('project_during_implementation', $projectDetail->project_during_implementation ?? '')}}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('project_during_implementation')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="project_mid_longterm_plan" :value="__('project mid longterm plan')" :title="__('ご不明な場合は事務局にお問い合わせください。')" />
                        <x-textarea id="project_mid_longterm_plan" class="block mt-1 w-full" type="text" name="project_mid_longterm_plan" rows="3" required>
                            {{old('project_mid_longterm_plan', $projectDetail->project_mid_longterm_plan ?? '')}}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('project_mid_longterm_plan')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('project_overview')"
                            :title="__('project overview')"
                            :description="__('プロジェクト概要図を添付してください。こちらから見本をダウンロードできます。')"
                            :link="$projectDetail->project_overview ?? ''"
                            :date="$projectDetail->project_overview_upload_date ?? ''"
                            :tooltip_title="__('雛形ファイルをダウンロードの上、ご作成ください。完成しましたら、当該ファイルをここにアップロードしてください。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('project_overview')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('implementing_body_credit_holder')"
                            :title="__('implementing body credit holder')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->implementing_body_credit_holder ?? ''"
                            :date="$projectDetail->implementing_body_credit_holder_upload_date ?? ''"
                            :tooltip_title="__('雛形ファイルをダウンロードの上、ご作成ください。完成しましたら、当該ファイルをここにアップロードしてください。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('implementing_body_credit_holder')" class="mt-2" />
                    </div>
                    <x-project-form-button-group :step="$step"></x-project-form-button-group>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step == 2)
    <!-- Step 2 -->
    <div id="step-2" class="step">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="row">
                    <!-- <div class="mt-4 mb-4 font-xl font-bold">
                        {{__('プロジェクト計画書 (PDD-1)')}}
                    </div> -->
                    <input type="text" name="id" value= "{{$projectDetail->id ?? ''}}" hidden>
                    <div class="mt-4  col-md-12">
                        <x-input-label for="emission_source_before_project" class="mbs-input-required" :value="__('emission source before project')" :title="__('太陽光発電プロジェクトの事例の記入例を示しています。ご不明な場合、事務局にお問い合せください。')" />
                        <x-text-input id="emission_source_before_project" class="block mt-1 w-full" type="text" name="emission_source_before_project" :value="old('emission_source_before_project', $projectDetail->emission_source_before_project ?? '')" required />
                        <x-input-error :messages="$errors->get('emission_source_before_project')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="emission_from_production1" class="mbs-input-required" :value="__('emission from production1')" :title="__('付随的な排出活動がある場合にのみ、その内容をご記載ください。ご不明な場合、事務局にお問い合せください。')" />
                        <x-text-input id="emission_from_production1" class="block mt-1 w-full" type="text" name="emission_from_production1" :value="old('emission_from_production1',  $projectDetail->emission_from_production1 ?? '')" required />
                        <x-input-error :messages="$errors->get('emission_from_production1')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="facilities_after_project" class="mbs-input-required"  :value="__('facilities after project')" :title="__('太陽光発電プロジェクトの事例の記入例を示しています。ご不明な場合、事務局にお問い合せください。')" />
                        <x-text-input id="facilities_after_project" class="block mt-1 w-full" type="text" name="facilities_after_project" :value="old('facilities_after_project', $projectDetail->facilities_after_project ?? '')" required />
                        <x-input-error :messages="$errors->get('facilities_after_project')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="emission_from_production2" class="mbs-input-required" :value="__('emission from production2')" :title="__('付随的な排出量の影響度が単独で1％以上、複数で合計5％以上の場合、モニタリング対象となります。')" />
                        <x-text-input id="emission_from_production2" class="block mt-1 w-full" type="text" name="emission_from_production2" :value="old('emission_from_production2', $projectDetail->emission_from_production2 ?? '')" required />
                        <x-input-error :messages="$errors->get('emission_from_production2')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="methodology_requirements" class="mbs-input-required" :value="__('methodology requirements')" :title="__('該当しない項目がある場合は申請ができません。ご不明な場合は事務局にお問い合わせください。
また、「妥当性確認の審査」時に確認できる根拠資料及び説明を準備ください。詳しくは申請後に事務局からガイダンスを行いますので、その際にご案内いたします。')" />

                        <x-select name="methodology_requirements" id="methodology_requirements" class="block mt-1 w-full">
                            <option value="">{{__('適用要件を確認し「✓」を入れてください
                                *刈田：これはテキスト入力欄ではないので、上記を固定の案内テキストとしてタイトル下あたりのよきところに表示')}}</option>
                            <option value="methodology_requirements1" {{ ($projectDetail->methodology_requirements ?? '') == 'methodology_requirements1' ? 'selected' : '' }}> 1</option>
                            <option value="methodology_requirements2" {{ ($projectDetail->methodology_requirements ?? '') == 'methodology_requirements2' ? 'selected' : '' }}> 2</option>
                            <option value="methodology_requirements3" {{ ($projectDetail->methodology_requirements ?? '') == 'methodology_requirements3' ? 'selected' : '' }}> 3</option>
                        </x-select>

                        <x-input-error :messages="$errors->get('methodology_requirements')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="additionality_requirements" class="mbs-input-required" :value="__('additionality requirements')" :title="__('追加性評価にかかる定量評価式を２種類から選択ください。ただし、家庭用新規PVは不要です。')" />

                        <x-select name="additionality_requirements" id="additionality_requirements" class="block mt-1 w-full" :placeholder="__('選択してください')">
                            <option value="" >{{__('選択してください')}}</option>
                            <option value="additionality_requirements1" {{ ($projectDetail->additionality_requirements ?? '') == 'additionality_requirements1' ? 'selected' : '' }}> 1</option>
                            <option value="additionality_requirements2" {{ ($projectDetail->additionality_requirements ?? '') == 'additionality_requirements2' ? 'selected' : '' }}> 2</option>
                            <option value="additionality_requirements3" {{ ($projectDetail->additionality_requirements ?? '') == 'additionality_requirements3' ? 'selected' : '' }}> 3</option>
                        </x-select>

                        <x-input-error :messages="$errors->get('additionality_requirements')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="expected_credit_amount" class="mbs-input-required" :value="__('expected credit amount')" :title="__('自動算定ツールを使う場合は、以下のボタンをクリックしてください。')" />
                        <x-text-input id="expected_credit_amount" class="block mt-1 w-full" type="text" name="expected_credit_amount" :value="old('expected_credit_amount', $projectDetail->expected_credit_amount ?? '')" :placeholder="__('1000')"  required />
                        <x-input-error :messages="$errors->get('expected_credit_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="payback_year" class="mbs-input-required" :value="__('payback year')" :title="__('本プロジェクトにおいて、貴社が想定している投資回収年数をご記入ください。')" />
                        <x-text-input id="payback_year" class="block mt-1 w-full" type="text" name="payback_year" :value="old('payback_year', $projectDetail->payback_year ?? '')" :placeholder="__('10')" required />
                        <x-input-error :messages="$errors->get('payback_year')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="decarbonization_pioneering_regions" class="mbs-input-required" :value="__('decarbonization pioneering regions')" :title="__('脱炭素先行地域の指定地域を確認サイト（https://policies.env.go.jp/policy/roadmap/preceding-region/#regions）')"  />
                        <x-text-input id="decarbonization_pioneering_regions" class="block mt-1 w-full" type="text" name="decarbonization_pioneering_regions" :value="old('decarbonization_pioneering_regions', $projectDetail->decarbonization_pioneering_regions ?? '')" :placeholder="__('選択してください')" required />
                        <x-input-error :messages="$errors->get('decarbonization_pioneering_regions')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="subside_environmental_value" class="mbs-input-required" :value="__('subside environmental value')" :title="__('補助事業を活用している場合、その要綱や規約類を確認下さい。補助事業によって「環境価値の帰属」あるいは「Jクレジット制度参加義務」などの記載がある場合、事務局にお問い合わせください。')" />
                        <x-text-input id="subside_environmental_value" class="block mt-1 w-full" type="text" name="subside_environmental_value" :value="old('subside_environmental_value', $projectDetail->subside_environmental_value ?? '')" :placeholder="__('選択してください')" required />
                        <x-input-error :messages="$errors->get('subside_environmental_value')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="dobule_counting_prevent_measures" class="mbs-input-required" :value="__('dobule counting prevent measures')" :title="__('Jクレジット、その他ボランタリークレジットや再エネ証書等の登録している場合はダブルカウントとなるため、当該申請は不可となる場合があります。')" />
                        <x-text-input id="dobule_counting_prevent_measures" class="block mt-1 w-full" type="text" name="dobule_counting_prevent_measures" :value="old('dobule_counting_prevent_measures', $projectDetail->dobule_counting_prevent_measures ?? '')" :placeholder="__('選択してください')" required />
                        <x-input-error :messages="$errors->get('dobule_counting_prevent_measures')" class="mt-2" />
                    </div>
                    <x-project-form-button-group :step="$step"></x-project-form-button-group>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step == 3)
    <!-- Step 3 -->
    <div id="step-3" class="step">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="row">
                    <!-- <div class="mt-4 mb-4 font-xl font-bold">
                        {{__('プロジェクト計画書 (PDD-2)')}}
                    </div> -->
                    <input type="text" name="id" value= "{{$projectDetail->id ?? ''}}" hidden>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('emission_reduction_plan_table')"
                            :title="__('emission reduction plan table')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->emission_reduction_plan_table ?? ''"
                            :date="$projectDetail->emission_reduction_plan_table_upload_date ?? ''"
                            :tooltip_title="__('雛形ファイルをダウンロードの上、ご作成ください。完成しましたら、当該ファイルをここにアップロードしてください。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('emission_reduction_plan_table')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="increased_emission_risk" class="mbs-input-required" :value="__('increased emission risk')" :title="__('プロジェクト実施に伴う他の場所での排出量の増加（リーケージ）、天候不順による影響、災害等による設備の破損など、最も大きいリスクを選んでください。')" />
                        <x-text-input id="increased_emission_risk" class="block mt-1 w-full" type="text" name="increased_emission_risk" :value="old('increased_emission_risk', $projectDetail->increased_emission_risk ?? '')" required />
                        <x-input-error :messages="$errors->get('increased_emission_risk')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('calculation_method_sheet')"
                            :title="__('calculation method sheet')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->calculation_method_sheet ?? ''"
                            :date="$projectDetail->calculation_method_sheet_upload_date ?? ''"
                            :tooltip_title="__('雛形ファイルをダウンロードの上、ご作成ください。完成しましたら、当該ファイルをここにアップロードしてください。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('calculation_method_sheet')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('initial_certification_period_amount')"
                            :title="__('initial certification period amount')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->initial_certification_period_amount ?? ''"
                            :date="$projectDetail->initial_certification_period_amount_upload_date ?? ''"
                            :tooltip_title="__('初回認証期間が過去日付の場合（既に実績の集計が完了している場合）のみ、ファイルをアップロードください。
対象ファイルの雛形は事務局より予めメールにて送付されます。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('initial_certification_period_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('above_based_raw_data')"
                            :title="__('above based raw data')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->above_based_raw_data ?? ''"
                            :date="$projectDetail->above_based_raw_data_upload_date ?? ''"
                            :tooltip_title="__('初回認証期間が過去日付の場合（既に実績の集計が完了している場合）のみ、ファイルをアップロードください。
対象ファイルの雛形は事務局より予めメールにて送付されます。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('above_based_raw_data')" class="mt-2" />
                    </div>

                    <x-project-form-button-group :step="$step"></x-project-form-button-group>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step == 4)
    <!-- Step 4 -->
    <div id="step-4" class="step">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="row">
                    <!-- <div class="mt-4 mb-4 font-xl font-bold">
                        {{__('プロジェクト計画書 (PDD-3)')}}
                    </div> -->

                    <input type="text" name="id" value= "{{$projectDetail->id ?? ''}}" hidden>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="person_responsible_monitoring_data" class="mbs-input-required" :value="__('person responsible monitoring data')" :title="__('責任者・担当者の組織名、部署名、役職名を記入してください。個人名は不要です。 ')" />
                        <x-text-input id="person_responsible_monitoring_data" class="block mt-1 w-full" type="text" name="person_responsible_monitoring_data" :value="old('person_responsible_monitoring_data', $projectDetail->person_responsible_monitoring_data ?? '')" required />
                        <x-input-error :messages="$errors->get('person_responsible_monitoring_data')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="monitoring_staff" class="mbs-input-required" :value="__('monitoring staff')" :title="__('責任者・担当者の組織名、部署名、役職名を記入してください。個人名は不要です。 ')" />
                        <x-text-input id="monitoring_staff" class="block mt-1 w-full" type="text" name="monitoring_staff" :value="old('monitoring_staff', $projectDetail->monitoring_staff ?? '')" required />
                        <x-input-error :messages="$errors->get('monitoring_staff')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="recording_storage_monitoring_data" class="mbs-input-required" :value="__('recording storage monitoring data')" :title="__('認証対象期間において複数の担当者がモニタリングを行う場合には、全ての責任者が適切にモニタリングデータの収集・記録・管理を行うための仕組みも併せて記載してください。')" />
                        <x-text-input id="recording_storage_monitoring_data" class="block mt-1 w-full" type="text" name="recording_storage_monitoring_data" :value="old('recording_storage_monitoring_data', $projectDetail->recording_storage_monitoring_data ?? '')" required />
                        <x-input-error :messages="$errors->get('recording_storage_monitoring_data')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="monitoring_frequency" class="mbs-input-required" :value="__('monitoring frequency')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="monitoring_frequency" class="block mt-1 w-full" type="text" name="monitoring_frequency" :value="old('monitoring_frequency', $projectDetail->monitoring_frequency ?? '')" required />
                        <x-input-error :messages="$errors->get('monitoring_frequency')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="data_storage_period" class="mbs-input-required" :value="__('data storage period')" :title="__('原則として、認証対象期間終了後２年間とする。')" />
                        <x-text-input id="data_storage_period" class="block mt-1 w-full" type="text" name="data_storage_period" :value="old('data_storage_period', $projectDetail->data_storage_period ?? '')" required />
                        <x-input-error :messages="$errors->get('data_storage_period')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="monitoring_items" class="mbs-input-required" :value="__('monitoring items')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="monitoring_items" class="block mt-1 w-full" type="text" name="monitoring_items" :value="old('monitoring_items', $projectDetail->monitoring_items ?? '')" required />
                        <x-input-error :messages="$errors->get('monitoring_items')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('monitoring_point_diagram')"
                            :title="__('monitoring point diagram')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->monitoring_point_diagram ?? ''"
                            :date="$projectDetail->monitoring_point_diagram_upload_date ?? ''"
                            :tooltip_title="__('計量器によるモニタリングポイントを図示してください。必ずしも個別項目ごとに図を作成する必要はなく、一つの図で全てのモニタリングポイントを示しても問題ありません。複数の図を作成する場合は、記入枠を必要に応じてコピーしてください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('monitoring_point_diagram')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="measurement_activity_amount" class="mbs-input-required" :value="__('measurement activity amount')" :title="__('計量器での実測の場合はその方法を、概算算定の場合はそのロジックを詳細に記載してください。')" />
                        <x-text-input id="measurement_activity_amount" class="block mt-1 w-full" type="text" name="measurement_activity_amount" :value="old('measurement_activity_amount',  $projectDetail->measurement_activity_amount ?? '')" required />
                        <x-input-error :messages="$errors->get('measurement_activity_amount')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="coefficient1_basic_unit" class="mbs-input-required" :value="__('coefficient1 basic unit')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="coefficient1_basic_unit" class="block mt-1 w-full" type="text" name="coefficient1_basic_unit" :value="old('coefficient1_basic_unit',  $projectDetail->coefficient1_basic_unit ?? '')" required />
                        <x-input-error :messages="$errors->get('coefficient1_basic_unit')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="coefficient2_emission" class="mbs-input-required" :value="__('coefficient2 emission')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="coefficient2_emission" class="block mt-1 w-full" type="text" name="coefficient2_emission" :value="old('coefficient2_emission', $projectDetail->coefficient2_emission ?? '')" required />
                        <x-input-error :messages="$errors->get('coefficient2_emission')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="coefficient3_other" class="mbs-input-required" :value="__('coefficient3 other')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="coefficient3_other" class="block mt-1 w-full" type="text" name="coefficient3_other" :value="old('coefficient3_other', $projectDetail->coefficient3_other ?? '')" required />
                        <x-input-error :messages="$errors->get('coefficient3_other')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="risk_occourrence_missing_values" class="mbs-input-required" :value="__('risk occourrence missing values')" :title="__('設置した機器におけるエラーや故障、通信回線の不具合等により情報を一時的に収集・把握できなくなる場合などは欠損値が生じます。そのような事象が発生していることを把握し、データ欠損部分を除外して算定する等、適切に算定を行ってください。なお、故障して稼働しない/撤去しているなどの場合は算定対象から除外が必要です。')"  />
                        <x-text-input id="risk_occourrence_missing_values" class="block mt-1 w-full" type="text" name="risk_occourrence_missing_values" :value="old('risk_occourrence_missing_values', $projectDetail->risk_occourrence_missing_values ?? '')" required />
                        <x-input-error :messages="$errors->get('risk_occourrence_missing_values')" class="mt-2" />
                    </div>

                    <div class="mt-4  col-md-12">
                        <x-input-label for="concept_correction_missing_values" class="mbs-input-required" :value="__('concept correction missing values')" :title="__('*Excelのどこをリファー？')" />
                        <x-text-input id="concept_correction_missing_values" class="block mt-1 w-full" type="text" name="concept_correction_missing_values" :value="old('concept_correction_missing_values', $projectDetail->concept_correction_missing_values ?? '')" required />
                        <x-input-error :messages="$errors->get('concept_correction_missing_values')" class="mt-2" />
                    </div>

                    <x-project-form-button-group :step="$step"></x-project-form-button-group>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($step == 5)
    <div id="step-5" class="step">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-4 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="row">
                    <!-- <div class="mt-4 mb-4 font-xl font-bold">
                        {{__('ESG+E評価')}}
                    </div> -->
                    <input type="text" name="id" value= "{{$projectDetail->id ?? ''}}" hidden>

                    <div class="mt-4  col-md-12">
                        <x-upload-container
                            :name="__('esg_economic_evaluation')"
                            :title="__('esg economic evaluation')"
                            :description="__('テキストテキストテキスト')"
                            :link="$projectDetail->esg_economic_evaluation ?? ''"
                            :date="$projectDetail->esg_economic_evaluation_upload_date ?? ''"
                            :tooltip_title="__('雛形ファイルをダウンロードの上、ご作成ください。完成しましたら、当該ファイルをここにアップロードしてください。ファイル作成にあたっての各種不明点は事務局にお問い合わせください。')"
                            >
                        </x-upload-container>
                        <x-input-error :messages="$errors->get('esg_economic_evaluation')" class="mt-2" />
                    </div>

                    <div class="mt-4 col-md-12">
                        <div class="d-flex align-items-start">
                            <x-checkbox-input name="pledge_compliance" id="pledge_compliance" class="mt-1" :checked="($projectDetail->pledge_compliance ?? '') == 'on'" />
                            <div>
                                <x-input-label for="pledge_compliance" :value="__('pledge compliance')" :title="__('')" />
                                <x-input-error :messages="$errors->get('pledge_compliance')" class="mt-2" />
                                <a href="#" class="underline text-gray-600">read statement</a>
                            </div>
                        </div>
                    </div>
                    <x-project-form-button-group :step="$step"></x-project-form-button-group>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>

<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/multi-step.css')}}"/>

<script>
    var currentTabPre = {{ $step }}; // Current tab is set to be the first tab (0)
    var currentTab = currentTabPre - 1;
    showTab(currentTab); // Display the current tab
    
    function showTab(n) {
        fixStepIndicator(n)
    }
 
    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("stepIndicator");
        for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    document.addEventListener('DOMContentLoaded', function () {
        const temporarySaveButton = document.querySelector('button[name="action"][value="temporary_save"]');
        const form = document.getElementById('projectDetailForm'); // Target form by ID

        temporarySaveButton.addEventListener('click', function (event) {
            form.setAttribute('novalidate', true);

            let actionField = document.createElement('input');
            actionField.setAttribute('type', 'hidden');
            actionField.setAttribute('name', 'action');
            actionField.setAttribute('value', 'temporary_save');

            form.appendChild(actionField);

            form.submit();
        });

        //Previous button
        const prevStepButton = document.querySelector('button[name="action"][value="prev_step"]');
        prevStepButton.addEventListener('click', function (event) {
            form.setAttribute('novalidate', true);

            let actionField = document.createElement('input');
            actionField.setAttribute('type', 'hidden');
            actionField.setAttribute('name', 'action');
            actionField.setAttribute('value', 'prev_step');

            form.appendChild(actionField);

            form.submit();
        })
    });

</script>


<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'click'
        });

        $(document).on('click', function (e) {
            if (!$('[data-toggle="tooltip"]').is(e.target) && $('[data-toggle="tooltip"]').has(e.target).length === 0 && $('.tooltip').has(e.target).length === 0) {
                $('[data-toggle="tooltip"]').tooltip('hide');
            }
        });
    });
</script>