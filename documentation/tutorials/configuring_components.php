<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Configuring Components</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">


        <h1 class="active">Configure components</h1>

        <div class="content2-container line-box">
        <div class="content2-container-1col">



        <h2 id="abstract">Abstract</h2>

        <p>This tutorial will give you some handson experience on:</p>

        <ul>
            <li>how to add configuration support for your component</li>
            <li>how to embed configuration into the Ruby script</li>
        </ul>

        <p>Components and underlying libraries often need to be configured before starting them. This tutorial will teach you
            how to use oroGen component’s properties to map to your library configuration option, and how to add the functionality
            to the oroGen component. </p>

        <p>At the end of this tutorial, the component will look like:</p>
        <br/>
        <p class="align-center"><img src="images/120_producer_config.png" alt="Component Interface"></p>
        <br/>
        <p>Let’s go back inside the message driver library</p>

        <pre>acd message_driver</pre>
        <br/>
        <h2 id="configure-a-component">Configure a component</h2>
        <p>Some libraries will require configuration before you can use them, e.g. add a the following property to the MessageDriver library.
            Therefore, add the configuration object code to src/Config.hpp in the message
            driver library:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#579">#ifndef</span> _MESSAGE_DRIVER_CONFIG_HPP_
<span style="color:#579">#define</span> _MESSAGE_DRIVER_CONFIG_HPP_

<span style="color:#080;font-weight:bold">namespace</span> message_driver
{

<span style="color:#777">/**
* This configuration struct is a simple example of what you
* can do in order to wrap multiple configuration properties
* into a single object
*
* This way you can manage configuration properties by grouping
* them into struct, and you don't have to change the oroGen
* components interface when your configuration object changes
*/</span>
<span style="color:#080;font-weight:bold">struct</span> Config
{
        <span style="color:#0a8;font-weight:bold">bool</span> uppercase;

        Config()
            : uppercase(<span style="color:#069">false</span>)
        {
        }

};

}
<span style="color:#579">#endif</span> <span style="color:#777">// _MESSAGE_DRIVER_CONFIG_HPP_</span>
</pre></div>
        </div>

        <p>Then adapt the message driver class (in src/MessageDriver.cpp and
            src/MessageDriver.hpp)</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;message_driver/Message.hpp&gt;</span>
<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;message_driver/Config.hpp&gt;</span>
        ...

        <span style="color:#777">/**
        * MessageDriver configuration
        * \param config Configuration object
        */</span>
        MessageDriver(<span style="color:#088;font-weight:bold">const</span> Config&amp; config = Config());

        ...
<span style="color:#088;font-weight:bold">private</span>:
        Config mConfig;

</pre></div>
        </div>

        <div class="CodeRay">
            <div class="code"><pre>...
<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;algorithm&gt;</span>
...

