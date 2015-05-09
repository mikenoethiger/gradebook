<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 22.04.15
 * Time: 21:37
 */

use App\School;
use App\User;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Log;

class ModelsTest extends TestCase {

    private $testUserEmail = "test@user.com";

    public function setUp()
    {
        parent::setUp();

        $testUser = User::create(['email' => $this->testUserEmail, 'password' => bcrypt('123')]);
        $this->be($testUser);
    }

    public function testSchoolModel()
    {
        $schoolName = 'My Test School';
        $school = School::create(['name' => $schoolName, 'user_id' => Auth::user()->id]);

        // Check if the School was created
        $school = School::find($school->id);
        $this->assertEquals($schoolName, $school->name);

        // Check if a semester is automatically created when a school is created
        $this->assertEquals(1, $school->semesters()->count());
        $school->delete();

        // Check if School was soft deleted
        $this->assertEquals(1, School::withTrashed()->whereId($school->id)->count());

        School::withTrashed()->find($school->id)->forceDelete();
        // Check if School was completely deleted from database
        $this->assertEquals(0, School::withTrashed()->find($school->id));
    }

    public function tearDown()
    {
        User::whereEmail($this->testUserEmail)->forceDelete();
        parent::tearDown();
    }
}