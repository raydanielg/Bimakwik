# Bima Kwik Reference Implementation Map

## Reference Documents Reviewed

- `referencesdoc/GUIDE Database Design Document.pdf`
- `referencesdoc/System Design Document (Detailed).pdf`
- `referencesdoc/Project Management Plan.pdf`
- `referencesdoc/Insurance digital platform profile.pdf`
- `referencesdoc/BIMAKWIK schedule.pdf`
- `referencesdoc/Bima Kwik Value Proposition to BUMACO Insurance.docx.pdf`
- `referencesdoc/readme.text`

## Core Platform Intent

Bima Kwik is a licensed digital insurance intermediary platform for Tanzania. It connects customers, agents, brokers, insurers, service providers, regulators, and administrators through web, mobile, and API channels.

The system design expects:

- User authentication, profile management, roles, and permissions.
- Insurance product catalog, product recommendations, and pricing.
- Policy purchase, issuance, renewal, endorsement, and viewing.
- Payment and commission transactions.
- Claims submission, tracking, processing, and settlement.
- Report generation and admin dashboards.
- Document upload, storage, and retrieval.
- Service provider registration, search, details, and rating.
- External integrations including payment gateways, insurer systems, regulators, SMS/email, and TIRAMISS.

## Main Data Domains

- Users, roles, permissions, and profiles.
- Customers, agents, brokers, aggregators, insurers, service providers, regulators, developers, financing partners.
- Products, product categories, benefits, exclusions, documents, and pricing rules.
- Policies, policy documents, renewals, endorsements, cancellations, nominees, and vehicle details.
- Payments, wallets, commissions, withdrawals, premium financing, loans, repayments, and disbursements.
- Claims, claim documents, claim status history, claim settlements, adjusters, fraud alerts, and reference bureau records.
- Reports, exports, schedules, dashboard widgets, analytics, AI risk/fraud/recommendation outputs.
- Communication: notifications, email, SMS, WhatsApp, campaigns, callbacks, live chat, support tickets.
- Audit/security: logs, login attempts, IP whitelists, blacklisted tokens, data-change logs.

## Implementation Priority

1. Admin foundation:
   - Login, roles, user management, admin dashboard metrics, RBAC.
   - Status: partially connected.

2. Admin data pages:
   - Admins/staff, insurers, aggregators, brokers, agents, customers, service providers.
   - Status: list pages render from DB; create/edit basics added for users and aggregators.

3. Role dashboards:
   - Customer, SFE, bancassurance, broker, aggregator, insurer, service provider, regulator, developer, financing partner.
   - Status: primary stat cards for customer, SFE, bancassurance, broker, aggregator, insurer, service provider, developer, and financing partner are now backed by shared safe database metrics. Secondary tables, charts, and activity feeds still need route-by-route wiring.

4. Public pages and forms:
   - Product listing, branches, quote/contact/newsletter, partner onboarding pages.
   - Status: mostly static or simple forms; should connect to products, branches, leads, newsletters, and contact storage/mail.

5. Business workflows:
   - Product purchase, policy issuance, claims, payments, commissions, financing, provider billing.
   - Status: models/tables exist in large part, but controller/view wiring needs a route-by-route pass.

## Local Database Notes

The project currently uses SQLite locally via `.env`. The reference documents mention PostgreSQL for production. The current local DB has a partial migration history and some schema drift from earlier pulls, so new wiring should check for table/column existence where needed until the database is rebuilt cleanly.

Recommended clean dev reset when current local data is disposable:

```bash
php artisan migrate:fresh --seed
```

That should be done only when the local SQLite data can be deleted.
