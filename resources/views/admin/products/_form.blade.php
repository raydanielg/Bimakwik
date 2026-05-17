@php
    $product = $product ?? null;
    $benefits = old('benefits', $product && is_array($product->benefits) ? implode("\n", $product->benefits) : '');
    $exclusions = old('exclusions', $product && is_array($product->exclusions) ? implode("\n", $product->exclusions) : '');
    $premiumLogic = old('premium_calculation_logic', $product && $product->premium_calculation_logic ? json_encode($product->premium_calculation_logic, JSON_PRETTY_PRINT) : '');
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name ?? '') }}" required>
        @error('product_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="product_code" class="form-label">Product Code</label>
        <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" name="product_code" value="{{ old('product_code', $product->product_code ?? '') }}" required>
        @error('product_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="product_name_sw" class="form-label">Product Name Swahili</label>
        <input type="text" class="form-control @error('product_name_sw') is-invalid @enderror" id="product_name_sw" name="product_name_sw" value="{{ old('product_name_sw', $product->product_name_sw ?? '') }}">
        @error('product_name_sw')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="insurer_id" class="form-label">Insurer</label>
        <select class="form-select @error('insurer_id') is-invalid @enderror" id="insurer_id" name="insurer_id">
            <option value="">Platform product</option>
            @foreach($insurers as $insurer)
                <option value="{{ $insurer->id }}" @selected(old('insurer_id', $product->insurer_id ?? '') == $insurer->id)>{{ $insurer->name }}</option>
            @endforeach
        </select>
        @error('insurer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="policy_category_id" class="form-label">Category</label>
        <select class="form-select @error('policy_category_id') is-invalid @enderror" id="policy_category_id" name="policy_category_id">
            <option value="">Create new category below</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('policy_category_id', $product->policy_category_id ?? '') == $category->id)>{{ $category->category_name }}</option>
            @endforeach
        </select>
        @error('policy_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="new_category_name" class="form-label">New Category Name</label>
        <input type="text" class="form-control @error('new_category_name') is-invalid @enderror" id="new_category_name" name="new_category_name" value="{{ old('new_category_name') }}">
        @error('new_category_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="base_premium" class="form-label">Base Premium</label>
        <input type="number" step="0.01" min="0" class="form-control @error('base_premium') is-invalid @enderror" id="base_premium" name="base_premium" value="{{ old('base_premium', $product->base_premium ?? '') }}" required>
        @error('base_premium')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-2">
        <label for="currency" class="form-label">Currency</label>
        <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency" required>
            @foreach($currencies as $currency)
                <option value="{{ $currency }}" @selected(old('currency', $product->currency ?? 'TZS') === $currency)>{{ $currency }}</option>
            @endforeach
        </select>
        @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="min_age" class="form-label">Min Age</label>
        <input type="number" min="0" max="120" class="form-control @error('min_age') is-invalid @enderror" id="min_age" name="min_age" value="{{ old('min_age', $product->min_age ?? '') }}">
        @error('min_age')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-3">
        <label for="max_age" class="form-label">Max Age</label>
        <input type="number" min="0" max="120" class="form-control @error('max_age') is-invalid @enderror" id="max_age" name="max_age" value="{{ old('max_age', $product->max_age ?? '') }}">
        @error('max_age')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="benefits" class="form-label">Benefits</label>
        <textarea class="form-control @error('benefits') is-invalid @enderror" id="benefits" name="benefits" rows="5">{{ $benefits }}</textarea>
        <div class="form-text">One benefit per line.</div>
        @error('benefits')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="exclusions" class="form-label">Exclusions</label>
        <textarea class="form-control @error('exclusions') is-invalid @enderror" id="exclusions" name="exclusions" rows="5">{{ $exclusions }}</textarea>
        <div class="form-text">One exclusion per line.</div>
        @error('exclusions')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="premium_calculation_logic" class="form-label">Premium Calculation Logic JSON</label>
        <textarea class="form-control @error('premium_calculation_logic') is-invalid @enderror" id="premium_calculation_logic" name="premium_calculation_logic" rows="5">{{ $premiumLogic }}</textarea>
        @error('premium_calculation_logic')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
            <label class="form-check-label" for="is_active">Active product</label>
        </div>
    </div>
</div>
