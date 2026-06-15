<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InsuranceProduct;
use App\Models\ProductRisk;
use App\Models\PolicyCategory;
use App\Models\Insurer;

class ImportProductData extends Command
{
    protected $signature = 'import:product-data {--file= : Path to Excel file with products and risks}';
    protected $description = 'Import products and risks from the reference Excel files';

    public function handle()
    {
        $this->info('Importing product data from internal reference...');

        // Categories from sheets / classes (TIRA-aligned)
        $categories = [
            'MOTOR' => 'Motor Insurance',
            'FIRE' => 'Fire Insurance',
            'FIRE_COMMERCIAL' => 'Fire Commercial',
            'ENGINEERING' => 'Engineering Insurance',
            'MARINE' => 'Marine Insurance',
            'GOODS_IN_TRANSIT' => 'Goods in Transit',
            'AVIATION' => 'Aviation Insurance',
            'AGRICULTURE' => 'Agriculture Insurance',
            'MISC' => 'Miscellaneous & Other General',
            'BOND' => 'Bond Insurance',
            'LIABILITY' => 'Liability Insurance',
            'PUBLIC_LIABILITY' => 'Public Liability Insurance',
            'THEFT' => 'Theft Insurance',
            'MONEY' => 'Money Insurance',
            'PROF_INDEMNITY' => 'Professional Indemnity',
            'PA_INDIVIDUAL' => 'Individual Personal Accident',
            'HEALTH' => 'Health Insurance',
            'WCOMPENSATION' => "Workmen's Compensation",
            'LIFE_INDIVIDUAL' => 'Individual Life Assurance',
            'LIFE_GROUP' => 'Group Life Assurance',
        ];

        $insurer = Insurer::first();
        if (!$insurer) {
            $this->error('No insurer found. Run database seeder first.');
            return 1;
        }

        $catMap = [];
        foreach ($categories as $code => $name) {
            $cat = PolicyCategory::firstOrCreate(
                ['category_code' => $code],
                [
                    'category_code' => $code,
                    'category_name' => $name,
                    'description' => $name . ' category',
                    'is_active' => true,
                ]
            );
            $catMap[$code] = $cat->id;
        }
        $this->info('Categories seeded: ' . count($categories));

        // Product & Risk data from reference docs
        $products = $this->getProductData();

        $count = 0;
        $riskCount = 0;
        foreach ($products as $p) {
            $classCode = $this->resolveCategoryCode($p['class']);
            $product = InsuranceProduct::firstOrCreate(
                ['product_code' => $p['product_code']],
                [
                    'policy_category_id' => $catMap[$classCode] ?? 1,
                    'insurer_id' => $insurer->id,
                    'product_name' => $p['product_name'],
                    'description' => $p['product_name'],
                    'base_premium' => $p['rate'] ?? 0,
                    'currency' => 'TZS',
                    'is_active' => true,
                ]
            );

            // Create risks for this product
            foreach ($p['risks'] as $risk) {
                ProductRisk::firstOrCreate(
                    ['risk_code' => $risk['risk_code']],
                    [
                        'insurance_product_id' => $product->id,
                        'risk_name' => $risk['risk_name'],
                        'product_code' => $p['product_code'],
                        'class_of_insurance' => $risk['class'] ?? $p['class'],
                        'minimum_rate' => $risk['rate'] ?? null,
                        'minimum_amount' => $risk['min_amount'] ?? null,
                        'is_active' => true,
                    ]
                );
                $riskCount++;
            }
            $count++;
        }

        $this->info("Imported {$count} products with {$riskCount} risks.");
        return 0;
    }

