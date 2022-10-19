    <?php

use App\User;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IndexSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $user = User::insertGetId([
            'name'      => 'Naufal',
            'email'     => 'arvinaufal@gmail.com',
            'password'  => Hash::make('admin123'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        UserDetail::insert([
            'user_id' => $user,
            'address' => 'Bogor',
            'phone' => '08123456789',
            'hobby' => 'main weh lah'
        ]);
        for($i = 0; $i < 51; $i++) {
            $id = User::insertGetId([
                'name'      =>  $faker->name,
                'email'     =>  $faker->unique()->safeEmail,
                'password'  =>  Hash::make('password'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            UserDetail::insert([
                'user_id' => $id,
                'address' => Str::random(10),
                'phone' => Str::random(10),
                'hobby' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        Artisan::call('passport:install');
    }
}
