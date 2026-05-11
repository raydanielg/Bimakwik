# Bima Kwik - Digital Insurance Platform

Bima Kwik is a modern, licensed digital insurance intermediary platform in Tanzania. It serves as an end-to-end solution for insurance sales and claims notifications, connecting insurers, regulators, sales channels, and customers.

## 🚀 Key Features
- **OMNI CHANNEL Access:** Seamless experience across Web, Mobile, and API integrations.
- **TIRAMISS Integrated:** Fully compliant and connected to the Tanzania Insurance Regulatory Authority (TIRA) systems.
- **Digital Claims:** Fast and transparent claims notification and tracking.
- **Financial Inclusion:** Revenue-sharing models designed to empower women, youth, SMEs, and marginalized groups.

---

## 👥 System Roles & Access Control
The platform is built with a robust multi-role architecture, supporting **12 distinct user roles** as per the system requirements.

| # | Role Name | Slug | Description |
|---|-----------|------|-------------|
| 1 | **Super Administrator** | `super-admin` | Full system-wide access and management. |
| 2 | **Sub-Administrator** | `sub-admin` | Limited administrative access for operational support. |
| 3 | **Insurance Companies** | `insurer` | Manage products, underwrite policies, and process claims. |
| 4 | **Brokers / Aggregators** | `broker` | Intermediaries managing multiple agents and sales. |
| 5 | **Insurance Agents** | `agent` | Individual sellers directly engaging with customers. |
| 6 | **Sales Force Executives** | `sfe` | Field sales teams driving ground-level adoption. |
| 7 | **Bancassurance Agents** | `bancassurance` | Bank partners selling insurance to their clients. |
| 8 | **Customers** | `customer` | The end-users purchasing policies and filing claims. |
| 9 | **Service Providers** | `service-provider` | Hospitals, Garages, Pharmacies for service fulfillment. |
| 10 | **Regulator** | `regulator` | TIRA and other bodies for compliance monitoring. |
| 11 | **Financing Partners** | `financing-partner` | Partners providing Premium Financing (loans). |
| 12 | **Developers / API** | `developer` | Technical partners for third-party integrations. |

---

## 🛠 Tech Stack
- **Framework:** Laravel 9+
- **Frontend:** Bootstrap 5, Animate.css, Swiper.js, SweetAlert2
- **Database:** SQLite (Local Dev) / MySQL (Production)
- **Architecture:** Role-Based Access Control (RBAC) with custom Middleware.

---

## 🧪 Testing Accounts (Development)
All passwords are set to `password`.

| Role | Email (Username) |
| :--- | :--- |
| **Super Administrator** | `super-admin@bimakwik.com` |
| **Sub-Administrator** | `sub-admin@bimakwik.com` |
| **Insurance Company** | `insurer@bimakwik.com` |
| **Broker / Aggregator** | `broker@bimakwik.com` |
| **Insurance Agent** | `agent@bimakwik.com` |
| **Sales Force (SFE)** | `sfe@bimakwik.com` |
| **Bancassurance Agent** | `bancassurance@bimakwik.com` |
| **Customer (Mteja)** | `customer@bimakwik.com` |
| **Service Provider** | `service-provider@bimakwik.com` |
| **Regulator (TIRA)** | `regulator@bimakwik.com` |
| **Financing Partner** | `financing-partner@bimakwik.com` |

---

## 📞 Contact Information
- **Contact Person:** Dorice Malle
- **Phone:** +255 762 883 065
- **Email:** info@bimakwik.com
- **Website:** [www.bimakwik.com](https://www.bimakwik.com)
