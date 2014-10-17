<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Control through a Virtual Joystick</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Control through a Virtual Joystick</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">
                    <br/>
                    <h2 id="tutorial-info">Tutorial Info</h2>

                    <p>This tutorial will give you some handson experience on:</p>

                    <ul>
                        <li>how to use a graphical widget to control the rolling rock.</li>
                    </ul>

                    <p>TODO Rewrite the tutorial using the task inspector</p>
                    <br/>
                    <h2 id="finding-the-right-widget">Finding the right widget</h2>

                    <p>TODO Add as soon as it is integrated into the package directory</p>
                    <br/>
                    <h2 id="integrating-it">Integrating it</h2>
                    <p>Now that we found the widget we want to use, we need to integrate it.
                        Again we therefore modify the runscript from the first tutorial in this
                        section. </p>

                    <p>We start by adding the VirtualJoystick widget before the Orocos.run block:</p>

                    <div class="CodeRay">
                        <div class="code"><pre><span style="color:#777"># load vizkit package</span>
require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">vizkit</span><span style="color:#710">'</span></span>

<span style="color:#777"># create a widget that emulates a joystick</span>
joystickGui = <span style="color:#036;font-weight:bold">Vizkit</span>.default_loader.create_widget(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">VirtualJoystick</span><span style="color:#710">'</span></span>)

<span style="color:#777">#show it</span>
joystickGui.show
</pre></div>
                    </div>

                    <p>This will open the desired widget and give us a handle to it.
                        Using the handle we can register a code block in the run-loop that get’s
                        executed whenever the widget emits a QT-Signal. Since this code needs a handle
                        to the rockControl task, it must be inserted after the Orocos.name_service.get line that
                        initializes rockControl.</p>

                    <div class="CodeRay">
                        <div class="code"><pre>rockControl = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">rock_control</span><span style="color:#710">'</span></span>
</pre></div>
                    </div>

                    <p>The “Orocos.run do .. end” block can then be modified with:</p>

                    <div class="CodeRay">
                        <div class="code"><pre>  <span style="color:#777">## Create a sample writer for a port ##</span>
  sampleWriter = rockControl.motion_command.writer

  <span style="color:#777"># get a sample that can be written to the port</span>
  <span style="color:#777"># If you know the sample type (here, base::MotionCommand2D),</span>
  <span style="color:#777"># an alternative syntax is</span>
  <span style="color:#777">#   sample = Types::Base::MotionCommand2D.new</span>
  sample = sampleWriter.new_sample

  <span style="color:#777">## glue the widget to the task writer</span>
  joystickGui.connect(SIGNAL(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">axisChanged(double, double)</span><span style="color:#710">'</span></span>)) <span style="color:#080;font-weight:bold">do</span> |x, y|
    sample.translation = x
    sample.rotation = - y.abs() * <span style="color:#036;font-weight:bold">Math</span>::atan2(y, x.abs())
    sampleWriter.write(sample)
  <span style="color:#080;font-weight:bold">end</span>
</pre></div>
                    </div>

                    <p>So, what does this do ? Whenever the signal ‘axisChanged’ is emitted by the widget the
                        code inside the ‘do / end’ is executed. One can think of it like a callback function. We use this ‘callback’
                        to modify a MotionCommand2D in respect to the axis values and write it to our rockControl task. Thus we
                        provide the ‘glue’-code between the widget and the Task and also show the power of the scripting interface.</p>
                    <br/>
                    <h2 id="run-it">Run it</h2>
                    <p>If you execute: </p>

                    <div class="CodeRay">
                        <div class="code"><pre>$ ruby rockTutorial3.rb</pre></div>
                    </div>

                    <p>two windows should pop up. One with our virtual joystick the other one should be the well known visualization of the rock.
                        Clicking and dragging the joystick should also make the rock move.</p>

                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>