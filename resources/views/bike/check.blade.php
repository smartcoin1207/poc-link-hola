<x-app-layout>
@include('partials.dashboard._custom_head')
    <div class="page-content">
        <div class="wizard-v1-content">
            <div class="wizard-form">
                <form class="form-register" id="form-register">
                    <div id="form-total">
                        <h4 class="text-center">
                            <span class="step-text text-center">自動計算と検算</span>
                        </h4>
                        <section>
                            <div class="inner">
                                <div class="form-row table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="space-row">
                                                <th>ベースライン排出量 (EMBL):</th>
                                                <td id="embl-val">{{ $embl }}</td>
                                            </tr>
                                            <tr class="space-row">
                                                <th>プロジェクト実施後排出量 (EMPJ):</th>
                                                <td id="empj-val">{{ $empj }}</td>
                                            </tr>
                                            <tr class="space-row">
                                                <th>排出削減量 (ER):</th>
                                                <td id="er-val">{{ $er }}</td>
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
    <script>
        var bike_calculate_url = "{{ route('bike.form') }}"
    </script>
</x-app-layout>
