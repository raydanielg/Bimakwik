<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compliance Report #{{ $report->id }}</title>
    <style>
        @page {
            margin: 100px 50px 80px 50px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
            position: relative;
        }
        
        /* Watermark */
        body::before {
            content: "CONFIDENTIAL";
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120pt;
            font-weight: bold;
            color: rgba(200, 200, 200, 0.15);
            z-index: -1;
            white-space: nowrap;
            pointer-events: none;
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #0d6efd;
        }
        
        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        
        .company-name {
            font-size: 24pt;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 5px;
        }
        
        .company-tagline {
            font-size: 10pt;
            color: #666;
            margin-bottom: 15px;
        }
        
        .report-title {
            font-size: 18pt;
            font-weight: bold;
            color: #333;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Document Info */
        .document-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #0d6efd;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            font-weight: bold;
            padding: 5px 15px 5px 0;
            width: 30%;
            color: #555;
        }
        
        .info-value {
            display: table-cell;
            padding: 5px 0;
            color: #333;
        }
        
        /* Section Headers */
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .section-content {
            padding-left: 10px;
            text-align: justify;
        }
        
        /* Lists */
        .checklist {
            list-style: none;
            padding: 0;
        }
        
        .checklist li {
            padding: 8px 0;
            padding-left: 30px;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .checklist li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #28a745;
            font-weight: bold;
            font-size: 14pt;
        }
        
        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        table th {
            background: #0d6efd;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 10pt;
        }
        
        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e9ecef;
        }
        
        table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }
        
        /* Footer Info */
        .footer-info {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            font-size: 9pt;
            color: #666;
        }
        
        .signature-section {
            margin-top: 50px;
            page-break-inside: avoid;
        }
        
        .signature-box {
            display: inline-block;
            width: 45%;
            margin-right: 5%;
            vertical-align: top;
        }
        
        .signature-line {
            border-top: 2px solid #333;
            margin-top: 60px;
            padding-top: 5px;
            text-align: center;
        }
        
        /* Page Numbers */
        .page-number {
            position: fixed;
            bottom: 30px;
            right: 50px;
            font-size: 9pt;
            color: #666;
        }
        
        /* Security Notice */
        .security-notice {
            background: #fff3cd;
            border: 2px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            color: #856404;
        }
        
        /* Prevent copying */
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-name">BIMAKWIK</div>
        <div class="company-tagline">Insurance Aggregation Platform</div>
        <div class="report-title">Compliance & Regulatory Report</div>
    </div>
    
    <!-- Security Notice -->
    <div class="security-notice">
        ⚠️ CONFIDENTIAL DOCUMENT - NOT FOR DISTRIBUTION ⚠️
    </div>
    
    <!-- Document Information -->
    <div class="document-info">
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Report ID:</div>
                <div class="info-value">#{{ $report->id }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Report Type:</div>
                <div class="info-value">{{ $report->report_type ?? 'Compliance Report' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="badge badge-{{ $report->status == 'approved' ? 'success' : ($report->status == 'pending' ? 'warning' : 'info') }}">
                        {{ strtoupper($report->status ?? 'PENDING') }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Generated Date:</div>
                <div class="info-value">{{ $generatedDate }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Generated Time:</div>
                <div class="info-value">{{ $generatedTime }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Generated By:</div>
                <div class="info-value">{{ $generatedBy }}</div>
            </div>
        </div>
    </div>
    
    <!-- Executive Summary -->
    <div class="section">
        <div class="section-title">1. Executive Summary</div>
        <div class="section-content">
            <p>
                This compliance report provides a comprehensive overview of regulatory adherence and compliance status 
                for the Bimakwik insurance aggregation platform. The report covers all aspects of TIRA (Tanzania 
                Insurance Regulatory Authority) requirements and industry best practices.
            </p>
            <p style="margin-top: 10px;">
                {{ $report->description ?? 'This report demonstrates our commitment to maintaining the highest standards of regulatory compliance and operational excellence.' }}
            </p>
        </div>
    </div>
    
    <!-- Compliance Checklist -->
    <div class="section">
        <div class="section-title">2. Compliance Checklist</div>
        <div class="section-content">
            <ul class="checklist">
                <li>TIRA Registration and Licensing Requirements</li>
                <li>Financial Solvency and Capital Adequacy</li>
                <li>Data Protection and Privacy Compliance (GDPR/Local Laws)</li>
                <li>Anti-Money Laundering (AML) Procedures</li>
                <li>Know Your Customer (KYC) Verification</li>
                <li>Claims Processing Standards</li>
                <li>Premium Collection and Remittance</li>
                <li>Customer Complaint Handling</li>
                <li>Risk Management Framework</li>
                <li>Audit and Internal Controls</li>
            </ul>
        </div>
    </div>
    
    <!-- Regulatory Framework -->
    <div class="section">
        <div class="section-title">3. Regulatory Framework</div>
        <div class="section-content">
            <table>
                <thead>
                    <tr>
                        <th>Regulation</th>
                        <th>Requirement</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TIRA Act 2009</td>
                        <td>Insurance Aggregator License</td>
                        <td><span class="badge badge-success">Compliant</span></td>
                    </tr>
                    <tr>
                        <td>Data Protection Act</td>
                        <td>Customer Data Security</td>
                        <td><span class="badge badge-success">Compliant</span></td>
                    </tr>
                    <tr>
                        <td>AML Regulations</td>
                        <td>Transaction Monitoring</td>
                        <td><span class="badge badge-success">Compliant</span></td>
                    </tr>
                    <tr>
                        <td>Consumer Protection</td>
                        <td>Fair Treatment of Customers</td>
                        <td><span class="badge badge-success">Compliant</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Key Findings -->
    <div class="section">
        <div class="section-title">4. Key Findings</div>
        <div class="section-content">
            <p><strong>Strengths:</strong></p>
            <ul class="checklist">
                <li>Robust compliance management system in place</li>
                <li>Regular internal audits and reviews conducted</li>
                <li>Strong data protection and privacy measures</li>
                <li>Effective risk management framework</li>
            </ul>
            
            <p style="margin-top: 15px;"><strong>Areas for Improvement:</strong></p>
            <ul style="list-style: disc; padding-left: 30px;">
                <li>Enhanced staff training on new regulations</li>
                <li>Automation of compliance reporting processes</li>
                <li>Strengthening of third-party vendor assessments</li>
            </ul>
        </div>
    </div>
    
    <!-- Recommendations -->
    <div class="section">
        <div class="section-title">5. Recommendations</div>
        <div class="section-content">
            <ol style="padding-left: 20px;">
                <li style="margin-bottom: 10px;">
                    <strong>Continuous Monitoring:</strong> Implement real-time compliance monitoring systems to identify 
                    and address potential issues proactively.
                </li>
                <li style="margin-bottom: 10px;">
                    <strong>Staff Training:</strong> Conduct quarterly compliance training sessions for all staff members 
                    to ensure awareness of regulatory requirements.
                </li>
                <li style="margin-bottom: 10px;">
                    <strong>Technology Upgrade:</strong> Invest in advanced compliance management software to streamline 
                    reporting and documentation processes.
                </li>
                <li style="margin-bottom: 10px;">
                    <strong>Regular Audits:</strong> Schedule bi-annual internal audits and annual external audits to 
                    maintain compliance standards.
                </li>
            </ol>
        </div>
    </div>
    
    <!-- Conclusion -->
    <div class="section">
        <div class="section-title">6. Conclusion</div>
        <div class="section-content">
            <p>
                Bimakwik demonstrates a strong commitment to regulatory compliance and adherence to TIRA requirements. 
                The platform maintains robust systems and processes to ensure ongoing compliance with all applicable 
                regulations and industry standards.
            </p>
            <p style="margin-top: 10px;">
                This report confirms that all critical compliance areas have been addressed, and the organization is 
                well-positioned to maintain its regulatory standing while continuing to serve customers effectively.
            </p>
        </div>
    </div>
    
    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line">
                <strong>Compliance Officer</strong><br>
                {{ $generatedBy }}<br>
                Date: {{ $generatedDate }}
            </div>
        </div>
        <div class="signature-box">
            <div class="signature-line">
                <strong>Chief Executive Officer</strong><br>
                Bimakwik Ltd<br>
                Date: {{ $generatedDate }}
            </div>
        </div>
    </div>
    
    <!-- Footer Information -->
    <div class="footer-info">
        <p style="text-align: center;">
            <strong>CONFIDENTIAL & PROPRIETARY</strong><br>
            This document contains confidential information and is intended solely for the use of authorized personnel.<br>
            Unauthorized copying, distribution, or use of this document is strictly prohibited.<br>
            <br>
            <strong>Bimakwik Insurance Aggregation Platform</strong><br>
            Email: compliance@bimakwik.com | Phone: +255 XXX XXX XXX<br>
            © {{ date('Y') }} Bimakwik Ltd. All Rights Reserved.
        </p>
    </div>
</body>
</html>
