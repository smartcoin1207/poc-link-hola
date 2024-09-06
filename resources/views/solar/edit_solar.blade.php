<div class="form-group">
    <label for="date">利用年月</label>
    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label for="customer_number">顧客番号</label>
    <input type="text" class="form-control @error('customer_number') is-invalid @enderror" id="customer_number" name="customer_number">
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label for="serial_number">GW製造番号</label>
    <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="electricity_number">電気番号</label>
    <input type="text" class="form-control @error('electricity_number') is-invalid @enderror" id="electricity_number" name="electricity_number" >
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="connection_date">連系日</label>
    <input type="date" class="form-control @error('connection_date') is-invalid @enderror" id="connection_date" name="connection_date">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="start_date">利用開始日</label>
    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="end_date">利用終了日</label>
    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" >
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="generation_billing">発電量_請求</label>
    <input type="text" class="form-control @error('generation_billing') is-invalid @enderror" id="generation_billing" name="generation_billing">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="power_sales">余剰売電量(kWh)</label>
    <input type="text" class="form-control @error('power_sales') is-invalid @enderror" id="power_sales" name="power_sales">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="self_consumption">自家消費(kWh)</label>
    <input type="text" class="form-control @error('self_consumption') is-invalid @enderror" id="self_consumption" name="self_consumption">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="meter_reading_date">基本検針日</label>
    <input type="text" class="form-control @error('meter_reading_date') is-invalid @enderror" id="meter_reading_date" name="meter_reading_date">
    <div class="invalid-feedback"></div>

</div>

<div class="form-group">
    <label for="address">住所</label>
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address">
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label for="billing">請求</label>
    <input type="text" class="form-control @error('billing') is-invalid @enderror" id="billing" name="billing">
    <div class="invalid-feedback"></div>
</div>

<div class="form-group">
    <label for="comment">処理コメント</label>
    <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment">
    <div class="invalid-feedback"></div>
</div>