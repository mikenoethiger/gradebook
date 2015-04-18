<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Grade;
use App\Icon;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('SubjectTableSeeder');
        $this->command->info('Subject table seeded!');

        $this->call('GradeTableSeeder');
        $this->command->info('Grade table seeded!');

        $this->call('IconTableSeeder');
        $this->command->info('Icon table seeded!');
	}
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $exampleUser = new User();
        $exampleUser->email = "noethiger.mike@gmail.com";
        $exampleUser->name = "Mike";
        $exampleUser->password = bcrypt("123");
        $exampleUser->save();
    }
}

class SubjectTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subjects')->delete();
        $userId = User::where('email', '=', 'noethiger.mike@gmail.com')->first()->id;

        Subject::create(['name' => 'Teilchenphysik', 'icon' => 'icon-atom', 'user_id' => $userId]);
        Subject::create(['name' => 'Mathematik', 'icon' => 'icon-maths', 'user_id' => $userId]);
        Subject::create(['name' => 'Gemoetrie', 'icon' => 'icon-dividers', 'user_id' => $userId]);
        Subject::create(['name' => 'Physik', 'icon' => 'icon-physics', 'user_id' => $userId]);
        Subject::create(['name' => 'Chemie', 'icon' => 'icon-chemistry', 'user_id' => $userId]);
        Subject::create(['name' => 'Deutsch', 'icon' => 'icon-pen', 'user_id' => $userId]);
        Subject::create(['name' => 'Französisch', 'icon' => 'icon-pen', 'user_id' => $userId]);
        Subject::create(['name' => 'Englisch', 'icon' => 'icon-pen', 'user_id' => $userId]);
        Subject::create(['name' => 'Geschichte', 'icon' => 'icon-history', 'user_id' => $userId]);
        Subject::create(['name' => 'Wirtschaft', 'icon' => 'icon-balance', 'user_id' => $userId]);
        Subject::create(['name' => 'Musik', 'icon' => 'icon-quaver', 'user_id' => $userId]);
        Subject::create(['name' => 'Literatur', 'icon' => 'icon-books', 'user_id' => $userId]);
        Subject::create(['name' => 'Informatik', 'icon' => 'icon-computer-screen', 'user_id' => $userId]);
        Subject::create(['name' => 'Biologie', 'icon' => 'icon-dna', 'user_id' => $userId]);
        Subject::create(['name' => 'Finanzwesen', 'icon' => 'icon-money', 'user_id' => $userId]);
        Subject::create(['name' => 'Finanzbuchhaltung', 'icon' => 'icon-financial-book', 'user_id' => $userId]);
        Subject::create(['name' => 'Statistik', 'icon' => 'icon-statistics', 'user_id' => $userId]);
        Subject::create(['name' => 'Ökonomie', 'icon' => 'icon-factory', 'user_id' => $userId]);
        Subject::create(['name' => 'Recht', 'icon' => 'icon-tribunal', 'user_id' => $userId]);
        Subject::create(['name' => 'Gesundheit', 'icon' => 'icon-medical', 'user_id' => $userId]);
        Subject::create(['name' => 'Gesellschaft', 'icon' => 'icon-multiple', 'user_id' => $userId]);
        Subject::create(['name' => 'Kunst', 'icon' => 'icon-drawing', 'user_id' => $userId]);
        Subject::create(['name' => 'Ökologie', 'icon' => 'icon-plant', 'user_id' => $userId]);
        Subject::create(['name' => 'Politik', 'icon' => 'icon-politics', 'user_id' => $userId]);
        Subject::create(['name' => 'Religion', 'icon' => 'icon-religion', 'user_id' => $userId]);
        Subject::create(['name' => 'Sport', 'icon' => 'icon-soccer', 'user_id' => $userId]);
        Subject::create(['name' => 'Astronomie', 'icon' => 'icon-astronomy', 'user_id' => $userId]);
        Subject::create(['name' => 'Werken', 'icon' => 'icon-tools', 'user_id' => $userId]);
        Subject::create(['name' => 'Mechanik', 'icon' => 'icon-wrench', 'user_id' => $userId]);
    }
}

class GradeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('grades')->delete();
        $userId = User::where('email', '=', 'noethiger.mike@gmail.com')->first()->id;

        $allSubjects = Subject::where('user_id', '=', $userId)->get();
        foreach ($allSubjects as $subject) {
            $numberOfGrades = rand(1,10);
            for ($i = 0; $i < $numberOfGrades; $i++) {
                $grade = rand(1,6);
                if ($grade < 6) {
                    $grade = $grade + round(mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax(),2);
                }
                Grade::create(['grade' => $grade, 'subject_id' => $subject->id, 'user_id' => $userId]);
            }
        }
    }
}

class IconTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('icons')->delete();

        Icon::create(['class' => 'icon-atom']);
        Icon::create(['class' => 'icon-bank']);
        Icon::create(['class' => 'icon-books']);
        Icon::create(['class' => 'icon-computer-screen']);
        Icon::create(['class' => 'icon-dna']);
        Icon::create(['class' => 'icon-money']);
        Icon::create(['class' => 'icon-dividers']);
        Icon::create(['class' => 'icon-earth']);
        Icon::create(['class' => 'icon-financial-book']);
        Icon::create(['class' => 'icon-statistics']);
        Icon::create(['class' => 'icon-factory']);
        Icon::create(['class' => 'icon-tribunal']);
        Icon::create(['class' => 'icon-history']);
        Icon::create(['class' => 'icon-balance']);
        Icon::create(['class' => 'icon-maths']);
        Icon::create(['class' => 'icon-medical']);
        Icon::create(['class' => 'icon-microscope']);
        Icon::create(['class' => 'icon-multiple']);
        Icon::create(['class' => 'icon-drawing']);
        Icon::create(['class' => 'icon-pen']);
        Icon::create(['class' => 'icon-physics']);
        Icon::create(['class' => 'icon-plant']);
        Icon::create(['class' => 'icon-politics']);
        Icon::create(['class' => 'icon-quaver']);
        Icon::create(['class' => 'icon-religion']);
        Icon::create(['class' => 'icon-soccer']);
        Icon::create(['class' => 'icon-astronomy']);
        Icon::create(['class' => 'icon-chemistry']);
        Icon::create(['class' => 'icon-tools']);
        Icon::create(['class' => 'icon-wrench']);
    }
}