@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Wallet & Balances</h2>
                <p class="text-muted small mb-0">Manage platform wallets and financial balances</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addWalletModal">
                <i class="bi bi-plus-circle me-2"></i>Add Wallet
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Balance</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($totalBalance, 2) }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-wallet2 text-primary fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-{{ $balanceGrowth >= 0 ? 'success' : 'danger' }} bg-opacity-10 text-{{ $balanceGrowth >= 0 ? 'success' : 'danger' }}">
                        <i class="bi bi-arrow-{{ $balanceGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($balanceGrowth), 1) }}% from last month
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Active Wallets</p>
                        <h3 class="fw-bold mb-0">{{ number_format($activeWallets) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info bg-opacity-10 text-info">
                        All wallet types
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pending Withdrawals</p>
                        <h3 class="fw-bold mb-0">TZS {{ number_format($pendingAmount, 2) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-clock-history text-warning fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        {{ $pendingWithdrawals }} requests pending
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Today's Transactions</p>
                        <h3 class="fw-bold mb-0">{{ number_format($todayTransactions) }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-arrow-left-right text-info fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        TZS {{ number_format($todayVolume, 2) }} volume
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Wallets Table -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0 fw-bold">All Wallets</h5>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-light" placeholder="Search wallets...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3">Wallet Owner</th>
                        <th class="border-0 py-3">Type</th>
                        <th class="border-0 py-3">Balance</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Last Transaction</th>
                        <th class="border-0 py-3 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse([
                        ['name' => 'Jubilee Insurance', 'type' => 'Insurer', 'balance' => '12,450,000', 'status' => 'active', 'last_tx' => '2 hours ago'],
                        ['name' => 'AAR Insurance', 'type' => 'Insurer', 'balance' => '8,230,000', 'status' => 'active', 'last_tx' => '5 hours ago'],
                        ['name' => 'Broker Network Ltd', 'type' => 'Broker', 'balance' => '3,120,000', 'status' => 'active', 'last_tx' => '1 day ago'],
                        ['name' => 'Aggregator Hub', 'type' => 'Aggregator', 'balance' => '1,890,000', 'status' => 'pending', 'last_tx' => '3 days ago'],
                        ['name' => 'Service Provider Co', 'type' => 'Provider', 'balance' => '560,000', 'status' => 'active', 'last_tx' => '12 hours ago'],
                    ] as $wallet)
                    <tr>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-building text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $wallet['name'] }}</div>
                                    <small class="text-muted">ID: WAL-{{ rand(1000, 9999) }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-{{ $wallet['type'] == 'Insurer' ? 'primary' : ($wallet['type'] == 'Broker' ? 'success' : 'info') }} bg-opacity-10 text-{{ $wallet['type'] == 'Insurer' ? 'primary' : ($wallet['type'] == 'Broker' ? 'success' : 'info') }}">
                                {{ $wallet['type'] }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-semibold">TZS {{ $wallet['balance'] }}</span>
                        </td>
                        <td class="py-3">
                            @if($wallet['status'] == 'active')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Active
                                </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <small class="text-muted">{{ $wallet['last_tx'] }}</small>
                        </td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success" title="Add Funds">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Transactions">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted">No wallets found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1 to 5 of 24 wallets</small>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add Wallet Modal -->
<div class="modal fade" id="addWalletModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Add New Wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addWalletForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Owner Type</label>
                        <select class="form-select" required>
                            <option value="">Select type...</option>
                            <option value="insurer">Insurer</option>
                            <option value="broker">Broker</option>
                            <option value="aggregator">Aggregator</option>
                            <option value="provider">Service Provider</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Owner Name</label>
                        <input type="text" class="form-control" placeholder="Enter owner name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Initial Balance</label>
                        <input type="number" class="form-control" placeholder="0.00" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Currency</label>
                        <select class="form-select" required>
                            <option value="TZS">TZS - Tanzanian Shilling</option>
                            <option value="USD">USD - US Dollar</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitWalletForm()">
                    <i class="bi bi-check-circle me-2"></i>Create Wallet
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function submitWalletForm() {
    // Simulate form submission
    Swal.fire({
        title: 'Creating Wallet...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Simulate API call
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Wallet Created!',
            text: 'The wallet has been created successfully',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            $('#addWalletModal').modal('hide');
            location.reload();
        });
    }, 1500);
}
</script>
@endpush
@endsection
