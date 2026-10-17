<?php
/**
 * Site settings.
 *
 * Everything the website shows (company name, contact details, services,
 * cities, FAQ) is read from this file. Edit the values below and every
 * page updates. Anything left as '' is simply not shown.
 */
return [

    // ---- Company -------------------------------------------------------
    'name'        => 'Movora',
    'tagline'     => 'Packers & Movers · Logistics',
    'legal_name'  => '',          // shown in the footer when set
    'established' => '',          // e.g. '2012'
    'gst'         => '',          // GSTIN
    'about'       => [
        'Movora provides packers and movers services and road freight logistics for households, offices and businesses, within the city, across the country and overseas.',
        'We look after the whole job: survey, packing, loading, transport, unloading and unpacking. You deal with one point of contact from the first call to the final delivery.',
    ],

    // ---- Contact -------------------------------------------------------
    'phone'    => '+91 00000 00000',
    'whatsapp' => '',             // digits only, with country code (919876543210). Falls back to phone.
    'email'    => 'info@example.com',
    'hours'    => 'Monday to Saturday, 9:00 am to 7:00 pm',
    'address'  => [
        'line1' => 'Street address, Area',
        'city'  => 'City',
        'state' => 'State',
        'pin'   => '000000',
    ],

    // ---- Site ----------------------------------------------------------
    'url'       => 'https://www.example.com',   // domain only, no trailing slash
    'base_path' => '',                          // '' at domain root, '/folder' if the site lives in a subfolder
    'logo'      => 'assets/img/logo.png',       // text wordmark is used when empty
    'timezone'  => 'Asia/Kolkata',

    // Enquiries are emailed here and also saved to storage/enquiries.log
    'mail_to'   => 'info@example.com',
    'mail_from' => 'no-reply@example.com',      // use an address on your own domain, or mail may be rejected
    'secret'    => '',                          // any long random string; used to sign the form timestamp

    // ---- Coverage ------------------------------------------------------
    'cities' => [
        'Delhi NCR', 'Mumbai', 'Pune', 'Bengaluru', 'Hyderabad', 'Chennai',
        'Kolkata', 'Ahmedabad', 'Jaipur', 'Lucknow', 'Chandigarh', 'Indore',
    ],

    // ---- Short points under the hero -----------------------------------
    'commitments' => [
        ['Written quotes',   'Itemised before you confirm anything.'],
        ['Room-wise packing', 'Cartons are numbered and listed.'],
        ['Transit cover',    'Insurance can be arranged for your goods.'],
        ['Status updates',   'On call or WhatsApp, from dispatch to delivery.'],
    ],

    // ---- Services ------------------------------------------------------
    'services' => [
        'packers' => [
            'label' => 'Packers & Movers',
            'items' => [
                [
                    'slug'        => 'home-shifting',
                    'title'       => 'Home shifting',
                    'summary'     => 'Full-home moves within the city or between cities.',
                    'description' => 'A complete relocation for flats, houses and villas. We pack room by room, dismantle furniture where needed, load, transport, unload and set things up at the new address.',
                    'includes'    => [
                        'Room-wise packing and labelling',
                        'Dismantling and reassembly of beds, wardrobes and tables',
                        'Careful handling of appliances, glass and fragile items',
                        'Loading, transport and unloading',
                        'Unpacking and placement on request',
                    ],
                ],
                [
                    'slug'        => 'office-relocation',
                    'title'       => 'Office relocation',
                    'summary'     => 'Planned moves for offices, shops and clinics.',
                    'description' => 'Office moves need a schedule. We plan the sequence with you so that desks, IT equipment and records arrive in an order your team can work with.',
                    'includes'    => [
                        'Workstation, IT and server equipment packing',
                        'Numbered file and record cartons',
                        'Moves scheduled outside working hours where needed',
                        'Dismantling and refitting of modular furniture',
                    ],
                ],
                [
                    'slug'        => 'local-shifting',
                    'title'       => 'Local shifting',
                    'summary'     => 'Within-city moves, usually completed in a day.',
                    'description' => 'For moves inside one city we send a vehicle sized to the load and a crew to pack, load and unload, so the move is usually finished the same day.',
                    'includes'    => [
                        'Vehicle sized to the load',
                        'Loading and unloading crew',
                        'Packing materials available',
                        'Fixed time window agreed in advance',
                    ],
                ],
                [
                    'slug'        => 'international-moving',
                    'title'       => 'International moving',
                    'summary'     => 'Household and personal goods moved overseas.',
                    'description' => 'Moving to or from another country involves packing standards, paperwork and coordination at both ends. We plan the shipment with you from packing to delivery.',
                    'includes'    => [
                        'Export-grade packing and inventory',
                        'Guidance on the documents you will need',
                        'Sea and air shipment options',
                        'Coordination with the agent at the destination',
                    ],
                ],
                [
                    'slug'        => 'vehicle-transportation',
                    'title'       => 'Car and bike transport',
                    'summary'     => 'Cars and two-wheelers moved between cities.',
                    'description' => 'Your vehicle can travel separately from the household goods. We note its condition at loading and again at delivery.',
                    'includes'    => [
                        'Cars and two-wheelers',
                        'Pickup and delivery at your address',
                        'Condition recorded at loading and delivery',
                    ],
                ],
                [
                    'slug'        => 'packing-unpacking',
                    'title'       => 'Packing and unpacking',
                    'summary'     => 'Packing materials and crew, with or without the move.',
                    'description' => 'If you only need help packing, or only unpacking at the other end, we can send a crew without the transport.',
                    'includes'    => [
                        'Corrugated cartons, bubble wrap, foam and stretch film',
                        'Furniture blankets and corner guards',
                        'Wardrobe boxes for hanging clothes',
                        'Cartons removed after unpacking',
                    ],
                ],
            ],
        ],
        'logistics' => [
            'label' => 'Logistics',
            'items' => [
                [
                    'slug'        => 'full-truck-load',
                    'title'       => 'Full truck load',
                    'summary'     => 'A dedicated vehicle for your consignment.',
                    'description' => 'The whole vehicle is yours for one consignment, point to point. Suitable for bulk goods and for shipments with a fixed delivery date.',
                    'includes'    => [
                        'Vehicle size chosen to suit the load',
                        'Point-to-point transit',
                        'Loading and unloading support',
                        'Lorry receipt with every dispatch',
                    ],
                ],
                [
                    'slug'        => 'part-load',
                    'title'       => 'Part load',
                    'summary'     => 'Share vehicle space for smaller consignments.',
                    'description' => 'For consignments that do not need a full vehicle. Your goods travel with other consignments on the same route and you pay for the space you use.',
                    'includes'    => [
                        'Charged by weight or volume',
                        'Consolidated with other consignments on the route',
                        'Lorry receipt with every dispatch',
                    ],
                ],
                [
                    'slug'        => 'warehousing',
                    'title'       => 'Warehousing and storage',
                    'summary'     => 'Short- and long-term storage for homes and businesses.',
                    'description' => 'Storage between moves, or for business stock that needs to wait before dispatch. Goods are recorded when they come in and when they go out.',
                    'includes'    => [
                        'Short- and long-term storage',
                        'Household goods and business stock',
                        'Entry and exit recorded',
                        'Access by prior appointment',
                    ],
                ],
                [
                    'slug'        => 'industrial-shifting',
                    'title'       => 'Industrial shifting',
                    'summary'     => 'Machinery and equipment, dismantled and re-installed.',
                    'description' => 'Plant, machinery and heavy equipment need to be dismantled, crated and lifted correctly. We plan the move around the equipment and the site.',
                    'includes'    => [
                        'Dismantling, packing and crating',
                        'Loading with suitable lifting equipment',
                        'Re-installation support on request',
                    ],
                ],
            ],
        ],
    ],

    // ---- How a move works ----------------------------------------------
    'steps' => [
        ['Enquiry and survey',   'Tell us what is moving and where. For larger moves we visit, list the items and note access at both ends.'],
        ['Written quote',        'You receive an itemised quote that says what is included. The date and time window are agreed before you confirm.'],
        ['Packing and loading',  'The crew packs room by room, labels every carton and loads the vehicle in the order it will be unloaded.'],
        ['Transit and delivery', 'We deliver, unload and place the goods. Unpacking and furniture assembly are done on request.'],
    ],

    // ---- Questions people ask -------------------------------------------
    'faq' => [
        [
            'How is the cost worked out?',
            'It depends on the volume or weight of the goods, the distance, floor and lift access at both ends, the packing material needed and the time of the month or year. We give a written quote once we have these details, or after a survey for larger moves.',
        ],
        [
            'Can I get a quote without a survey?',
            'For a small move, a list of items sent by phone or WhatsApp is usually enough. For a full house or an office we recommend a survey so that the quote is accurate.',
        ],
        [
            'How early should I book?',
            'As soon as your date is fixed. Month-end and weekends fill up first. If your move is at short notice, call us and we will tell you what is possible.',
        ],
        [
            'Are my goods insured in transit?',
            'Transit insurance can be arranged on request. Ask for the terms when you request a quote; the cover and the claim process are explained before you confirm.',
        ],
        [
            'Do you dismantle and reassemble furniture?',
            'Yes. Beds, wardrobes, tables and modular furniture can be dismantled for the move and reassembled at the new address.',
        ],
    ],
];
