<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'समाचार सिर्जना', 'slug' => 'news.create', 'description' => 'नयाँ समाचार सिर्जना गर्न सक्ने'],
            ['name' => 'समाचार सम्पादन', 'slug' => 'news.edit', 'description' => 'समाचार सम्पादन गर्न सक्ने'],
            ['name' => 'समाचार मेटाउने', 'slug' => 'news.delete', 'description' => 'समाचार मेटाउन सक्ने'],
            ['name' => 'समाचार प्रकाशित', 'slug' => 'news.publish', 'description' => 'समाचार प्रकाशित गर्न सक्ने'],
            ['name' => 'श्रेणी व्यवस्थापन', 'slug' => 'categories.manage', 'description' => 'श्रेणीहरू व्यवस्थापन गर्न सक्ने'],
            ['name' => 'ट्याग व्यवस्थापन', 'slug' => 'tags.manage', 'description' => 'ट्यागहरू व्यवस्थापन गर्न सक्ने'],
            ['name' => 'प्रयोगकर्ता व्यवस्थापन', 'slug' => 'users.manage', 'description' => 'प्रयोगकर्ताहरू व्यवस्थापन गर्न सक्ने'],
            ['name' => 'भूमिका व्यवस्थापन', 'slug' => 'roles.manage', 'description' => 'भूमिका र अनुमतिहरू व्यवस्थापन गर्न सक्ने'],
            ['name' => 'क्रल स्रोत व्यवस्थापन', 'slug' => 'sources.manage', 'description' => 'क्रल स्रोतहरू व्यवस्थापन गर्न सक्ने'],
            ['name' => 'क्रल गर्ने', 'slug' => 'crawl.run', 'description' => 'वेब क्रल चलाउन सक्ने'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['slug' => $perm['slug']], $perm);
        }

        $roles = [
            'super-admin' => [
                'name' => 'सुपर प्रशासक',
                'description' => 'पूर्ण पहुँच भएको प्रशासक',
                'permissions' => ['news.create', 'news.edit', 'news.delete', 'news.publish', 'categories.manage', 'tags.manage', 'users.manage', 'roles.manage', 'sources.manage', 'crawl.run'],
            ],
            'admin' => [
                'name' => 'प्रशासक',
                'description' => 'प्रशासक पहुँच',
                'permissions' => ['news.create', 'news.edit', 'news.delete', 'news.publish', 'categories.manage', 'tags.manage', 'sources.manage', 'crawl.run'],
            ],
            'editor' => [
                'name' => 'सम्पादक',
                'description' => 'समाचार सिर्जना र सम्पादन गर्न सक्ने',
                'permissions' => ['news.create', 'news.edit', 'news.publish'],
            ],
            'author' => [
                'name' => 'लेखक',
                'description' => 'समाचार सिर्जना गर्न सक्ने तर प्रकाशित गर्न सक्ने छैन',
                'permissions' => ['news.create'],
            ],
            'user' => [
                'name' => 'प्रयोगकर्ता',
                'description' => 'सामान्य प्रयोगकर्ता',
                'permissions' => [],
            ],
        ];

        foreach ($roles as $slug => $roleData) {
            $role = Role::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $roleData['name'],
                    'slug' => $slug,
                    'description' => $roleData['description'],
                ]
            );

            $permSlugs = $roleData['permissions'];
            $permIds = Permission::whereIn('slug', $permSlugs)->pluck('id')->toArray();
            $role->permissions()->sync($permIds);
        }
    }
}
