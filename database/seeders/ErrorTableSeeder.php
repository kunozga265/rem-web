<?php

namespace Database\Seeders;

use App\Models\Error;
use Illuminate\Database\Seeder;

class ErrorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Error::create([
            "code"          => "ERR02",
            "name"          => "Over-current during acceleration",
            "causes"        => "<ul> <li>The main circuit output is grounded or short circuited</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The encoder signal is incorrect.</li> <li>The UPS running feedback signal is incorrect.</li> </ul>",
            "solution"      => "<ul><li>Check whether the RUN contactor at the controller output side is normal.</li> <li><p>Check</p> <ul> <li>Whether the power cable jacket is damaged</li> <li>Whether the power cable is possibly short circuited to ground</li> </ul></li> </ul>",
        ]);

        Error::create([
            "code"          => "ERR03",
            "name"          => "Over-current during deceleration",
            "causes"        => "<ul> <li>The main circuit output is grounded or short circuited</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The encoder signal is incorrect.</li> <li>The UPS running feedback signal is incorrect.</li> </ul>",
            "solution"      => "<ul><li>Check whether the RUN contactor at the controller output side is normal.</li> <li><p>Check</p> <ul> <li>Whether the power cable jacket is damaged</li> <li>Whether the power cable is possibly short circuited to ground</li> </ul></li> </ul>",
        ]);

        Error::create([
            "code"          => "ERR04",
            "name"          => "Over-current at constant speed",
            "causes"        => "<ul> <li>The main circuit output is grounded or short circuited</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The encoder signal is incorrect.</li> <li>The UPS running feedback signal is incorrect.</li> </ul>",
            "solution"      => "<ul><li>Check whether the RUN contactor at the controller output side is normal.</li> <li><p>Check</p> <ul> <li>Whether the power cable jacket is damaged</li> <li>Whether the power cable is possibly short circuited to ground</li> </ul></li> </ul>",
        ]);

        Error::create([
            "code"          => "ERR05",
            "name"          => "Over-voltage during acceleration",
            "causes"        => "<ul> <li>The main circuit output is grounded or short circuited</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The encoder signal is incorrect.</li> <li>The UPS running feedback signal is incorrect.</li> </ul>",
            "solution"      => "<ul><li>Check whether the RUN contactor at the controller output side is normal.</li> <li><p>Check</p> <ul> <li>Whether the power cable jacket is damaged</li> <li>Whether the power cable is possibly short circuited to ground</li> </ul></li> </ul>",
        ]);
    }
}
