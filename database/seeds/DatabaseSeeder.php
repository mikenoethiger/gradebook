<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Subject;
use App\Grade;
use App\Icon;
use App\School;
use App\Semester;
use \Illuminate\Support\Facades\Log;

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

        $this->call('UserTableSeeder');

        $this->call('SchoolTableSeeder');

        $this->call('SemesterTableSeeder');

        $this->call('IconTableSeeder');

        $this->call('SubjectTableSeeder');

        $this->call('GradeTableSeeder');
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

class SchoolTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('schools')->delete();

        $user = User::whereEmail('noethiger.mike@gmail.com')->first();

        Log::debug($user->id);

        School::create(['name' => 'GIBB', 'user_id' => $user->id]);
        School::create(['name' => 'Gerbrunnen', 'user_id' => $user->id]);
    }
}

class SemesterTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('semesters')->delete();

        $user = User::where('email', '=', 'noethiger.mike@gmail.com')->first();

        $schools = School::whereUserId($user->id)->get();
        foreach ($schools as $school) {
            $numberOfSemesters = rand(1, 2);
            for ($i = 0; $i < $numberOfSemesters; $i++) {
                $school->addSemester($user);
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

class SubjectTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subjects')->delete();

        $subjectNames = [
            'Teilchenphysik',
            'Mathematik',
            'Geometrie',
            'Physik',
            'Chemie',
            'Deutsch',
            'Französisch',
            'Englisch',
            'Geschichte',
            'Wirtschaft',
            'Musik',
            'Literatur',
            'Informatik',
            'Biologie',
            'Finanzwesen',
            'Finanzbuchhaltung',
            'Statistik',
            'Ökonomie',
            'Recht',
            'Gesundheit',
            'Gesellschaft',
            'Kunst',
            'Ökologie',
            'Politik',
            'Religion',
            'Sport',
            'Astronomie',
            'Werken',
            'Mechanik'
        ];

        $user = User::where('email', '=', 'noethiger.mike@gmail.com')->first();
        $semesters = Semester::ofUser($user->id)->get();
        $icons = Icon::all()->toArray();
        foreach ($semesters as $semester) {
            $numberOfSubjects = rand(2, 5);
            $randSubjectNames = array_rand($subjectNames, $numberOfSubjects);
            $randIcons = array_rand($icons, $numberOfSubjects);
            for ($i = 0; $i < $numberOfSubjects; $i++) {
                Subject::create([
                    'name' => $subjectNames[$randSubjectNames[$i]],
                    'icon' => $icons[$randIcons[$i]]['class'],
                    'semester_id' => $semester->id
                ]);
            }
        }

    }
}

class GradeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('grades')->delete();
        $userId = User::where('email', '=', 'noethiger.mike@gmail.com')->first()->id;

        $allSubjects = Subject::ofUser($userId)->get();

        foreach ($allSubjects as $subject) {
            $numberOfGrades = rand(1, 3);
            for ($i = 0; $i < $numberOfGrades; $i++) {
                $grade = rand(1, 6);
                if ($grade < 6) {
                    $grade = $grade + round(mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax(), 2);
                }
                Grade::create(['grade' => $grade, 'subject_id' => $subject->id, 'weighting' => 1]);

            }
        }
    }
}