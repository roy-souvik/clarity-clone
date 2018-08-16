<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		    Model::unguard();

		    $this->call(RolesTableSeeder::class);

		    $this->call(UsersTableSeeder::class);

		    $this->call(RoleUserTableSeeder::class);

            $this->call(CategoriesFixedTableSeeder::class);

            $this->call(TagsTableSeeder::class);

            $this->call(Tag_UserTableSeeder::class);

            $this->call(PagesTableSeeder::class);

            $this->call(EmailsTableSeeder::class);

            $this->call(AlbumsTableSeeder::class);

        Model::reguard();
    }
}
