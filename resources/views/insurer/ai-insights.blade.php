@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-4">
    @include('insurer._partials.page-header', [
        'title' => 'AI Insights',
        'subtitle' => 'AI-powered analytics and recommendations',
        'icon' => 'bi-magic'
    ])

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-lightning-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Active Insights</h6>
                            <h4 class="mb-0 fw-bold">5</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-trophy-fill text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Opportunities</h6>
                            <h4 class="mb-0 fw-bold">3</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Risks Detected</h6>
                            <h4 class="mb-0 fw-bold">2</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-graph-up-arrow text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 text-muted">Confidence Score</h6>
                            <h4 class="mb-0 fw-bold">87%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Growth Opportunities</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3 p-3 bg-success bg-opacity-10 rounded">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Expand to Northern Region</h6>
                            <p class="text-muted small mb-2">High demand detected in Arusha and Kilimanjaro regions with low competition.</p>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2">Potential Revenue:</small>
                                <span class="fw-bold text-success">TZS 45M/month</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3 p-3 bg-success bg-opacity-10 rounded">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Launch Micro-Insurance Product</h6>
                            <p class="text-muted small mb-2">Untapped market for low-premium, high-volume micro-insurance products.</p>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2">Potential Customers:</small>
                                <span class="fw-bold text-success">50,000+</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start p-3 bg-success bg-opacity-10 rounded">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Partner with Mobile Money Providers</h6>
                            <p class="text-muted small mb-2">Integration with M-Pesa and Tigo Pesa could increase premium collection by 40%.</p>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2">Expected Growth:</small>
                                <span class="fw-bold text-success">+40%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Risk Alerts</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3 p-3 bg-warning bg-opacity-10 rounded">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">High Claim Ratio in Motor Insurance</h6>
                            <p class="text-muted small mb-2">Motor insurance claim ratio has increased to 78% in the last quarter.</p>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2">Severity:</small>
                                <span class="badge bg-warning">Medium</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start p-3 bg-danger bg-opacity-10 rounded">
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Fraud Pattern Detected</h6>
                            <p class="text-muted small mb-2">Unusual claim patterns detected from 3 specific brokers requiring investigation.</p>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-2">Severity:</small>
                                <span class="badge bg-danger">High</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Customer Sentiment</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-success">4.2</div>
                        <div class="text-muted">out of 5.0</div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>5 stars</small>
                            <small>45%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>4 stars</small>
                            <small>30%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>3 stars</small>
                            <small>15%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 15%"></div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between mb-1">
                            <small>2 stars</small>
                            <small>7%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-danger" style="width: 7%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <small>1 star</small>
                            <small>3%</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-danger" style="width: 3%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">Performance Metrics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Policy Renewal Rate</small>
                            <small class="fw-bold">78%</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Claims Processing Time</small>
                            <small class="fw-bold">5.2 days</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>Customer Acquisition Cost</small>
                            <small class="fw-bold">TZS 15,000</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <small>Net Promoter Score</small>
                            <small class="fw-bold">42</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">AI Recommendations</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                            <i class="bi bi-lightning-fill text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold small mb-1">Optimize Pricing</h6>
                            <p class="text-muted small mb-0">Consider dynamic pricing for motor insurance based on driver behavior data.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                            <i class="bi bi-lightning-fill text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold small mb-1">Improve Claims Process</h6>
                            <p class="text-muted small mb-0">Implement AI-assisted document verification to reduce processing time by 30%.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                            <i class="bi bi-lightning-fill text-primary"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold small mb-1">Enhance Customer Support</h6>
                            <p class="text-muted small mb-0">Deploy chatbot for 24/7 customer inquiries to improve satisfaction scores.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent AI Analysis</h5>
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-repeat me-1"></i> Refresh Analysis
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Analysis Type</th>
                            <th>Insight</th>
                            <th>Confidence</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary">Market Analysis</span></td>
                            <td>Northern region expansion opportunity</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 92%"></div>
                                    </div>
                                    <small>92%</small>
                                </div>
                            </td>
                            <td>Today, 10:30 AM</td>
                            <td><span class="badge bg-success">New</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-warning">Risk Assessment</span></td>
                            <td>Motor insurance claim ratio increase</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 85%"></div>
                                    </div>
                                    <small>85%</small>
                                </div>
                            </td>
                            <td>Today, 09:15 AM</td>
                            <td><span class="badge bg-warning">Review</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-info">Customer Behavior</span></td>
                            <td>High churn risk in health insurance segment</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-info" style="width: 78%"></div>
                                    </div>
                                    <small>78%</small>
                                </div>
                            </td>
                            <td>Yesterday, 4:45 PM</td>
                            <td><span class="badge bg-secondary">Reviewed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
