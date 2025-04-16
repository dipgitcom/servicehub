<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ServiceOption;

class AdditionalCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // New categories to add
        $newCategories = [
            [
                'name' => 'Home Renovation',
                'slug' => 'home-renovation',
                'description' => 'Professional home renovation and remodeling services',
                'icon' => 'home',
                'services' => [
                    [
                        'title' => 'Kitchen Renovation',
                        'description' => 'Complete kitchen renovation services including cabinets, countertops, and appliance installation.',
                        'price' => 25000,
                        'icon' => 'coffee'
                    ],
                    [
                        'title' => 'Bathroom Remodeling',
                        'description' => 'Transform your bathroom with our professional remodeling services.',
                        'price' => 18000,
                        'icon' => 'droplet'
                    ],
                    [
                        'title' => 'Interior Painting',
                        'description' => 'Professional interior painting services for a fresh new look.',
                        'price' => 8000,
                        'icon' => 'paint-bucket'
                    ]
                ]
            ],
            [
                'name' => 'Car Services',
                'slug' => 'car-services',
                'description' => 'Comprehensive car maintenance and repair services',
                'icon' => 'car',
                'services' => [
                    [
                        'title' => 'Car Wash & Detailing',
                        'description' => 'Professional car washing and detailing services to keep your vehicle looking its best.',
                        'price' => 1200,
                        'icon' => 'droplet'
                    ],
                    [
                        'title' => 'Engine Oil Change',
                        'description' => 'Regular oil changes to keep your engine running smoothly.',
                        'price' => 1500,
                        'icon' => 'tool'
                    ],
                    [
                        'title' => 'Car AC Service',
                        'description' => 'Complete car air conditioning service and repair.',
                        'price' => 2500,
                        'icon' => 'thermometer'
                    ],
                    [
                        'title' => 'Tire Replacement',
                        'description' => 'Professional tire replacement and balancing services.',
                        'price' => 3500,
                        'icon' => 'circle'
                    ]
                ]
            ],
            [
                'name' => 'Computer & IT Services',
                'slug' => 'computer-it-services',
                'description' => 'Professional computer repair and IT support services',
                'icon' => 'laptop',
                'services' => [
                    [
                        'title' => 'Computer Repair',
                        'description' => 'Professional repair services for desktops and laptops.',
                        'price' => 1500,
                        'icon' => 'tool'
                    ],
                    [
                        'title' => 'Virus Removal',
                        'description' => 'Remove viruses, malware, and other threats from your computer.',
                        'price' => 1200,
                        'icon' => 'shield'
                    ],
                    [
                        'title' => 'Data Recovery',
                        'description' => 'Recover lost or deleted data from your hard drive or other storage devices.',
                        'price' => 3000,
                        'icon' => 'database'
                    ],
                    [
                        'title' => 'Network Setup',
                        'description' => 'Professional setup and configuration of home or office networks.',
                        'price' => 2500,
                        'icon' => 'wifi'
                    ]
                ]
            ],
            [
                'name' => 'Event Management',
                'slug' => 'event-management',
                'description' => 'Professional event planning and management services',
                'icon' => 'calendar',
                'services' => [
                    [
                        'title' => 'Birthday Party Planning',
                        'description' => 'Complete birthday party planning and execution services.',
                        'price' => 15000,
                        'icon' => 'gift'
                    ],
                    [
                        'title' => 'Wedding Planning',
                        'description' => 'Comprehensive wedding planning services to make your special day perfect.',
                        'price' => 50000,
                        'icon' => 'heart'
                    ],
                    [
                        'title' => 'Corporate Event Management',
                        'description' => 'Professional planning and management of corporate events and conferences.',
                        'price' => 35000,
                        'icon' => 'briefcase'
                    ]
                ]
            ],
            [
                'name' => 'Home Security',
                'slug' => 'home-security',
                'description' => 'Professional home security installation and monitoring services',
                'icon' => 'lock',
                'services' => [
                    [
                        'title' => 'CCTV Installation',
                        'description' => 'Professional installation of CCTV cameras for home or business security.',
                        'price' => 12000,
                        'icon' => 'video'
                    ],
                    [
                        'title' => 'Smart Lock Installation',
                        'description' => 'Installation and setup of smart locks for enhanced security and convenience.',
                        'price' => 5000,
                        'icon' => 'key'
                    ],
                    [
                        'title' => 'Security System Setup',
                        'description' => 'Complete security system installation including alarms and sensors.',
                        'price' => 18000,
                        'icon' => 'bell'
                    ]
                ]
            ],
            [
                'name' => 'Tutoring & Education',
                'slug' => 'tutoring-education',
                'description' => 'Professional tutoring and educational services',
                'icon' => 'book',
                'services' => [
                    [
                        'title' => 'Math Tutoring',
                        'description' => 'Professional math tutoring for students of all levels.',
                        'price' => 800,
                        'icon' => 'plus'
                    ],
                    [
                        'title' => 'Language Lessons',
                        'description' => 'Learn a new language with our professional language tutors.',
                        'price' => 1000,
                        'icon' => 'message-circle'
                    ],
                    [
                        'title' => 'Test Preparation',
                        'description' => 'Comprehensive preparation for standardized tests and exams.',
                        'price' => 1200,
                        'icon' => 'file-text'
                    ]
                ]
            ],
            [
                'name' => 'Photography & Videography',
                'slug' => 'photography-videography',
                'description' => 'Professional photography and videography services',
                'icon' => 'camera',
                'services' => [
                    [
                        'title' => 'Wedding Photography',
                        'description' => 'Professional photography services to capture your special day.',
                        'price' => 25000,
                        'icon' => 'image'
                    ],
                    [
                        'title' => 'Product Photography',
                        'description' => 'High-quality product photography for e-commerce and marketing.',
                        'price' => 5000,
                        'icon' => 'shopping-bag'
                    ],
                    [
                        'title' => 'Event Videography',
                        'description' => 'Professional video recording and editing for events and special occasions.',
                        'price' => 20000,
                        'icon' => 'video'
                    ]
                ]
            ],
            [
                'name' => 'Gardening & Landscaping',
                'slug' => 'gardening-landscaping',
                'description' => 'Professional gardening and landscaping services',
                'icon' => 'flower',
                'services' => [
                    [
                        'title' => 'Garden Maintenance',
                        'description' => 'Regular garden maintenance services to keep your outdoor space looking beautiful.',
                        'price' => 2000,
                        'icon' => 'scissors'
                    ],
                    [
                        'title' => 'Landscape Design',
                        'description' => 'Professional landscape design and implementation for your outdoor space.',
                        'price' => 15000,
                        'icon' => 'map'
                    ],
                    [
                        'title' => 'Tree Trimming & Removal',
                        'description' => 'Professional tree trimming, pruning, and removal services.',
                        'price' => 5000,
                        'icon' => 'git-branch'
                    ]
                ]
            ],
            [
                'name' => 'Food & Catering',
                'slug' => 'food-catering',
                'description' => 'Professional food and catering services',
                'icon' => 'coffee',
                'services' => [
                    [
                        'title' => 'Event Catering',
                        'description' => 'Professional catering services for events and special occasions.',
                        'price' => 20000,
                        'icon' => 'utensils'
                    ],
                    [
                        'title' => 'Personal Chef',
                        'description' => 'Hire a personal chef to prepare meals in your home.',
                        'price' => 5000,
                        'icon' => 'chef-hat'
                    ],
                    [
                        'title' => 'Cake & Dessert Delivery',
                        'description' => 'Custom cakes and desserts delivered for your special occasions.',
                        'price' => 2500,
                        'icon' => 'cake'
                    ]
                ]
            ],
            [
                'name' => 'Legal Services',
                'slug' => 'legal-services',
                'description' => 'Professional legal services and consultation',
                'icon' => 'file-text',
                'services' => [
                    [
                        'title' => 'Legal Consultation',
                        'description' => 'Professional legal consultation for various matters.',
                        'price' => 3000,
                        'icon' => 'briefcase'
                    ],
                    [
                        'title' => 'Document Preparation',
                        'description' => 'Professional preparation of legal documents and contracts.',
                        'price' => 5000,
                        'icon' => 'file'
                    ],
                    [
                        'title' => 'Property Law Services',
                        'description' => 'Legal services related to property transactions and disputes.',
                        'price' => 8000,
                        'icon' => 'home'
                    ]
                ]
            ]
        ];

        // Create categories and services
        foreach ($newCategories as $categoryData) {
            $services = $categoryData['services'];
            unset($categoryData['services']);
            
            // Create category
            $category = ServiceCategory::create($categoryData);
            
            // Create services for this category
            foreach ($services as $serviceData) {
                $service = Service::create([
                    'title' => $serviceData['title'],
                    'slug' => strtolower(str_replace(' ', '-', $serviceData['title'])),
                    'description' => $serviceData['description'],
                    'price' => $serviceData['price'],
                    'image' => 'services/service-placeholder.jpg',
                    'category_id' => $category->id,
                    'is_featured' => rand(0, 1),
                    'status' => 1,
                    'icon' => $serviceData['icon']
                ]);
                
                // Create service options
                ServiceOption::create([
                    'service_id' => $service->id,
                    'name' => 'Standard Package',
                    'description' => 'Standard service package',
                    'price' => $serviceData['price'],
                    'original_price' => $serviceData['price'] * 1.2,
                    'status' => 1
                ]);
                
                ServiceOption::create([
                    'service_id' => $service->id,
                    'name' => 'Premium Package',
                    'description' => 'Premium service package with additional features',
                    'price' => $serviceData['price'] * 1.5,
                    'original_price' => $serviceData['price'] * 1.8,
                    'status' => 1
                ]);
            }
        }
    }
}
