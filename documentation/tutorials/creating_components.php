<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Creating Components</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

        <h1 class="active">Creating components</h1>

        <div class="content2-container line-box">
        <div class="content2-container-1col">

        <h2 id="abstract">Abstract</h2>

        <p>This tutorial will give you some hands-on experience on:</p>

        <ul>
            <li>how to model an oroGen component and embed a library</li>
            <li>how to run a component</li>
        </ul>

        <p>If you don’t want to execute the following steps by yourself, the result can also be found in ‘~dev/tutorials’.
            For this tutorial it is assumed that your autoproj installation can be found in ~/dev.</p>

        <p>The component we want to create will <strong>integrate</strong> the functionality of the
            library developed <a href="<?=$basicUrl?>documentation/tutorials/index.php?page=creating_libraries">in the previous tutorial</a>, exposing that functionality into a
            system.</p>

        <p>The final component will look like:</p>
        <br/>
        <p class="align-center"><img src="images/110_producer_component.png" alt="Producer Component"></p>
        <br/>
        <p>This step-by-step tutorial will guide you through the process of:</p>

        <ul>
            <li>creating the oroGen component package</li>
            <li>declaring the component interface</li>
            <li>adding the necessary C++ code for the component to pull data from the
                message_driver library out to its output port.</li>
        </ul>
        <br/>
        <h2 id="creating-an-orogen-component">Creating an oroGen component</h2>
        <p>While Rock uses the Orocos Realtime Toolkit (Orocos RTT) to build its components upon, and uses the Orocos generation tool ‘oroGen’ to easily create so-called oroGen components. oroGen requires a component specification to generate a skeleton for you, which you can fill with the functionality you require.</p>

        <p>There are multiple advantages for using oroGen:</p>

        <ul>
            <li>one can get an overview of the components without having to look at the
                code, and without having to rely on up-to-date documentation</li>
            <li>you have the guarantee that your component(s) will be usable across the
                complete Rock toolchain, from simple command-line execution to advanced
                model-based system management</li>
        </ul>

        <p>This tutorial does not cover all details of Orocos components but you will find further information in the <a href="/documentation/orogen/index.html">oroGen documentation</a>.</p>

        <p>Similar to the creation of a library you start to create an oroGen component using the command ‘rock-create-orogen’. </p>

        <div class="CodeRay">
            <div class="code"><pre>~/dev$ rock-create-orogen tutorials/orogen/message_producer
</pre></div>
        </div>

        <p>You will see the same configuration dialog as when calling rock-create-lib.</p>

        <div class="CodeRay">
            <div class="code"><pre>------------------------------------------
We require some information to update the manifest.xml
------------------------------------------
Brief package description
(Press ENTER when finished):
Message producer component
Long description:
This component will produce simple, timestamped messages
Author:
New user
Author email:
new-user@rock-robotics.org
Url (optional):

Enter your dependencies as a comma separated list.
Press ENTER when finished:
tutorials/message_driver
</pre></div>
        </div>

        <p>As a convention, all oroGen components are created inside an orogen/ subfolder
            of the corresponding library category. In this tutorial, the library and oroGen
            packages are placed respectively in the tutorials/ and tutorials/orogen folders.
            Moreover, when an oroGen component is created to integrate a library, it is
            highly recommended to use the same name than the library (here:
            tutorials/message_producer and tutorials/orogen/message_producer).</p>
        <br/>
        <h3 id="define-tasks">Define tasks</h3>

        <p>The previous command creates a new folder ‘tutorials/orogen/message_producer’. Inside you find two files: manifest.xml and message_producer.orogen.
            The manifest.xml will have been filled with the information you provided already, but when you need to add additional dependencies to libraries or oroGen components you will have to edit manifest.xml directly. Since you want to use your newly created library, check that your library has been added as dependency.</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#070;font-weight:bold">&lt;depend</span> <span style="color:#b48">package</span>=<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">tutorials/message_driver</span><span style="color:#710">"</span></span> <span style="color:#070;font-weight:bold">/&gt;</span>
</pre></div>
        </div>

        <p>The message_producer.orogen is the specification file of the your new oroGen component, and allows you to define Orocos tasks.
            The goal is to create a component which produces messages at a rate of 1 Hz, so the component only requires an output port for messages. </p>

        <div class="CodeRay">
            <div class="code"><pre>name <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer</span><span style="color:#710">"</span></span>

using_library <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver</span><span style="color:#710">"</span></span>
import_types_from <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Message.hpp</span><span style="color:#710">"</span></span>