Message MessageDriver::createMessage()
{
        Message msg(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Message from MessageDriver</span><span style="color:#710">"</span></span>);

        <span style="color:#080;font-weight:bold">if</span>(mConfig.uppercase)
            std::transform(msg.content.begin()
                     , msg.content.end()
                 , msg.content.begin()
                 , toupper);

        <span style="color:#080;font-weight:bold">return</span> msg;
}

...

MessageDriver::MessageDriver(<span style="color:#088;font-weight:bold">const</span> Config&amp; config)
        : mConfig(config)
{
}

...
</pre></div>
        </div>
        <br/>
        <h3 id="update-the-build-configuration">Update the build configuration</h3>

        <div class="CodeRay">
            <div class="code"><pre>rock_library(message_driver
    SOURCES MessageDriver.cpp
    HEADERS MessageDriver.hpp Message.hpp Config.hpp
    DEPS_PKGCONFIG base-types)
</pre></div>
        </div>
        <br/>
        <h3 id="embed-the-configuration-property-into-the-orogen-component">Embed the configuration property into the oroGen component</h3>

        <p>In order to embed the configuration property into the oroGen component, we will
            have to do the following steps:</p>

        <ol>
            <li><strong>declare</strong> the property in message_producer.orogen specification file</li>
            <li><strong>enable</strong> the PRE_OPERATIONAL state. This is done by adding
                needs_configuration in the task description in the orogen file and by
                uncommenting both configureHook and cleanupHook in tasks/Task.hpp and
                tasks/Task.cpp</li>
            <li><strong>move</strong> the construction/destruction of the driver from the task’s
                constructor and destructor into configureHook / cleanupHook</li>
        </ol>

        <p>The final version of the component’s code is in branch ‘with_config’ of basic_tutorials/orogen/message_producer (<em>git checkout with_config</em>). </p>

        <p><strong>(1)</strong> we modify the task description in the message_producer.orogen file.
            We add a property of the configuration type as follows (see also <a href="../orogen/task_interface.html">Task
                Interface</a>). <strong>(2)</strong> Since we want a specific configuration step, the new
            task should not be started without configuration, which can be set by adding the
            statement ‘need_configuration’.</p>

        <div class="CodeRay">
            <div class="code"><pre>import_types_from <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Config.hpp</span><span style="color:#710">"</span></span>

task_context <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Task</span><span style="color:#710">"</span></span> <span style="color:#080;font-weight:bold">do</span>
  needs_configuration

  property <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">config</span><span style="color:#710">"</span></span>, <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Config</span><span style="color:#710">"</span></span>

  ...
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p><strong>(2)</strong> we edit task/Task.hpp and activate the configureHook and the cleanupHook by
            uncommenting them:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#0a8;font-weight:bold">bool</span> configureHook();
<span style="color:#088;font-weight:bold">void</span> cleanupHook();
</pre></div>
        </div>

        <p><strong>(3)</strong> Finally, we remove the allocation and deallocation from the constructor and destructor, since it will be moved into the configureHook and the cleanupHook:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#0a8;font-weight:bold">bool</span> Task::configureHook()
{
    <span style="color:#080;font-weight:bold">if</span> (! TaskBase::configureHook())
        <span style="color:#080;font-weight:bold">return</span> <span style="color:#069">false</span>;

    message_driver::Config configuration = _config.get();
    mpMessageDriver = <span style="color:#080;font-weight:bold">new</span> message_driver::MessageDriver(configuration);

    <span style="color:#080;font-weight:bold">return</span> <span style="color:#069">true</span>;
}
</pre></div>
        </div>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#088;font-weight:bold">void</span> Task::cleanupHook()
{
    TaskBase::cleanupHook();

    <span style="color:#080;font-weight:bold">delete</span> mpMessageDriver;
}
</pre></div>
        </div>
        <br/>
        <h3 id="build-the-task">Build the task</h3>
        <p>Now, build the task, and be aware: it will fail!</p>

        <p>Assuming that you are in the message_producer folder or in one of its
            subfolders,</p>

        <div class="CodeRay">
            <div class="code"><pre>amake
</pre></div>
        </div>

        <p>Building the task fails, since some of the constructors need to be adapted to account for the configuration requirement. However, oroGen supports you with this tasks, since it always generates the latest task template *.hpp and *.cpp files into the templates folder.
            Thus copy the constructor from templates/task/Task.hpp and templates/task/Task.cpp to replace the current ones in tasks/Task.hpp and task.cpp. </p>

        <p>Finally your header and source file should contain the following constructors:</p>

        <div class="CodeRay">
            <div class="code"><pre>Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name = <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer::Task</span><span style="color:#710">"</span></span>);
Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name, RTT::ExecutionEngine* engine);
</pre></div>
        </div>

        <div class="CodeRay">
            <div class="code"><pre>Task::Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name)
    : TaskBase(name), mpMessageDriver(<span style="color:#00D">0</span>)
{
}

