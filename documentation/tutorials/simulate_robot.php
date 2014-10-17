<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Simulate a Robot</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

        <h1 class="active">Simulate a Robot</h1>

        <div class="content2-container line-box">
        <div class="content2-container-1col">

        <h2 id="abstract">Abstract</h2>
        <p>This tutorial is the basis for the followup tutorials in this section. Before you try this tutorial,
            you should have worked through the basic tutorials. </p>

        <p>In this tutorial, we will create a library for simulating a ‘Rock’-Robot.
            Further we will wrap it into an orocos task and fire it up. </p>
        <br/>
        <h2 id="implementation">Implementation</h2>

        <h3 id="create-a-new-library">Create a new library</h3>
        <p>We start by entering the tutorials folder and creating a library named ‘rock-tutorial’ by using the ‘rock-create-lib’ command. </p>

        <div class="CodeRay">
            <div class="code"><pre>cd tutorials
rock-create-lib rock_tutorial
</pre></div>
        </div>

        <p>This should give us an folder containing the following files :</p>

        <div class="CodeRay">
            <div class="code"><pre>CMakeLists.txt  INSTALL  LICENSE  manifest.xml  README  src
</pre></div>
        </div>

        <p>Make sure you add the required dependencies to the manifest.xml, i.e. here ‘base/types’ and ‘gui/vizkit’.</p>

        <div class="CodeRay">
            <div class="code"><pre>&lt;depend package="base/types" /&gt;
</pre></div>
        </div>

        <p>Afterwards, create a new class in the src folder named ‘RockControl’.</p>

        <p>This class will contain the (very basic) simulation logic for our Rock-Robot. Therefore it will calculate new positions
            of our robot given movement commands and a time step. </p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#579">#ifndef</span> ROCKCONTROL_H
<span style="color:#579">#define</span> ROCKCONTROL_H

<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;base/motion_command.h&gt;</span>
<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;base/samples/rigid_body_state.h&gt;</span>

<span style="color:#080;font-weight:bold">namespace</span> rock_tutorial {

<span style="color:#080;font-weight:bold">class</span> <span style="color:#B06;font-weight:bold">RockControl</span>
{

<span style="color:#088;font-weight:bold">public</span>:
    RockControl();
    <span style="color:#088;font-weight:bold">virtual</span> ~RockControl();

    base::samples::RigidBodyState computeNextPose(<span style="color:#088;font-weight:bold">const</span> <span style="color:#0a8;font-weight:bold">double</span> &amp;deltaTime,
      <span style="color:#088;font-weight:bold">const</span> base::MotionCommand2D &amp;command);

<span style="color:#088;font-weight:bold">private</span>:
    <span style="color:#777">/**
    * Makes sure that angles are between PI and -PI.
    */</span>
    <span style="color:#088;font-weight:bold">void</span> constrainAngle(<span style="color:#0a8;font-weight:bold">double</span>&amp; angle);

    <span style="color:#777">/**
    * This method constrains the relativ rotation and
    * translation of a 2d motion command.
    * Rotation should be between PI an -PI.
    * Translation should be between 10 and -10.
    */</span>
    <span style="color:#088;font-weight:bold">void</span> constrainValues(base::MotionCommand2D&amp; motionCommand);

    <span style="color:#777">/**
    * Current Position and orientation of the rock
    **/</span>
    base::samples::RigidBodyState currentPose;

    <span style="color:#777">/**
    * Current heading of the rock
    **/</span>

    <span style="color:#0a8;font-weight:bold">double</span> currentHeading;
    <span style="color:#777">/**
    * Current speed of the rock
    **/</span>
    <span style="color:#0a8;font-weight:bold">double</span> currentRoll;

};

}

