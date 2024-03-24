<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Lesson;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public static $fakeVideoURLs = [
        [
            'title' => 'Dead Cells - Return To Castlevania Original Soundtrack',
            'url' => 'https://www.youtube.com/watch?v=QyF1SvmpC_Q',
        ],
        [
            'title' => 'Dead Cells Demake Soundtrack',
            'url' => 'https://www.youtube.com/watch?v=cTkm4RM8ijU',
        ],
        [
            'title' => 'Puzzle Forge Dungeon Soundtrack',
            'url' => 'https://www.youtube.com/watch?v=Tx5qOAi6i3Q',
        ],
        [
            'title' => 'Remixes',
            'url' => 'https://www.youtube.com/watch?v=Eg2V9BQlUz0',
        ],
        [
            'title' => 'Dead Cells Official Soundtrack',
            'url' => 'https://www.youtube.com/watch?v=caM1MxmV3Ps',
        ],
        [
            'title' => 'Dead Cells - Title (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=caM1MxmV3Ps',
        ],
        [
            'title' => 'Dead Cells - Prisoners Awakening (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=CzK3z8MLSpA',
        ],
        [
            'title' => 'Dead Cells - Promenade Of The Condemned (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=fkVU0-L3vP0',
        ],
        [
            'title' => 'Dead Cells - The Merchant (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=NKzuSzGhiVQ',
        ],
        [
            'title' => 'Dead Cells - Prisons Rooftop (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=hPoPbmovCJQ',
        ],
        [
            'title' => 'Dead Cells - Black Bridge (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=hHqXhA9eXWs',
        ],
        [
            'title' => 'Dead Cells - The Village (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=9JO11kms23k',
        ],
        [
            'title' => 'Dead Cells - Toxic Sewers (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=zXtMVd3vbWw',
        ],
        [
            'title' => 'Dead Cells - Ossuary (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=OvOjyrBNUFw',
        ],
        [
            'title' => 'Dead Cells - Elite Fight (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=Udf2E3g3TIg',
        ],
        [
            'title' => 'Dead Cells - Old Sewers (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=NiROsJXHjoI',
        ],
        [
            'title' => 'Dead Cells - The Cemetery (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=dyU1LkECF8U',
        ],
        [
            'title' => 'Dead Cell - Conjonctivius (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=L89h9wbJpU0',
        ],
        [
            'title' => 'Dead Cells - Prisons Depths (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=XKkGMfUkkZQ',
        ],
        [
            'title' => 'Dead Cells- Prison Theme (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=dRmJGLZSVOQ',
        ],
        [
            'title' => 'Dead Cells - The Crypt (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=eJehlLCsBH4',
        ],
        [
            'title' => 'Dead Cells - Weapon Merchant (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=N2rVy8Ce5E0',
        ],
        [
            'title' => 'Dead Cells - The Cook (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=skMRWnx5U4o',
        ],
        [
            'title' => 'Dead Cells - Temple (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=fg0R4w7LvG4',
        ],
        [
            'title' => 'Dead Cells - ClockTower (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=fZ1Pk8HBYJU',
        ],
        [
            'title' => 'Dead Cells - Formerly Known As Assassin (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=cH8uFP_jDm0',
        ],
        [
            'title' => 'Dead Cells - Collectors Theme (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=T27n796LAaE',
        ],
        [
            'title' => 'Dead Cells - Castle (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=WGc2i8S9biE',
        ],
        [
            'title' => 'Dead Cells - Hand Of The King (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=Db701jABalw',
        ],
        [
            'title' => 'Dead Cells - Credits (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=MJYqLJg5a0s',
        ],
        [
            'title' => 'Dead Cells - Cavern (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=UnC9brx5NH8',
        ],
        [
            'title' => 'Dead Cells - Guardians Haven (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=B3eb3d5-9MI',
        ],
        [
            'title' => 'Astrolab (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=DrlKVx_nTB4',
        ],
        [
            'title' => 'Observatory (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=-5kXChODPKc',
        ],
        [
            'title' => 'Time For Your \\"Medicine\\" (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=6O-vJYtZfpc',
        ],
        [
            'title' => 'Dead Cells - Arboretum (Bad Seeds DLC Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=vRKI2PU_y_o',
        ],
        [
            'title' => 'Dead Cells - Corrupted Prison (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=ENYCSfB11dY',
        ],
        [
            'title' => 'Dead Cells - Swamp (Dead Cells DLC Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=TnXUgjabsmA',
        ],
        [
            'title' => 'Dead Cells - Heart of the swamp (DLC Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=XBJqpn6vbIc',
        ],
        [
            'title' => 'Dead Cells - Distillery (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=qB1Y6XqyjLM',
        ],
        [
            'title' => 'Fractured Shrines - Dead Cells Fatal Falls (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=gMTHc78x8fo',
        ],
        [
            'title' => 'The Undying Shores - Dead Cells Fatal Falls (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=NaxnJrrMVl0',
        ],
        [
            'title' => 'The Mausoleum - Dead Cells Fatal Falls (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=ykEyXFZsutg',
        ],
        [
            'title' => 'Keep Off The Flowers - Dead Cells Fatal Falls (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=_oiyiEpautc',
        ],
        [
            'title' => 'The Crown -  The Queen And The Sea DLC (Dead Cells Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=oT90TxBJ_2E',
        ],
        [
            'title' => 'Lighthouse - Dead Cells The Queen And The Sea (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=7fqHBOTFgcI',
        ],
        [
            'title' => 'Shipwreck - Dead Cells The Queen And The Sea (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=E7X7enEpDd8',
        ],
        [
            'title' => 'Beyond Reasoning (The Queen) - Dead Cells The Queen And The Sea (Official Soundtrack)',
            'url' => 'https://www.youtube.com/watch?v=X2jpclkerDI',
        ],
        [
            'title' => 'Bloc Party Boat (From Dead Cells Animated Trailer The Queen And The Sea)',
            'url' => 'https://www.youtube.com/watch?v=gFRG3LsJUY4',
        ],
        [
            'title' => 'Dead Cells - Bank',
            'url' => 'https://www.youtube.com/watch?v=R-d5whjYwFc',
        ],
        [
            'title' => 'Dead Cells - Bank Elevator (All Tracks)',
            'url' => 'https://www.youtube.com/watch?v=72yNKek6d_0',
        ],
        [
            'title' => 'Dead Cells - Bank Elevator (Prisoners Awakening)',
            'url' => 'https://www.youtube.com/watch?v=CME0yGCfHOo',
        ],
        [
            'title' => 'Dead Cells -  Bank Elevator (PanMaster Slash)',
            'url' => 'https://www.youtube.com/watch?v=4aY4bz0iO6M',
        ],
        [
            'title' => 'Dead Cells - Bank Elevator (ClockTower)',
            'url' => 'https://www.youtube.com/watch?v=z51UmmnZOhA',
        ],
        [
            'title' => 'Game music',
            'url' => 'https://www.youtube.com/watch?v=5qajT8lS2ok',
        ],
    ];

    public function definition(): array
    {
        $randomVideo = $this->faker->randomElement(self::$fakeVideoURLs);
        return [
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
            'title' => $randomVideo['title'],
            'description' => $this->faker->text(),
            'video_url' => $randomVideo['url'],
            'order' => $this->faker->randomNumber(),
        ];
    }
}
