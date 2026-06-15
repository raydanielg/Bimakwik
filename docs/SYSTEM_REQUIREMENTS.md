# Bima Kwik Insurance Platform — System Requirements Document

## Version: 1.0 — June 2026

---

## 1. Introduction

### 1.1 Purpose
Bima Kwik is a Tanzanian insurance technology platform that connects insurers, brokers, agents, bancassurance partners, and SFE (Sales Force Executives) to sell and manage insurance policies. The platform integrates with TIRA (Tanzania Insurance Regulatory Authority) through TIRAMIS API v1.3 for regulatory reporting and compliance.

### 1.2 Scope
- Policy origination and management (Motor, Fire, Marine, Engineering, Goods in Transit, Misc & Accidents, Aviation, Agriculture)
- Multi-channel distribution (Direct, Agent, Broker, Bancassurance, SFE, Partner)
- Commission management with per-channel and per-product rates
- TIRAMIS API integration for regulatory data submission
- Selcom payment gateway integration
- Role-based access control (14 roles)
- Reporting and analytics

---

## 2. System Architecture

### 2.1 Technology Stack
- **Backend**: PHP 8.x / Laravel 9.x
- **Frontend**: Bootstrap 5, JavaScript, jQuery
- **Database**: SQLite (development), MySQL/MariaDB (production)
- **Queue**: Laravel Queue (database driver)
- **Cache**: File-based (development), Redis (production)
- **API Style**: RESTful with XML payload for TIRA

### 2.2 Core Entities
- Users (with roles: super_admin, admin, sub_admin, banker, bancassurance, regulator, insurer, broker, agent, sfe, adjuster, tira, financing_partner, customer)
- Insurers (with company_code for TIRA)
- Insurance Products (with product_code matching TIRA codes)
- Product Risks (risk_code, risk_name, minimum rates)
- Policy Categories (Motor, Fire, Marine, Engineering, Goods in Transit, Misc & Accidents, Aviation, Agriculture)
- Customer Policies (with company_code, sale_point_code for TIRA)
- Commission Rates (per product, category, channel, insurer)
- Commission Transactions
- Claims
- TirAmisReports (regulatory submission tracking)
- SalePoints (TIRA sale point master data)

---

## 3. Feature Requirements

### 3.1 Product & Risk Management
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| PR-01 | Policy Categories CRUD | High | Done |
| PR-02 | Insurance Products CRUD with product codes | High | Done |
| PR-03 | Product Risks (risk codes, rates, minimum amounts) | High | Done |
| PR-04 | Product Benefits & Exclusions | Medium | Done |
| PR-05 | Product Documents (policy wordings) | Low | Schema ready |
| PR-06 | Short Period Products (motor transit) | Medium | Data imported |

### 3.2 Policy Origination
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| PO-01 | Customer self-service buy flow | High | Done |
| PO-02 | Agent/SFE policy issuance | High | Done |
| PO-03 | Bancassurance policy sale | High | Done |
| PO-04 | Policy quote and pricing | High | Partial |
| PO-05 | Company Code & Sale Point Code capture | High | Done |
| PO-06 | Premium calculation from risk rates | Medium | Pending |

### 3.3 Commission Management
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| CM-01 | Commission rate configuration (per product, category, channel, insurer) | High | Done |
| CM-02 | Rate types: Percentage or Fixed amount | High | Done |
| CM-03 | Tiered rates by premium amount ranges | High | Done |
| CM-04 | Date-effective rates (effective_from / effective_to) | High | Done |
| CM-05 | Channel types: Agent, Broker, Bancassurance, SFE, Direct, Partner | High | Done |
| CM-06 | Auto-calculation of commission on policy purchase | High | Done |
| CM-07 | Commission transaction tracking (pending, approved, paid) | High | Done |
| CM-08 | Admin commission rate management UI | High | Done |
| CM-09 | Insurer commission rate management UI | Medium | Pending |
| CM-10 | Commission reports & payouts | Medium | Pending |
| CM-11 | Multi-level commission splitting | Low | Pending |

### 3.4 TIRAMIS (TIRA) Integration
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| TI-01 | CoverNoteRefReq (Non-Life Covernote Submission) | High | Done |
| TI-02 | MotorCoverNoteRefReq (Motor Non-Fleet) | High | Done |
| TI-03 | MotorCoverNoteRefReq (Motor Fleet) | High | Done |
| TI-04 | PolicyReq (Policy Data Submission) | High | Done |
| TI-05 | ClaimNotificationRefReq | High | Done |
| TI-06 | ClaimIntimationReq | High | Done |
| TI-07 | ClaimAssessmentReq | High | Done |
| TI-08 | DischargeVoucherReq | High | Done |
| TI-09 | ClaimPaymentReq | High | Done |
| TI-10 | ClaimRejectionReq | High | Done |
| TI-11 | ReinsuranceReq | High | Done |
| TI-12 | Digital Signature (PKCS12, SHA1withRSA) | High | Done (blocked on cert) |
| TI-13 | Async callback handling (ResAck generation) | High | Done |
| TI-14 | Simulation mode (offline testing without live TIRA) | High | Done |
| TI-15 | Commission data in XML (CommisionPaid, CommisionRate) | High | Done |
| TI-16 | Product codes in XML submissions | High | Done |
| TI-17 | Response code mapping (TIRA001–TIRA234) | High | Done |
| TI-18 | Integration log (request/response audit) | High | Done |
| TI-19 | Admin TIRAMIS dashboard (reports, logs, pending) | High | Done |
| TI-20 | Regulator TIRAMIS dashboard | High | Done |
| TI-21 | TIRA Codes assignment (company, sales codes) | High | Done |
| TI-22 | SalePoint master data (model + migration) | Medium | Done |