<span style="color:#579">#endif</span> <span style="color:#777">// ROCKCONTROL_H</span>
</pre></div>
        </div>

        <p>The implementation is rather straight forward and for readability reasons only relevant parts will be explained:</p>

        <p>The type base::MotionCommand2D contains a demanded translation and a rotation speed. Translation is measured in m/s and
            rotation in rad/s. The parameter deltaTime defines, how much time advanced since the last call. The function
            +computeNextPose+ computes the new position and and rotation of our rock, in respect to the last pose.</p>

        <div class="CodeRay">
            <div class="code"><pre>base::samples:RigidBodyState RockControl::computeNextPose(
  <span style="color:#088;font-weight:bold">const</span> <span style="color:#0a8;font-weight:bold">double</span> &amp;deltaTime,
  <span style="color:#088;font-weight:bold">const</span> base::MotionCommand2D &amp;inputCommand)
{
  <span style="color:#777">//limit the input values. </span>
  base::MotionCommand2D command = inputCommand;
  constrainValues(command);

  <span style="color:#777">//calculate acceleration</span>
  <span style="color:#0a8;font-weight:bold">double</span> delta_translation  = command.translation * deltaTime;
  <span style="color:#0a8;font-weight:bold">double</span> delta_rotation  = command.rotation * deltaTime;

  <span style="color:#777">//apply new acceleration to rock state</span>
  currentHeading += delta_rotation;
  currentRoll += delta_translation * -<span style="color:#00D">2</span>;

  <span style="color:#777">//limit the maximum speed and turn rate to sane values</span>
  constrainAngle(currentHeading);
  constrainAngle(currentRoll);

  <span style="color:#777">//calculate new absolut values for position and orientation</span>
  currentPose.position +=
    Eigen::AngleAxisd(currentHeading, Eigen::Vector3d::UnitZ())
    * Eigen::Vector3d(<span style="color:#00D">0</span>, delta_translation, <span style="color:#00D">0</span>);
  currentPose.orientation =
    Eigen::AngleAxisd(currentHeading, Eigen::Vector3d::UnitZ())
    * Eigen::AngleAxisd(currentRoll, Eigen::Vector3d::UnitX());
  currentPose.orientation.normalize();

  <span style="color:#080;font-weight:bold">return</span> currentPose;
}
</pre></div>
        </div>
        <br/>
        <h2 id="wrapping-it-up">Wrapping it up</h2>
        <p>So, now that we are equipped with our library, we can go to the second step and wrap the code into an orocos task.
            Therefore we create a new orocos component we use the command ‘rock-create-orogen’. </p>

        <div class="CodeRay">
            <div class="code"><pre>cd tutorials/orogen/
rock-create-orogen rock_tutorial
</pre></div>
        </div>
        <br/>
        <h3 id="define-task">Define task</h3>

        <p>Again we start by adding the build dependencies in the mainfest.xml. In this case we only depend on ‘rock_tutorial’, as
            rock_tutorial already depends on ‘base/types’ and the dependencies are resolved recursive.</p>

        <p>In the rock_tutorial.orogen we will define the orocos task. For this tutorial we replace the existing entries by our definitions:</p>

        <div class="CodeRay">
            <div class="code"><pre>name <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">rock_tutorial</span><span style="color:#710">"</span></span>
version <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">0.1</span><span style="color:#710">"</span></span>

import_types_from <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">base</span><span style="color:#710">"</span></span>
using_library <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">rock_tutorial</span><span style="color:#710">"</span></span>

task_context <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">RockTutorialControl</span><span style="color:#710">"</span></span> <span style="color:#080;font-weight:bold">do</span>
  <span style="color:#777"># Declare input port motion_command</span>
  input_port <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">motion_command</span><span style="color:#710">"</span></span>, <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">base::MotionCommand2D</span><span style="color:#710">"</span></span>
  <span style="color:#777"># Declare output port pose</span>
  output_port <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">pose</span><span style="color:#710">"</span></span>, <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">base::samples::RigidBodyState</span><span style="color:#710">"</span></span>
  <span style="color:#777"># Set runtime behaviour</span>
  periodic(<span style="color:#60E">0.01</span>)
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p>The task RockTutorialControl has an input port called ‘motion_command’ of type base::MotionCommand2D and an output port called ‘pose’
            of type base::samples::RigidBodyState. This task will compute a new position and orientation each time the update hook will triggered, given
            the translation and rotation speed it receives on its input port. The latest motion command will be used if there is no new one.
            The update hook of this task will triggered periodically.</p>

        <p><a href="110_basics_create_component.html">As with all oroGen packages</a>, we call
            rock-create-orogen to finalize the package creation, and can then write the
            component implementation in tasks/RockTutorialControl.cpp.</p>

        <p>The implementation is simple, as the task only calls the library and passes on the result.</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#0a8;font-weight:bold">bool</span> RockTutorialControl::startHook()
{
  <span style="color:#777">//delete last instance in case we got restarted</span>
  <span style="color:#080;font-weight:bold">if</span>(control)
    <span style="color:#080;font-weight:bold">delete</span> control;

  <span style="color:#777">//create instance of the controller</span>
  control = <span style="color:#080;font-weight:bold">new</span> RockControl();

  <span style="color:#777">//figure out the period in which the update hook get's called</span>
  taskPeriod = TaskContext::getPeriod();

  <span style="color:#080;font-weight:bold">return</span> RockTutorialControlBase::startHook();
}

