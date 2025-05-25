<?php

class DummyDataImporter
{
    public function insert_alviit_Cf_household_rooms_data()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'alviit_cf_household_rooms';

        // Check if table exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") !== $table_name) {
            return;
        }

        $room_items = [
            'WOONKAMER' => [
                ['Dozen', 0.1], ['2-persoonsbank', 1], ['3-persoonsbank', 1.5], ['Fauteuil', 0.5],
                ['Tapijt', 0.5], ['Stoel', 0.2], ['Kast', 1], ['Salontafel', 0.4],
                ['Buffetkast', 1], ['Bureau', 1], ['Eettafel', 0.75], ['Dressoir', 1],
                ['Grote stoel', 0.5], ['Schilderijen', 0.15], ['Planten', 0.1], ['Secretaire', 0.5],
                ['Bijzettafel', 0.2], ['Klein meubel', 0.3], ['TV', 0.4],
            ],
            'SLAAPKAMER' => [
                ['Dozen', 0.1], ['Babybadje', 0.2], ['Nachtkastje', 0.3], ['Box', 0.2],
                ['Stoel', 0.2], ['Ombouw', 0.5], ['Wieg', 0.4], ['Kast met 2 deuren', 1],
                ['Kast met 3 deuren', 2], ['Bureau', 1], ['Tweepersoonsbed', 0.7], ['Ladekast', 1],
                ['Kaptafel', 0.6], ['Kinderstoel (baby)', 0.15], ['Groot speelgoed', 0.5],
                ['Grote kledingkast', 0.6], ['Matras', 0.1], ['Eenpersoonsbed', 0.3],
                ['Kleine kledingkast', 0.4], ['Stereo', 0.2], ['TV', 0.4],
            ],
            'BADKAMER' => [
                ['Dozen', 0.1], ['Kast', 1], ['Droger', 0.6], ['Wasmachine', 0.6],
            ],
            'WERKKAMER' => [
                ['Dozen', 0.1], ['Boekenkast', 1], ['Stoel', 0.2], ['Computer', 0.25], ['Bureau', 1],
            ],
            'KEUKEN' => [
                ['Dozen', 0.1], ['Buffet', 1], ['Kast', 1], ['Eethoek', 1],
                ['Vaatwasser', 0.5], ['Vriezer', 0.5], ['Magnetron', 0.3],
                ['Oven', 0.3], ['Koelkast', 0.5], ['Fornuis', 0.5],
            ],
            'SCHUUR' => [
                ['Dozen', 0.1], ['Tuingereedschap', 0.5], ['Ladder', 0.3],
                ['Grote fiets', 0.5], ['Kleine fiets', 0.3], ['Werkbank', 1],
            ],
            'TUIN' => [
                ['Tuintafels', 0.75], ['Plantenbak', 0.5], ['Hout', 0.1],
            ],
            'ZOLDER' => [
                ['Dozen', 0.1], ['Bed', 0.3], ['Kampeeruitrusting', 1],
                ['Kerstversiering', 0.5], ['Kast', 1], ['Wiegje', 0.5],
            ],
            'OVERIG' => [
                ['Overig 0.5m3', 0.5], ['Overig 1.0m3', 1],
            ]
        ];

        foreach ($room_items as $room => $items) {
            foreach ($items as [$item, $m3_value]) {
                $wpdb->insert(
                    $table_name,
                    [
                        'room_name'   => $room,
                        'item_name'   => $item,
                        'm3_value'    => $m3_value,
                        'created_at'  => current_time('mysql'),
                        'updated_at'  => current_time('mysql')
                    ]
                );
            }
        }
    }
}
