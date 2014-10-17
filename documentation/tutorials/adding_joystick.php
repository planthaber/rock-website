<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Adding a Joystick into the Mix</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

            <h1 class="active">Adding a Joystick into the Mix</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="tutorial-info">Tutorial Info</h2>

                    <p>This tutorial will give you some handson experience on:</p>

                    <ul>
                        <li>how to find a ‘standard’ Rock package that provides a port X</li>
                        <li>how to install the package.</li>
                        <li>how to create a small control loop by attaching a Joystick to our rolling rock task.</li>
                    </ul>
                    <br/>
                    <h2 id="finding-a-standard-task-that-provides-a-port-x">Finding a standard task that provides a port X.</h2>

                    <p>We are using here an existing task of the rock-robotics framework and the task from the previous
                        tutorial, so we don’t have to implement anything.</p>

                    <p>In order to get our control we need a task that supplies us with ‘base::MotionCommand2D’.
                        For that it is recommended to take a look into the <a href="/package_directory.html">package directory</a>.
                        You will have two options there:</p>

                    <ul>
                        <li>look for a specific orogen package in the Packages section. For instance, you can search for
                            “joystick orogen”</li>
                        <li>look for tasks that produce the type you require (here /base/MotionCommand2D) by going into
                            the oroGen types section, selecting the type and looking at the Produced by section at the
                            top of the page.</li>
                    </ul>

                    <p>The package directory gives you a general overview of available ‘standard’ packages and types.
                        For our purpose we need to look into the subcategory ‘oroGen Types’. This category shows all
                        available types that are exported by any task in the standard rock packages. As we are interested
                        on ‘base::MotionCommand2D’ we open the page about this type. Apart from the general description of
                        the type there is a section ‘produced by’ and ‘consumed by’, which gives us the list of all tasks
                        producing ‘base::MotionCommand2D’. As we want to integrate a joystick, we pick controldev::JoystickTask
                        from the list, which is defined in ‘drivers/orogen/controldev’.  </p>

                    <p>In order to install the package to your installation, either do </p>

                    <div class="CodeRay">
                        <div class="code"><pre>$ amake drivers/orogen/controldev
</pre></div>
                    </div>

                    <p>which will install the current version of the package, but not update / build it
                        later. To permanently integrate it into your whole installation, you have to <a href="100_basics_create_library.html#add-to-manifest">edit the
                            manifest file</a>.</p>
                    <br/>
                    <h2 id="integration-of-the-task">Integration of the task</h2>

                    <p>Now that we have found a task, that supplies the needed motion commands we need to integrate it into
                        our run script. Therefore we modify the last runscript. By adding a joystick driver to it.
                        As we know from the package directory, the controldev package provides a tasks for our purpose. To find
                        out which exact task we can use we call </p>

                    <div class="CodeRay">
                        <div class="code"><pre>oroinspect -t controldev
</pre></div>
                    </div>

                    <p>This returns us an output of every installed task that is defined controldev.
                        The interesting part of the output is in our case this :</p>

<pre>
==========================================================
Task name:  controldev::JoystickTask
defined in controldev
----------------------------------------------------------

------- controldev::JoystickTask ------
A Task that provides a joystick driver
subclass of controldev::GenericTask (the superclass elements are displayed below)
Ports
    [out]four_wheel_command:/controldev/FourWheelCommand
    [out]motion_command:/base/MotionCommand2D
    [out]raw_command:/controldev/RawCommand
    [out]speed_command:/base/SpeedCommand6D
    [out]state:/int32_t
No dynamic ports
Properties
    device:/std/string: Path to the joystick device
    maxRotationSpeed:/double: Maximum rotation speed in rad/s
    maxSpeed:/double: Maximum translation speed in m/s
    minRotationSpeed:/double: Minimum rotation speed in rad/s
    minSpeed:/double: Minimum translation speed in m/s
No attributes
No operations</pre>

                    <p>This output tells us that there is a task controldev::JoystickTask, which has a
                        output port with the name ‘motion_command’ of the type ‘/base/MotionCommand2D’.
                        So it fits exactly our needs.</p>

                    <p>Knowing this, we can now modify the script from the previous tutorial (copy it
                        to scripts/rockTutorial2.rb):</p>

                    <div class="CodeRay">
                        <div class="code"><pre>require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">orocos</span><span style="color:#710">'</span></span>
require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">readline</span><span style="color:#710">'</span></span>
include <span style="color:#036;font-weight:bold">Orocos</span>

<span style="color:#777">## Initialize orocos ##</span>
<span style="color:#036;font-weight:bold">Orocos</span>.initialize

<span style="color:#777">## Execute the task ##</span>
<span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial::RockControlTutorial</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial_control</span><span style="color:#710">'</span></span>,
     <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">controldev::JoytickTask</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">joystick</span><span style="color:#710">'</span></span> <span style="color:#080;font-weight:bold">do</span>

    <span style="color:#777">## Get the specific task context ##</span>
    rockControl = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial_control</span><span style="color:#710">'</span></span>
    joystick = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">joystick</span><span style="color:#710">'</span></span>

    <span style="color:#777">## Connect the ports ##</span>
    joystick.motion_command.connect_to rockControl.motion_command

    <span style="color:#777">## Set some properties ##</span>
    joystick.device = <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">/dev/input/js0</span><span style="color:#710">"</span></span> <span style="color:#777"># this might be another port</span>

    <span style="color:#777">## Configure the tasks ##</span>
    joystick.configure

    <span style="color:#777">## Start the tasks ##</span>
    joystick.start
    rockControl.start

    <span style="color:#036;font-weight:bold">Readline</span>::readline(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Press Enter to exit</span><span style="color:#b0b">\n</span><span style="color:#710">"</span></span>) <span style="color:#080;font-weight:bold">do</span>
    <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>

</pre></div>
                    </div>

                    <p>This script is quite the same as the script from rock tutorial 1, but with some improvements. As you can see
                        we execute a second Taskt named ‘joystick’, besides the ‘rock_tutorial’ task.</p>

                    <p>Also we acquire a handle to the JoystickTask. Then we connect the output port ‘motion_command’
                        of the task ‘joystick’ with the equal named input port of the task ‘rockControl’. The task ‘joystick’ of course uses the
                        joystick input to generate motion commands. In the next step we could set a property named ‘device’ of the task ‘joystick’.
                        With that we can set a string which is the local device of the joystick on your machine. Next we configure the ‘joystick’
                        task by issuing the command ‘joystick.configure’. At last we will start all the Tasks. </p>
                    <br/>
                    <h2 id="run-it">Run it</h2>
                    <p>You can now simply run it by executing</p>

                    <div class="CodeRay">
                        <div class="code"><pre>$ ruby rockTutorial2.rb</pre></div>
                    </div>

                    <p>And in another console:</p>

                    <div class="CodeRay">
                        <div class="code"><pre>$ rock-display rock_tutorial_control</pre></div>
                    </div>

                    <p>Again with a right-click on the <em>pose</em> port you can start the visualization and enjoy commanding around the robot with the joystick.</p>


                </div>
            </div>


        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>