Task::Task(std::<span style="color:#0a8;font-weight:bold">string</span> <span style="color:#088;font-weight:bold">const</span>&amp; name, RTT::ExecutionEngine* engine)
    : TaskBase(name, engine), mpMessageDriver(<span style="color:#00D">0</span>)
{
}
</pre></div>
        </div>
        <br/>
        <h3 id="embedding-configuration-into-the-ruby-script">Embedding configuration into the ruby script</h3>

        <p>Now, copy ‘start.rb’ to a new file ‘configure.rb’ -
            you will reuse ‘start.rb’ at a later stage.
            Modify ‘configure.rb’ according to the following
            code block:</p>

        <div class="CodeRay">
            <div class="code"><pre>require <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">orocos</span><span style="color:#710">'</span></span>

include <span style="color:#036;font-weight:bold">Orocos</span>
<span style="color:#036;font-weight:bold">Orocos</span>.initialize

<span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer::Task</span><span style="color:#710">'</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span> <span style="color:#080;font-weight:bold">do</span>

    message_producer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">'</span><span style="color:#D20">message_producer</span><span style="color:#710">'</span></span>

    <span style="color:#777"># 'config' is the name of the property</span>
    message_producer.config <span style="color:#080;font-weight:bold">do</span> |p|
        p.uppercase = <span style="color:#069">true</span>
    <span style="color:#080;font-weight:bold">end</span>

    <span style="color:#777"># Call to configure is required for this component</span>
    <span style="color:#777"># since it has been generated with 'needs_configuration'</span>
    message_producer.configure
    message_producer.start

    reader = message_producer.messages.reader

    <span style="color:#080;font-weight:bold">while</span> <span style="color:#069">true</span>
        <span style="color:#080;font-weight:bold">if</span> msg = reader.read_new
            puts <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="background-color:hsla(0,0%,0%,0.07);color:black"><span style="font-weight:bold;color:#666">#{</span>msg.time<span style="font-weight:bold;color:#666">}</span></span><span style="color:#D20"> </span><span style="background-color:hsla(0,0%,0%,0.07);color:black"><span style="font-weight:bold;color:#666">#{</span>msg.content<span style="font-weight:bold;color:#666">}</span></span><span style="color:#710">"</span></span>
        <span style="color:#080;font-weight:bold">end</span>

        sleep <span style="color:#60E">0.5</span>
    <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>
        <br/>
        <h3 id="run-it">Run it</h3>

        <p>Now you can run the script. </p>

        <div class="CodeRay">
            <div class="code"><pre>ruby configure.rb
</pre></div>
        </div>

        <p>Again, you should see something similar to the following. You can switch
            between uppercase and mixed case printing by using your newly defined configuration options. With the script above you should see something like the following:</p>

        <div class="CodeRay">
            <div class="code"><pre>Wed Aug 03 09:40:28 +0200 2011 MESSAGE FROM MESSAGEDRIVER
Wed Aug 03 09:40:29 +0200 2011 MESSAGE FROM MESSAGEDRIVER
</pre></div>
        </div>

        <p>You can also try running the start.rb script. You will see, however, that the component will fail to start. Since you specified ‘needs_configuration’ in the component specification, it cannot be started without being configured beforehand.</p>
        <br/>
        <h3 id="use-a-configuration-file">Use a configuration file</h3>
        <p>Property values can be read from a file, what is especially handy in case of more properties to set. The configuration file is a yaml-file which organises the properties in a structured way. For the present example create a file e.g. <em>message_producer_config.yml</em> with the
            following content:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#606">config</span>:
    <span style="color:#606">uppercase</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">True</span></span>
</pre></div>
        </div>

        <p>Note that yaml uses intention for organizing the data. The script can now be changed to use this file. Instead of </p>

        <div class="CodeRay">
            <div class="code"><pre>    <span style="color:#777"># 'config' is the name of the property</span>
    message_producer.config <span style="color:#080;font-weight:bold">do</span> |p|
        p.uppercase = <span style="color:#069">true</span>
    <span style="color:#080;font-weight:bold">end</span>
