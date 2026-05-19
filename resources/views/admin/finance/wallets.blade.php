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
                    @forelse($wallets as $wallet)
                    <tr>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-wallet2 text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $wallet->user->name ?? 'System Wallet' }}</div>
                                    <small class="text-muted">ID: #{{ $wallet->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            @php
                                $userRole = $wallet->user->role ?? 'system';
                                $roleColors = [
                                    'insurer' => 'primary',
                                    'broker' => 'success',
                                    'aggregator' => 'info',
                                    'agent' => 'warning',
                                    'customer' => 'secondary',
                                    'system' => 'dark'
                                ];
                                $color = $roleColors[$userRole] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} text-capitalize">
                                {{ $userRole }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-semibold">TZS {{ number_format($wallet->balance ?? 0, 2) }}</span>
                        </td>
                        <td class="py-3">
                            @if(($wallet->is_active ?? true))
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-check-circle"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-x-circle"></i> Frozen
                                </span>
                            @endif
                        </td>
                        <td class="py-3">
                            <small class="text-muted">{{ $wallet->updated_at ? $wallet->updated_at->diffForHumans() : 'N/A' }}</small>
                        </td>
                        <td class="py-3 text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="viewWallet({{ $wallet->id }})" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success" onclick="showAddFundsModal({{ $wallet->id }}, '{{ $wallet->user->name ?? 'Wallet' }}')" title="Add Funds">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <button class="btn btn-outline-info" onclick="viewTransactions({{ $wallet->id }})" title="Transactions">
                                    <i class="bi bi-list-ul"></i>
                                </button>
                                @if(($wallet->is_active ?? true))
                                <button class="btn btn-outline-danger" onclick="freezeWallet({{ $wallet->id }})" title="Freeze Wallet">
                                    <i class="bi bi-snow"></i>
                                </button>
                                @else
                                <button class="btn btn-outline-success" onclick="activateWallet({{ $wallet->id }})" title="Activate Wallet">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-0">No wallets found</p>
                            <small class="text-muted">Wallets will appear here</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($wallets->hasPages())
    <div class="card-footer bg-white border-top py-3">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing {{ $wallets->firstItem() }} to {{ $wallets->lastItem() }} of {{ $wallets->total() }} wallets</small>
            <div>
                {{ $wallets->links() }}
            </div>
        </div>
    </div>
    @endif
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
