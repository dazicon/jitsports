<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'dazi';
        $user->email = 'hansir1993@outlook.com';
        $user->stu_id = '1205106136';
        $user->klass = '12软件工程3';
        $user->password = bcrypt('han123');
        $user->is_admin = true;
        $user->save();
    }
}
