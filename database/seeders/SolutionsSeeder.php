<?php

namespace Database\Seeders;

use App\Models\Solution;
use Illuminate\Database\Seeder;

class SolutionsSeeder extends Seeder
{
    public function run(): void
    {
        $solutions = [
            [
                'name'              => 'ERP System',
                'slug'              => 'erp-system',
                'short_description' => 'Integrate internal and external management information across finance, accounting, manufacturing, sales, and customer relationship management.',
                'description'       => 'An Enterprise Resource Planning (ERP) system integrates all core business processes into a single unified platform. Innovation Project helps you implement and configure an ERP solution tailored to your business workflows — from finance and accounting to supply chain, manufacturing, and CRM. Our consultative approach ensures the system fits your actual operational needs, not just a generic template.',
                'benefits'          => [
                    'Unified data across all departments — eliminating information silos',
                    'Real-time visibility into business performance and KPIs',
                    'Automated workflows that reduce manual processes and errors',
                    'Better decision-making through integrated reporting and analytics',
                    'Scalable platform that grows with your business',
                    'Reduced operational costs through process efficiency',
                ],
                'features'          => [
                    ['title' => 'Financial Management', 'description' => 'General ledger, accounts payable/receivable, budgeting, and financial reporting.', 'icon' => '💰'],
                    ['title' => 'Supply Chain Management', 'description' => 'End-to-end visibility of procurement, inventory, and supplier management.', 'icon' => '🔗'],
                    ['title' => 'Manufacturing Operations', 'description' => 'Production planning, work order management, and quality control.', 'icon' => '🏭'],
                    ['title' => 'Sales & CRM', 'description' => 'Customer management, sales pipeline, and order processing.', 'icon' => '🤝'],
                    ['title' => 'Human Resources', 'description' => 'Employee management, payroll, and performance tracking.', 'icon' => '👥'],
                    ['title' => 'Reporting & Analytics', 'description' => 'Dashboards and reports for informed decision-making across all departments.', 'icon' => '📊'],
                ],
                'use_cases'         => [
                    'Manufacturing company needing integrated production and inventory management',
                    'Trading company wanting unified finance, procurement, and sales systems',
                    'Service business seeking better project cost tracking and billing',
                    'Multi-branch organization requiring consolidated financial reporting',
                ],
                'faq_items'         => [
                    ['question' => 'How long does ERP implementation take?', 'answer' => 'Implementation timelines vary by company size and complexity. Typically 3–6 months for a mid-size business. We provide a detailed project plan during the proposal phase.'],
                    ['question' => 'Can the ERP be customized for our business?', 'answer' => 'Yes. Our consultative approach means we configure the system to match your actual workflows, not force you to adapt to a generic template.'],
                    ['question' => 'Do you provide training for our team?', 'answer' => 'Absolutely. We provide hands-on training during implementation and documentation for ongoing reference.'],
                ],
                'seo_title'         => 'ERP System Implementation — Innovation Project',
                'seo_description'   => 'Implement an ERP system tailored to your business. Innovation Project provides end-to-end ERP consulting, configuration, and support.',
                'status'            => 'published',
            ],
            [
                'name'              => 'Transportation Management System',
                'slug'              => 'transportation-management-system',
                'short_description' => 'Plan, execute, monitor, and optimize the movement of goods with full logistics visibility, documentation, and compliance support.',
                'description'       => 'A Transportation Management System (TMS) helps businesses plan, execute, and monitor the physical movement of goods. Innovation Project implements TMS solutions that give you real-time visibility into shipments, streamline logistics documentation, and help you reduce transportation costs through better route optimization and carrier management.',
                'benefits'          => [
                    'Real-time shipment tracking and visibility',
                    'Reduced transportation costs through route optimization',
                    'Streamlined freight documentation and compliance',
                    'Better carrier management and performance monitoring',
                    'Fewer manual errors in logistics operations',
                    'Improved on-time delivery rates',
                ],
                'features'          => [
                    ['title' => 'Shipment Planning', 'description' => 'Plan routes and consolidate shipments for cost efficiency.', 'icon' => '🗺️'],
                    ['title' => 'Real-Time Tracking', 'description' => 'Track shipment status and location in real time.', 'icon' => '📍'],
                    ['title' => 'Document Management', 'description' => 'Manage BOL, delivery orders, customs documents, and proof of delivery.', 'icon' => '📄'],
                    ['title' => 'Carrier Management', 'description' => 'Evaluate and manage carrier performance and rates.', 'icon' => '🚛'],
                    ['title' => 'Freight Costing', 'description' => 'Accurately calculate and allocate freight costs per shipment.', 'icon' => '💵'],
                    ['title' => 'Analytics & Reporting', 'description' => 'Monitor logistics KPIs and identify improvement opportunities.', 'icon' => '📈'],
                ],
                'use_cases'         => [
                    'Logistics company managing high-volume shipments',
                    'Manufacturer needing to track outbound deliveries',
                    'Distributor managing multi-carrier freight operations',
                    'E-commerce business improving last-mile delivery visibility',
                ],
                'faq_items'         => [
                    ['question' => 'Can TMS integrate with our existing ERP?', 'answer' => 'Yes. We design TMS implementations to integrate with your existing ERP or WMS systems for seamless data flow.'],
                    ['question' => 'Does TMS support multiple carriers?', 'answer' => 'Absolutely. Our TMS solutions support multi-carrier operations with performance comparison and rate management.'],
                ],
                'seo_title'         => 'Transportation Management System (TMS) — Innovation Project',
                'seo_description'   => 'Implement a TMS to gain full visibility and control over your logistics operations. End-to-end consulting by Innovation Project.',
                'status'            => 'published',
            ],
            [
                'name'              => 'Warehouse Management System',
                'slug'              => 'warehouse-management-system',
                'short_description' => 'Control warehouse operations including receiving, put away, picking, shipping, stock movement, and inventory visibility.',
                'description'       => 'A Warehouse Management System (WMS) optimizes every aspect of warehouse operations. From receiving and put-away to picking, packing, and shipping — our WMS implementations give you real-time inventory visibility, reduce errors, and improve throughput. Innovation Project tailors the WMS to your specific warehouse layout and operational processes.',
                'benefits'          => [
                    'Real-time inventory visibility across all locations',
                    'Reduced picking errors and order inaccuracies',
                    'Faster order fulfillment and shipping',
                    'Better space utilization in the warehouse',
                    'Accurate stock counts — fewer surprises during audits',
                    'Improved labor productivity tracking',
                ],
                'features'          => [
                    ['title' => 'Receiving & Put Away', 'description' => 'Streamlined inbound process with directed put-away logic.', 'icon' => '📥'],
                    ['title' => 'Pick, Pack & Ship', 'description' => 'Optimized picking routes, packing verification, and shipping confirmation.', 'icon' => '📦'],
                    ['title' => 'Inventory Control', 'description' => 'Real-time stock levels, lot/serial tracking, and cycle counts.', 'icon' => '🔢'],
                    ['title' => 'Location Management', 'description' => 'Manage bin, rack, zone, and aisle locations efficiently.', 'icon' => '📍'],
                    ['title' => 'Stock Movement', 'description' => 'Track all internal stock transfers and adjustments.', 'icon' => '🔄'],
                    ['title' => 'Reporting', 'description' => 'Inventory reports, activity logs, and performance dashboards.', 'icon' => '📊'],
                ],
                'use_cases'         => [
                    'Distributor managing high-SKU inventory',
                    'E-commerce fulfillment center needing faster pick-and-ship',
                    'Manufacturer controlling raw material and finished goods inventory',
                    'Cold chain operator managing temperature-sensitive stock',
                ],
                'faq_items'         => [
                    ['question' => 'Can WMS handle multiple warehouse locations?', 'answer' => 'Yes. Our WMS supports multi-warehouse and multi-location operations with consolidated inventory visibility.'],
                    ['question' => 'Does WMS support barcode scanning?', 'answer' => 'Yes. Barcode and QR code scanning is supported for receiving, picking, and stock movement operations.'],
                ],
                'seo_title'         => 'Warehouse Management System (WMS) — Innovation Project',
                'seo_description'   => 'Implement a WMS to control your warehouse operations and gain real-time inventory visibility. Innovation Project end-to-end consulting.',
                'status'            => 'published',
            ],
            [
                'name'              => 'Material Resource Planning',
                'slug'              => 'material-resource-planning',
                'short_description' => 'Support production planning, scheduling, purchasing, delivery, and inventory control for manufacturing processes.',
                'description'       => 'Material Resource Planning (MRP) helps manufacturing businesses plan and control their production processes. By analyzing demand, current inventory, and production capacity, an MRP system generates purchase orders and production schedules automatically — ensuring you have the right materials at the right time without overstocking.',
                'benefits'          => [
                    'Eliminate stockouts that halt production',
                    'Reduce excess inventory and carrying costs',
                    'Better production scheduling and capacity utilization',
                    'Automatic purchase order generation based on demand',
                    'Improved supplier coordination and on-time procurement',
                    'Accurate production cost tracking',
                ],
                'features'          => [
                    ['title' => 'Demand Planning', 'description' => 'Calculate material requirements based on sales forecasts and production plans.', 'icon' => '📋'],
                    ['title' => 'Production Scheduling', 'description' => 'Plan and schedule work orders to optimize resource utilization.', 'icon' => '📅'],
                    ['title' => 'Purchase Order Management', 'description' => 'Auto-generate POs based on MRP recommendations.', 'icon' => '🛒'],
                    ['title' => 'Bill of Materials', 'description' => 'Manage multi-level BOM for complex production structures.', 'icon' => '🧩'],
                    ['title' => 'Inventory Control', 'description' => 'Track raw materials, WIP, and finished goods in real time.', 'icon' => '🏷️'],
                    ['title' => 'Supplier Management', 'description' => 'Manage supplier lead times, pricing, and performance.', 'icon' => '🤝'],
                ],
                'use_cases'         => [
                    'Food manufacturer planning production runs and ingredient procurement',
                    'Furniture producer managing complex BOM and supplier lead times',
                    'Electronics assembler coordinating component procurement',
                    'Garment manufacturer scheduling production batches',
                ],
                'faq_items'         => [
                    ['question' => 'Is MRP the same as ERP?', 'answer' => 'MRP is a subset of ERP focused on manufacturing planning. We can implement MRP as a standalone module or as part of a broader ERP solution.'],
                    ['question' => 'Can MRP handle make-to-order and make-to-stock scenarios?', 'answer' => 'Yes. Our MRP implementations support both production strategies and can handle mixed environments.'],
                ],
                'seo_title'         => 'Material Resource Planning (MRP) — Innovation Project',
                'seo_description'   => 'Implement MRP to optimize production planning, reduce inventory costs, and improve procurement. End-to-end consulting by Innovation Project.',
                'status'            => 'published',
            ],
            [
                'name'              => 'IoT Solution',
                'slug'              => 'iot-solution',
                'short_description' => 'Connect physical devices, sensors, software, and systems to exchange data and improve monitoring, automation, and operational visibility.',
                'description'       => 'Internet of Things (IoT) solutions connect your physical assets — machines, vehicles, storage units, environmental sensors — to digital systems that collect, process, and act on real-time data. Innovation Project designs and implements IoT solutions that give businesses unprecedented visibility into their operations, enabling proactive monitoring and data-driven decision-making.',
                'benefits'          => [
                    'Real-time monitoring of equipment, assets, and conditions',
                    'Predictive maintenance to prevent costly downtime',
                    'Automated alerts when thresholds are exceeded',
                    'Data-driven insights for operational optimization',
                    'Reduced manual inspection and monitoring labor',
                    'Improved compliance and audit trail for monitored assets',
                ],
                'features'          => [
                    ['title' => 'Device Connectivity', 'description' => 'Connect sensors, PLCs, machines, and devices via industry protocols.', 'icon' => '🔌'],
                    ['title' => 'Real-Time Dashboard', 'description' => 'Monitor all connected assets on a centralized live dashboard.', 'icon' => '📡'],
                    ['title' => 'Automated Alerts', 'description' => 'Configure threshold alerts and automated notifications.', 'icon' => '🔔'],
                    ['title' => 'Data Logging', 'description' => 'Store historical sensor data for trend analysis and compliance.', 'icon' => '💾'],
                    ['title' => 'Integration', 'description' => 'Integrate IoT data with ERP, WMS, or other business systems.', 'icon' => '🔗'],
                    ['title' => 'Reporting', 'description' => 'Generate reports on asset performance, uptime, and anomalies.', 'icon' => '📈'],
                ],
                'use_cases'         => [
                    'Cold chain monitoring of temperature-sensitive goods in transit',
                    'Factory floor machine monitoring and OEE tracking',
                    'Fleet vehicle tracking and fuel consumption monitoring',
                    'Smart warehouse with automated inventory sensing',
                    'Environmental monitoring for clean rooms or server rooms',
                ],
                'faq_items'         => [
                    ['question' => 'What types of devices can be connected?', 'answer' => 'We support a wide range of devices including temperature/humidity sensors, GPS trackers, RFID readers, industrial PLCs, and more.'],
                    ['question' => 'Can IoT data be integrated with our ERP system?', 'answer' => 'Yes. We design IoT solutions to feed data into your existing ERP, WMS, or analytics platform for a unified operational view.'],
                ],
                'seo_title'         => 'IoT Solution for Business Operations — Innovation Project',
                'seo_description'   => 'Connect your physical assets to digital systems with IoT solutions from Innovation Project. Real-time monitoring, automation, and operational visibility.',
                'status'            => 'published',
            ],
        ];

        foreach ($solutions as $data) {
            Solution::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('✅ 5 Solutions seeded successfully.');
    }
}