    private function resolveCategoryCode($class)
    {
        $map = [
            'Motor' => 'MOTOR',
            'Misc' => 'MISC',
            'Fire' => 'FIRE',
            'Fire Domestic' => 'FIRE',
            'Fire Industrial' => 'FIRE_COMMERCIAL',
            'Marine' => 'MARINE',
            'Marine Cargo' => 'MARINE',
            'Engineering' => 'ENGINEERING',
            'Machinery breakdown' => 'ENGINEERING',
            'Contractors All Risk' => 'ENGINEERING',
            'Goods in Transit' => 'GOODS_IN_TRANSIT',
            'Aviation' => 'AVIATION',
            'Agriculture' => 'AGRICULTURE',
            'Bond' => 'BOND',
            'Liability' => 'LIABILITY',
            'Public Liability' => 'PUBLIC_LIABILITY',
            'Cargo' => 'MARINE',
            'Personal Accident' => 'PA_INDIVIDUAL',
            'Theft' => 'THEFT',
            'Burglary' => 'THEFT',
            'Money' => 'MONEY',
            'Professional Indemnity' => 'PROF_INDEMNITY',
            'Health' => 'HEALTH',
            'Credit' => 'MISC',
            'Trade Credit' => 'MISC',
            'Cyber' => 'MISC',
            'Travel' => 'MISC',
            'Plate Glass' => 'MISC',
            'Fidelity' => 'BOND',
            'Kidnap' => 'MISC',
            'Political Violence' => 'MISC',
            'Accidental Damage' => 'MISC',
            'Hoteliers' => 'LIABILITY',
            'Golfers' => 'PA_INDIVIDUAL',
            'Workmen' => 'WCOMPENSATION',
        ];
        return $map[$class] ?? 'MISC';
    }

