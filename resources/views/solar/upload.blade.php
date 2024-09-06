<x-app-layout>
<div class="page-content" style="background-image: url('assets/images/wizard-v1.jpg')">
            <div class="wizard-v1-content">
                <div class="wizard-form">
                    <form class="form-upload" id="form-upload" action="{{route('solar.calculate.upload_csv')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h2>
                            <div class="title-label" style="text-align: center;">CSVファイルをアップロード</div>
                        </h2>
                        <section>
                            <div class="inner" style="margin-top: 10px;">
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <input type="file" class="form-control" id="csv_file" name="csv_file"  accept=".csv" required>
                                        <!-- <label for="csv_file" style="color: black;">file upload</label> -->
                                    </div>
                                    <div class="form-group" style="padding: 0 13px;">
                                        <input type="checkbox" id="is_correction_data" name="is_correction_data" value="1">
                                        <label for="is_correction_data" style="margin-bottom: 0;">補正されたデータですか？</label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <input type="submit" class="btn" style="float: right; padding: 10px; background-color:darkblue; border-radius: 10px; color: white;" value="アップロード">
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
