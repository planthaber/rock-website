<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Introduction</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Introduction</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">
                    <h2 id="rock-tutorials">Rock Tutorials</h2>
                    <p>Welcome to the Rock tutorials. The tutorials are intended to allow practitioners and developers in the robotics field to start working with the Robot Construction Kit.
                        To get the most out of the tutorials, you should be familiar with basic software development in C++. The tutorials will not teach you C++ or software development in general, but they provide you with a guideline for developing components within Rock. </p>
                    <br/>
                    <h2 id="what-to-expect-from-the-basic-tutorials">What to expect from the basic tutorials</h2>
                    <p>The tutorials are structured as follows.
                        The first set of tutorials covers the basics for working with Rock, and will teach you on how to create a library, embed into an Orocos component using orogen, and finally deploy it, i.e. build and run.
                        Further, the tutorials will teach you how to examine your data, how to log data from your running components and view them afterwards.
                        The complete set is wrapped up by a holistic example ‘Rolling Rock’</p>
                    <br/>
                    <h2 id="quick-start">Quick Start.</h2>
                    <p>In order to start with the tutorial you require a minimal but working
                        installation of Rock. Just follow the installation procedure as described in the
                        <a href="<?=$basicUrl?>documentation/introduction/index.php?page=installation">step-by-step installation guide</a>.</p>

                    <p>To check if you are ready for your first tutorial open your console and enter ‘which rock-create-lib’ and verify that the command returns a full path to the ‘rock-create-lib’-script. </p>
                    <br/>
                    <h2 id="tutorials-outline">Tutorials Outline</h2>

                    <p>The tutorials work along a typical Rock-workflow, and will give you a guideline on how to approach building software for your robotic system.
                        The typical workflow starts with implementing functionality in a library, allowing for a framework independant implementation, and proceeds further to generating an orogen (thus framework specific) component, and gives you some details on how to enhance your data analysis using logging and data visualization (<a href="/documentation/orogen/index.html">more</a>).</p>

                    <p>The showcase example allows you to repeat a more complex example to deepen your knowledge of how to use Rock, while you can still pick dedicated topics from the advanced tutorials. </p>

                    <p><strong>Basics</strong></p>

                    <p>The basic tutorials cover how to get started: create new code, integrate it in
                        the build system and then in components.</p>

                    <ul>
                        <li><a href="index.php?page=creating_libraries">Create a C++ library package</a></li>
                        <li><a href="index.php?page=creating_components">Create a component</a></li>
                        <li><a href="index.php?page=configuring_components">Configure your components</a></li>
                        <li><a href="index.php?page=connecting_components">Run the components together</a></li>
                    </ul>

                    <p>If you want to know how to find and install packages have a look at the following:</p>

                    <ul>
                        <li><a href="index.php?page=installing_packages">Installing packages</a></li>
                    </ul>

                    <p>How to use logging:</p>

                    <ul>
                        <li><a href="index.php?page=view_data">Displaying data, logging and replay</a></li>
                    </ul>

                    <p><strong>Showcase Example</strong></p>

                    <p>This example covers, in principle, the same subjects as the basic tutorials,
                        but with a more complex (and more realistic) example. You will learn how to
                        browse and find components in the Rock component collection.</p>

                    <ul>
                        <li><a href="index.php?page=simulate_robot">Simple simulation of a robot</a> </li>
                        <li><a href="index.php?page=adding_joystick">Integrating a Joystick</a></li>
                        <li><a href="index.php?page=control_virtual_joystick">Integrating a Virtual Joystick (for those that don’t have a physical one)</a></li>
                    </ul>
                    <br/>
                    <h2 id="installing">Installing the tutorial results</h2>
                    <p>In case you don’t want to write all the package yourself, the Rock tutorials have been packaged so that you can easily retrieve them.
                        If you want to add the tutorials to your installation add the package set to
                        your autoproj/manifest.</p>

                    <p>autoproj/manifest should look like:</p>

                    <div class="CodeRay">
                        <div class="code"><pre>package_sets:
   - gitorious: rock-toolchain/package_set
   - gitorious: rock/package_set
   - gitorious: rock-tutorials/package_set

layout:
   - rock.base
   - rock.toolchain
   - rock.tutorials
</pre></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>