    private function getProductData()
    {
        return [
            // === MOTOR ===
            ['product_code' => 'SP014001000000', 'product_name' => 'Motor Private Vehicle', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014001000001', 'risk_name' => 'Motor Private Vehicles-Comprehensive claim free Vehicle', 'rate' => 3.5, 'min_amount' => 250000],
                ['risk_code' => 'SP014001000002', 'risk_name' => 'Motor Private Vehicles-Comprehensive with claim record', 'rate' => 4.0, 'min_amount' => 250000],
                ['risk_code' => 'SP014001000003', 'risk_name' => 'Motor Private Vehicles-TPFT', 'rate' => 2.0, 'min_amount' => 200000],
                ['risk_code' => 'SP014001000004', 'risk_name' => 'Motor Private Vehicles-TPO', 'rate' => null, 'min_amount' => 100000],
                ['risk_code' => 'SP014001000005', 'risk_name' => 'Motor Private Vehicles-Agreed Value-Comprehensive claim free', 'rate' => 4.0, 'min_amount' => 250000],
                ['risk_code' => 'SP014001000006', 'risk_name' => 'Motor Private Vehicles-Agreed Value-Comprehensive with claim', 'rate' => 4.5, 'min_amount' => 250000],
            ]],
            ['product_code' => 'SP014002000000', 'product_name' => 'Motor Motor Cycle', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014002000001', 'risk_name' => 'Motor Cycle-Comprehensive-Two wheelers claims free', 'rate' => 5.0],
                ['risk_code' => 'SP014002000002', 'risk_name' => 'Motor Cycle-Comprehensive-Two wheelers with claims record', 'rate' => 6.0],
                ['risk_code' => 'SP014002000003', 'risk_name' => 'Motor Cycle-Comprehensive-Three Wheelers claims free', 'rate' => 6.0, 'min_amount' => 125000],
                ['risk_code' => 'SP014002000004', 'risk_name' => 'Motor Cycle-Comprehensive-Three wheelers with claims record', 'rate' => 7.0, 'min_amount' => 125000],
                ['risk_code' => 'SP014002000005', 'risk_name' => 'Motor Cycle-TPFT - Two wheelers', 'rate' => 3.5, 'min_amount' => 100000],
            ]],
            ['product_code' => 'SP014003000000', 'product_name' => 'Motor Commercial Vehicle', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014003000001', 'risk_name' => 'Motor Commercial Vehicle-General Goods Carrying-Comprehensive Up to 2 tonnes', 'rate' => 4.0, 'min_amount' => 300000],
                ['risk_code' => 'SP014003000002', 'risk_name' => 'Motor Commercial Vehicle-General Goods Carrying-Comprehensive Above 2 to 5 tonnes', 'rate' => 4.5, 'min_amount' => 350000],
                ['risk_code' => 'SP014003000003', 'risk_name' => 'Motor Commercial Vehicle-General Goods Carrying-Comprehensive in excess of 5 tonnes but less 10 tonnes', 'rate' => 5.0, 'min_amount' => 400000],
                ['risk_code' => 'SP014003000004', 'risk_name' => 'Motor Commercial Vehicle-Oil tankers- Comprehensive', 'rate' => 5.5, 'min_amount' => 500000],
            ]],
            ['product_code' => 'SP014004000000', 'product_name' => 'Motor Passenger Carrying', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014004000001', 'risk_name' => 'Motor Passenger Carrying-Comprehensive- Public Taxis, private hire, tour operators', 'rate' => 6.0, 'min_amount' => 350000],
                ['risk_code' => 'SP014004000002', 'risk_name' => 'Motor Passenger Carrying-Comprehensive-Buses-Daladala within City', 'rate' => 5.0, 'min_amount' => 300000],
                ['risk_code' => 'SP014004000003', 'risk_name' => 'Motor Passenger Carrying-Comprehensive-Buses Up Country', 'rate' => 5.5, 'min_amount' => 350000],
                ['risk_code' => 'SP014004000004', 'risk_name' => 'Motor Passenger Carrying-TPO- Public Taxis', 'rate' => null, 'min_amount' => 150000],
            ]],
            ['product_code' => 'SP014005000000', 'product_name' => 'Motor Special Type Vehicles', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014005000001', 'risk_name' => 'Motor Special Type Vehicles-Comprehensive- Farm Tractors, Forklifts, Graders, Cranes', 'rate' => 3.0, 'min_amount' => 200000],
                ['risk_code' => 'SP014005000002', 'risk_name' => 'Motor Special Type Vehicles-TPO', 'rate' => null, 'min_amount' => 100000],
            ]],
            ['product_code' => 'SP014006000000', 'product_name' => 'Motor Excess of Loss Liability', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014006000001', 'risk_name' => 'Motor Excess of Loss Liability', 'rate' => null],
            ]],
            ['product_code' => 'SP014007000000', 'product_name' => 'Motor Trade', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014007000001', 'risk_name' => 'Motor Trade insurance', 'rate' => null],
            ]],
            ['product_code' => 'SP014008000000', 'product_name' => 'Motor Contingent Liability', 'class' => 'Motor', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP014008000001', 'risk_name' => 'Motor Contingent Liability', 'rate' => null],
            ]],

            // === FIRE ===
            ['product_code' => 'SP012001000000', 'product_name' => 'Fire Class I', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP012001000001', 'risk_name' => 'Fire Class I- Non-manufacturing Risks-Residences, Libraries, Museums', 'rate' => 0.15, 'class' => 'Fire Domestic'],
                ['risk_code' => 'SP012001000002', 'risk_name' => 'Fire Class I-Non-manufacturing Risks-Hospitals and Clinics, Auditorium', 'rate' => 0.175, 'class' => 'Fire Domestic'],
                ['risk_code' => 'SP012001000003', 'risk_name' => 'Fire Class I-Industrial/Manufacturing risks-Standalone Utilities', 'rate' => 0.175, 'class' => 'Fire Industrial'],
                ['risk_code' => 'SP012001000004', 'risk_name' => 'Fire Class I-Non-manufacturing Risks-Cafes, Restaurants, Kiosks', 'rate' => 0.2, 'class' => 'Fire Domestic'],
                ['risk_code' => 'SP012001000005', 'risk_name' => 'Fire Class I-Industrial/Manufacturing risks-Aerated Water Factories', 'rate' => 0.2, 'class' => 'Fire Industrial'],
            ]],
            ['product_code' => 'SP012002000000', 'product_name' => 'Fire Class II', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP012002000001', 'risk_name' => 'Fire Class II risks', 'rate' => 0.25],
            ]],
            ['product_code' => 'SP012003000000', 'product_name' => 'Fire Class III', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP012003000001', 'risk_name' => 'Fire Class III risks', 'rate' => 0.35],
            ]],
            ['product_code' => 'SP012012000000', 'product_name' => 'Domestic Package', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010012000001', 'risk_name' => 'Domestic Package - Building', 'rate' => 0],
                ['risk_code' => 'SP010012000002', 'risk_name' => 'Domestic Package - Contents', 'rate' => 0],
                ['risk_code' => 'SP010012000003', 'risk_name' => 'Domestic Package - All Risk', 'rate' => 0],
                ['risk_code' => 'SP010012000004', 'risk_name' => 'Domestic Package - Owner liability', 'rate' => 0],
                ['risk_code' => 'SP010012000005', 'risk_name' => 'Domestic Package - Electronic equipment', 'rate' => 0],
            ]],
            ['product_code' => 'SP012013000000', 'product_name' => 'Business All Risks', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP012013000001', 'risk_name' => 'Business All Risks', 'rate' => 0],
            ]],
            ['product_code' => 'SP012014000000', 'product_name' => 'Plant All Risks', 'class' => 'Fire', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP012014000001', 'risk_name' => 'Plant All Risks', 'rate' => 0],
            ]],

            // === ENGINEERING ===
            ['product_code' => 'SP010001000000', 'product_name' => 'Machinery Breakdown', 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010001000001', 'risk_name' => 'Machinery Breakdown-Power Plant', 'rate' => 0.006, 'class' => 'Machinery breakdown'],
                ['risk_code' => 'SP010001000002', 'risk_name' => 'Machinery Breakdown-Electrical Machines', 'rate' => 0.0085, 'class' => 'Machinery breakdown'],
                ['risk_code' => 'SP010001000003', 'risk_name' => 'Machinery Breakdown-Equipment', 'rate' => 0.006, 'class' => 'Machinery breakdown'],
                ['risk_code' => 'SP010001000004', 'risk_name' => 'Machinery Breakdown-General Machines', 'rate' => 0.0075, 'class' => 'Machinery breakdown'],
            ]],
            ['product_code' => 'SP010002000000', 'product_name' => "Contractors' All Risk Insurance", 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010002000001', 'risk_name' => "Contractors All Risks up to Tzs.1 Billion-Buildings-residential", 'rate' => 0.2, 'class' => 'Contractors All Risk'],
                ['risk_code' => 'SP010002000002', 'risk_name' => "Contractors All Risks up to Tzs.1 Billion-Buildings-non residential", 'rate' => 0.2, 'class' => 'Contractors All Risk'],
            ]],
            ['product_code' => 'SP010003000000', 'product_name' => 'Erection All Risks', 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010003000001', 'risk_name' => 'Erection All Risks', 'rate' => 0.25],
            ]],
            ['product_code' => 'SP010004000000', 'product_name' => 'Electronic Equipment Insurance', 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010004000001', 'risk_name' => 'Electronic Equipment Insurance', 'rate' => 0.0085],
            ]],
            ['product_code' => 'SP010005000000', 'product_name' => 'Machinery Loss of Profits', 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010005000001', 'risk_name' => 'Machinery Loss of Profits', 'rate' => 0],
            ]],
            ['product_code' => 'SP010006000000', 'product_name' => "Contractor's & Erection All Risk", 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010006000001', 'risk_name' => "Contractor's & Erection All Risk", 'rate' => 0],
            ]],
            ['product_code' => 'SP010008000000', 'product_name' => 'Deterioration of Stock', 'class' => 'Engineering', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP010008000001', 'risk_name' => 'Deterioration of Stock', 'rate' => 0],
            ]],

            // === MARINE ===
            ['product_code' => 'SP011001000000', 'product_name' => 'Marine Cargo ICC(A) Containerised', 'class' => 'Marine', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP011001000001', 'risk_name' => 'Marine ICC(A)-Containerised-Produce Raw Agriculture', 'rate' => 0.0025, 'class' => 'Cargo'],
                ['risk_code' => 'SP011001000002', 'risk_name' => 'Marine ICC(A)-Containerised-Grains in bags', 'rate' => 0.0035, 'class' => 'Cargo'],
                ['risk_code' => 'SP011001000003', 'risk_name' => 'Marine ICC(A)-Containerised-Non fragile General Merchandise', 'rate' => 0.0035, 'class' => 'Cargo'],
            ]],
            ['product_code' => 'SP011002000000', 'product_name' => 'Marine Cargo ICC(B)', 'class' => 'Marine', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP011002000001', 'risk_name' => 'Marine ICC(B) Containerised', 'rate' => 0.0015],
            ]],
            ['product_code' => 'SP011003000000', 'product_name' => 'Marine Cargo ICC(C)', 'class' => 'Marine', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP011003000001', 'risk_name' => 'Marine ICC(C) Containerised', 'rate' => 0.001],
            ]],
            ['product_code' => 'SP011013000000', 'product_name' => 'Marine Hull plus TPL (Yatch & Motor Boat)', 'class' => 'Marine', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP011013000001', 'risk_name' => 'Marine Hull + TPL', 'rate' => 0],
            ]],

            // === GOODS IN TRANSIT ===
            ['product_code' => 'SP015001000000', 'product_name' => 'Own Transport within Tanzania- All Risks Containerised', 'class' => 'Goods in Transit', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP015001000001', 'risk_name' => 'Own Transport-Containerised-Produce Raw Agriculture', 'rate' => 0.35],
                ['risk_code' => 'SP015001000002', 'risk_name' => 'Own Transport-Containerised-Non fragile General', 'rate' => 0.4],
                ['risk_code' => 'SP015001000003', 'risk_name' => 'Own Transport-Containerised-Semi-fragile', 'rate' => 0.5],
                ['risk_code' => 'SP015001000004', 'risk_name' => 'Own Transport-Containerised-Fragile General', 'rate' => 0.6],
            ]],
            ['product_code' => 'SP015002000000', 'product_name' => 'Own Transport within Tanzania- All Risks Non-Containerised', 'class' => 'Goods in Transit', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP015002000001', 'risk_name' => 'Own Transport Non-Containerised-Produce Raw Agriculture', 'rate' => 0.4],
                ['risk_code' => 'SP015002000002', 'risk_name' => 'Own Transport Non-Containerised-Non fragile General', 'rate' => 0.45],
            ]],

            // === MISCELLANEOUS AND ACCIDENTS ===
            ['product_code' => 'SP013001000000', 'product_name' => 'Burglary', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013001000001', 'risk_name' => 'Burglary and House breaking First loss sum insured 100% of full value', 'rate' => 0.006],
                ['risk_code' => 'SP013001000002', 'risk_name' => 'Burglary and House breaking First Loss Sum Insured 65% of full value', 'rate' => 0.0054],
                ['risk_code' => 'SP013001000003', 'risk_name' => 'Burglary and House breaking First Loss Sum Insured 60% of full value', 'rate' => 0.0052],
            ]],
            ['product_code' => 'SP013002000000', 'product_name' => 'Money Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013002000001', 'risk_name' => 'Money Insurance-in Safe up to 5M', 'rate' => 0.35],
                ['risk_code' => 'SP013002000002', 'risk_name' => 'Money Insurance-in Transit', 'rate' => 0.6],
            ]],
            ['product_code' => 'SP013003000000', 'product_name' => 'Workmen Compensation & Employer Liability', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013003000001', 'risk_name' => 'Workmen Compensation-Employers Liability', 'rate' => 0.005],
            ]],
            ['product_code' => 'SP013004000000', 'product_name' => 'Public Liability', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013004000001', 'risk_name' => 'Public Liability', 'rate' => 0.0025],
            ]],
            ['product_code' => 'SP013005000000', 'product_name' => 'Bond Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013005000001', 'risk_name' => 'Customs Bond', 'rate' => 0],
            ]],
            ['product_code' => 'SP013006000000', 'product_name' => 'Personal Accident', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013006000001', 'risk_name' => 'Personal Accident', 'rate' => 0],
            ]],
            ['product_code' => 'SP013007000000', 'product_name' => 'Glass Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013007000001', 'risk_name' => 'Glass Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013008000000', 'product_name' => 'Fidelity Guarantee', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013008000001', 'risk_name' => 'Fidelity Guarantee', 'rate' => 0],
            ]],
            ['product_code' => 'SP013009000000', 'product_name' => 'Contractors Plant & Machinery', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013009000001', 'risk_name' => 'Contractors Plant & Machinery', 'rate' => 0],
            ]],
            ['product_code' => 'SP013010000000', 'product_name' => 'Professional Indemnity', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013010000001', 'risk_name' => 'Professional Indemnity', 'rate' => 0],
            ]],
            ['product_code' => 'SP013011000000', 'product_name' => 'Directors & Officers Liability', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013011000001', 'risk_name' => 'Directors & Officers Liability', 'rate' => 0],
            ]],
            ['product_code' => 'SP013012000000', 'product_name' => 'Travel Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013012000001', 'risk_name' => 'Travel Insurance Worldwide, Europe, Africa, Asia', 'rate' => 0],
            ]],
            ['product_code' => 'SP013013000000', 'product_name' => 'Cyber & Crime', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013013000001', 'risk_name' => 'Cyber & Crime Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013014000000', 'product_name' => 'Bankers Blanket Bond', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013014000001', 'risk_name' => 'Bankers Blanket Bond', 'rate' => 0],
            ]],
            ['product_code' => 'SP013015000000', 'product_name' => 'Kidnapping & Ransom', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013015000001', 'risk_name' => 'Kidnap and Ransom Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013016000000', 'product_name' => 'Plate Glass Cover', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013016000001', 'risk_name' => 'Plate Glass Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013017000000', 'product_name' => 'Political Violence & Terrorism', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013017000001', 'risk_name' => 'Political Violence & Terrorism', 'rate' => 0],
            ]],
            ['product_code' => 'SP013018000000', 'product_name' => 'Accidental Damage', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013018000001', 'risk_name' => 'Accidental Damage', 'rate' => 0],
            ]],
            ['product_code' => 'SP013019000000', 'product_name' => 'Trade Credit Guarantee', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013019000001', 'risk_name' => 'Trade Credit Guarantee', 'rate' => 0],
            ]],
            ['product_code' => 'SP013020000000', 'product_name' => "Tour Operator's Liability", 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013020000001', 'risk_name' => "Tour Operator's Liability", 'rate' => 0],
            ]],
            ['product_code' => 'SP013021000000', 'product_name' => 'Third Party, Fire & Theft (Tour Operators)', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013021000001', 'risk_name' => 'Third Party, Fire & Theft (Tour Operators)', 'rate' => 0],
            ]],
            ['product_code' => 'SP013022000000', 'product_name' => "Carriers Legal Liability/Freight Forwarders Liability", 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013022000001', 'risk_name' => "Carriers Legal Liability/Freight Forwarders Liability", 'rate' => 0],
            ]],
            ['product_code' => 'SP013023000000', 'product_name' => 'Golfers Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013023000001', 'risk_name' => 'Golfers Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013024000000', 'product_name' => 'Hoteliers Liability', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013024000001', 'risk_name' => 'Hoteliers Liability', 'rate' => 0],
            ]],
            ['product_code' => 'SP013025000000', 'product_name' => 'Credit Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013025000001', 'risk_name' => 'Credit Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013026000000', 'product_name' => "Port Operators' Insurance", 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013026000001', 'risk_name' => "Port Operators' Insurance", 'rate' => 0],
            ]],
            ['product_code' => 'SP013027000000', 'product_name' => 'Excess of Liability Insurance', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013027000001', 'risk_name' => 'Excess of Liability Insurance', 'rate' => 0],
            ]],
            ['product_code' => 'SP013028000000', 'product_name' => 'Stock Throughput Insurance (STP)', 'class' => 'Misc', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP013028000001', 'risk_name' => 'Stock Throughput Insurance', 'rate' => 0],
            ]],

            // === AVIATION ===
            ['product_code' => 'SP008000000000', 'product_name' => 'Aviation Insurance', 'class' => 'Aviation', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP008000000001', 'risk_name' => 'Aviation - Hull', 'rate' => 0],
                ['risk_code' => 'SP008000000002', 'risk_name' => 'Aviation - Spares & All Risks', 'rate' => 0],
                ['risk_code' => 'SP008000000003', 'risk_name' => 'Aviation - Liability', 'rate' => 0],
                ['risk_code' => 'SP008000000004', 'risk_name' => 'Aviation - Loss of License', 'rate' => 0],
                ['risk_code' => 'SP008000000005', 'risk_name' => 'Aviation - Personal Accident', 'rate' => 0],
            ]],

            // === AGRICULTURE ===
            ['product_code' => 'SP009000000000', 'product_name' => 'Agriculture Insurance', 'class' => 'Agriculture', 'rate' => 0, 'risks' => [
                ['risk_code' => 'SP009000000001', 'risk_name' => 'Agriculture Insurance', 'rate' => 0],
            ]],
        ];
    }
}
