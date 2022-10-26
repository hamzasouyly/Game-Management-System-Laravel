<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => "ECAFLIP'S COIN",
            'discription' => "Unpredictable Fighter

            Ecaflips are warrior gamblers who can be found anywhere they can win big or lose everything... True Ecaflips never stop gambling, and they always go all in.",

            'image' => 'https://www.gamosaurus.com/wp-content/uploads/dofus/vignettes-classes-dofus/ecaflip-eca-stuff-dofus-vignette-gamosaurus-680x382.jpg',

            'Slug' => 'Category-Nft',
            'nft_id' => '1',
            'images_male' => json_encode([
                '1' => 'https://static.ankama.com/dofus/renderer/look/7b317c36302c323039327c313d31363338303633342c323d31333732363031322c333d31363733353737382c343d323738363138362c353d31363736313930347c3135307d/full/0/250_250-10_100.png',
                '2' => 'https://static.ankama.com/dofus/renderer/look/7b317c38302c323132347c313d31363736353536342c323d31363335353838332c333d31363737373138352c343d323931303036342c353d31343536313739397c3134307d/full/1/250_250-10_100.png',
                '3' => 'https://static.ankama.com/dofus/renderer/look/7b317c36302c323039327c313d31363338303633342c323d31333732363031322c333d31363733353737382c343d323738363138362c353d31363736313930347c3135307d/full/3/250_250-10_100.png'
            ]),
            'images_female' => json_encode([
                '1' => 'https://static.ankama.com/dofus/renderer/look/7b317c36312c323130307c313d31363338303633342c323d31343337383736392c333d31343536383733352c343d31333230313138312c353d323035373034367c3135307d/full/1/250_250-10_100.png',
                '2' => 'https://static.ankama.com/dofus/renderer/look/7b317c36312c323130307c313d31363338303633342c323d31343337383736392c333d31343536383733352c343d31333230313138312c353d323035373034367c3135307d/full/2/250_250-10_100.png',
                '3' => 'https://static.ankama.com/dofus/renderer/look/7b317c36312c323130307c313d31363338303633342c323d31343337383736392c333d31343536383733352c343d31333230313138312c353d323035373034367c3135307d/full/3/250_250-10_100.png'
            ]),

        ];
    }
}
