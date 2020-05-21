<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    protected $menus = [
        [
            'name'                      =>  'Root',
            'description'               =>  'This is the root category, don\'t delete this one',
            'parent_id'                 =>  null,
            'activeStatus'              =>  0,
            'order'                     =>  0,
        ],
        [
            'name'                      =>  'Organization',
            'description'               =>  'Organization',
            'parent_id'                 =>  1,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Activity',
            'description'               =>  'Organization',
            'parent_id'                 =>  1,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Education',
            'description'               =>  'Organization',
            'parent_id'                 =>  1,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Gallery',
            'description'               =>  '',
            'parent_id'                 =>  1,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'More',
            'description'               =>  '',
            'parent_id'                 =>  1,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Journey of DUDSF',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Committee',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Advisor',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Past Leader',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Founder',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Sponsor',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'DUDAA',
            'description'               =>  '',
            'parent_id'                 =>  2,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Social Responsibility',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Providing Scholarship',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Providing Materials',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Math Competition',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Reception',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Helping Poor People',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Relief During Disaster',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
        [
            'name'                      =>  'Social Awareness',
            'description'               =>  '',
            'parent_id'                 =>  3,
            'activeStatus'              =>  1,
        ],
    ];

    public function run()
    {
        foreach ($this->menus as $index => $menu)
        {
            $result = Menu::create($menu);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->menus). ' records');
    }
}
