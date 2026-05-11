<?php
/**
 * BIMA KWIK - COMPLETE SYSTEM DOCUMENTATION
 * Version: 1.0
 * Author: Bima Kwik Team
 * Description: Complete system documentation for all roles, menus, database, workflows, and APIs
 */

// Set page title
$page_title = "Bima Kwik - Complete System Documentation";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete system documentation for Bima Kwik Insurance Platform">
    <meta name="author" content="Bima Kwik Team">
    <title><?php echo $page_title; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Prism.js for Code Highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            line-height: 1.6;
            scroll-behavior: smooth;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            border-right: 1px solid #334155;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            border-bottom: 1px solid #334155;
            text-align: center;
        }
        
        .sidebar-header h2 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .sidebar-header p {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 8px;
        }
        
        .sidebar-nav {
            padding: 20px 0;
        }
        
        .nav-category {
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
        }
        
        .nav-item {
            display: block;
            padding: 10px 20px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .nav-item:hover {
            background: rgba(96, 165, 250, 0.1);
            color: #60a5fa;
            border-left-color: #60a5fa;
        }
        
        .nav-item.active {
            background: rgba(96, 165, 250, 0.15);
            color: #60a5fa;
            border-left-color: #60a5fa;
        }
        
        .nav-item i {
            width: 24px;
            margin-right: 10px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px 60px;
            min-height: 100vh;
        }
        
        /* Header Section */
        .hero-section {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 24px;
            padding: 60px;
            margin-bottom: 40px;
            border: 1px solid #334155;
            text-align: center;
        }
        
        .hero-section h1 {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, #60a5fa, #a78bfa, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }
        
        .hero-section p {
            font-size: 18px;
            color: #94a3b8;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-right: 8px;
            margin-bottom: 8px;
        }
        
        .badge-primary { background: #3b82f6; color: white; }
        .badge-success { background: #10b981; color: white; }
        .badge-danger { background: #ef4444; color: white; }
        .badge-warning { background: #f59e0b; color: white; }
        .badge-info { background: #06b6d4; color: white; }
        .badge-purple { background: #8b5cf6; color: white; }
        .badge-pink { background: #ec4899; color: white; }
        
        /* Cards */
        .card {
            background: #1e293b;
            border-radius: 16px;
            border: 1px solid #334155;
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .card-header {
            padding: 20px 25px;
            background: #0f172a;
            border-bottom: 1px solid #334155;
            cursor: pointer;
        }
        
        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #f1f5f9;
        }
        
        .card-header h2 i {
            margin-right: 12px;
            color: #60a5fa;
        }
        
        .card-body {
            padding: 25px;
        }
        
        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            text-align: left;
            padding: 12px;
            background: #0f172a;
            color: #94a3b8;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #334155;
            color: #cbd5e1;
        }
        
        .data-table tr:hover td {
            background: rgba(96, 165, 250, 0.05);
        }
        
        /* Code Blocks */
        pre {
            background: #0f172a;
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
            margin: 15px 0;
            border: 1px solid #334155;
        }
        
        code {
            font-family: 'Fira Code', monospace;
            font-size: 13px;
        }
        
        /* Grid Layout */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }
        
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }
        
        /* Stats Card */
        .stat-card {
            background: #0f172a;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            border: 1px solid #334155;
        }
        
        .stat-card i {
            font-size: 40px;
            color: #60a5fa;
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 28px;
            font-weight: 700;
        }
        
        .stat-card p {
            font-size: 12px;
            color: #94a3b8;
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #334155;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding-left: 20px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #60a5fa;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #60a5fa;
        }
        
        /* Footer */
        .footer {
            background: #0f172a;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
            border: 1px solid #334155;
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #334155;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 12px 24px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            border-bottom-color: #60a5fa;
            color: #60a5fa;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Accordion */
        .accordion-item {
            border-bottom: 1px solid #334155;
        }
        
        .accordion-header {
            padding: 15px;
            cursor: pointer;
            font-weight: 600;
        }
        
        .accordion-header:hover {
            background: #0f172a;
        }
        
        .accordion-body {
            padding: 0 15px 15px 15px;
            display: none;
        }
        
        .accordion-body.open {
            display: block;
        }
        
        /* Progress Bar */
        .progress-bar {
            background: #334155;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #60a5fa, #a78bfa);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease;
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Bima Kwik</h2>
        <p>Complete System Documentation</p>
        <p style="font-size: 10px; margin-top: 5px;">Version 1.0 | <?php echo date('Y'); ?></p>
    </div>
    
    <div class="sidebar-nav">
        <div class="nav-category">INTRODUCTION</div>
        <a href="#overview" class="nav-item" data-section="overview"><i class="fas fa-home"></i> System Overview</a>
        <a href="#architecture" class="nav-item" data-section="architecture"><i class="fas fa-project-diagram"></i> Architecture</a>
        <a href="#roles" class="nav-item" data-section="roles"><i class="fas fa-users"></i> System Roles</a>
        
        <div class="nav-category">DATABASE</div>
        <a href="#database" class="nav-item" data-section="database"><i class="fas fa-database"></i> Database Schema</a>
        <a href="#tables" class="nav-item" data-section="tables"><i class="fas fa-table"></i> All Tables</a>
        <a href="#relationships" class="nav-item" data-section="relationships"><i class="fas fa-share-alt"></i> Relationships</a>
        
        <div class="nav-category">MENUS</div>
        <a href="#superadmin-menus" class="nav-item" data-section="superadmin-menus"><i class="fas fa-crown"></i> Super Admin Menus</a>
        <a href="#admin-menus" class="nav-item" data-section="admin-menus"><i class="fas fa-user-shield"></i> Admin Menus</a>
        <a href="#insurer-menus" class="nav-item" data-section="insurer-menus"><i class="fas fa-building"></i> Insurer Menus</a>
        <a href="#broker-menus" class="nav-item" data-section="broker-menus"><i class="fas fa-handshake"></i> Broker Menus</a>
        <a href="#agent-menus" class="nav-item" data-section="agent-menus"><i class="fas fa-user-tie"></i> Agent Menus</a>
        <a href="#customer-menus" class="nav-item" data-section="customer-menus"><i class="fas fa-user"></i> Customer Menus</a>
        
        <div class="nav-category">WORKFLOWS</div>
        <a href="#workflows" class="nav-item" data-section="workflows"><i class="fas fa-chart-line"></i> System Workflows</a>
        <a href="#claim-workflow" class="nav-item" data-section="claim-workflow"><i class="fas fa-file-invoice"></i> Claim Workflow</a>
        <a href="#payment-workflow" class="nav-item" data-section="payment-workflow"><i class="fas fa-credit-card"></i> Payment Workflow</a>
        
        <div class="nav-category">API</div>
        <a href="#api" class="nav-item" data-section="api"><i class="fas fa-code"></i> API Documentation</a>
        <a href="#endpoints" class="nav-item" data-section="endpoints"><i class="fas fa-plug"></i> API Endpoints</a>
        <a href="#webhooks" class="nav-item" data-section="webhooks"><i class="fas fa-bell"></i> Webhooks</a>
        
        <div class="nav-category">SECURITY</div>
        <a href="#security" class="nav-item" data-section="security"><i class="fas fa-lock"></i> Security</a>
        <a href="#compliance" class="nav-item" data-section="compliance"><i class="fas fa-gavel"></i> Compliance</a>
        
        <div class="nav-category">DEPLOYMENT</div>
        <a href="#deployment" class="nav-item" data-section="deployment"><i class="fas fa-cloud-upload-alt"></i> Deployment</a>
        <a href="#commands" class="nav-item" data-section="commands"><i class="fas fa-terminal"></i> Commands</a>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    
    <!-- Hero Section -->
    <div class="hero-section" id="overview">
        <h1>Bima Kwik</h1>
        <p>Complete Digital Insurance Platform Documentation</p>
        <div style="margin-top: 30px;">
            <span class="badge badge-primary"><i class="fas fa-code"></i> PHP 8.2+</span>
            <span class="badge badge-success"><i class="fas fa-database"></i> PostgreSQL</span>
            <span class="badge badge-danger"><i class="fas fa-bolt"></i> Laravel 11</span>
            <span class="badge badge-warning"><i class="fas fa-brain"></i> AI Powered</span>
            <span class="badge badge-info"><i class="fas fa-shield-alt"></i> ISO 27001</span>
            <span class="badge badge-purple"><i class="fas fa-mobile-alt"></i> Multi-Channel</span>
        </div>
    </div>
    
    <!-- System Stats -->
    <div class="grid-4" style="margin-bottom: 40px;">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>14</h3>
            <p>System Roles</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-table"></i>
            <h3>198</h3>
            <p>Database Tables</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-bars"></i>
            <h3>1,500+</h3>
            <p>Total Menus & Sub-menus</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-code-branch"></i>
            <h3>50+</h3>
            <p>API Endpoints</p>
        </div>
    </div>
    
    <!-- System Architecture -->
    <div class="card" id="architecture">
        <div class="card-header">
            <h2><i class="fas fa-project-diagram"></i> System Architecture</h2>
        </div>
        <div class="card-body">
            <div class="grid-2">
                <div>
                    <h3 style="margin-bottom: 15px;">Frontend Layer</h3>
                    <ul style="list-style: none; padding-left: 0;">
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Admin Web Portal (Vue.js/React)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Customer Web Portal</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Mobile App (iOS/Android - Flutter)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Service Provider Portal</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> WhatsApp Commerce</li>
                    </ul>
                </div>
                <div>
                    <h3 style="margin-bottom: 15px;">Backend Layer</h3>
                    <ul style="list-style: none; padding-left: 0;">
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Laravel 11 PHP Framework</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> PostgreSQL Database</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Redis Cache & Queue</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> AI/ML Models (Python)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> RESTful API (JSON)</li>
                    </ul>
                </div>
            </div>
            
            <div class="progress-bar" style="margin: 30px 0 15px 0;">
                <div class="progress-fill" style="width: 100%;"></div>
            </div>
            
            <div class="grid-2">
                <div>
                    <h3 style="margin-bottom: 15px;">Integration Layer</h3>
                    <ul style="list-style: none; padding-left: 0;">
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Payment Gateways (M-Pesa, Tigo Pesa, Airtel Money)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> NIDA (National ID Verification)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> TIRAMIS (Regulator System)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> SMS/Email Gateways</li>
                    </ul>
                </div>
                <div>
                    <h3 style="margin-bottom: 15px;">Infrastructure</h3>
                    <ul style="list-style: none; padding-left: 0;">
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Docker Containers</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Kubernetes Orchestration</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Load Balancer (Nginx)</li>
                        <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 10px;"></i> Local Data Centers (Tanzania)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- System Roles -->
    <div class="card" id="roles">
        <div class="card-header">
            <h2><i class="fas fa-users"></i> System Roles (14 Main Roles)</h2>
        </div>
        <div class="card-body">
            <div class="grid-3">
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-crown" style="color: #f59e0b;"></i>
                    <h4>1. Super Administrator</h4>
                    <p style="font-size: 11px;">Full system access, creates all users</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-user-shield"></i>
                    <h4>2. Administrator</h4>
                    <p style="font-size: 11px;">Platform management, approves users</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-user-cog"></i>
                    <h4>3. Sub-Administrator</h4>
                    <p style="font-size: 11px;">Limited management by assigned area</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-building"></i>
                    <h4>4. Insurer</h4>
                    <p style="font-size: 11px;">Insurance company, creates products</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-handshake"></i>
                    <h4>5. Broker</h4>
                    <p style="font-size: 11px;">Sells policies from multiple insurers</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-chart-line"></i>
                    <h4>6. Aggregator</h4>
                    <p style="font-size: 11px;">Refers customers for commission</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-user-tie"></i>
                    <h4>7. Agent</h4>
                    <p style="font-size: 11px;">Independent insurance agent</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-chart-simple"></i>
                    <h4>8. SFE</h4>
                    <p style="font-size: 11px;">Sales Force Executive</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-university"></i>
                    <h4>9. Bancassurance</h4>
                    <p style="font-size: 11px;">Bank insurance agent</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-user"></i>
                    <h4>10. Customer</h4>
                    <p style="font-size: 11px;">End user buying insurance</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-hospital"></i>
                    <h4>11. Service Provider</h4>
                    <p style="font-size: 11px;">Hospital, Pharmacy, Garage, etc.</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-gavel"></i>
                    <h4>12. Regulator</h4>
                    <p style="font-size: 11px;">Insurance Regulatory Authority</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4>13. Financing Partner</h4>
                    <p style="font-size: 11px;">Premium financing loans</p>
                </div>
                <div class="stat-card" style="text-align: left;">
                    <i class="fas fa-code"></i>
                    <h4>14. Developer</h4>
                    <p style="font-size: 11px;">API integrator</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Database Tables -->
    <div class="card" id="database">
        <div class="card-header">
            <h2><i class="fas fa-database"></i> Database Schema Overview</h2>
        </div>
        <div class="card-body">
            <div class="grid-2">
                <div>
                    <h3>Total Tables: 198</h3>
                    <div class="progress-bar" style="margin: 15px 0;">
                        <div class="progress-fill" style="width: 100%;"></div>
                    </div>
                    <ul style="list-style: none; padding-left: 0;">
                        <li><i class="fas fa-database" style="color: #60a5fa;"></i> Core System: 21 tables</li>
                        <li><i class="fas fa-building" style="color: #60a5fa;"></i> Insurance Companies: 5 tables</li>
                        <li><i class="fas fa-box" style="color: #60a5fa;"></i> Product Management: 12 tables</li>
                        <li><i class="fas fa-users" style="color: #60a5fa;"></i> Customer Management: 12 tables</li>
                        <li><i class="fas fa-file-contract" style="color: #60a5fa;"></i> Policy Management: 8 tables</li>
                        <li><i class="fas fa-sync" style="color: #60a5fa;"></i> Renewals & Documents: 7 tables</li>
                        <li><i class="fas fa-handshake" style="color: #60a5fa;"></i> Broker Management: 10 tables</li>
                        <li><i class="fas fa-chart-line" style="color: #60a5fa;"></i> Aggregator Management: 10 tables</li>
                        <li><i class="fas fa-user-tie" style="color: #60a5fa;"></i> Agent Management: 11 tables</li>
                        <li><i class="fas fa-truck-medical" style="color: #60a5fa;"></i> Service Provider: 11 tables</li>
                        <li><i class="fas fa-file-invoice" style="color: #60a5fa;"></i> Claims Management: 10 tables</li>
                        <li><i class="fas fa-wallet" style="color: #60a5fa;"></i> Wallet & Payments: 10 tables</li>
                        <li><i class="fas fa-gavel" style="color: #60a5fa;"></i> Regulator: 9 tables</li>
                        <li><i class="fas fa-question-circle" style="color: #60a5fa;"></i> FAQ & Support: 10 tables</li>
                        <li><i class="fas fa-brain" style="color: #60a5fa;"></i> AI & Analytics: 9 tables</li>
                        <li><i class="fas fa-chart-bar" style="color: #60a5fa;"></i> Reporting: 6 tables</li>
                        <li><i class="fas fa-envelope" style="color: #60a5fa;"></i> Communication: 8 tables</li>
                        <li><i class="fas fa-shield-alt" style="color: #60a5fa;"></i> Audit & Logging: 7 tables</li>
                        <li><i class="fas fa-code" style="color: #60a5fa;"></i> Developer & API: 7 tables</li>
                        <li><i class="fas fa-coins" style="color: #60a5fa;"></i> Financing: 8 tables</li>
                        <li><i class="fas fa-chart-line" style="color: #60a5fa;"></i> Indexes & Views: 10+ tables</li>
                    </ul>
                </div>
                <div>
                    <h3>Key Tables</h3>
                    <pre><code class="language-sql">-- Core Tables
users, admins, roles, permissions, customers

-- Policy Tables
customer_policies, policy_renewals, policy_documents

-- Claims Tables
claims, claim_documents, claim_status_histories

-- Financial Tables
wallets, wallet_transactions, payment_transactions

-- Product Tables
insurance_products, product_categories, dynamic_forms

-- Commission Tables
broker_commissions, agent_commissions, aggregator_commissions</code></pre>
                    
                    <h3 style="margin-top: 20px;">Data Types Used</h3>
                    <div class="grid-2" style="margin-top: 10px;">
                        <span class="badge badge-info">UUID (Primary Keys)</span>
                        <span class="badge badge-info">VARCHAR</span>
                        <span class="badge badge-info">TEXT</span>
                        <span class="badge badge-info">DECIMAL(15,2)</span>
                        <span class="badge badge-info">INTEGER</span>
                        <span class="badge badge-info">BOOLEAN</span>
                        <span class="badge badge-info">TIMESTAMP</span>
                        <span class="badge badge-info">JSONB (PostgreSQL)</span>
                        <span class="badge badge-info">INET (IP Address)</span>
                        <span class="badge badge-info">ENUM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Complete Database Tables List -->
    <div class="card" id="tables">
        <div class="card-header">
            <h2><i class="fas fa-table"></i> Complete Database Tables List (198 Tables)</h2>
        </div>
        <div class="card-body">
            <div class="tabs">
                <div class="tab active" data-tab="core">Core (21)</div>
                <div class="tab" data-tab="insurance">Insurance (5)</div>
                <div class="tab" data-tab="product">Product (12)</div>
                <div class="tab" data-tab="customer">Customer (12)</div>
                <div class="tab" data-tab="policy">Policy (8)</div>
                <div class="tab" data-tab="renewal">Renewals (7)</div>
                <div class="tab" data-tab="broker">Broker (10)</div>
                <div class="tab" data-tab="aggregator">Aggregator (10)</div>
                <div class="tab" data-tab="agent">Agent (11)</div>
                <div class="tab" data-tab="provider">Provider (11)</div>
                <div class="tab" data-tab="claim">Claim (10)</div>
            </div>
            
            <!-- Core Tables -->
            <div id="core" class="tab-content active">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>1</td><td>users</td><td>System users (authentication base)</td></tr>
                    <tr><td>2</td><td>admins</td><td>Administrator details</td></tr>
                    <tr><td>3</td><td>roles</td><td>System roles</td></tr>
                    <tr><td>4</td><td>permissions</td><td>Permissions matrix</td></tr>
                    <tr><td>5</td><td>role_permissions</td><td>Role-permission mapping</td></tr>
                    <tr><td>6</td><td>user_roles</td><td>User-role mapping</td></tr>
                    <tr><td>7</td><td>activity_logs</td><td>User activities log</td></tr>
                    <tr><td>8</td><td>sessions</td><td>User sessions</td></tr>
                    <tr><td>9</td><td>password_resets</td><td>Password reset tokens</td></tr>
                    <tr><td>10</td><td>two_factor_auths</td><td>2FA settings</td></tr>
                    <tr><td>11</td><td>notifications</td><td>System notifications</td></tr>
                    <tr><td>12</td><td>notification_preferences</td><td>User notification settings</td></tr>
                    <tr><td>13</td><td>system_settings</td><td>Global system configuration</td></tr>
                    <tr><td>14</td><td>audit_logs</td><td>Audit trail</td></tr>
                    <tr><td>15</td><td>backup_logs</td><td>Backup history</td></tr>
                    <tr><td>16</td><td>api_keys</td><td>API key management</td></tr>
                    <tr><td>17</td><td>api_logs</td><td>API usage logs</td></tr>
                    <tr><td>18</td><td>webhooks</td><td>Webhook subscriptions</td></tr>
                    <tr><td>19</td><td>webhook_logs</td><td>Webhook delivery logs</td></tr>
                    <tr><td>20</td><td>country_instances</td><td>Multi-country instances</td></tr>
                    <tr><td>21</td><td>country_configs</td><td>Country-specific configs</td></tr>
                </table>
            </div>
            
            <!-- Insurance Tables -->
            <div id="insurance" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>22</td><td>insurers</td><td>Insurance companies</td></tr>
                    <tr><td>23</td><td>insurer_admins</td><td>Insurer admin users</td></tr>
                    <tr><td>24</td><td>insurer_branches</td><td>Insurer branch offices</td></tr>
                    <tr><td>25</td><td>insurer_bank_details</td><td>Insurer bank accounts</td></tr>
                    <tr><td>26</td><td>insurer_contracts</td><td>Insurer agreements</td></tr>
                </table>
            </div>
            
            <!-- Product Tables -->
            <div id="product" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>27</td><td>product_categories</td><td>Product categories (Motor, Health, Life)</td></tr>
                    <tr><td>28</td><td>insurance_products</td><td>All insurance products</td></tr>
                    <tr><td>29</td><td>product_benefits</td><td>Product benefit details</td></tr>
                    <tr><td>30</td><td>product_exclusions</td><td>Product exclusion details</td></tr>
                    <tr><td>31</td><td>product_documents</td><td>Product document templates</td></tr>
                    <tr><td>32</td><td>dynamic_forms</td><td>Dynamic form schemas</td></tr>
                    <tr><td>33</td><td>dynamic_form_fields</td><td>Form field definitions</td></tr>
                    <tr><td>34</td><td>dynamic_form_responses</td><td>Customer form responses</td></tr>
                    <tr><td>35</td><td>low_code_product_builders</td><td>Low-code product builder</td></tr>
                    <tr><td>36</td><td>premium_calculation_rules</td><td>Premium calculation logic</td></tr>
                    <tr><td>37</td><td>age_range_rules</td><td>Age-based pricing rules</td></tr>
                    <tr><td>38</td><td>hospital_lists</td><td>Hospital network for health products</td></tr>
                </table>
            </div>
            
            <!-- Customer Tables -->
            <div id="customer" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>39</td><td>customers</td><td>Customer profiles</td></tr>
                    <tr><td>40</td><td>customer_profiles</td><td>Extended customer details</td></tr>
                    <tr><td>41</td><td>customer_kyc_submissions</td><td>KYC submission records</td></tr>
                    <tr><td>42</td><td>customer_kyc_documents</td><td>KYC uploaded documents</td></tr>
                    <tr><td>43</td><td>customer_kyc_histories</td><td>KYC status history</td></tr>
                    <tr><td>44</td><td>customer_verification_tokens</td><td>OTP and verification tokens</td></tr>
                    <tr><td>45</td><td>customer_sessions</td><td>Customer login sessions</td></tr>
                    <tr><td>46</td><td>customer_notifications</td><td>Customer notifications</td></tr>
                    <tr><td>47</td><td>customer_communication_preferences</td><td>Customer comms preferences</td></tr>
                    <tr><td>48</td><td>customer_activity_logs</td><td>Customer activity tracking</td></tr>
                    <tr><td>49</td><td>customer_data_export_requests</td><td>GDPR data export requests</td></tr>
                    <tr><td>50</td><td>account_deletion_requests</td><td>Account deletion queue</td></tr>
                </table>
            </div>
            
            <!-- Policy Tables -->
            <div id="policy" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>51</td><td>customer_policies</td><td>Active and historical policies</td></tr>
                    <tr><td>52</td><td>policy_benefit_utilizations</td><td>Benefit usage tracking (health)</td></tr>
                    <tr><td>53</td><td>policy_vehicle_details</td><td>Vehicle-specific policy data</td></tr>
                    <tr><td>54</td><td>policy_nominees</td><td>Life insurance beneficiaries</td></tr>
                    <tr><td>55</td><td>policy_endorsements</td><td>Policy changes/amendments</td></tr>
                    <tr><td>56</td><td>policy_endorsement_histories</td><td>Endorsement audit trail</td></tr>
                    <tr><td>57</td><td>policy_cancellations</td><td>Policy cancellation records</td></tr>
                    <tr><td>58</td><td>dashboard_summaries</td><td>Cached customer dashboard data</td></tr>
                </table>
            </div>
            
            <!-- Renewal Tables -->
            <div id="renewal" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>59</td><td>policy_renewals</td><td>Policy renewal history</td></tr>
                    <tr><td>60</td><td>auto_renewal_settings</td><td>Auto-renewal preferences</td></tr>
                    <tr><td>61</td><td>renewal_reminders_logs</td><td>Renewal reminder tracking</td></tr>
                    <tr><td>62</td><td>policy_documents</td><td>Generated policy PDFs</td></tr>
                    <tr><td>63</td><td>policy_document_access_logs</td><td>Document access audit</td></tr>
                    <tr><td>64</td><td>policy_document_share_links</td><td>Secure document sharing</td></tr>
                    <tr><td>65</td><td>document_generation_queues</td><td>Async PDF generation queue</td></tr>
                </table>
            </div>
            
            <!-- Broker Tables -->
            <div id="broker" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>66</td><td>brokers</td><td>Broker profiles</td></tr>
                    <tr><td>67</td><td>broker_profiles</td><td>Extended broker details</td></tr>
                    <tr><td>68</td><td>broker_bank_details</td><td>Broker payment info</td></tr>
                    <tr><td>69</td><td>broker_licenses</td><td>Broker license records</td></tr>
                    <tr><td>70</td><td>broker_customers</td><td>Broker-customer assignments</td></tr>
                    <tr><td>71</td><td>broker_commissions</td><td>Broker commission records</td></tr>
                    <tr><td>72</td><td>broker_commission_withdrawals</td><td>Commission payout requests</td></tr>
                    <tr><td>73</td><td>broker_agreements</td><td>Broker contracts</td></tr>
                    <tr><td>74</td><td>broker_penalties</td><td>Broker sanctions</td></tr>
                    <tr><td>75</td><td>broker_compliance_logs</td><td>Broker compliance audit</td></tr>
                </table>
            </div>
            
            <!-- Aggregator Tables -->
            <div id="aggregator" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>76</td><td>aggregators</td><td>Aggregator profiles</td></tr>
                    <tr><td>77</td><td>aggregator_profiles</td><td>Extended aggregator details</td></tr>
                    <tr><td>78</td><td>aggregator_bank_details</td><td>Aggregator payment info</td></tr>
                    <tr><td>79</td><td>aggregator_referral_links</td><td>Unique referral links</td></tr>
                    <tr><td>80</td><td>aggregator_referral_clicks</td><td>Click tracking</td></tr>
                    <tr><td>81</td><td>aggregator_referral_sales</td><td>Conversion tracking</td></tr>
                    <tr><td>82</td><td>aggregator_commissions</td><td>Referral commission records</td></tr>
                    <tr><td>83</td><td>aggregator_commission_withdrawals</td><td>Payout requests</td></tr>
                    <tr><td>84</td><td>aggregator_agreements</td><td>Aggregator contracts</td></tr>
                    <tr><td>85</td><td>aggregator_penalties</td><td>Aggregator sanctions</td></tr>
                </table>
            </div>
            
            <!-- Agent Tables -->
            <div id="agent" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>86</td><td>agents</td><td>Agent profiles (including SFE, Bancassurance)</td></tr>
                    <tr><td>87</td><td>agent_profiles</td><td>Extended agent details</td></tr>
                    <tr><td>88</td><td>agent_bank_details</td><td>Agent payment info</td></tr>
                    <tr><td>89</td><td>agent_licenses</td><td>Agent license records</td></tr>
                    <tr><td>90</td><td>agent_customers</td><td>Agent-customer assignments</td></tr>
                    <tr><td>91</td><td>agent_commissions</td><td>Agent commission records</td></tr>
                    <tr><td>92</td><td>agent_commission_withdrawals</td><td>Payout requests</td></tr>
                    <tr><td>93</td><td>agent_agreements</td><td>Agent contracts</td></tr>
                    <tr><td>94</td><td>agent_trainings</td><td>Training modules</td></tr>
                    <tr><td>95</td><td>agent_training_completions</td><td>Training completion records</td></tr>
                    <tr><td>96</td><td>agent_penalties</td><td>Agent sanctions</td></tr>
                </table>
            </div>
            
            <!-- Service Provider Tables -->
            <div id="provider" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>97</td><td>service_providers</td><td>Provider profiles</td></tr>
                    <tr><td>98</td><td>service_provider_types</td><td>Provider types (Hospital, Pharmacy, Garage)</td></tr>
                    <tr><td>99</td><td>service_provider_profiles</td><td>Extended provider details</td></tr>
                    <tr><td>100</td><td>service_provider_bank_details</td><td>Provider payment info</td></tr>
                    <tr><td>101</td><td>service_provider_slas</td><td>SLA agreements</td></tr>
                    <tr><td>102</td><td>service_provider_contracts</td><td>Provider contracts</td></tr>
                    <tr><td>103</td><td>service_provider_permissions</td><td>Portal access rights</td></tr>
                    <tr><td>104</td><td>service_provider_staff</td><td>Provider staff accounts</td></tr>
                    <tr><td>105</td><td>service_provider_performance_metrics</td><td>Performance tracking</td></tr>
                    <tr><td>106</td><td>service_provider_payments</td><td>Payment records</td></tr>
                    <tr><td>107</td><td>service_provider_penalties</td><td>Provider sanctions</td></tr>
                </table>
            </div>
            
            <!-- Claim Tables -->
            <div id="claim" class="tab-content">
                <table class="data-table">
                    <tr><th>#</th><th>Table Name</th><th>Description</th></tr>
                    <tr><td>108</td><td>claims</td><td>Claim records</td></tr>
                    <tr><td>109</td><td>claim_documents</td><td>Claim supporting documents</td></tr>
                    <tr><td>110</td><td>claim_status_histories</td><td>Claim status change log</td></tr>
                    <tr><td>111</td><td>claim_fraud_alerts</td><td>AI fraud detection alerts</td></tr>
                    <tr><td>112</td><td>claim_fraud_detection_logs</td><td>AI fraud detection logs</td></tr>
                    <tr><td>113</td><td>claim_adjusters</td><td>Claim adjuster profiles</td></tr>
                    <tr><td>114</td><td>claim_adjuster_assignments</td><td>Adjuster-claim assignments</td></tr>
                    <tr><td>115</td><td>claim_settlements</td><td>Settlement details</td></tr>
                    <tr><td>116</td><td>tir_amis_reports</td><td>Regulator reports</td></tr>
                    <tr><td>117</td><td>claim_notifications</td><td>Claim-related notifications</td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Workflows -->
    <div class="card" id="workflows">
        <div class="card-header">
            <h2><i class="fas fa-chart-line"></i> System Workflows</h2>
        </div>
        <div class="card-body">
            <h3>End-to-End Customer Journey</h3>
            <div class="timeline">
                <div class="timeline-item"><strong>Step 1:</strong> Customer registers and completes KYC</div>
                <div class="timeline-item"><strong>Step 2:</strong> Customer browses and compares products</div>
                <div class="timeline-item"><strong>Step 3:</strong> Customer selects product and gets quote</div>
                <div class="timeline-item"><strong>Step 4:</strong> Customer makes payment (Mobile Money/Card/Bank/Wallet)</div>
                <div class="timeline-item"><strong>Step 5:</strong> System issues policy and generates documents</div>
                <div class="timeline-item"><strong>Step 6:</strong> Commission distributed to broker/agent/aggregator</div>
                <div class="timeline-item"><strong>Step 7:</strong> Customer receives policy via email/SMS/App</div>
                <div class="timeline-item"><strong>Step 8:</strong> Annual renewal reminder sent (60,30,14,7,1 days before)</div>
                <div class="timeline-item"><strong>Step 9:</strong> Customer renews or policy expires</div>
            </div>
            
            <h3 style="margin-top: 30px;">Claim Processing Workflow</h3>
            <div class="timeline">
                <div class="timeline-item"><strong>Step 1:</strong> Customer or service provider submits claim (documents attached)</div>
                <div class="timeline-item"><strong>Step 2:</strong> AI fraud detection scans claim (0-100% fraud score)</div>
                <div class="timeline-item"><strong>Step 3:</strong> If fraud suspected → flagged for manual review</div>
                <div class="timeline-item"><strong>Step 4:</strong> Claim assigned to adjuster (if complex)</div>
                <div class="timeline-item"><strong>Step 5:</strong> Insurer reviews and approves/rejects</div>
                <div class="timeline-item"><strong>Step 6:</strong> If approved → payment processed to customer or service provider</div>
                <div class="timeline-item"><strong>Step 7:</strong> Claim reported to TIRAMIS (regulator)</div>
                <div class="timeline-item"><strong>Step 8:</strong> Customer receives notification and payment</div>
            </div>
        </div>
    </div>
    
    <!-- API Documentation -->
    <div class="card" id="api">
        <div class="card-header">
            <h2><i class="fas fa-code"></i> API Documentation</h2>
        </div>
        <div class="card-body">
            <h3>Base URL</h3>
            <pre><code class="language-php">https://api.bimakwik.com/v1</code></pre>
            
            <h3>Authentication</h3>
            <pre><code class="language-php">Headers:
Authorization: Bearer {api_key}
Content-Type: application/json</code></pre>
            
            <h3>Sample API Endpoints</h3>
            <table class="data-table">
                <tr><th>Method</th><th>Endpoint</th><th>Description</th></tr>
                <tr><td><span class="badge badge-primary">GET</span></td><td>/products</td><td>List all insurance products</td></tr>
                <tr><td><span class="badge badge-primary">GET</span></td><td>/products/{id}</td><td>Get product details</td></tr>
                <tr><td><span class="badge badge-success">POST</span></td><td>/policies</td><td>Purchase policy</td></tr>
                <tr><td><span class="badge badge-primary">GET</span></td><td>/policies/{id}</td><td>Get policy details</td></tr>
                <tr><td><span class="badge badge-success">POST</span></td><td>/claims</td><td>Submit claim</td></tr>
                <tr><td><span class="badge badge-primary">GET</span></td><td>/claims/{id}</td><td>Get claim status</td></tr>
                <tr><td><span class="badge badge-success">POST</span></td><td>/payments/initiate</td><td>Initiate payment</td></tr>
                <tr><td><span class="badge badge-primary">GET</span></td><td>/wallet/balance</td><td>Get wallet balance</td></tr>
                <tr><td><span class="badge badge-success">POST</span></td><td>/customers/verify</td><td>Verify customer coverage</td></tr>
                <tr><td><span class="badge badge-success">POST</span></td><td>/webhooks/register</td><td>Register webhook</td></tr>
            </table>
            
            <h3 style="margin-top: 20px;">Sample Request (Purchase Policy)</h3>
            <pre><code class="language-json">{
    "product_id": "550e8400-e29b-41d4-a716-446655440000",
    "customer_id": "550e8400-e29b-41d4-a716-446655441111",
    "policy_details": {
        "vehicle_registration": "T123ABC",
        "vehicle_make": "Toyota",
        "vehicle_model": "Hilux",
        "year": 2020
    },
    "payment_method": "mobile_money",
    "payment_details": {
        "provider": "M-Pesa",
        "phone": "0712345678"
    }
}</code></pre>
            
            <h3 style="margin-top: 20px;">Sample Response</h3>
            <pre><code class="language-json">{
    "success": true,
    "data": {
        "policy_number": "POL202400012345",
        "policy_id": "550e8400-e29b-41d4-a716-446655442222",
        "premium_amount": 250000,
        "start_date": "2024-01-01",
        "end_date": "2025-01-01",
        "policy_document_url": "https://storage.bimakwik.com/policies/POL202400012345.pdf"
    }
}</code></pre>
        </div>
    </div>
    
    <!-- Webhooks -->
    <div class="card" id="webhooks">
        <div class="card-header">
            <h2><i class="fas fa-bell"></i> Webhook Events</h2>
        </div>
        <div class="card-body">
            <table class="data-table">
                <tr><th>Event Type</th><th>Trigger</th><th>Payload</th></tr>
                <tr><td>policy.created</td><td>New policy purchased</td><td>policy_id, customer_id, premium</td></tr>
                <tr><td>policy.renewed</td><td>Policy renewed</td><td>old_policy_id, new_policy_id, premium</td></tr>
                <tr><td>policy.cancelled</td><td>Policy cancelled</td><td>policy_id, reason, refund_amount</td></tr>
                <tr><td>claim.submitted</td><td>Claim submitted</td><td>claim_id, policy_id, amount</td></tr>
                <tr><td>claim.approved</td><td>Claim approved</td><td>claim_id, approved_amount</td></tr>
                <tr><td>claim.paid</td><td>Claim paid</td><td>claim_id, paid_amount, transaction_id</td></tr>
                <tr><td>payment.received</td><td>Payment received</td><td>transaction_id, amount, method</td></tr>
                <tr><td>customer.kyc_verified</td><td>KYC completed</td><td>customer_id, verification_date</td></tr>
                <tr><td>renewal.reminder</td><td>Renewal reminder sent</td><td>policy_id, customer_id, expiry_date</td></tr>
            </table>
        </div>
    </div>
    
    <!-- Installation Commands -->
    <div class="card" id="commands">
        <div class="card-header">
            <h2><i class="fas fa-terminal"></i> Installation & Deployment Commands</h2>
        </div>
        <div class="card-body">
            <h3>Clone Repository</h3>
            <pre><code class="language-bash">git clone https://github.com/bimakwik/bima-kwik.git
cd bima-kwik</code></pre>
            
            <h3>Install Dependencies</h3>
            <pre><code class="language-bash">composer install
npm install</code></pre>
            
            <h3>Environment Configuration</h3>
            <pre><code class="language-bash">cp .env.example .env
php artisan key:generate</code></pre>
            
            <h3>Database Setup</h3>
            <pre><code class="language-bash">php artisan migrate
php artisan db:seed
php artisan migrate --seed</code></pre>
            
            <h3>Create All Models with Migrations</h3>
            <pre><code class="language-bash">php artisan make:model User -m
php artisan make:model Admin -m
php artisan make:model Customer -m
php artisan make:model Policy -m
php artisan make:model Claim -m
# ... (198 models total)</code></pre>
            
            <h3>Create All Controllers</h3>
            <pre><code class="language-bash">php artisan make:controller SuperAdmin/DashboardController
php artisan make:controller Admin/UserController
php artisan make:controller Customer/PolicyController
# ... (150+ controllers total)</code></pre>
            
            <h3>Run Development Server</h3>
            <pre><code class="language-bash">php artisan serve
npm run dev</code></pre>
            
            <h3>Production Deployment</h3>
            <pre><code class="language-bash">php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache</code></pre>
        </div>
    </div>
    
    <!-- Security & Compliance -->
    <div class="card" id="security">
        <div class="card-header">
            <h2><i class="fas fa-lock"></i> Security & Compliance</h2>
        </div>
        <div class="card-body">
            <div class="grid-2">
                <div>
                    <h3>Security Features</h3>
                    <ul>
                        <li>✅ Password hashing (bcrypt)</li>
                        <li>✅ Two-Factor Authentication (2FA)</li>
                        <li>✅ Role-Based Access Control (RBAC)</li>
                        <li>✅ API Key authentication</li>
                        <li>✅ Rate limiting on APIs</li>
                        <li>✅ IP whitelisting</li>
                        <li>✅ Session management</li>
                        <li>✅ Data encryption at rest (AES-256)</li>
                        <li>✅ SSL/TLS encryption in transit</li>
                        <li>✅ SQL injection prevention (Eloquent ORM)</li>
                        <li>✅ XSS protection</li>
                        <li>✅ CSRF protection</li>
                    </ul>
                </div>
                <div>
                    <h3>Compliance Certifications</h3>
                    <ul>
                        <li>✅ Personal Data Protection Act (Tanzania)</li>
                        <li>✅ ISO 27001 (Information Security)</li>
                        <li>✅ PCI DSS (Payment Security)</li>
                        <li>✅ GDPR (Data Protection - EU)</li>
                        <li>✅ TIRAMIS Integration (Regulator)</li>
                        <li>✅ NIDA Integration (National ID)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>Bima Kwik</strong> - Complete Digital Insurance Platform</p>
        <p>Documentation Version 1.0 | Last Updated: <?php echo date('F d, Y'); ?></p>
        <p style="margin-top: 15px;">
            <i class="fas fa-envelope"></i> docs@bimakwik.com |
            <i class="fas fa-globe"></i> www.bimakwik.com |
            <i class="fab fa-github"></i> github.com/bimakwik
        </p>
    </div>
    
</div>

<script>
    // Smooth scrolling for navigation
    document.querySelectorAll('.nav-item').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Tab functionality
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const tabId = tab.getAttribute('data-tab');
            
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            tabContents.forEach(content => {
                content.classList.remove('active');
                if (content.id === tabId) {
                    content.classList.add('active');
                }
            });
        });
    });
    
    // Active nav highlighting on scroll
    const sections = document.querySelectorAll('.card[id]');
    const navItems = document.querySelectorAll('.nav-item');
    
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });
        
        navItems.forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('href') === '#' + current) {
                item.classList.add('active');
            }
        });
    });
    
    // Progress bar animation
    window.addEventListener('load', () => {
        document.querySelectorAll('.progress-fill').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    });
</script>

</body>
</html>