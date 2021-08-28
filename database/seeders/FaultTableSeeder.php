<?php

namespace Database\Seeders;

use App\Models\Fault;
use Illuminate\Database\Seeder;

class FaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fault::create([
            "code"          => "EMERGENCY",
            "name"          => "Lift in emergency state",
            "causes"        => "<li>A fault not registered has occurred</li><li>An unexplainable fault has occurred</li>",
            "solution"      => "<li>Get in touch with building's lift manager</li>",
        ]);

        Fault::create([
            "code"          => "PASSENGER",
            "name"          => "Passenger panic button",
            "causes"        => "<li>Passenger stuck in lift</li><li>Abnormal operation of lift</li>",
            "solution"      => "<li>Get in touch with building's lift manager</li>",
        ]);

        Fault::create([
            "code"          => "ERR02",
            "name"          => "Over-current during acceleration",
            "causes"        => "<li>The main circuit output is grounded or short circuited.</li>
<li>Motor auto-tuning is performed improperly.</li>
<li>The load is too heavy.</li>
<li>The encoder signal is incorrect.</li>
<li>The UPS running feedback signal is incorrect.</li>",
            "solution"      => "<li>Check whether the RUN contactor at the controller output side is normal.</li>
<li><p>Check:</p>
<ul> <li>Whether the power cable jacket is damaged.</li> <li>Whether the power cable is possibly short circuited to ground.</li><li>Whether the power cable is connected reliably.</li> </ul>
</li>
<li>Check the insulation of motor power terminals, and check whether the motor winding is short-circuited or grounded.
</li>
<li>Check whether shorting PMSM stator causes controller output short circuit.</li>
<li>Check whether motor parameters comply with the nameplate.</li>
<li>Perform motor auto-tuning again.</li>
<li>Check whether the brake keeps released before the fault occurs and whether the brake is stuck mechanically.</li>
<li>Check whether the balance coefficient is correct.</li>
<li>Check whether the encoder wirings are correct. For asynchronous motor, perform SVC and compare the current to judge whether the encoder works properly</li>
<li>
<p>Check:</p>
<ul>
<li>Whether encoder pulses per revolution (PPR) is set correctly </li>
<li>Whether the encoder signal is interfered with</li>
<li>Whether the encoder cable runs through the duct independently </li>
<li>Whether the cable is too long </li>
<li>Whether the shield is grounded at one end</li>
</ul>
</li>
<li>
<p>Check:</p>
<ul>
<li>Whether the encoder is installed reliably</li>
<li>Whether the rotating shaft is connected to the motor shaft reliably </li>
<li>Whether the encoder is stable during normal-speed running</li>
</ul>
</li>
<li>Check whether UPS feedback is valid in the non-UPS running state (Err02).</li>
<li>Check whether the acceleration/deceleration rate is too high (Err02, Err03).</li>
",
        ]);

        Fault::create([
            "code"          => "ERR03",
            "name"          => "Over-current during deceleration",
            "causes"        => "<li>The main circuit output is grounded or short circuited.</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The deceleration rate is too short.</li><li>The encoder signal is incorrect.</li>",
            "solution"      => "<li>Check whether the RUN contactor at the controller output side is normal.</li>
<li><p>Check:</p>
<ul> <li>Whether the power cable jacket is damaged.</li> <li>Whether the power cable is possibly short circuited to ground.</li><li>Whether the power cable is connected reliably.</li> </ul>
</li>
<li>Check the insulation of motor power terminals, and check whether the motor winding is short-circuited or grounded.
</li>
<li>Check whether shorting PMSM stator causes controller output short circuit.</li>
<li>Check whether motor parameters comply with the nameplate.</li>
<li>Perform motor auto-tuning again.</li>
<li>Check whether the brake keeps released before the fault occurs and whether the brake is stuck mechanically.</li>
<li>Check whether the balance coefficient is correct.</li>
<li>Check whether the encoder wirings are correct. For asynchronous motor, perform SVC and compare the current to judge whether the encoder works properly</li>
<li>
<p>Check:</p>
<ul>
<li>Whether encoder pulses per revolution (PPR) is set correctly </li>
<li>Whether the encoder signal is interfered with</li>
<li>Whether the encoder cable runs through the duct independently </li>
<li>Whether the cable is too long </li>
<li>Whether the shield is grounded at one end</li>
</ul>
</li>
<li>
<p>Check:</p>
<ul>
<li>Whether the encoder is installed reliably</li>
<li>Whether the rotating shaft is connected to the motor shaft reliably </li>
<li>Whether the encoder is stable during normal-speed running</li>
</ul>
</li>
<li>Check whether UPS feedback is valid in the non-UPS running state (Err02).</li>
<li>Check whether the acceleration/deceleration rate is too high (Err02, Err03).</li>",
        ]);

        Fault::create([
            "code"          => "ERR04",
            "name"          => "Over-current at constant speed",
            "causes"        => "<li>The main circuit output is grounded or short circuited</li> <li>Motor auto-tuning is performed improperly.</li> <li>The load is too heavy.</li> <li>The encoder signal is incorrect.</li>",
            "solution"      => "<li>Check whether the RUN contactor at the controller output side is normal.</li>
<li><p>Check:</p>
<ul> <li>Whether the power cable jacket is damaged.</li> <li>Whether the power cable is possibly short circuited to ground.</li><li>Whether the power cable is connected reliably.</li> </ul>
</li>
<li>Check the insulation of motor power terminals, and check whether the motor winding is short-circuited or grounded.
</li>
<li>Check whether shorting PMSM stator causes controller output short circuit.</li>
<li>Check whether motor parameters comply with the nameplate.</li>
<li>Perform motor auto-tuning again.</li>
<li>Check whether the brake keeps released before the fault occurs and whether the brake is stuck mechanically.</li>
<li>Check whether the balance coefficient is correct.</li>
<li>Check whether the encoder wirings are correct. For asynchronous motor, perform SVC and compare the current to judge whether the encoder works properly</li>
<li>
<p>Check:</p>
<ul>
<li>Whether encoder pulses per revolution (PPR) is set correctly </li>
<li>Whether the encoder signal is interfered with</li>
<li>Whether the encoder cable runs through the duct independently </li>
<li>Whether the cable is too long </li>
<li>Whether the shield is grounded at one end</li>
</ul>
</li>
<li>
<p>Check:</p>
<ul>
<li>Whether the encoder is installed reliably</li>
<li>Whether the rotating shaft is connected to the motor shaft reliably </li>
<li>Whether the encoder is stable during normal-speed running</li>
</ul>
</li>
<li>Check whether UPS feedback is valid in the non-UPS running state (Err02).</li>
<li>Check whether the acceleration/deceleration rate is too high (Err02, Err03).</li>",
        ]);

        Fault::create([
            "code"          => "ERR05",
            "name"          => "Over-voltage during acceleration",
            "causes"        => "<li>The input voltage is too high</li><li>The regeneration power of the motor is too high</li><li>The braking resistance is too large, or the braking unit fails</li><li>The acceleration rate is too short.</li>",
            "solution"      => "<li>Adjust the input voltage. Observe whether the bus voltage is normal and whether it rises too quickly during running.</li>
<li>Check for the balance coefficient.</li>
<li>Select a proper braking resistor and check whether the resistance is too large based on the recommended braking resistance table in chapter 3.</li>
<li>
<ul>
<p>Check:</p>
<li>Whether the cable connecting the braking resistor is damaged</li>
<li>Whether the cooper wire touches the ground</li>
<li>Whether the connection is reliable</li>
</ul>
</li>
",
        ]);

        Fault::create([
            "code"          => "ERR06",
            "name"          => "Over-voltage during deceleration",
            "causes"        => "<li>The input voltage is too high</li><li>The braking resistance is too large, or the braking unit fails</li><li>The deceleration rate is too short.</li>",
            "solution"      => "<li>Adjust the input voltage. Observe whether the bus voltage is normal and whether it rises too quickly during running.</li>
<li>Check for the balance coefficient.</li>
<li>Select a proper braking resistor and check whether the resistance is too large based on the recommended braking resistance table in chapter 3.</li>
<li>
<ul>
<p>Check:</p>
<li>Whether the cable connecting the braking resistor is damaged</li>
<li>Whether the cooper wire touches the ground</li>
<li>Whether the connection is reliable</li>
</ul>
</li>
",
        ]);

        Fault::create([
            "code"          => "ERR07",
            "name"          => "Over-voltage during deceleration",
            "causes"        => "<li>The input voltage is too high</li><li>The braking resistance is too large, or the braking unit fails</li>",
            "solution"      => "<li>Adjust the input voltage. Observe whether the bus voltage is normal and whether it rises too quickly during running.</li>
<li>Check for the balance coefficient.</li>
<li>Select a proper braking resistor and check whether the resistance is too large based on the recommended braking resistance table in chapter 3.</li>
<li>
<ul>
<p>Check:</p>
<li>Whether the cable connecting the braking resistor is damaged</li>
<li>Whether the cooper wire touches the ground</li>
<li>Whether the connection is reliable</li>
</ul>
</li>
",
        ]);

        Fault::create([
            "code"          => "ERR19",
            "name"          => "Motor auto tuning fault",
            "causes"        => "<li>The motor cannot rotate properly.</li>
<li>The motor auto-tuning times out. </li>
<li>The encoder for the PMSM fails.</li>",
            "solution"      => "<li>Enter the motor parameters correctly. </li>
<li> Check the motor wiring and whether phase loss occurs on the contactor at the output side.</li>
<li>Check the encoder wiring and ensure that the encoder PPR is set properly.</li>
<li>Check whether the brake keeps released during no-load auto-tuning.</li>
<li>Check whether the inspection button is released before the PMSM with-load auto-tuning is finished.</li>
",
        ]);

        Fault::create([
            "code"          => "ERR20",
            "name"          => "Speed feedback incorrect",
            "causes"        => "<ul>
<li>1: AB signals are lost during auto-tuning.</li>
<li>3: The phase sequence of the motor is incorrect.</li>
<li>4: Z signal cannot be detected during auto-tuning.</li>
<li>5: The CD signal cables of the SIN/COS encoder break.</li>
<li>7: The UVW cables of the UVW encoder break.</li>
<li>8: The deviation between the absolute position angle and the cumulative angle is too large.</li>
<li>9: Overspeed occurs or the speed deviation is too large.</li>
<li>10/11: AB signals or CD signals of the SIN/COS encoder are interfered with.</li>
<li>12: The detected speed is 0 at torque limit.</li>
<li>13: AB signals are lost during running.</li>
<li>14: Z signal is lost during running.</li>
<li>19: The AB analog signal cables break during low speed running.</li>
<li>55: CD signal error or serious Z signal interference occurs during auto-tuning.</li>
</ul>
",
            "solution"      => "<ul><li>3: Exchange any two phases of the motor UVW cables. </li>
<li>1, 4, 5, 7, 8, 10, 11, 13, 14, 19: Check that all signal cable wiring of the encoder is correct and secure.</li>
<li>9: Check that the setting of F1- 00, F1-12, and F1-25 for the synchronous motor is correct. </li>
<li>12: Check that there is no mechanical stuck and that the brake has been released during running.</li>
<li>55: Check that the grounding is reliable and eliminate interference problems.</li></ul>
",
        ]);

        Fault::create([
            "code"          => "ERR41",
            "name"          => "Safety circuit disconnected",
            "causes"        => "<li>The safety circuit signal becomes OFF</li>
",
            "solution"      => "<p>101:</p>
<li>Check the safety circuit switches and their states.</li>
<li>Check whether the external power supply is normal.</li>
<li>Check whether the safety circuit contactor acts properly.</li>
<li>Confirm the signal feature (NO, NC) of the feedback contact of the safety circuit contactor.</li>
",
        ]);

        Fault::create([
            "code"          => "ERR42",
            "name"          => "Door lock disconnected during running",
            "causes"        => "<ul><li>101: The door lock circuit feedback is invalid during the elevator running.</li></ul>
",
            "solution"      => "<p>101:</p>
<li>Check whether the hall door lock and the car door lock are in good contact.</li>
<li>Check whether the door lock contactor acts properly.</li>
<li>Check the signal feature (NO, NC) of the feedback contact on the door lock contactor.</li>
<li>Check whether the external
power supply is normal</li>
",
        ]);
    }
}
