@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1"><i class="bi bi-wallet2 me-2"></i>Wallet & Balances</h2>
                <p class="text-muted small mb-0">Manage platform wallets and financial balances</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary rounded-pill px-4" onclick="showAddWalletModal()">
                    <i class="bi bi-plus-circle me-2"></i>Add Wallet
                </button>
            </div>
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
                                $userRole = optional(optional($wallet->user)->roles->first())->name ?? $wallet->user_type ?? 'system';
                                $roleColors = [
                                    'insurer' => 'primary',
                                    'broker' => 'success',
                                    'aggregator' => 'info',
                                    'agent' => 'warning',
                                    'service_provider' => 'secondary',
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
                                <button class="btn btn-outline-success" onclick="showAddFundsModal({{ $wallet->id }}, @js($wallet->user->name ?? 'Wallet'))" title="Add Funds">
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

<!-- Add Funds Modal -->
<div class="modal fade" id="addFundsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Add Funds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Adding funds to: <strong id="walletOwnerName"></strong>
                </div>
                <form id="addFundsForm">
                    @csrf
                    <input type="hidden" id="walletId" name="wallet_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount (TZS)</label>
                        <input type="number" class="form-control" id="fundAmount" name="amount" placeholder="Enter amount" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" name="description" rows="2" placeholder="Reason for adding funds"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitAddFunds()">
                    <i class="bi bi-check-circle me-2"></i>Add Funds
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Transactions Modal -->
<div class="modal fade" id="transactionsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold"><i class="bi bi-list-ul me-2"></i>Recent Transactions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody id="transactionsList">
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                    <span class="ms-2">Loading...</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function getOrCreateBsModal(id) {
    const el = document.getElementById(id);
    if (!el) return null;
    return bootstrap.Modal.getOrCreateInstance(el);
}

function cleanupModalBackdrops() {
    if (document.querySelectorAll('.modal.show').length === 0) {
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
        document.querySelectorAll('.modal-backdrop').forEach((el) => el.remove());
        document.querySelectorAll('.modal').forEach((el) => {
            el.classList.remove('show');
            el.setAttribute('aria-hidden', 'true');
            el.style.display = 'none';
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    ['addWalletModal', 'addFundsModal', 'transactionsModal'].forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('hidden.bs.modal', cleanupModalBackdrops);
        }
    });
});

function showAddWalletModal() {
    cleanupModalBackdrops();
    const addWalletModal = getOrCreateBsModal('addWalletModal');
    addWalletModal?.show();
}

function submitWalletForm() {
    Swal.fire({
        title: 'Creating Wallet...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Wallet Created!',
            text: 'The wallet has been created successfully',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            const addWalletModal = getOrCreateBsModal('addWalletModal');
            addWalletModal?.hide();
            cleanupModalBackdrops();
            location.reload();
        });
    }, 1500);
}

function showAddFundsModal(walletId, ownerName) {
    document.getElementById('walletId').value = walletId;
    document.getElementById('walletOwnerName').textContent = ownerName;
    document.getElementById('fundAmount').value = '';
    const addFundsModal = getOrCreateBsModal('addFundsModal');
    addFundsModal?.show();
}

function submitAddFunds() {
    const walletId = document.getElementById('walletId').value;
    const amount = document.getElementById('fundAmount').value;
    
    if (!amount || amount <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Amount',
            text: 'Please enter a valid amount'
        });
        return;
    }
    
    Swal.fire({
        title: 'Adding Funds...',
        text: 'Please wait',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: `/admin/finance/wallets/${walletId}/add-funds`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            amount: amount
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Funds Added!',
                text: `Successfully added TZS ${amount}`,
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                const addFundsModal = getOrCreateBsModal('addFundsModal');
                addFundsModal?.hide();
                cleanupModalBackdrops();
                location.reload();
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Failed to add funds. Please try again.'
            });
        }
    });
}

function viewWallet(walletId) {
    window.location.href = `/admin/finance/wallets/${walletId}`;
}

function viewTransactions(walletId) {
    const transactionsModal = getOrCreateBsModal('transactionsModal');
    transactionsModal?.show();

    const txList = document.getElementById('transactionsList');
    txList.innerHTML = `
        <tr>
            <td colspan="4" class="text-center py-3">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                <span class="ms-2">Loading...</span>
            </td>
        </tr>
    `;

    $.ajax({
        url: `/admin/finance/wallets/${walletId}/transactions`,
        method: 'GET',
        success: function(response) {
            if (!response.success || !Array.isArray(response.transactions) || response.transactions.length === 0) {
                txList.innerHTML = '<tr><td colspan="4" class="text-center py-3 text-muted">No transactions found</td></tr>';
                return;
            }

            txList.innerHTML = response.transactions.map((tx) => {
                const isCredit = String(tx.type).toLowerCase() === 'credit';
                const badgeClass = isCredit ? 'success' : 'danger';
                const label = tx.type ? tx.type.charAt(0).toUpperCase() + tx.type.slice(1) : 'N/A';
                return `
                    <tr>
                        <td><small>${tx.date}</small></td>
                        <td><span class="badge bg-${badgeClass} bg-opacity-10 text-${badgeClass}">${label}</span></td>
                        <td><strong>TZS ${tx.amount}</strong></td>
                        <td><small>${tx.description}</small></td>
                    </tr>
                `;
            }).join('');
        },
        error: function(xhr) {
            const msg = xhr.responseJSON?.message || 'Failed to load transactions';
            txList.innerHTML = `<tr><td colspan="4" class="text-center py-3 text-danger">${msg}</td></tr>`;
        }
    });
}

function freezeWallet(walletId) {
    Swal.fire({
        title: 'Freeze Wallet?',
        text: 'This will prevent all transactions on this wallet',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, freeze it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/finance/wallets/${walletId}/freeze`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Wallet Frozen!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                },
                error: function() {
                    const message = arguments[0]?.responseJSON?.message || 'Failed to freeze wallet';
                    Swal.fire('Error', message, 'error');
                }
            });
        }
    });
}

function activateWallet(walletId) {
    Swal.fire({
        title: 'Activate Wallet?',
        text: 'This will allow transactions on this wallet',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, activate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/finance/wallets/${walletId}/activate`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Wallet Activated!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                },
                error: function() {
                    const message = arguments[0]?.responseJSON?.message || 'Failed to activate wallet';
                    Swal.fire('Error', message, 'error');
                }
            });
        }
    });
}
</script>
@endpush
@endsection
