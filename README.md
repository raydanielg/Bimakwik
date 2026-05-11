# Bima Kwik - Digital Insurance Platform

Bima Kwik is a modern, licensed digital insurance intermediary platform in Tanzania. It serves as an end-to-end solution for insurance sales and claims notifications, connecting insurers, regulators, sales channels, and customers.

## 🚀 Key Features
- **OMNI CHANNEL Access:** Seamless experience across Web, Mobile, and API integrations.
- **TIRAMISS Integrated:** Fully compliant and connected to the Tanzania Insurance Regulatory Authority (TIRA) systems.
- **Digital Claims:** Fast and transparent claims notification and tracking.
- **Financial Inclusion:** Revenue-sharing models designed to empower women, youth, SMEs, and marginalized groups.

---

## 👥 System Roles & Access Control
The platform is built with a robust multi-role architecture, supporting **14 distinct user roles** as per the system requirements.

| # | Role Name | Slug | Description |
|---|-----------|------|-------------|
| 1 | **Super Administrator** | `super_admin` | Full system-wide access and management. |
| 2 | **Administrator** | `admin` | General platform administration. |
| 3 | **Sub-Administrator** | `sub_admin` | Limited administrative access for operational support. |
| 4 | **Insurance Companies** | `insurer` | Manage products, underwrite policies, and process claims. |
| 5 | **Brokers** | `broker` | Insurance brokers managing their own clients and agents. |
| 6 | **Aggregators** | `aggregator` | Platform partners managing referral networks. |
| 7 | **General Agents** | `agent` | Individual sellers directly engaging with customers. |
| 8 | **Sales Force Executives** | `sfe` | Field sales teams driving ground-level adoption. |
| 9 | **Bancassurance Agents** | `bancassurance` | Bank partners selling insurance to their clients. |
| 10 | **Customers** | `customer` | The end-users purchasing policies and filing claims. |
| 11 | **Service Providers** | `service_provider` | Hospitals, Garages, Pharmacies for service fulfillment. |
| 12 | **Regulator** | `regulator` | TIRA and other bodies for compliance monitoring. |
| 13 | **Financing Partners** | `financing_partner` | Partners providing Premium Financing (loans). |
| 14 | **Developers / API** | `developer` | Technical partners for third-party integrations. |

---

## 🧪 Testing Accounts (Development)
**Default Password for all accounts:** `password`

| Role | Email (Username) | Role Slug |
| :--- | :--- | :--- |
| **Super Administrator** | `super-admin@bimakwik.com` | `super_admin` |
| **Administrator** | `admin@bimakwik.com` | `admin` |
| **Sub-Administrator** | `sub-admin@bimakwik.com` | `sub_admin` |
| **Insurance Company** | `insurer@bimakwik.com` | `insurer` |
| **Broker** | `broker@bimakwik.com` | `broker` |
| **Aggregator** | `aggregator@bimakwik.com` | `aggregator` |
| **General Agent** | `agent@bimakwik.com` | `agent` |
| **SFE Executive** | `sfe@bimakwik.com` | `sfe` |
| **Bancassurance Agent** | `bancassurance@bimakwik.com` | `bancassurance` |
| **Customer (Mteja)** | `customer@bimakwik.com` | `customer` |
| **Service Provider** | `service-provider@bimakwik.com` | `service_provider` |
| **Regulator** | `regulator@bimakwik.com` | `regulator` |
| **Financing Partner** | `financing-partner@bimakwik.com` | `financing_partner` |
| **Developer** | `developer@bimakwik.com` | `developer` |

---

## � Tech Stack
- **Framework:** Laravel 9+
- **Frontend:** Bootstrap 5, Animate.css, Swiper.js, Lucide/Bootstrap Icons
- **Database:** SQLite (Local Dev) / MySQL (Production)
- **Architecture:** Role-Based Access Control (RBAC) with custom Middleware.

---

## 📞 Contact Information
- **Contact Person:** Dorice Malle
- **Phone:** +255 762 883 065
- **Email:** info@bimakwik.com
- **Website:** [www.bimakwik.com](https://www.bimakwik.com)