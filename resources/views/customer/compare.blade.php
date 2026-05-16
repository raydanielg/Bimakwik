@extends('layouts.dashboard')

@section('dashboard_title', 'Compare Insurance Plans')

@section('dashboard_content')
<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-columns-gap me-2"></i>
            Linganisha Mipango ya Bima
        </h2>
        <p class="text-muted">Linganisha bei, faida, na ushindi wa mipango mbalimbali</p>
    </div>
</div>

<!-- Product Type Selector -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <label class="fw-bold mb-3">Chagua Aina ya Bima</label>
                <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="product_type" id="motor" value="motor" checked>
                    <label class="btn btn-outline-primary" for="motor">Motor</label>

                    <input type="radio" class="btn-check" name="product_type" id="health" value="health">
                    <label class="btn btn-outline-primary" for="health">Health</label>

                    <input type="radio" class="btn-check" name="product_type" id="property" value="property">
                    <label class="btn btn-outline-primary" for="property">Property</label>

                    <input type="radio" class="btn-check" name="product_type" id="travel" value="travel">
                    <label class="btn btn-outline-primary" for="travel">Travel</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comparison Table -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="border-bottom-2">
                                <th class="fw-bold py-3" width="25%">Sifa</th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-file-earmark-text" style="font-size: 1.5rem;"></i>
                                        <span class="mt-2">Basic</span>
                                        <small class="text-muted">TZS 50,000</small>
                                    </div>
                                </th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-star-fill" style="font-size: 1.5rem; color: #ffc107;"></i>
                                        <span class="mt-2">Standard</span>
                                        <small class="text-muted">TZS 100,000</small>
                                    </div>
                                </th>
                                <th class="fw-bold text-center py-3" width="25%">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-gem" style="font-size: 1.5rem; color: #dc3545;"></i>
                                        <span class="mt-2">Premium</span>
                                        <small class="text-muted">TZS 200,000</small>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Coverage -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-shield-check me-2"></i> Ushindi
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Ushindi wa Kuu</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Ushindi wa Ziada</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Jumla ya Ushindi</td>
                                <td class="text-center">
                                    <strong>TZS 50,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 100,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 200,000</strong>
                                </td>
                            </tr>

                            <!-- Deductibles -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-cash me-2"></i> Tangazo na Huduma
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tangazo la Kawaida</td>
                                <td class="text-center">
                                    <strong>TZS 10,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>TZS 5,000</strong>
                                </td>
                                <td class="text-center">
                                    <strong>Bila Tangazo</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Huduma za Kuzunguka Saa</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>

                            <!-- Support -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-headset me-2"></i> Msaada na Huduma
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kujuta na Simu</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Msaada wa WhatsApp</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Werevu wa Kibinafsi</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>

                            <!-- Additional Features -->
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold py-3">
                                    <i class="bi bi-star me-2"></i> Sifa za Ziada
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mgogoro wa Heri</td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger">✗ Hapana</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Mpangilio wa Mishahara</td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">✓ Ndio</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route('customer.buy') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-cart-plus me-2"></i> Nunua Sasa
            </a>
            <a href="{{ route('customer.marketplace') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left me-2"></i> Rudi kwenye Marketplace
            </a>
        </div>
    </div>
</div>

<!-- Comparison Tips -->
<div class="row mt-5">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-lightbulb me-2"></i> Kidogo Katika Kuchagua
                </h5>
                <ul class="mb-0">
                    <li class="mb-2"><strong>Basic Plan:</strong> Mzuri kwa walioanza - ushindi mdogo lakini bei nafuu</li>
                    <li class="mb-2"><strong>Standard Plan:</strong> Kwa kawaida akili - usawa mzuri wa bei na ushindi</li>
                    <li class="mb-2"><strong>Premium Plan:</strong> Kwa wenye mahitaji mengi - ushindi kamili na huduma ya ziada</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .border-bottom-2 {
        border-bottom: 2px solid #dee2e6 !important;
    }

    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
</style>

<script>
    // Handle product type selection
    document.querySelectorAll('input[name="product_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            console.log('Selected product type:', this.value);
            // In a real implementation, this would load comparison data for the selected product
        });
    });
</script>
@endsection