task_context <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Task</span><span style="color:#710">"</span></span> <span style="color:#080;font-weight:bold">do</span>
  output_port <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">messages</span><span style="color:#710">"</span></span>, <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Message</span><span style="color:#710">"</span></span>
  periodic(<span style="color:#60E">1.0</span>)
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p>The specification contains a number of statement with the following meaning:</p>

        <ul>
            <li>name: defines the name of the component</li>
            <li>using_library: tells oroGen that this component requires, i.e. needs to link against the ‘message_driver’ library</li>
            <li>import_types_from: tells oroGen to import all types in the given file</li>
            <li>task_context: everything within this block defines an Orocos task context
                model, including what input and output ports are required and a default value
                for the runtime execution schema (every 1.0 second in this case)</li>
        </ul>

        <p>The task has an output port called ‘messages’ of type ‘message_driver/Message’.
            This type is initially unknown to the component, but it can be found in the
            ‘Message.hpp’ header of the ‘message_driver’ library. the using_library
            statement tells oroGen only to look for a library of the given name and link it
            to any deployment.  In order to make types known to your component so that you
            can use them in the specification, you have to do this explicitly with the
            ‘import_types_from’ statement.</p>
        <br/>
        <h3 id="integration-into-the-build-system">Integration into the build system</h3>
        <p>To finalize the package creation, one has to run rock-create-orogen again, but
            this time without arguments and in the folder that contains the oroGen file.</p>

        <p>Then, you should add you component to the build system by adding the package to
            autproj/manifest’s layout section:</p>

        <div class="CodeRay">
            <div class="code"><pre>package_sets:
  - gitorious: rock-toolchain/package_set

# Layout. Note that the rock.base, rock.toolchain
# and orocos.toolchain sets are imported
# by other rock sets.
layout:
  - rock.base
  - rock.toolchain
  - tutorials/message_driver
  - tutorials/orogen/message_producer
</pre></div>
        </div>

        <p>And then call amake in the package’s folder.</p>

        <div class="CodeRay">
            <div class="code"><pre>amake
</pre></div>
        </div>

        <p>If you get an error here, you most likely have a syntax error, then please
            compare your files against the files in the tutorial package set.</p>
        <br/>
        <h3 id="writing-the-task">Writing the task</h3>
        <p>Now, that you have created the oroGen component you still have to embedd the functionality that message_driver provides, in order to achieve a proper message producing component. </p>

        <p>Calling ‘rock-create-orogen’ created several new files. For now, you only need to care about the files in the tasks/ subfolder and can safely ignore the templates folder for the moment. </p>

        <p>Within the subfolder ‘tasks’ of the created component you will find two files: ‘Task.hpp’ and ‘Task.cpp’. They contain the skeleton for the Orocos component that has been created. Within ‘Task.hpp’ you will find several commented so-called hook methods, and you have to uncomment the methods you want to define in your task. For this tutorial you uncomment the updateHook.
            (More information about this methods could be found <a href="../orogen/task_states.html">here</a>)</p>

        <p>To add the message_driver functionality, add a forward declaration for message_driver and add a message_driver::MessageDriver member to the Task.hpp:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#080;font-weight:bold">namespace</span> message_driver {
    <span style="color:#080;font-weight:bold">class</span> <span style="color:#B06;font-weight:bold">MessageDriver</span>;
}

<span style="color:#080;font-weight:bold">namespace</span> message_producer {
    <span style="color:#080;font-weight:bold">class</span> <span style="color:#B06;font-weight:bold">Task</span> : <span style="color:#088;font-weight:bold">public</span> TaskBase
    {
        <span style="color:#088;font-weight:bold">friend</span> <span style="color:#080;font-weight:bold">class</span> <span style="color:#B06;font-weight:bold">TaskBase</span>;
    <span style="color:#088;font-weight:bold">protected</span>:
        message_driver::MessageDriver* mpMessageDriver;
...
</pre></div>
        </div>

        <p>Add the the message driver creation to the task’s constructor and deallocation to the destructor.</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;message_driver/MessageDriver.hpp&gt;</span>
...

Task::Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name,
                 TaskCore::TaskState initial_state)
    : TaskBase(name, initial_state)
    , mpMessageDriver(<span style="color:#00D">0</span>)
{
    mpMessageDriver = <span style="color:#080;font-weight:bold">new</span> message_driver::MessageDriver();
}

Task::Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name, RTT::ExecutionEngine* engine,
                 TaskCore::TaskState initial_state)
    : TaskBase(name, engine, initial_state)
    , mpMessageDriver(<span style="color:#00D">0</span>)
{
    mpMessageDriver = <span style="color:#080;font-weight:bold">new</span> message_driver::MessageDriver();
}

