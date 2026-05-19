<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\Milestone;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Certification;
use App\Models\Sector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@pushpraj.com'],
            [
                'name' => 'Pushpraj Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Clear existing entries to prevent duplication on re-seeding
        Project::truncate();
        Service::truncate();
        Milestone::truncate();
        Testimonial::truncate();
        TeamMember::truncate();
        Certification::truncate();
        Sector::truncate();

        // Seed Sectors
        $sectorsData = [
            ['name' => 'Industrial Construction', 'sort_order' => 1],
            ['name' => 'Highways & Roads', 'sort_order' => 2],
            ['name' => 'Bridges & Flyovers', 'sort_order' => 3],
            ['name' => 'EPC Contracts', 'sort_order' => 4],
            ['name' => 'Water Management', 'sort_order' => 5],
            ['name' => 'Residential Projects', 'sort_order' => 6],
            ['name' => 'Commercial', 'sort_order' => 7],
            ['name' => 'Pharmaceutical', 'sort_order' => 8],
            ['name' => 'Infrastructure', 'sort_order' => 9],
            ['name' => 'Civil Works', 'sort_order' => 10],
        ];
        foreach ($sectorsData as $sec) {
            Sector::create($sec);
        }

        // 3. Seed Services Data
        $services = [
            [
                'title' => 'Industrial Construction',
                'icon' => 'factory',
                'description' => 'High-performance factory blueprints, logistics parks, warehouse hubs, and heavy manufacturing facilities customized for heavy industrial operations and logistics.',
                'features' => json_encode(['Factory Blueprints', 'Warehouse Hubs', 'Manufacturing Plants', 'Safety Auditing']),
                'sort_order' => 1,
            ],
            [
                'title' => 'Highways & Roads',
                'icon' => 'route',
                'description' => 'Multi-lane expressways, national highways, urban municipal roads, and rural connectivity passages designed with extreme asphalt durability and traffic engineering.',
                'features' => json_encode(['Asphalt Paving', 'Traffic Safety Systems', 'Bridges & Culverts', 'Soil Stabilization']),
                'sort_order' => 2,
            ],
            [
                'title' => 'Bridges & Flyovers',
                'icon' => 'bridge',
                'description' => 'Heavy civil bridge structures, urban flyovers, and elevated highway overpasses engineered with supreme structural load ratings and long-span durability.',
                'features' => json_encode(['Pre-Stressed Girders', 'Foundation Piling', 'River Crossings', 'Seismic Design']),
                'sort_order' => 3,
            ],
            [
                'title' => 'EPC Contracts',
                'icon' => 'clipboard-check',
                'description' => 'End-to-end engineering, procurement, and construction turnkey solutions for complex utility structures, state infrastructure, and private factory setups.',
                'features' => json_encode(['Turnkey Solutions', 'Procurement Scale', 'Engineering Design', 'Project Management']),
                'sort_order' => 4,
            ],
            [
                'title' => 'Water Management',
                'icon' => 'waves',
                'description' => 'Large scale water distribution channels, urban drainage pipelines, river canal systems, reservoirs, and public treatment networks.',
                'features' => json_encode(['Urban Drainage', 'Water Reservoirs', 'Sewage Pipelines', 'Irrigation Canals']),
                'sort_order' => 5,
            ],
            [
                'title' => 'Residential Projects',
                'icon' => 'home',
                'description' => 'Premium multi-family housing complexes, residential layouts, high-rise luxury apartments, and integrated township grids.',
                'features' => json_encode(['High-rise Apartments', 'Society Layouts', 'Commercial Complexes', 'Eco-friendly Design']),
                'sort_order' => 6,
            ],
        ];
        foreach ($services as $srv) {
            Service::create($srv);
        }

        // 4. Seed Projects Data
        $projects = [
            [
                'title' => 'P. CHHOTALAL MANUFACTURERS',
                'category' => 'industrial',
                'location' => 'Sanand GIDC, Ahmedabad',
                'client' => 'P. Chhotalal',
                'sector' => 'Pharmaceutical',
                'value' => '14.00 Cr',
                'timeline' => '18 Months',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=600&auto=format&fit=crop',
                'description' => 'A massive, state-of-the-art pharmaceutical manufacturing and formulation facility spanning 20+ acres. The build includes high-end structural steel frameworks, a structural glass-mirrored facade, automated shutter bays, heavy concrete flooring foundations, and dedicated climate-controlled storage vaults. We successfully managed the civil, structural, and secondary utility systems compliant with global pharmaceutical safety and GIDC regulations.',
                'sort_order' => 1,
            ],
            [
                'title' => 'BOTAD-GADHADA EXPRESSWAY',
                'category' => 'infrastructure',
                'location' => 'Botad District, Gujarat',
                'client' => 'Gujarat Road Development Board',
                'sector' => 'Infrastructure',
                'value' => '48.50 Cr',
                'timeline' => '24 Months',
                'image' => 'https://images.unsplash.com/photo-1590486803833-1c5dc8ddd4c8?q=80&w=600&auto=format&fit=crop',
                'description' => 'A high-speed 4-lane expressway connecting Botad with Gadhada trade zones. Built with heavy-duty asphalt layers, soil reinforcement, concrete culverts, active safety signaling, and high-contrast reflective paving lines to handle daily heavy commercial transport.',
                'sort_order' => 2,
            ],
            [
                'title' => 'NARMADA RIVER SPILLWAY BRIDGE',
                'category' => 'civil-works',
                'location' => 'Narmada District, Gujarat',
                'client' => 'Sardar Sarovar Narmada Nigam',
                'sector' => 'Civil Works',
                'value' => '32.00 Cr',
                'timeline' => '18 Months',
                'image' => 'https://images.unsplash.com/photo-1545459720-aac33910c682?q=80&w=600&auto=format&fit=crop',
                'description' => 'A heavy-duty civil riverbed bridge. Implemented deep under-water piling, high-tensile pre-stressed girder installations, concrete spans, and seismic joint structures engineered to withstand massive river current velocities during monsoon peak discharges.',
                'sort_order' => 3,
            ],
            [
                'title' => 'PUSHPRAJ CORPORATE HEIGHTS',
                'category' => 'commercial',
                'location' => 'S.G. Highway, Ahmedabad',
                'client' => 'Pushpraj Group',
                'sector' => 'Commercial',
                'value' => '22.50 Cr',
                'timeline' => '15 Months',
                'image' => 'https://images.unsplash.com/photo-1542362567-b07eac790acd?q=80&w=600&auto=format&fit=crop',
                'description' => 'A modern 12-story high-rise commercial workspace building featuring double-glazed architectural glass walling, active energy-efficient internal cooling systems, high-speed lift shafts, dynamic conference auditoriums, and massive double-level underground parking spaces.',
                'sort_order' => 4,
            ],
            [
                'title' => 'SAURASHTRA MAIN CANAL NETWORK',
                'category' => 'infrastructure',
                'location' => 'Rajkot District, Gujarat',
                'client' => 'Gujarat Water Infrastructure Ltd.',
                'sector' => 'Infrastructure',
                'value' => '18.00 Cr',
                'timeline' => '12 Months',
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=600&auto=format&fit=crop',
                'description' => 'Concrete lining, lock assembly, and main canal distribution channels covering over 12 kilometers. This project facilitates dynamic, high-efficiency water supply and agricultural irrigation to regional fields, protecting hundreds of farming families.',
                'sort_order' => 5,
            ],
            [
                'title' => 'RAJKOT HEIGHTS RESIDENTIAL SOCIETY',
                'category' => 'residential',
                'location' => 'Kalawad Road, Rajkot',
                'client' => 'Heights Development Group',
                'sector' => 'Residential',
                'value' => '35.00 Cr',
                'timeline' => '20 Months',
                'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=600&auto=format&fit=crop',
                'description' => 'A premium multi-family township containing four 10-story towers. The structure includes earthquake-resistant seismic shear walls, integrated rainwater harvesting reservoirs, luxury central pools, modern clubhouses, and robust smart home features.',
                'sort_order' => 6,
            ],
        ];
        foreach ($projects as $proj) {
            Project::create($proj);
        }

        // 5. Seed Milestones Data
        $milestones = [
            [
                'year' => '2005',
                'title' => 'Corporate Foundation',
                'description' => 'Pushpraj Construction was founded in Botad, Gujarat by Mr. Rajeshbhai Patel, starting with a core team of five engineers and basic machinery.',
                'sort_order' => 1,
            ],
            [
                'year' => '2010',
                'title' => 'Class-A Government License',
                'description' => 'Earned the official Class-A Government Contractor certification, permitting bid submissions for major state infrastructure and unlimited civil works.',
                'sort_order' => 2,
            ],
            [
                'year' => '2016',
                'title' => '50+ Major Landmarks',
                'description' => 'Crossed the threshold of 50 successfully delivered district roads, municipal bridges, and heavy industrial warehouses across the region.',
                'sort_order' => 3,
            ],
            [
                'year' => '2021',
                'title' => 'Turnkey EPC Contract Scaling',
                'description' => 'Established dedicated corporate EPC divisions, taking on full-scale manufacturing setups, factory networks, and large logistics park developments.',
                'sort_order' => 4,
            ],
            [
                'year' => '2026',
                'title' => 'ISO Standard Engineering & 150+ Deliveries',
                'description' => 'Expanded operations globally and nationally, securing ISO 9001 and ISO 45001 certificates while delivering over 150+ finished public-private structures.',
                'sort_order' => 5,
            ],
        ];
        foreach ($milestones as $miles) {
            Milestone::create($miles);
        }

        // 6. Seed Certifications Data
        $certifications = [
            [
                'title' => 'ISO 9001:2015 Quality Standards',
                'description' => 'Validates that our materials, concrete strength testing labs, site planning structures, and project management flows strictly follow international quality control audits.',
                'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=600&auto=format&fit=crop',
                'sort_order' => 1,
            ],
            [
                'title' => 'ISO 45001:2018 Safety Management',
                'description' => 'Ensures the highest standards of safety are met across all active development zones, establishing a zero-harm environment, regular audits, and custom scaffolding standards.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=600&auto=format&fit=crop',
                'sort_order' => 2,
            ],
            [
                'title' => 'Government Class-A Registry Certificate',
                'description' => 'High-ranking legal certificate granted by state authorities, acknowledging our engineering infrastructure, financial health, and safety compliance records.',
                'image' => 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?q=80&w=600&auto=format&fit=crop',
                'sort_order' => 3,
            ],
        ];
        foreach ($certifications as $cert) {
            Certification::create($cert);
        }

        // 7. Seed Team Members Data
        $team = [
            [
                'name' => 'Mr. Rajeshbhai V. Patel',
                'role' => 'Founder & Managing Director',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop',
                'linkedin_url' => '#',
                'email' => 'rajesh@pushpraj.com',
                'sort_order' => 1,
            ],
            [
                'name' => 'Mr. Amit R. Patel',
                'role' => 'Director & Chief Project Coordinator',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop',
                'linkedin_url' => '#',
                'email' => 'amit@pushpraj.com',
                'sort_order' => 2,
            ],
            [
                'name' => 'Er. Hardik Shah',
                'role' => 'Chief Structural Planner & Consultant',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop',
                'linkedin_url' => '#',
                'email' => 'hardik@pushpraj.com',
                'sort_order' => 3,
            ],
        ];
        foreach ($team as $member) {
            TeamMember::create($member);
        }

        // 8. Seed Testimonials Data
        $testimonials = [
            [
                'name' => 'Mansukhbhai Savaliya',
                'company' => 'Botad Cotton Industries',
                'role' => 'Chairman & Founder',
                'rating' => 5,
                'text' => 'Pushpraj Construction delivered our heavy cotton processing factory park and logistics bay ahead of our requested deadline. Their commitment to site safety and steel fabrication structural integrity was outstanding!',
                'sort_order' => 1,
            ],
            [
                'name' => 'Er. Sanjay Mehta',
                'company' => 'Gujarat Road Development Board',
                'role' => 'Superintending Engineer',
                'rating' => 5,
                'text' => 'We partnered with the Pushpraj team on the State Route 10 highway widening project. They displayed professional asphalt engineering grading, rigorous safety measures, and exceptional coordination from start to finish.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kiritbhai Sheth',
                'company' => 'Sheth Warehousing & Logistics',
                'role' => 'Managing Director',
                'rating' => 5,
                'text' => 'A masterclass in civil works. The multi-span heavy warehouse factories and foundation bases they completed for us are extremely robust, durable, and customized perfectly for our heavy load weights.',
                'sort_order' => 3,
            ],
        ];
        foreach ($testimonials as $test) {
            Testimonial::create($test);
        }
    }
}
