<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php?page=about_rock">About Rock</a></li>
        <li class="active">Relation to Others</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Relation to Others</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="whats-the-difference-with-the-orocos-toolchain">What’s the difference with the Orocos Toolchain?</h2>
                    <p>The Orocos Toolchain is the standard infrastructure required to build Orocos
                        components. It contains the Real-Time Toolkit, typeGen/oroGen code generators
                        and supportive components for deployment and task browsing.</p>

                    <p>The Rock toolchain is centered around the use of oroGen for component
                        writing, and the Ruby language for system deployment and data analysis. In
                        practice, what you get is:</p>

                    <ul>
                        <li>use Ruby scripts to start your components and monitor them</li>
                        <li>use a model-based tool for large-scale system deployment, and benefit from
                            its logging capabilities to do post-mortem analysis of system behavior.</li>
                        <li>use the data logger to log all data that your components generate, and use
                            Ruby scripts to analyze this load of data. Replay the data into components
                            for testing, or use the Rock UI to display it.</li>
                        <li>benefit from a large component repository</li>
                    </ul>

                    <div class="note note-success">
                        <p><strong>Important for existing Orocos users</strong> The development workflow in Rock does
                            not encourage the use of the Orocos deployer and the RTT scripting language.
                            Since they are both expensive to build, they are by default disabled when you
                            build the Rock toolchain. However:</p>

                        <ul>
                            <li>you can reenable OCL by removing the ‘ocl’ line in exclude_packages in autoproj/manifest</li>
                            <li>you can reenable the RTT scripting by changing PLUGINS_SCRIPTING_ENABLED from OFF
                                to ON in autoproj/overrides.rb</li>
                        </ul>
                    </div>
                    <br/>
                    <h2 id="how-does-rock-relate-to-the-robot-operating-system-ros">How does Rock relate to the Robot Operating System (ROS)?</h2>

                    <p>The <a href="http://ros.org">Robot Operating System</a> is similar to Rock in scope. It
                        provides tooling, drivers and modules (called nodes) to support the generation
                        of software for a wide variety of robots. While ROS started out to be mainly for
                        indoor service robotics, the module and driver base has extended to other
                        application areas recently. </p>

                    <p>Without giving a detailed comparison, we would like to point out a few points
                        with regard to differences in paradigm between ROS and Rock:</p>

                    <ul>
                        <li>
                            <p>ROS uses a topic based communication model, while Rock is connection based.
                                While topic based communication is possibly simpler to use in some
                                applications as it requires less management overhead, it also makes it harder
                                to control the flow of information in the system.</p>
                        </li>
                        <li>
                            <p>ROS does not require a formal model, while Rock modules are defined using
                                an abstract module description. Having a formal description of the module,
                                allows higher-level runtime tools the management of state and connections.</p>
                        </li>
                        <li>
                            <p>Real-time applications can easily be implemented in Rock since it is directly
                                based on the Orocos RTT. ROS also provides support for Orocos in real-time
                                domains, but requires special interfacing. </p>
                        </li>
                        <li>
                            <p>Rock has the policy to split between libraries and modules, so that
                                communication layer and functionality are separated. In this way, Rock plays
                                nice with other systems. This is also the case for the bigger libraries in
                                ROS like pcl and opencv, but does not seem to be a general policy.  </p>
                        </li>
                        <li>
                            <p>Rock can use normal C++ classes (with restrictions) as interface types,
                                while ROS requires a special compiler for the interface types. This makes
                                separation of functionality and communication easier, as most of the libraries
                                datatypes can be directly used for module communication.</p>
                        </li>
                        <li>
                            <p>Rock has native support for flexible module deployments. There is full
                                control over how modules get split up into processes to avoid process
                                boundaries for high interacting modules. This is also possible in ROS with the
                                help of Nodelets, but not as transparent.</p>
                        </li>
                        <li>
                            <p>ROS has been around longer than Rock, has a larger library of modules and is
                                more mature in its tooling.</p>
                        </li>
                    </ul>



                </div>
            </div>



        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>


