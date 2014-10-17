<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php">Introduction</a></li>
        <li class="active">Overview</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Overview</h1>
            <div class="content-form-page">
                <div class="row">
                    <div class="content2-container line-box">
                        <div class="content2-container-1col">
                            <p>Rock offers both a <strong>rich development environment</strong> and a collection of
                                <strong>ready-to-use packages</strong>. This documentation pages describe the development
                                environment as well as some important “core” libraries. For the package
                                documentation, got to the <a href="/pkg">package list</a></p>
                            <br/>
                            <h2 id="development-workflow">Development Workflow</h2>
                            <iframe src="http://player.vimeo.com/video/41603535" webkitallowfullscreen="1" mozallowfullscreen="1" allowfullscreen="1" width="480" frameborder="0" height="360">Vimeo Video</iframe>
                            <br/><br/>
                            <p>First and foremost, development in Rock always starts with <strong><a href="tutorials/100_basics_create_library.html">creating a
                                        library</a></strong>. As a guideline, this
                                library has to be independent of Rock’s component-based integration framework.
                                That’s right, even if you don’t use Rock’s tooling, <a href="packages/outside_of_rock.html">feel free to use its
                                    drivers and algorithms</a> Then, this library gets
                                integrated in <strong>oroGen</strong>, Rock’s component-oriented integration framework.</p>

                            <p>For runtime, network of Rock components are often setup and managed using <a href="http://ruby-lang.org">the
                                    Ruby programming language</a>. Bindings to Ruby allow to start
                                processes, start and stop components, connect them together and bind them to
                                user interfaces in a very flexible way.</p>

                            <p><a href="tutorials/index.html">Tutorials</a> will guide you through getting to grips with
                                the process, from a library to running network of components.</p>
                            <br/>
                            <h2 id="data-analysis">Data Analysis</h2>

                            <iframe src="http://player.vimeo.com/video/41586124" webkitallowfullscreen="1" mozallowfullscreen="1" allowfullscreen="1" width="480" frameborder="0" height="360">Vimeo Video</iframe>
                            <br/><br/>
                            <p>At this point, Rock offers extended support for runtime as well as offline data
                                analysis. <a href="data_analysis/index.html">Logging</a> is an integral part of the
                                development workflow: it can be used for post-mortem analysis as well as to
                                test components through log replay mechanisms. Then, <strong>Vizkit</strong> kicks in. is
                                both an oroGen-independent library of Qt-based widgets and OpenSceneGraph-based
                                3D visualizers, and a Ruby library that allows to seamlessly display both
                                logged and live data. Extending it with new widgets and visualizers is
                                straightforward.</p>
                            <br/>
                            <h2 id="advanced-system-management">Advanced System Management</h2>
                            <p>Finally, Rock gives you rock-roby, a <a href="system/index.html">model-based system management
                                    layer</a> which will allow you to manage complex networks of
                                components both at design and running time. Have a look first at the
                                <a href="system_management_tutorials">corresponding tutorials</a>.</p>
                            <br/>
                            <iframe src="http://www.youtube.com/embed/QKl_0pGIfqI" width="480" frameborder="0" height="360">Youtube Video</iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>