</pre></div>
        </div>

        <p>put</p>

        <div class="CodeRay">
            <div class="code"><pre>    <span style="color:#777"># load property from configuration file</span>
    message_producer.apply_conf_file(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer_config.yml</span><span style="color:#710">"</span></span>)
</pre></div>
        </div>

        <p>The result when running the script should be the same as above. It is possible to
            have one configuration file per task context and then load the properties for each task
            from the corresponding file. Of course the properties in the file have to match the
            properties given in the orogen definition. A good way to create a proper configuration
            file is to generate such a file from the task model definition. To do so run the
            following command from the shell:</p>

        <div class="CodeRay">
            <div class="code"><pre>oroconf extract message_producer::Task --save message_producer.yml
</pre></div>
        </div>

        <p><em>oroconf</em> is the command to access the configuration of tasks. It can do more then
            extracting configruation files (<em>--help</em>) but we will stick to the command <em>extract</em>
            for now. The first argument after extract gives the task model which is the orogen
            name plus double colon plus task name. Behind <em>--save</em> the file is given to which the
            data should be written. You might note that there are some variations to the hand
            written file:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#f8f;background:#505"><span style="color:#f4f">---</span></span> <span style="color:#F00;background-color:#FAA">name:default</span>
<span style="color:#777"># no documentation available for this property</span>
<span style="color:#606">config</span>:
  <span style="color:#606">uppercase</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">0</span></span>
</pre></div>
        </div>

        <p>In this file <strong>uppercase</strong> is 0 which of course is <em>False</em> which is the default
            setting of the property (see configuration constructor). The comment in the second line
            would be the documentation string if the property would have one e.g. (brackets
            are necessary here since the doc is attached with a dot)</p>

        <div class="CodeRay">
            <div class="code"><pre>    property(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">config</span><span style="color:#710">"</span></span>,<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_driver/Config</span><span style="color:#710">"</span></span>)
        .doc(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Configuration for the message driver.</span><span style="color:#710">"</span></span>)
</pre></div>
        </div>

        <p>The first line is the name for the configuration. It is possible to have multiple
            configurations in one file which can be distinguished by their name. Think of a
            file called ‘message_producer_multi.yml’:</p>

        <div class="CodeRay">
            <div class="code"><pre><span style="color:#f8f;background:#505"><span style="color:#f4f">---</span></span> <span style="color:#F00;background-color:#FAA">name:default</span>
<span style="color:#777"># no documentation available for this property</span>
<span style="color:#606">config</span>:
  <span style="color:#606">uppercase</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">0</span></span>

<span style="color:#f8f;background:#505"><span style="color:#f4f">---</span></span> <span style="color:#F00;background-color:#FAA">name:uppercase</span>
<span style="color:#777"># no documentation available for this property</span>
<span style="color:#606">config</span>:
  <span style="color:#606">uppercase</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">1</span></span>
</pre></div>
        </div>

        <p>Then one can apply the uppercase configuration with</p>

        <div class="CodeRay">
            <div class="code"><pre>    <span style="color:#777"># load property from configuration file</span>
    message_producer.apply_conf_file(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer_multi.yml</span><span style="color:#710">"</span></span>,
        [<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">uppercase</span><span style="color:#710">"</span></span>])
</pre></div>
        </div>

        <p>For more information on configuration files have a look <a href="../runtime/configuration.html">here</a>.</p>
        <br/>
        <h2 id="summary">Summary</h2>
        <p>In this tutorial you have learned to: </p>

        <ul>
            <li>how to embed configuration into an oroGen component</li>
            <li>how to use the templates/ subfolder of an oroGen component</li>
            <li>how to set configuration properties for your component in a ruby script</li>
            <li>how to generate and use configuration files</li>
        </ul>

        <p>In the next tutorial you will learn how to create a data driven component and how to connect it
            with an existing component.</p>

        </div>
        </div>

        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>