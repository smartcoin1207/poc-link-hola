<x-app-layout>
@include('partials.dashboard._custom_head')

<div class="page-content">
            <div class="wizard-v1-content">
                <div class="wizard-form">
                    <form class="form-upload" id="form-upload" action="{{route('solar.calculate.upload_csv')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2>
                            <div class="title-label" style="text-align: center;">CSVファイルをアップロード</div>
                        </h2>
                        <section>
                            <div class="inner" style="margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="csv_file" name="csv_file"  accept=".csv" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" style="padding: 0 13px;">
                                            <input type="checkbox" id="is_correction_data" name="is_correction_data" value="1">
                                            <label for="is_correction_data" style="margin-bottom: 0;">補正されたデータですか？</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="アップロード">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
