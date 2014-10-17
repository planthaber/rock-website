<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Connecting Components</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Connecting Components</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="abstract">Abstract</h2>
                    <p>This tutorial will teach you:</p>

                    <ul>
                        <li>how to create a data driven component</li>
                        <li>how to connect multiple components </li>
                    </ul>

                    <p>The data driven component that is designed in this tutorial waits for incoming messages and outputs their
                        content once it receives a message. The incoming messages will be produced by the message_producer component
                        designed in the previous tutorials.</p>

                    <p>The final setup will look like:</p>
                    <p class="align-center"><img src="images/130_producer_consumer.png" alt="Producer/Consumer Setup"></p>
                    <br/>
                    <h2 id="create-a-consumer-component">Create a consumer component</h2>

                    <p>Your first task in this tutorial is to apply the acquired knowleged from the previous tutorials, and prepare a consumer component named ‘message_consumer’ and place in ‘tutorials/orogen/’. Perform all step up to the point where you can edit the orogen specification, i.e.:</p>

                    <ul>
                        <li>use <a href="110_basics_create_component.html">rock-create-orogen</a> to create your component (note: you will need a
                            dependency on both message_driver and message_producer)</li>
                        <li>check for any required dependencies and verify the manifest.xml</li>
                        <li>add your component to the build configuration, i.e. to autoproj/manifest</li>
                    </ul>

                    <p>The next step will be to adapt the orogen specification. The component should allow to receive messages on an input port, and call the updateHook only when it receives a message. The specification should looks as follows: </p>

                    <div class="CodeRay">
                        <div class="code"><pre>using_library <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver</span><span style="color:#710">"</span></span>
import_types_from <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer</span><span style="color:#710">"</span></span>

task_context <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Task</span><span style="color:#710">"</span></span> <span style="color:#080;font-weight:bold">do</span>
   input_port <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">messages</span><span style="color:#710">"</span></span>, <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Message</span><span style="color:#710">"</span></span>

   port_driven <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">messages</span><span style="color:#710">"</span></span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
                    </div>

                    <p>The ‘port_driven’ statement allows you to specify ports, where incoming data triggers a call to the updateHook of the task (more details in the <a href="../orogen/triggering/ports.html">documentation</a>).
                        Implement the updateHook, so that every incoming message is printed to stdout, using the existing printMessage function of your ‘message_driver’ library.</p>

                    <div class="CodeRay">
                        <div class="code"><pre><span style="color:#088;font-weight:bold">void</span> Task::updateHook()
{
    TaskBase::updateHook();

    message_driver::Message message;
    _messages.read(message);

    mpMessageDriver-&gt;printMessage(message);
}
</pre></div>
                    </div>

                    <p>Build your component with:</p>
                    <pre>$ amake</pre>
                    <br/>
                    <h2 id="connecting-multiple-components">Connecting multiple components</h2>

                    <p>You have designed a component that produces messages and a component that consumes messages. To connect them, you will use the Ruby scripting interface. Create a file start.rb in your consumer component’s script folder (you will have to create the folder first) with the following content: </p>

                    <div class="CodeRay">
                        <div class="code"><pre>require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">orocos</span><span style="color:#710">'</span></span>
require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">readline</span><span style="color:#710">'</span></span>

include <span style="color:#036;font-weight:bold">Orocos</span>
<span style="color:#036;font-weight:bold">Orocos</span>.initialize


<span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer::Task</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span>,
    <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_consumer::Task</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_consumer</span><span style="color:#710">'</span></span> <span style="color:#080;font-weight:bold">do</span>

  message_producer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span>
  message_consumer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_consumer</span><span style="color:#710">'</span></span>

  <span style="color:#777"># Never assume that a component supports being reconnected</span>
  <span style="color:#777"># at runtime, it might not be the case</span>
  <span style="color:#777">#</span>
  <span style="color:#777"># If you have the choice, connect before the component is</span>
  <span style="color:#777"># even configured</span>
  message_producer.messages.connect_to message_consumer.messages

  message_producer.configure
  message_producer.start

  message_consumer.start

  <span style="color:#036;font-weight:bold">Readline</span>::readline(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Press ENTER to exit</span><span style="color:#b0b">\n</span><span style="color:#710">"</span></span>) <span style="color:#080;font-weight:bold">do</span>
  <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
                    </div>

                    <p>The call to ‘connect_to’ for an output port allows you to connect it with an input port. By default a data connection is created, but you can also specify the type of your connection explicitly. Check the <a href="../runtime/ports.html">documentation</a> for more details on that topic. </p>
                    <br/>
                    <h3 id="run-it">Run it</h3>

                    <p>Run your ruby script</p>

                    <div class="CodeRay">
                        <div class="code"><pre>ruby start.rb
</pre></div>
                    </div>

                    <p>If everything has been done correctly, you will eventually see the consumer printing messages to the console, in the periodicity you set on the message producer: </p>

                    <div class="CodeRay">
                        <div class="code"><pre>[<span style="color:#00D">20110803</span>-<span style="color:#00D">10</span>:<span style="color:#00D">59</span>:<span style="color:#00D">55</span>:<span style="color:#00D">068</span>] Message from MessageDriver
[<span style="color:#00D">20110803</span>-<span style="color:#00D">10</span>:<span style="color:#00D">59</span>:<span style="color:#00D">56</span>:<span style="color:#00D">068</span>] Message from MessageDriver
[<span style="color:#00D">20110803</span>-<span style="color:#00D">10</span>:<span style="color:#00D">59</span>:<span style="color:#00D">57</span>:<span style="color:#00D">068</span>] Message from MessageDriver
[<span style="color:#00D">20110803</span>-<span style="color:#00D">10</span>:<span style="color:#00D">59</span>:<span style="color:#00D">58</span>:<span style="color:#00D">068</span>] Message from MessageDriver
</pre></div>
                    </div>

                    <p>As usual, shut it down with CTRL+C. The script does the cleanup itself.</p>
                    <br/>
                    <h2 id="summary">Summary</h2>
                    <p>In this tutorial you have learned to: </p>

                    <ul>
                        <li>create a component that is triggered upon receiving incoming data, i.e. you know now how to design a port/data driven component</li>
                        <li>run two components using a single ruby script</li>
                        <li>connect two components by connecting an output and an input port with a default data connection</li>
                    </ul>

                </div>
            </div>

        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>