<span style="color:#088;font-weight:bold">void</span> RockTutorialControl::updateHook()
{
  <span style="color:#777">//read new motion command if available</span>
  base::MotionCommand2D motionCommand;
  _motion_command.readNewest(motionCommand);

  <span style="color:#777">//compute new position based on the input command</span>
  base::samples::RigidBodyState rbs =
    control-&gt;computeNextPose(taskPeriod, motionCommand);

  <span style="color:#777">//set time stamp </span>
  rbs.time = base::Time::now();

  <span style="color:#777">//write pose on output port</span>
  <span style="color:#080;font-weight:bold">if</span>(_pose.connected())
    _pose.write(rbs);
}
</pre></div>
        </div>
        <br/>
        <h2 id="run-it">Run it</h2>

        <p>Now we should run it to see if it works. Create a scripts/ folder and create a
            new <tt>rockTutorial1.rb</tt> script containing:</p>

        <div class="CodeRay">
            <div class="code"><pre>require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">orocos</span><span style="color:#710">'</span></span>
require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">readline</span><span style="color:#710">'</span></span>
include <span style="color:#036;font-weight:bold">Orocos</span>

<span style="color:#777">## Initialize orocos ##</span>
<span style="color:#036;font-weight:bold">Orocos</span>.initialize

<span style="color:#777">## load and add the 3d plugin for the rock</span>
<span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial::RockTutorialControl</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial_control</span><span style="color:#710">'</span></span> <span style="color:#080;font-weight:bold">do</span>


  rockControl = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_tutorial_control</span><span style="color:#710">'</span></span>

  <span style="color:#777">## Create a sample writer for a port ##</span>
  sampleWriter = rockControl.motion_command.writer

  <span style="color:#777">## Start the tasks ##</span>
  rockControl.start

  <span style="color:#777">## Write motion command sample ##</span>
  sample = sampleWriter.new_sample
  sample.translation = <span style="color:#00D">1</span>
  sample.rotation = <span style="color:#60E">0.5</span>
  sampleWriter.write(sample)

  <span style="color:#036;font-weight:bold">Readline</span>::readline(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Press Enter to exit</span><span style="color:#b0b">\n</span><span style="color:#710">"</span></span>) <span style="color:#080;font-weight:bold">do</span>
  <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p>and run it with</p>

        <pre>$ ruby rockTutorial1.rb</pre>

        <p>As in the basics tutorial, the Ruby commands lead to a start of the task, i.e. calling the
            startHook() of the task.
            Afterwards we use a port writer to write a motion command to the ‘motion_command’ port.</p>

        <p>In another console start the task inspector with</p>

        <pre>$ rock-display rock_tutorial_control</pre>

        <p>Right-klicking the output port <em>pose</em> gives you the option to use <em>RigidBodyStateVisualization</em>
            to show the rock’s state. It will be presented by coordinate axes showing position and orientation of
            the rock.</p>

        <p>If you want to steer the rock using a joystick, progress to <a href="510_joystick.html">the next
                tutorial</a>. If you don’t have a joystick
            go <a href="/documentation/tutorials/520_virtual_joystick.html">to steer using a graphical interface</a></p>

        </div>
        </div>

        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>