### 3.5 Payment Gateway
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| PG-01 | Selcom createOrder API | High | Done |
| PG-02 | Sandbox mode for testing | High | Done |
| PG-03 | Webhook handling (payment confirmation) | High | Done |
| PG-04 | Dual-vendor support (Bima Kwik + Mama Mia's Soko) | High | Done |
| PG-05 | Payment status check endpoint | High | Done |
| PG-06 | Success/Cancel redirect pages | High | Done |
| PG-07 | Production mode switch | Medium | Pending |

### 3.6 User Management & Access Control
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| UA-01 | Role-based authentication (14 roles) | High | Done |
| UA-02 | User registration with role selection | High | Done |
| UA-03 | Profile management | High | Done |
| UA-04 | Permission seeding | Medium | Pending |
| UA-05 | Sidebar menus per role | High | Done |

### 3.7 Reporting & Analytics
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| RA-01 | Admin dashboard with real data | High | Done |
| RA-02 | Regulator market overview | High | Done |
| RA-03 | TIRAMIS compliance reports | High | Done |
| RA-04 | Commission reports | Medium | Pending |
| RA-05 | Export (CSV/Excel) | Medium | Partial |

### 3.8 Claims Management
| ID | Feature | Priority | Status |
|----|---------|----------|--------|
| CL-01 | Claim submission and tracking | High | Done |
| CL-02 | TIRA claim notification/intimation | High | Done |
| CL-03 | Adjuster assignment | Medium | Pending |
| CL-04 | Fraud detection | Low | Pending |

---

## 4. Commission Rate Structure

### 4.1 Rate Resolution Priority
The system resolves commission rates using the following priority order:

1. **Product-specific rate** (insurance_product_id IS NOT NULL) — most specific
2. **Category-specific rate** (policy_category_id IS NOT NULL) — fallback
3. **Insurer-specific rate** (insurer_id IS NOT NULL) — fallback
4. **Global rate** (all NULL) — least specific

### 4.2 Rate Matching Rules
- Channel type must match exactly (agent, broker, bancassurance, sfe, direct, partner)
- Premium amount must fall within min/max range (if set)
- Current date must fall within effective_from/effective_to (if set)
- Only active rates are considered

### 4.3 Default Commission Rates (seeded)

| Category | Agent | Broker | Bancassurance | SFE |
|----------|-------|--------|---------------|-----|
| Motor | 10% | 5% | 8% | 12% |
| Fire | 12% | 6% | 10% | 15% |
| Marine | 10% | 5% | 8% | 12% |
| Engineering | 8% | 4% | 6% | 10% |
| Misc & Accidents | 12% | 6% | 10% | 15% |
| Goods in Transit | 10% | 5% | 8% | 12% |
| Aviation | 7% | 3.5% | 5% | 9% |
| Agriculture | 10% | 5% | 8% | 12% |

---

## 5. TIRAMIS API Endpoints

### 5.1 Message Types Implemented
- **CoverNoteRefReq** / **CoverNoteRefReqAck** / **CoverNoteRefRes** / **CoverNoteRefResAck**
- **MotorCoverNoteRefReq** (Non-Fleet) / **MotorCoverNoteRefReq** (Fleet)
- **PolicyReq** / **PolicyReqAck** / **PolicyRes** / **PolicyResAck**
- **ClaimNotificationRefReq** / **ClaimNotificationRefReqAck**
- **ClaimIntimationReq** / **ClaimIntimationReqAck**
- **ClaimAssessmentReq** / **ClaimAssessmentReqAck**
- **DischargeVoucherReq** / **DischargeVoucherReqAck**
- **ClaimPaymentReq** / **ClaimPaymentReqAck**
- **ClaimRejectionReq** / **ClaimRejectionReqAck**
- **ReinsuranceReq** / **ReinsuranceReqAck**

### 5.2 Headers
- `Content-Type: application/xml`
- `ClientCode: OC1014`
- `ClientKey: [configured in .env]`

### 5.3 Digital Signature
- Algorithm: SHA1withRSA
- Format: PKCS12 certificate (`.p12`)
- Signed element: `<Signature>` appended before closing root tag
- Status: Implemented — BLOCKED on TIRA certificate

---

## 6. Prerequisites for Production

### 6.1 TIRA Integration
1. Establish VPN to TIRA datacenter
2. Share Bima Kwik public certificate with TIRA
3. Obtain TIRA public certificate
4. Get TIRAMIS testing endpoints
5. Place certificate at `storage/app/tiramis/cert.p12`
6. Set `TIRAMIS_CERT_PASSWORD` in `.env`
7. Set `TIRAMIS_SIGNATURE_ENABLED=true`
8. Run integration tests with TIRA

### 6.2 Selcom Payment
1. Switch from sandbox to production in Selcom dashboard
2. Update `SELCOM_ENVIRONMENT=production` in `.env`
3. Test end-to-end payment flow

### 6.3 Database
1. Migrate from SQLite to MySQL/MariaDB
2. Update `.env` database connection settings

---

## 7. Glossary

| Term | Definition |
|------|------------|
| TIRA | Tanzania Insurance Regulatory Authority |
| TIRAMIS | TIRA Management Information System |
| SFE | Sales Force Executive |
| Sale Point | Physical or digital location where insurance is sold (e.g. SP677) |
| Company Code | TIRA-assigned code for the transacting company (e.g. ICC113) |
| Client Code / Client Key | API authentication credentials for TIRAMIS |
| Cover Note | Proof of insurance coverage submitted to TIRA |
| PKCS12 | Public-Key Cryptography Standards #12 (certificate format) |
| Selcom | Tanzanian mobile payment gateway |