Task::~Task()
{
    <span style="color:#080;font-weight:bold">delete</span> mpMessageDriver;
}
</pre></div>
        </div>

        <p>Also implement the updateHook, and make sure it is uncommented in the source and(!) the header file.
            Within the update hook the messages port is accessed, which is identified by the name given in the specification and an ‘_’ prefix. Since you specified the type for this port a ‘message_driver::Message’ can be written to the port. This update port is triggered at the rate that you specified in the the deployment section of the .orogen file.</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#088;font-weight:bold">void</span> Task::updateHook()
{
    TaskBase::updateHook();

    message_driver::Message msg = mpMessageDriver-&gt;createMessage();
    _messages.write(msg);
}
</pre></div>
        </div>

        <p>To build your first component call:</p>

        <div class="CodeRay">
            <div class="code"><pre>amake tutorials/orogen/message_producer
</pre></div>
        </div>

        <p>Or, assuming that you are in the message_producer folder or in one of its
            subfolders, you can use</p>

        <div class="CodeRay">
            <div class="code"><pre>amake
</pre></div>
        </div>
        <br/>
        <h2 id="run-it">Run it</h2>

        <p>Now, that you have a component ready to run, but probably want to see it running. Rock offers a ruby scripting interface for that purpose: <a href="../runtime/index.html">orocos.rb</a>
            So create a subfolder scripts in the message producer component and create a file start.rb.</p>

        <div class="CodeRay">
            <div class="code"><pre>require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">orocos</span><span style="color:#710">'</span></span>
include <span style="color:#036;font-weight:bold">Orocos</span>

<span style="color:#777">## Initialize orocos ##</span>
<span style="color:#036;font-weight:bold">Orocos</span>.initialize

<span style="color:#777">## Execute the task 'message_producer::Task' ##</span>
<span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer::Task</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span> <span style="color:#080;font-weight:bold">do</span>
  <span style="color:#777">## Get the task context##</span>
  message_producer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span>

  <span style="color:#777">## Start the tasks ##</span>
  message_producer.start

  reader = message_producer.messages.reader

  <span style="color:#080;font-weight:bold">while</span> <span style="color:#069">true</span>
      <span style="color:#080;font-weight:bold">if</span> msg = reader.read_new
          puts <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="background-color:hsla(0,0%,0%,0.07);color:black"><span style="font-weight:bold;color:#666">#{</span>msg.time<span style="font-weight:bold;color:#666">}</span></span><span style="color:#D20"> </span><span style="background-color:hsla(0,0%,0%,0.07);color:black"><span style="font-weight:bold;color:#666">#{</span>msg.content<span style="font-weight:bold;color:#666">}</span></span><span style="color:#710">"</span></span>
      <span style="color:#080;font-weight:bold">end</span>

      sleep <span style="color:#60E">0.1</span>
  <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p>This scripts starts a process for the task ‘message_producer’ (The second argument behind Orocos.run gives the name to access it in the Orocos.run body). Once the message_producer has been created, the task can be accessed using ‘Orocos.name_service.get’. Having the reference to the task context allows you to explicitly start the task. Run it using ruby. </p>

        <div class="CodeRay">
            <div class="code"><pre>ruby start.rb
</pre></div>
        </div>

        <p>The script prints only new messages that the producer provides. Since you set the periodicity to 1 second,  messages should show only every 1s. </p>

        <div class="CodeRay">
            <div class="code"><pre>Tue Aug 02 16:43:48 +0200 2011 Message from MessageDriver
Tue Aug 02 16:43:49 +0200 2011 Message from MessageDriver
</pre></div>
        </div>

        <p>Stop the script with CTRL+C. The script will stop the component process by
            itself, which would happen also if you had an error in the script itself.</p>
        <br/>
        <h2 id="summary">Summary</h2>
        <p>In this tutorial you have learned to: </p>

        <ul>
            <li>create a simple oroGen component</li>
            <li>how to embed a library into an oroGen component</li>
            <li>how to use Ruby to start oroGen components</li>
        </ul>

        <p>Now that you have a rough idea of what oroGen is and can do, we recommend that you have a look at the <a href="images/orogen_cheat_sheet.pdf">oroGen cheat sheet</a>.</p>

        <p>In the next tutorial you will learn how to add configuration options to your task.</p>

        </div>
        </div>


        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>